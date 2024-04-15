<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Repository;

use Neos\Flow\Security\Account;
use Vendor\Demo\Domain\Model\Company\Company;
use Vendor\Demo\Domain\Model\Company\CompanyId;

interface CompanyRepository
{
    public function save(Company $company): void;

    public function find(CompanyId $id): ?Company;

    public function findByAccount(Account $account): ?Company;
}
