<?php

declare(strict_types=1);

namespace Vendor\Demo\Infrastructure\Repository\Doctrine;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;
use Vendor\Demo\Domain\Model\Department\Department;

/**
 * @Flow\Scope("singleton")
 */
class DepartmentRepository extends Repository
{
    public function create(Department $department): void
    {
        // TODO: Implement add() method.
    }
}
