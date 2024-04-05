<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Employee;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Neos\Flow\Annotations as Flow;
use Vendor\Demo\Domain\Model\Company\Company;
use Vendor\Demo\Domain\Model\PunchRecord\PunchRecord;
use Vendor\Demo\Domain\Model\PunchRecord\PunchRecordId;
use Vendor\Demo\Domain\Model\PunchRecord\PunchRecordType;

/**
 * @Flow\Entity
 */
class Employee
{
    #[ORM\ManyToOne(targetEntity: Company::class)]
    protected Company $company;

    #[ORM\OneToMany(targetEntity: PunchRecord::class)]
    protected Collection $punchRecords;

    /**
     * @param EmployeeId              $id
     * @param EmployeeName            $name
     * @param EmployeeEmail           $email
     * @param EmployeeRole            $role
     * @param \DateTimeImmutable      $createdAt
     * @param \DateTimeImmutable|null $updatedAt
     * @param \DateTimeImmutable|null $deletedAt
     */
    public function __construct(
        #[ORM\Column(type: 'guid')]
        private readonly EmployeeId $id,
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
    ) {
    }

    public function punchRecords(): Collection
    {
        return $this->punchRecords;
    }

    public function punchIn(
        PunchRecordId $punchRecordId,
        \DateTimeImmutable $punchInAt,
    ): PunchRecord {
        $prevPunchRecord = $this->punchRecords->last();

        if ($prevPunchRecord && $prevPunchRecord->type()->isPunchIn()) {
            $punchRecordType = PunchRecordType::punchOut();
        } else {
            $punchRecordType = PunchRecordType::punchIn();
        }

        return new PunchRecord(
            id: $punchRecordId,
            employeeId: $this->id,
            type: $punchRecordType,
            punchInAt: $punchInAt,
            createdAt: new \DateTimeImmutable(),
            updatedAt: null,
        );
    }

    public function id(): EmployeeId
    {
        return $this->id;
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
}
