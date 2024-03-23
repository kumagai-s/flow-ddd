<?php
declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Employee;

use Vendor\Demo\Domain\Model\Company\CompanyId;
use Vendor\Demo\Domain\Model\Employee\EmployeeId;
use Vendor\Demo\Domain\Model\Employee\EmployeeName;
use Vendor\Demo\Domain\Model\Employee\EmployeeRole;


class Employee
{
    public function __construct(
        private EmployeeId $id,
        private CompanyId $companyId,
        private EmployeeName $name,
        private EmployeeRole $role,
    ) {}
    
    public function id(): EmployeeId
    {
        return $this->id;
    }
    
    public function name(): EmployeeName
    {
        return $this->name;
    }
    
    public function role(): EmployeeRole
    {
        return $this->role;
    }
    
    public function companyId(): CompanyId
    {
        return $this->companyId;
    }
}