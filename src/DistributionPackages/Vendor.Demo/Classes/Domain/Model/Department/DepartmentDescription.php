<?php

namespace Vendor\Demo\Domain\Model\Department;

use Neos\Flow\Annotations as Flow;

/**
 * @Flow\ValueObject
 */
class DepartmentDescription
{
    public function __construct(
        private readonly string $value,
    ) {
        if (empty($value)) {
            throw new \InvalidArgumentException('User name cannot be empty');
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(DepartmentDescription $other): bool
    {
        return $this->value === $other->value();
    }
}
