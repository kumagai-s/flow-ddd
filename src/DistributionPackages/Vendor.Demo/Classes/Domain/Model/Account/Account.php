<?php
declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Account;

use Neos\Flow\Annotations as Flow;

/**
 * @Flow\Entity
 */
class Account
{
    public function __construct(
        private AccountId       $id,
        private AccountEmail    $name,
        private AccountPassword $role,
    ) {}
    
    public function id(): AccountId
    {
        return $this->id;
    }

    public function name(): AccountEmail
    {
        return $this->name;
    }
}
