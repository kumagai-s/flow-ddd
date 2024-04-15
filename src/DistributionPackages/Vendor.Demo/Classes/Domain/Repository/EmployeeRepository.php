<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Repository;

use Neos\Flow\Security\Account;
use Vendor\Demo\Domain\Model\Company\Company;
use Vendor\Demo\Domain\Model\Employee\Employee;

interface EmployeeRepository
{
    public function save(Employee $employee): void;

    public function findByAccountAndCompany(Account $account, Company $company): ?Employee;
}
