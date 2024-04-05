<?php

declare(strict_types=1);

namespace Vendor\Demo\Infrastructure\Repository\Doctrine;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;
use Neos\Flow\Security\Account;
use Vendor\Demo\Domain\Model\Company\Company;
use Vendor\Demo\Domain\Model\Company\CompanyId;

#[Flow\Scope('singleton')]
class CompanyRepository extends Repository implements \Vendor\Demo\Domain\Repository\CompanyRepository
{
    public function nextIdentity(): string
    {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }

    public function save(Company $company): void
    {
        $this->add($company);
    }

    public function find(CompanyId $id): ?Company
    {
        return $this->createQuery()->matching(
            $this->createQuery()->equals('id', $id)
        )->execute()->getFirst();
    }

    public function findByAccount(Account $account): ?Company
    {
        return $this->createQuery()->matching(
            $this->createQuery()->contains('accounts', $account)
        )->execute()->getFirst();
    }
}
