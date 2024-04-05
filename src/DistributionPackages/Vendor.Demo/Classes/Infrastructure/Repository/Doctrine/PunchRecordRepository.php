<?php

declare(strict_types=1);

namespace Vendor\Demo\Infrastructure\Repository\Doctrine;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;
use Vendor\Demo\Domain\Model\PunchRecord\PunchRecord;

#[Flow\Scope('singleton')]
class PunchRecordRepository extends Repository implements \Vendor\Demo\Domain\Repository\PunchRecordRepository
{
    public function nextIdentity(): string
    {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }

    public function save(PunchRecord $punchRecord): void
    {
        $this->add($punchRecord);
    }
}
