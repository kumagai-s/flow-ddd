<?php

declare(strict_types=1);

namespace Vendor\Demo\Infrastructure\Repository\Doctrine;

/*
 * This file is part of the Neos.Welcome package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;
use Vendor\Demo\Domain\Model\Company\CompanyId;
use Vendor\Demo\Domain\Model\Employee\Employee;

/**
 * @Flow\Scope("singleton")
 */
class EmployeeRepository extends Repository
{
    public function findByCompanyId(CompanyId $companyId): ?Employee
    {
        return null;
    }

    public function create(Employee $employee): void
    {
        // TODO: Implement add() method.
    }
}
