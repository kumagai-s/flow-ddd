<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Timestamp;

use Doctrine\ORM\Mapping as ORM;
use Neos\Flow\Annotations as Flow;
use Vendor\Demo\Domain\Model\Employee\Employee;

/**
 * @Flow\Entity
 */
class Timestamp
{
    /**
     * @param TimestampId             $id
     * @param Employee                $employee
     * @param TimestampType           $type
     * @param \DateTimeImmutable      $clockInAt
     * @param \DateTimeImmutable      $createdAt
     * @param \DateTimeImmutable|null $updatedAt
     */
    public function __construct(
        #[ORM\Column(type: 'guid')]
        private readonly TimestampId $id,
        #[ORM\ManyToOne(targetEntity: Employee::class)]
        private readonly Employee $employee,
        #[ORM\Column(type: 'string')]
        private TimestampType $type,
        #[ORM\Column(type: 'datetime')]
        private \DateTimeImmutable $clockInAt,
        #[ORM\Column(type: 'datetime')]
        private readonly \DateTimeImmutable $createdAt,
        #[ORM\Column(type: 'datetime')]
        private ?\DateTimeImmutable $updatedAt = null,
    ) {
    }

    public function id(): TimestampId
    {
        return $this->id;
    }

    public function employee(): Employee
    {
        return $this->employee;
    }

    public function type(): TimestampType
    {
        return $this->type;
    }

    public function clockInAt(): \DateTimeImmutable
    {
        return $this->clockInAt;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function changeType(TimestampType $type): void
    {
        $this->type = $type;
    }

    public function changeDatetime(\DateTimeImmutable $datetime): void
    {
        $this->clockInAt = $datetime;
    }

    public function changeUpdatedAt(\DateTimeImmutable $datetime): void
    {
        $this->updatedAt = $datetime;
    }
}
