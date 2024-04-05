<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\PunchRecord;

use Neos\Flow\Annotations as Flow;

/**
 * @Flow\ValueObject
 */
class PunchRecordId
{
    public function __construct(
        private readonly string $value,
    ) {
        if (empty($value)) {
            throw new \InvalidArgumentException('Punch time id cannot be empty');
        }
    }

    public function equals(PunchRecordId $other): bool
    {
        return $this->value === $other->value;
    }
}
