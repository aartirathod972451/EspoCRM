<?php

namespace Espo\Custom\Services;

use Espo\Core\Acl;
use Espo\Entities\User;
use Espo\ORM\EntityManager;

/**
 * CAttendance service
 *
 * Notes:
 * - Do NOT use $this->getUser() in backend services. Inject the current User via DI.
 * - This class is a plain PHP service wired by Espo's DI container.
 * - Controller should receive this service via constructor injection.
 *
 * @see https://docs.espocrm.com/development/services/
 * @see https://forum.espocrm.com/forum/developer-help/86883-logged-in-user
 */
class CAttendance
{
    public function __construct(
        private EntityManager $entityManager,
        private Acl $acl,
        private User $user
    ) {
    }

    /**
     * Clock In Action
     *
     * @param array|null $data
     * @return array<string,mixed>
     */
    public function clockIn($data = null): array
    {
        $user   = $this->user;
        $userId = $user->getId();
        $today  = date('Y-m-d');
        $now    = date('Y-m-d H:i:s');

        // CHECK 1: Verify if user has Employee Role
        if (!$this->userHasEmployeeRole($user)) {
            return [
                'status'     => 'error',
                'message'    => '❌ You are not an Employee. Only employees can clock in.',
                'isEmployee' => false,
            ];
        }

        // Get employee record
        $employee = $this->getEmployeeByUser($userId);

        // If no employee record exists, create one automatically
        if (!$employee) {
            $employee = $this->createEmployeeFromUser($user);
            if (!$employee) {
                return [
                    'status'     => 'error',
                    'message'    => '❌ Could not create employee record. Please contact HR.',
                    'isEmployee' => true,
                ];
            }
        }

        // CHECK 2: Find today's attendance record
        $attendance = $this->entityManager
            ->getRDBRepository('CAttendance')
            ->where([
                'employeeId'   => $employee->getId(),
                'employeeType' => 'CEmployee',
                'date'         => $today,
            ])
            ->findOne();

        // CHECK 3: If no attendance record exists for today - FIRST CLOCK IN
        if (!$attendance) {
            // Create NEW attendance record (first clock in of the day)
            $attendance = $this->entityManager->getNewEntity('CAttendance');
            $attendance->set([
                'employeeId'    => $employee->getId(),
                'employeeType'  => 'CEmployee',
                'employeeName'  => $employee->get('name'),
                'date'          => $today,
                'firstClockIn'  => $now,
                'status'        => 'Present',
                'name'          => $employee->get('name') . ' - ' . $today,
            ]);

            $this->entityManager->saveEntity($attendance);

            // Create attendance history record (FIRST clock in history)
            $history = $this->entityManager->getNewEntity('CAttendanceHistory');
            $history->set([
                'attendanceId' => $attendance->getId(),
                'employeeId'   => $employee->getId(),
                'employeeType' => 'CEmployee',
                'actionType'   => 'Clock In',
                'actionTime'   => $now,
                'ipAddress'    => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
                'deviceInfo'   => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
            ]);

            $this->entityManager->saveEntity($history);

            return [
                'status'        => 'success',
                'message'       => '✅ Clocked In Successfully! (First clock in today)',
                'time'          => date('h:i:s A'),
                'date'          => $today,
                'attendanceId'  => $attendance->getId(),
                'isEmployee'    => true,
                'clockInCount'  => 1,
            ];
        }

        // CHECK 4: Attendance record exists - Check if already clocked out
        if ($attendance->get('lastClockOut')) {
            return [
                'status'       => 'error',
                'message'      => '❌ You have already clocked out today. Cannot clock in again.',
                'isEmployee'   => true,
                'isClockedOut' => true,
            ];
        }

        // CHECK 5: Already clocked in today (no clock out yet)
        // This is an ADDITIONAL clock in - only create history record
        // DO NOT update firstClockIn or lastClockOut

        // Create attendance history record (ADDITIONAL clock in)
        $history = $this->entityManager->getNewEntity('CAttendanceHistory');
        $history->set([
            'attendanceId' => $attendance->getId(),
            'employeeId'   => $employee->getId(),
            'employeeType' => 'CEmployee',
            'actionType'   => 'Clock In',
            'actionTime'   => $now,
            'ipAddress'    => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
            'deviceInfo'   => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
        ]);

        $this->entityManager->saveEntity($history);

        // Count total clock ins today
        $clockInCount = $this->entityManager
            ->getRDBRepository('CAttendanceHistory')
            ->where([
                'attendanceId'  => $attendance->getId(),
                'actionType'    => 'Clock In',
                'actionTime>='  => $today . ' 00:00:00',
                'actionTime<='  => $today . ' 23:59:59',
            ])
            ->count();

        return [
            'status'        => 'success',
            'message'       => '✅ Additional Clock In recorded! (#' . $clockInCount . ' today)',
            'time'          => date('h:i:s A'),
            'date'          => $today,
            'attendanceId'  => $attendance->getId(),
            'isEmployee'    => true,
            'clockInCount'  => $clockInCount,
        ];
    }

