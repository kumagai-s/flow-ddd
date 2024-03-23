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
        private readonly AccountId $id,
        private AccountEmail $email,
        private AccountPassword $password,
        private readonly \DateTimeImmutable $createdAt,
        private ?\DateTimeImmutable $updatedAt = null,
        private ?\DateTimeImmutable $deletedAt = null,
    ) {
    }

    public function id(): AccountId
    {
        return $this->id;
    }

    public function name(): AccountEmail
    {
        return $this->email;
    }

    public function password(): AccountPassword
    {
        return $this->password;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function deletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function changeEmail(AccountEmail $newEmail): void
    {
        $this->email = $newEmail;
    }

    public function changePassword(AccountPassword $newPassword): void
    {
        $this->password = $newPassword;
    }

    public function changeUpdatedAt(\DateTimeImmutable $newUpdatedAt): void
    {
        $this->updatedAt = $newUpdatedAt;
    }

    public function changeDeletedAt(\DateTimeImmutable $newDeletedAt): void
    {
        $this->deletedAt = $newDeletedAt;
    }
}
