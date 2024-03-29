<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Company;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Neos\Flow\Annotations as Flow;
use Vendor\Demo\Domain\Model\Department\Department;
use Vendor\Demo\Domain\Model\Employee\Employee;

/**
 * @Flow\Entity
 */
class Company
{
    /**
     * @param CompanyId               $id
     * @param CompanyName             $name
     * @param \DateTimeImmutable      $createdAt
     * @param \DateTimeImmutable|null $updatedAt
     * @param \DateTimeImmutable|null $deletedAt
     * @param Collection<Department>  $departments
     * @param Collection<Employee>    $employees
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
        #[ORM\OneToMany(targetEntity: Department::class)]
        private readonly Collection $departments,
        #[ORM\OneToMany(targetEntity: Employee::class)]
        private readonly Collection $employees,
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

    public function departments(): Collection
    {
        return $this->departments;
    }

    public function addDepartment(Department $department): void
    {
        if ($department->company() !== $this) {
            return;
        }

        if ($this->departments->contains($department)) {
            return;
        }

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
}
