<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Employee;

use Doctrine\ORM\Mapping as ORM;
use Neos\Flow\Annotations as Flow;

/**
 * @Flow\ValueObject
 */
class EmployeeName
{
    public function __construct(
        /**
         * @ORM\Column(name="name", type="string")
         *
         * @var string
         */
        protected string $value,
    ) {
        if (empty($value)) {
            throw new \InvalidArgumentException('User name cannot be empty');
        }
    }

    public function equals(EmployeeName $other): bool
    {
        return $this->value === $other->value;
    }
}