    /**
     * Clock Out Action
     *
     * @param array|null $data
     * @return array<string,mixed>
     */
    public function clockOut($data = null): array
    {
        $user   = $this->user;
        $userId = $user->getId();
        $today  = date('Y-m-d');
        $now    = date('Y-m-d H:i:s');

        // CHECK 1: Verify if user has Employee Role
        if (!$this->userHasEmployeeRole($user)) {
            return [
                'status'     => 'error',
                'message'    => '❌ You are not an Employee. Only employees can clock out.',
                'isEmployee' => false,
            ];
        }

        // Get employee record
        $employee = $this->getEmployeeByUser($userId);

        if (!$employee) {
            return [
                'status'     => 'error',
                'message'    => '❌ Employee record not found. Please contact HR.',
                'isEmployee' => true,
            ];
        }

        // Find today's attendance
        $attendance = $this->entityManager
            ->getRDBRepository('CAttendance')
            ->where([
                'employeeId'   => $employee->getId(),
                'employeeType' => 'CEmployee',
                'date'         => $today,
            ])
            ->findOne();

        if (!$attendance) {
            return [
                'status'     => 'error',
                'message'    => '❌ No clock-in record found for today. Please clock in first.',
                'isEmployee' => true,
            ];
        }

        if ($attendance->get('lastClockOut')) {
            return [
                'status'     => 'error',
                'message'    => '❌ You have already clocked out today.',
                'isEmployee' => true,
            ];
        }

        // Update attendance with clock out time
        $attendance->set('lastClockOut', $now);

        // Calculate total hours
        $clockIn  = new \DateTime($attendance->get('firstClockIn'));
        $clockOut = new \DateTime($now);
        $interval = $clockIn->diff($clockOut);
        $totalHours = $interval->h + ($interval->i / 60) + ($interval->s / 3600);
        $totalHours = round($totalHours, 2);

        $attendance->set('totalHours', $totalHours);
        $this->entityManager->saveEntity($attendance);

        // Create attendance history record for clock out
        $history = $this->entityManager->getNewEntity('CAttendanceHistory');
        $history->set([
            'attendanceId' => $attendance->getId(),
            'employeeId'   => $employee->getId(),
            'employeeType' => 'CEmployee',
            'actionType'   => 'Clock Out',
            'actionTime'   => $now,
            'ipAddress'    => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
            'deviceInfo'   => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
        ]);

        $this->entityManager->saveEntity($history);

        // Count total clock outs today
        $clockOutCount = $this->entityManager
            ->getRDBRepository('CAttendanceHistory')
            ->where([
                'attendanceId' => $attendance->getId(),
                'actionType'   => 'Clock Out',
                'actionTime>=' => $today . ' 00:00:00',
                'actionTime<=' => $today . ' 23:59:59',
            ])
            ->count();

        return [
            'status'        => 'success',
            'message'       => '✅ Clocked Out Successfully! (#' . $clockOutCount . ' today)',
            'time'          => date('h:i:s A'),
            'totalHours'    => $totalHours,
            'attendanceId'  => $attendance->getId(),
            'isEmployee'    => true,
            'clockOutCount' => $clockOutCount,
        ];
    }

