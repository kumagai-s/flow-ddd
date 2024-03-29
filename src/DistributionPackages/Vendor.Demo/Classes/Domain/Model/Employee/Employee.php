<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Employee;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Neos\Flow\Security\Account;
use Vendor\Demo\Domain\Model\Company\Company;
use Vendor\Demo\Domain\Model\Timestamp\Timestamp;

class Employee
{
    /**
     * @param EmployeeId              $id
     * @param Account                 $account
     * @param Company                 $company
     * @param EmployeeName            $name
     * @param EmployeeEmail           $email
     * @param EmployeeRole            $role
     * @param \DateTimeImmutable      $createdAt
     * @param \DateTimeImmutable|null $updatedAt
     * @param \DateTimeImmutable|null $deletedAt
     * @param Collection<Timestamp>   $timestamps
     */
    public function __construct(
        #[ORM\Column(type: 'guid')]
        private readonly EmployeeId $id,
        #[ORM\ManyToOne(targetEntity: Account::class)]
        private readonly Account $account,
        #[ORM\ManyToOne(targetEntity: Company::class)]
        private readonly Company $company,
        #[ORM\Column(type: 'string')]
        private EmployeeName $name,
        #[ORM\Column(type: 'string')]
        private EmployeeEmail $email,
        #[ORM\Column(type: 'string')]
        private EmployeeRole $role,
        #[ORM\Column(type: 'datetime')]
        private readonly \DateTimeImmutable $createdAt,
        #[ORM\Column(type: 'datetime')]
        private ?\DateTimeImmutable $updatedAt,
        #[ORM\Column(type: 'datetime')]
        private ?\DateTimeImmutable $deletedAt,
        #[ORM\OneToMany(targetEntity: Timestamp::class)]
        private readonly Collection $timestamps,
    ) {
    }

    public function id(): EmployeeId
    {
        return $this->id;
    }

    public function account(): Account
    {
        return $this->account;
    }

    public function company(): Company
    {
        return $this->company;
    }

    public function name(): EmployeeName
    {
        return $this->name;
    }

    public function changeName(EmployeeName $newName): void
    {
        $this->name = $newName;
    }

    public function email(): EmployeeEmail
    {
        return $this->email;
    }

    public function changeEmail(EmployeeEmail $newEmail): void
    {
        $this->email = $newEmail;
    }

    public function role(): EmployeeRole
    {
        return $this->role;
    }

    public function changeRole(EmployeeRole $newRole): void
    {
        $this->role = $newRole;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function changeUpdatedAt(\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function deletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function changeDeletedAt(\DateTimeImmutable $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

    public function timestamps(): Collection
    {
        return $this->timestamps;
    }

    public function clockIn(Timestamp $timestamp): void
    {
        $this->timestamps->add($timestamp);
    }
}
