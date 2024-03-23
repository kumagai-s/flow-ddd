<?php
declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Timestamp;

class TimestampId
{
    public function __construct(
        private string $value,
    ) {
        if (empty($value)) {
            throw new \InvalidArgumentException('Punch time id cannot be empty');
        }
    }

    public function equals(TimestampId $other): bool
    {
        return $this->value === $other->value;
    }
}