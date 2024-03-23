<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Company;

use Vendor\Demo\Domain\Model\Employee\EmployeeId;

class Company
{
    /**
     * @param array<EmployeeId> $employees
     */
    public function __construct(
        private readonly CompanyId $id,
        private array $employees,
        private CompanyName $name,
        private readonly \DateTimeImmutable $createdAt,
        private ?\DateTimeImmutable $updatedAt = null,
        private ?\DateTimeImmutable $deletedAt = null,
    ) {
    }

    public function id(): CompanyId
    {
        return $this->id;
    }

    public function name(): CompanyName
    {
        return $this->name;
    }

    public function employees(): array
    {
        return $this->employees;
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

    public function addEmployee(EmployeeId $employeeId): void
    {
        $this->employees[] = $employeeId;
    }

    public function removeEmployee(EmployeeId $employeeId): void
    {
        $this->employees = array_filter($this->employees, fn (EmployeeId $id) => !$id->equals($employeeId));
    }

    public function hasEmployee(EmployeeId $employeeId): bool
    {
        return in_array($employeeId, $this->employees, true);
    }

    public function changeName(CompanyName $newName): void
    {
        $this->name = $newName;
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
