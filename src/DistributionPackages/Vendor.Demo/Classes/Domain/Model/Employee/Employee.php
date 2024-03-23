<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Employee;

use Vendor\Demo\Domain\Model\Company\CompanyId;

class Employee
{
    public function __construct(
        private readonly EmployeeId $id,
        private readonly CompanyId $companyId,
        private EmployeeName $name,
        private EmployeeRole $role,
        private readonly \DateTimeImmutable $createdAt,
        private ?\DateTimeImmutable $updatedAt = null,
        private ?\DateTimeImmutable $deletedAt = null,
    ) {
    }

    public function id(): EmployeeId
    {
        return $this->id;
    }

    public function companyId(): CompanyId
    {
        return $this->companyId;
    }

    public function name(): EmployeeName
    {
        return $this->name;
    }

    public function role(): EmployeeRole
    {
        return $this->role;
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

    public function changeName(EmployeeName $newName): void
    {
        $this->name = $newName;
    }

    public function changeRole(EmployeeRole $newRole): void
    {
        $this->role = $newRole;
    }

    public function changeUpdatedAt(\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function changeDeletedAt(\DateTimeImmutable $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

    public function clockIn(\DateTimeImmutable $datetime): void
    {
        // ...
    }
}
