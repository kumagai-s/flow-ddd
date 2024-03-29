<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Company;

use Neos\Flow\Annotations as Flow;

/**
 * @Flow\ValueObject
 */
class CompanyName
{
    public function __construct(
        private readonly string $value,
    ) {
        if (empty($value)) {
            throw new \InvalidArgumentException('Company name cannot be empty');
        }
    }

    public function equals(CompanyName $other): bool
    {
        return $this->value === $other->value;
    }
}
