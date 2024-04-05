<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Repository;

use Vendor\Demo\Domain\Model\PunchRecord\PunchRecord;

interface PunchRecordRepository
{
    public function nextIdentity(): string;

    public function save(PunchRecord $punchRecord): void;
}
