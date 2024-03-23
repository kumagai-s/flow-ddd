<?php
declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Employee;

class EmployeeRole
{
    const ROLE_EMPLOYEE = 'employee';
    const ROLE_MANAGER = 'manager';
    
    public static function employee(): self
    {
        return new self(self::ROLE_EMPLOYEE);
    }
    
    public static function manager(): self
    {
        return new self(self::ROLE_MANAGER);
    }
    
    public function __construct(
        private string $value,
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