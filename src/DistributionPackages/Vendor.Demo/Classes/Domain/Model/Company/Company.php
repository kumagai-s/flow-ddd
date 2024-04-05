<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Company;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Security\Account;
use Vendor\Demo\Domain\Model\Department\Department;
use Vendor\Demo\Domain\Model\Department\DepartmentId;
use Vendor\Demo\Domain\Model\Department\DepartmentName;
use Vendor\Demo\Domain\Model\Employee\Employee;
use Vendor\Demo\Domain\Model\Employee\EmployeeEmail;
use Vendor\Demo\Domain\Model\Employee\EmployeeId;
use Vendor\Demo\Domain\Model\Employee\EmployeeName;
use Vendor\Demo\Domain\Model\Employee\EmployeeRole;

/**
 * @Flow\Entity
 */
class Company
{
    #[ORM\ManyToMany(targetEntity: Account::class)]
    protected Collection $accounts;

    #[ORM\OneToMany(targetEntity: Department::class)]
    protected Collection $departments;

    #[ORM\OneToMany(targetEntity: Employee::class)]
    protected Collection $employees;

    /**
     * @param CompanyId               $id
     * @param CompanyName             $name
     * @param \DateTimeImmutable      $createdAt
     * @param \DateTimeImmutable|null $updatedAt
     * @param \DateTimeImmutable|null $deletedAt
     */
    public function __construct(
        #[ORM\Column(type: 'guid')]
        private readonly CompanyId $id,
        #[ORM\Column(type: 'string')]
        private CompanyName $name,
        #[ORM\Column(type: 'datetime')]
        private readonly \DateTimeImmutable $createdAt,
        #[ORM\Column(type: 'datetime')]
        private ?\DateTimeImmutable $updatedAt,
        #[ORM\Column(type: 'datetime')]
        private ?\DateTimeImmutable $deletedAt,
    ) {
    }

    public function accounts(): Collection
    {
        return $this->accounts;
    }

    public function addAccount(Account $account): void
    {
        if ($this->accounts->contains($account)) {
            return;
        }

        $this->accounts->add($account);
    }

    public function removeAccount(Account $account): void
    {
        $this->accounts->removeElement($account);
    }

    public function departments(): Collection
    {
        return $this->departments;
    }

    public function addDepartment(
        DepartmentId $id,
        DepartmentName $name,
    ): void {
        $department = new Department(
            id: $id,
            name: $name,
            createdAt: new \DateTimeImmutable(),
            updatedAt: null,
            deletedAt: null,
        );

        $this->departments->add($department);
    }

    public function removeDepartment(Department $department): void
    {
        $this->departments->removeElement($department);
    }

    public function employees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(
        EmployeeId $id,
        EmployeeName $name,
        EmployeeEmail $email,
        EmployeeRole $role,
    ): void {
        if ($this->employees->exists(fn (Employee $employee) => $employee->email()->equals($email))) {
            throw new \InvalidArgumentException('Employee already exists');
        }

        $employee = new Employee(
            id: $id,
            companyId: $this->id,
            name: $name,
            email: $email,
            role: $role,
            createdAt: new \DateTimeImmutable(),
            updatedAt: null,
            deletedAt: null,
        );

        // Todo: クライアントにメールを送信して、アカウントの登録を完了させる

        $this->employees->add($employee);
    }

    public function removeEmployee(Employee $employee): void
    {
        $this->employees->removeElement($employee);
    }

    public function id(): CompanyId
    {
        return $this->id;
    }

    public function name(): CompanyName
    {
        return $this->name;
    }

    public function changeName(CompanyName $newName): void
    {
        $this->name = $newName;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function changeUpdatedAt(\DateTimeImmutable $newUpdatedAt): void
    {
        $this->updatedAt = $newUpdatedAt;
    }

    public function deletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function changeDeletedAt(\DateTimeImmutable $newDeletedAt): void
    {
        $this->deletedAt = $newDeletedAt;
    }

    public function findEmployeeByAccount(Account $account): ?Employee
    {
        return $this->employees->findFirst(function (Employee $employee) use ($account) {
            return $employee->email()->equals(new EmployeeEmail($account->getAccountIdentifier()));
        });
    }
}
