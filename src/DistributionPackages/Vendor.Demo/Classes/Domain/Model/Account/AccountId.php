<?php
declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Account;

class AccountId
{
    public function __construct(
        private string $value,
    ) {
        if (empty($value)) {
            throw new \InvalidArgumentException('User name cannot be empty');
        }
    }

    public function equals(AccountId $other): bool
    {
        return $this->value === $other->value;
    }
}