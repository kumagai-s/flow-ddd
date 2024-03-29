<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Employee;

use Neos\Flow\Annotations as Flow;

/**
 * @Flow\ValueObject
 */
class EmployeeId
{
    public function __construct(
        private readonly string $value,
    ) {
        if (empty($value)) {
            throw new \InvalidArgumentException('User name cannot be empty');
        }
    }

    public function equals(EmployeeId $other): bool
    {
        return $this->value === $other->value;
    }
}
