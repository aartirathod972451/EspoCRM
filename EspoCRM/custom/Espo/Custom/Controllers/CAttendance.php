<?php
namespace Espo\Custom\Controllers;

use Espo\Core\Controllers\Record;
use Espo\Core\Api\Request;
use Espo\Core\Exceptions\Forbidden;
use Espo\Core\Exceptions\BadRequest;

class CAttendance extends Record
{
    public function postActionClockIn(Request $request): array
    {
        $user = $this->getUser();
        
        // FIX: Admin cannot clock in
        if (!$this->userHasEmployeeRole($user)) {
            throw new Forbidden("Only employees can clock in");
        }
        
        $data = $request->getParsedBody();
        
        /** @var \Espo\Custom\Services\CAttendance $service */
        $service = $this->getRecordService();
        
        return $service->clockIn($data);
    }
    
    public function postActionClockOut(Request $request): array
    {
        $user = $this->getUser();
        
        // FIX: Admin cannot clock out
        if (!$this->userHasEmployeeRole($user)) {
            throw new Forbidden("Only employees can clock out");
        }
        
        $data = $request->getParsedBody();
        
        /** @var \Espo\Custom\Services\CAttendance $service */
        $service = $this->getRecordService();
        
        return $service->clockOut($data);
    }
    
    public function getTodayStatus(): array
{
    $user = $this->getUser();
    
    // Check if user has Employee Role
    $isEmployee = $this->userHasEmployeeRole($user);
    
    if (!$isEmployee) {
        return [
            'isEmployee' => false,
            'message' => 'You are not an Employee',
            'canClockIn' => false,
            'canClockOut' => false,
            'date' => date('Y-m-d'),
            'todayStatus' => 'notEmployee'
        ];
    }
    
    // Rest of your logic...
    
    return [
        'isEmployee' => true,
        'message' => 'You are not an Employee',
        'canClockIn' => false,
        'canClockOut' => false,
        'date' => date('Y-m-d'),
        'todayStatus' => 'clockedOut'
        // ... other data
    ];
}
    
    /**
     * Helper: Check if user has Employee Role
     */
    private function userHasEmployeeRole($user)
    {
        // FIX: Admin is NOT an employee
        if ($user->isAdmin()) {
            return false;
        }
        
        // FIX: Use proper method to get roles
        $userRoles = $user->getLinkMultipleIdList('roles');
        if (empty($userRoles)) {
            return false;
        }
        
        // Check if any role is named "Employee Role"
        $roleRepository = $this->entityManager->getRDBRepository('Role');
        foreach ($userRoles as $roleId) {
            $role = $roleRepository->getById($roleId);
            if ($role && $role->get('name') === 'Employee Role') {
                return true;
            }
        }
        
        return false;
    }
}