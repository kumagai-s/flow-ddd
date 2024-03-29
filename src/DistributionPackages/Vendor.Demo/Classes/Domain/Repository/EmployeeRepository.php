<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Repository;

use Vendor\Demo\Domain\Model\Company\CompanyId;
use Vendor\Demo\Domain\Model\Employee\Employee;

interface EmployeeRepository
{
    public function findByCompanyId(CompanyId $companyId): ?Employee;

    public function create(Employee $employee): void;
}