    /**
     * Get Today's Status
     *
     * @return array<string,mixed>
     */
    public function getTodayStatus(): array
    {
        $user   = $this->user;
        $userId = $user->getId();
        $today  = date('Y-m-d');

        // Check if user has Employee Role
        $isEmployee = $this->userHasEmployeeRole($user);

        if (!$isEmployee) {
            return [
                'isEmployee'  => false,
                'message'     => 'You are not an Employee',
                'canClockIn'  => false,
                'canClockOut' => false,
                'date'        => $today,
            ];
        }

        // Get employee record
        $employee = $this->getEmployeeByUser($userId);

        if (!$employee) {
            return [
                'isEmployee'        => true,
                'hasEmployeeRecord' => false,
                'message'           => 'Employee record not found',
                'canClockIn'        => false,
                'canClockOut'       => false,
                'date'              => $today,
            ];
        }

        // Find today's attendance
        $attendance = $this->entityManager
            ->getRDBRepository('CAttendance')
            ->where([
                'employeeId'   => $employee->getId(),
                'employeeType' => 'CEmployee',
                'date'         => $today,
            ])
            ->findOne();

        $isClockedIn  = $attendance && $attendance->get('firstClockIn') ? true : false;
        $isClockedOut = $attendance && $attendance->get('lastClockOut') ? true : false;

        // Count clock ins and outs today
        $clockInCount  = 0;
        $clockOutCount = 0;

        if ($attendance) {
            $clockInCount = $this->entityManager
                ->getRDBRepository('CAttendanceHistory')
                ->where([
                    'attendanceId' => $attendance->getId(),
                    'actionType'   => 'Clock In',
                    'actionTime>=' => $today . ' 00:00:00',
                ])
                ->count();

            $clockOutCount = $this->entityManager
                ->getRDBRepository('CAttendanceHistory')
                ->where([
                    'attendanceId' => $attendance->getId(),
                    'actionType'   => 'Clock Out',
                    'actionTime>=' => $today . ' 00:00:00',
                ])
                ->count();
        }

        return [
            'isEmployee'     => true,
            'hasEmployeeRecord' => true,
            'isClockedIn'    => $isClockedIn,
            'isClockedOut'   => $isClockedOut,
            'clockInCount'   => $clockInCount,
            'clockOutCount'  => $clockOutCount,
            'canClockIn'     => !$isClockedOut,
            'canClockOut'    => $isClockedIn && !$isClockedOut,
            'attendance'     => $attendance ? $attendance->getValueMap() : null,
            'employeeName'   => $employee->get('name'),
            'date'           => $today,
            'firstClockIn'   => $attendance ? $attendance->get('firstClockIn') : null,
            'lastClockOut'   => $attendance ? $attendance->get('lastClockOut') : null,
            'totalHours'     => $attendance ? $attendance->get('totalHours') : 0,
        ];
    }

    /**
     * Helper: Get employee by user ID
     *
     * @param string $userId
     * @return \Espo\ORM\Entity|null
     */
    protected function getEmployeeByUser($userId)
    {
        if (!$this->entityManager->hasRepository('CEmployee')) {
            return null;
        }

        try {
            $employee = $this->entityManager
                ->getRDBRepository('CEmployee')
                ->join('users')
                ->where([
                    'users.id' => $userId,
                ])
                ->findOne();

            return $employee;
        } catch (\Exception $e) {
            $GLOBALS['log']->error('Error fetching employee: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Helper: Create employee from user
     *
     * @param User $user
     * @return \Espo\ORM\Entity|null
     */
    protected function createEmployeeFromUser(User $user)
    {
        if (!$this->entityManager->hasRepository('CEmployee')) {
            return null;
        }

        try {
            $employee = $this->entityManager->getNewEntity('CEmployee');
            $employee->set([
                'name'            => $user->get('name'),
                'firstName'       => $user->get('firstName'),
                'lastName'        => $user->get('lastName'),
                'emailAddress'    => $user->get('emailAddress'),
                'employeeNumber'  => 'EMP' . date('Ymd') . rand(100, 999),
                'employmentStatus'=> 'Active',
                'usersIds'        => [$user->getId()],
            ]);

            $this->entityManager->saveEntity($employee);
            return $employee;
        } catch (\Exception $e) {
            $GLOBALS['log']->error('Error creating employee: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Helper: Check if user has Employee Role
     *
     * @param User $user
     * @return bool
     */
    protected function userHasEmployeeRole(User $user): bool
    {
        if ($user->isAdmin()) {
            return false; // Admin is NOT an employee
        }

        try {
            $userRoles = $user->getLinkMultipleIdList('roles');
            if (empty($userRoles)) {
                return false;
            }

            $employeeRole = $this->entityManager
                ->getRDBRepository('Role')
                ->where([
                    'id'   => $userRoles,
                    'name' => 'Employee Role',
                ])
                ->findOne();

            return (bool) $employeeRole;
        } catch (\Exception $e) {
            $GLOBALS['log']->error('Error checking role: ' . $e->getMessage());
            return false;
        }
    }
}