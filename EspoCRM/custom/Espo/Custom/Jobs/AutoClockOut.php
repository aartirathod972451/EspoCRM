<?php
namespace Espo\Custom\Jobs;

class AutoClockOut extends \Espo\Core\Jobs\Base
{
    public function run()
    {
        $today = date('Y-m-d');
        
        // Find all attendances without clock out
        $attendances = $this->getEntityManager()
            ->getRepository('CAttendance')
            ->where([
                'date' => $today,
                'lastClockOut' => null
            ])
            ->find();
            
        foreach ($attendances as $attendance) {
            // Auto clock out at end of day
            $attendance->set('lastClockOut', date('Y-m-d 23:59:59'));
            
            // Calculate hours
            $clockIn = new \DateTime($attendance->get('firstClockIn'));
            $clockOut = new \DateTime($attendance->get('lastClockOut'));
            $interval = $clockIn->diff($clockOut);
            $totalHours = $interval->h + ($interval->i / 60);
            
            $attendance->set('totalHours', round($totalHours, 2));
            $attendance->set('status', 'Auto Clocked Out');
            
            $this->getEntityManager()->saveEntity($attendance);
            
            // Create history entry
            $history = $this->getEntityManager()->getEntity('CAttendanceHistory');
            $history->set([
                'attendanceId' => $attendance->id,
                'employeeId' => $attendance->get('employeeId'),
                'employeeType' => $attendance->get('employeeType'),
                'actionType' => 'Auto Clock Out',
                'actionTime' => date('Y-m-d 23:59:59'),
                'deviceInfo' => 'System Auto Clock Out'
            ]);
            
            $this->getEntityManager()->saveEntity($history);
        }
        
        return true;
    }
}