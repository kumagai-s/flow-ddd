<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Department;

use Neos\Flow\Annotations as Flow;

/**
 * @Flow\Entity
 */
class Department
{
    public function __construct(
        private readonly DepartmentId $id,
        private DepartmentName $name,
        private readonly \DateTimeImmutable $createdAt,
        private ?\DateTimeImmutable $updatedAt,
        private ?\DateTimeImmutable $deletedAt,
    ) {
    }

    public function id(): DepartmentId
    {
        return $this->id;
    }

    public function name(): DepartmentName
    {
        return $this->name;
    }

    public function changeName(DepartmentName $newName): void
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

    public function deletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }
}
