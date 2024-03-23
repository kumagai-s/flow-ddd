<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Timestamp;

class Timestamp
{
    public function __construct(
        private readonly TimestampId $id,
        private TimestampType $type,
        private \DateTimeImmutable $clockInAt,
        private readonly \DateTimeImmutable $createdAt,
        private ?\DateTimeImmutable $updatedAt = null,
    ) {
    }

    public function id(): TimestampId
    {
        return $this->id;
    }

    public function type(): TimestampType
    {
        return $this->type;
    }

    public function clockInAt(): \DateTimeImmutable
    {
        return $this->clockInAt;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function changeType(TimestampType $type): void
    {
        $this->type = $type;
    }

    public function changeDatetime(\DateTimeImmutable $datetime): void
    {
        $this->clockInAt = $datetime;
    }

    public function changeUpdatedAt(\DateTimeImmutable $datetime): void
    {
        $this->updatedAt = $datetime;
    }
}
