<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Employee;

use Doctrine\ORM\Mapping as ORM;
use Neos\Flow\Annotations as Flow;

/**
 * @Flow\ValueObject
 */
class EmployeeEmail
{
    public function __construct(
        /**
         * @ORM\Column(name="email", type="string")
         *
         * @var string
         */
        protected string $value,
    ) {
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(EmployeeEmail $other): bool
    {
        return $this->value === $other->value();
    }
}
