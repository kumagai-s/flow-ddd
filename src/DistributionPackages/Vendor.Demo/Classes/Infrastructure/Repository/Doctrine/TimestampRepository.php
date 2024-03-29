<?php

declare(strict_types=1);

namespace Vendor\Demo\Infrastructure\Repository\Doctrine;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;
use Vendor\Demo\Domain\Model\Timestamp\Timestamp;

/**
 * @Flow\Scope("singleton")
 */
class TimestampRepository extends Repository
{
    public function create(Timestamp $timestamp): void
    {
        // TODO: Implement add() method.
    }
}
