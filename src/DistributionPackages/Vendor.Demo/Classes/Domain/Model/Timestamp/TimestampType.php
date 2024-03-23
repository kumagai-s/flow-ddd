<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Timestamp;

class TimestampType
{
    public function __construct(
        private readonly string $value,
    ) {
        if (empty($value)) {
            throw new \InvalidArgumentException('Punch time date cannot be empty');
        }
    }

    public function equals(TimestampType $other): bool
    {
        return $this->value === $other->value;
    }
}
