<?php
namespace Espo\Custom\Services;

use Espo\ORM\Entity;
use Espo\Core\Exceptions\Error;
use Espo\Core\Exceptions\Forbidden;

class CEmployee extends \Espo\Core\Templates\Services\Base
{
    protected $attendanceService;
    protected $attendanceHistoryService;
    
    protected function init()
    {
        parent::init();
        $this->attendanceService = $this->getServiceFactory()->create('CAttendance');
        $this->attendanceHistoryService = $this->getServiceFactory()->create('CAttendanceHistory');
    }
    
    public function clockIn($data)
    {
        $user = $this->getUser();
        $employee = $this->getEmployeeByUser($user->id);
        
        if (!$employee) {
            throw new Error("Employee record not found for this user");
        }
        
        $today = date('Y-m-d');
        
        // Check if already clocked in today without clocking out
        $existingAttendance = $this->getEntityManager()
            ->getRepository('CAttendance')
            ->where([
                'employeeId' => $employee->id,
                'employeeType' => 'CEmployee',
                'date' => $today,
                'lastClockOut' => null
            ])
            ->findOne();
            
        if ($existingAttendance) {
            throw new Forbidden("You must clock out before clocking in again");
        }
        
        // Create or get today's attendance record
        $attendance = $this->getEntityManager()
            ->getRepository('CAttendance')
            ->where([
                'employeeId' => $employee->id,
                'employeeType' => 'CEmployee',
                'date' => $today
            ])
            ->findOne();
            
        if (!$attendance) {
            $attendance = $this->getEntityManager()->getEntity('CAttendance');
            $attendance->set([
                'employeeId' => $employee->id,
                'employeeType' => 'CEmployee',
                'date' => $today,
                'firstClockIn' => date('Y-m-d H:i:s'),
                'status' => 'Present'
            ]);
            $this->getEntityManager()->saveEntity($attendance);
        } else {
            // Update if this is first clock in of the day
            if (!$attendance->get('firstClockIn')) {
                $attendance->set('firstClockIn', date('Y-m-d H:i:s'));
                $this->getEntityManager()->saveEntity($attendance);
            }
        }
        
        // Create attendance history record
        $history = $this->getEntityManager()->getEntity('CAttendanceHistory');
        $history->set([
            'attendanceId' => $attendance->id,
            'employeeId' => $employee->id,
            'employeeType' => 'CEmployee',
            'actionType' => 'Clock In',
            'actionTime' => date('Y-m-d H:i:s'),
            'ipAddress' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'deviceInfo' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
        ]);
        
        $this->getEntityManager()->saveEntity($history);
        
        return [
            'status' => 'success',
            'message' => 'Clocked in successfully',
            'time' => date('Y-m-d H:i:s'),
            'attendance' => $attendance->getValueMap()
        ];
    }
    
    public function clockOut($data)
    {
        $user = $this->getUser();
        $employee = $this->getEmployeeByUser($user->id);
        
        if (!$employee) {
            throw new Error("Employee record not found for this user");
        }
        
        $today = date('Y-m-d');
        
        // Check if clocked in today
        $attendance = $this->getEntityManager()
            ->getRepository('CAttendance')
            ->where([
                'employeeId' => $employee->id,
                'employeeType' => 'CEmployee',
                'date' => $today
            ])
            ->findOne();
            
        if (!$attendance || !$attendance->get('firstClockIn')) {
            throw new Forbidden("You must clock in first before clocking out");
        }
        
        // Check if already clocked out
        if ($attendance->get('lastClockOut')) {
            throw new Forbidden("You have already clocked out today");
        }
        
        // Update attendance
        $attendance->set('lastClockOut', date('Y-m-d H:i:s'));
        
        // Calculate total hours
        $clockIn = new \DateTime($attendance->get('firstClockIn'));
        $clockOut = new \DateTime($attendance->get('lastClockOut'));
        $interval = $clockIn->diff($clockOut);
        $totalHours = $interval->h + ($interval->i / 60) + ($interval->s / 3600);
        
        $attendance->set('totalHours', round($totalHours, 2));
        $this->getEntityManager()->saveEntity($attendance);
        
        // Create attendance history record
        $history = $this->getEntityManager()->getEntity('CAttendanceHistory');
        $history->set([
            'attendanceId' => $attendance->id,
            'employeeId' => $employee->id,
            'employeeType' => 'CEmployee',
            'actionType' => 'Clock Out',
            'actionTime' => date('Y-m-d H:i:s'),
            'ipAddress' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'deviceInfo' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
        ]);
        
        $this->getEntityManager()->saveEntity($history);
        
        return [
            'status' => 'success',
            'message' => 'Clocked out successfully',
            'time' => date('Y-m-d H:i:s'),
            'totalHours' => $attendance->get('totalHours'),
            'attendance' => $attendance->getValueMap()
        ];
    }
    
    public function getAttendanceHistory()
    {
        $user = $this->getUser();
        $employee = $this->getEmployeeByUser($user->id);
        
        if (!$employee) {
            throw new Error("Employee record not found for this user");
        }
        
        $attendances = $this->getEntityManager()
            ->getRepository('CAttendance')
            ->where([
                'employeeId' => $employee->id,
                'employeeType' => 'CEmployee'
            ])
            ->order('date', 'DESC')
            ->limit(0, 30)
            ->find();
            
        $result = [];
        foreach ($attendances as $attendance) {
            $history = $this->getEntityManager()
                ->getRepository('CAttendanceHistory')
                ->where([
                    'attendanceId' => $attendance->id
                ])
                ->order('actionTime', 'ASC')
                ->find();
                
            $historyData = [];
            foreach ($history as $record) {
                $historyData[] = $record->getValueMap();
            }
            
            $attendanceData = $attendance->getValueMap();
            $attendanceData['history'] = $historyData;
            $result[] = $attendanceData;
        }
        
        return $result;
    }
    
    protected function getEmployeeByUser($userId)
    {
        return $this->getEntityManager()
            ->getRepository('CEmployee')
            ->join('users')
            ->where([
                'users.id' => $userId
            ])
            ->findOne();
    }
}