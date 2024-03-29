<?php

declare(strict_types=1);

namespace Vendor\Demo\Infrastructure\Repository\Doctrine;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;
use Vendor\Demo\Domain\Model\Company\Company;

/**
 * @Flow\Scope("singleton")
 */
class CompanyRepository extends Repository
{
    public function create(Company $company): void
    {
        // TODO: Implement add() method.
    }
}
