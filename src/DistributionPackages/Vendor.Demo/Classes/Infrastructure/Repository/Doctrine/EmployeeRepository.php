<?php

declare(strict_types=1);

namespace Vendor\Demo\Infrastructure\Repository\Doctrine;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;
use Neos\Flow\Security\Account;
use Vendor\Demo\Domain\Model\Company\Company;
use Vendor\Demo\Domain\Model\Employee\Employee;

#[Flow\Scope('singleton')]
class EmployeeRepository extends Repository implements \Vendor\Demo\Domain\Repository\EmployeeRepository
{
    public const ENTITY_CLASSNAME = Employee::class;

    public function save(Employee $employee): void
    {
        $this->add($employee);
    }

    public function findByAccountAndCompany(Account $account, Company $company): ?Employee
    {
        return $this->createQuery()->matching(
            $this->createQuery()->equals('company', $company),
            $this->createQuery()->equals('email', $account->getAccountIdentifier()),
        )->execute()->getFirst();
    }
}
