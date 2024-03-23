<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Employee;

class EmployeeRole
{
    public const ROLE_EMPLOYEE = 'employee';
    public const ROLE_ADMIN = 'admin';

    public static function employee(): self
    {
        return new self(self::ROLE_EMPLOYEE);
    }

    public static function admin(): self
    {
        return new self(self::ROLE_ADMIN);
    }

    public function __construct(
        private readonly string $value,
    ) {
        if (empty($value)) {
            throw new \InvalidArgumentException('User name cannot be empty');
        }
    }

    public function equals(EmployeeRole $other): bool
    {
        return $this->value === $other->value;
    }
}
