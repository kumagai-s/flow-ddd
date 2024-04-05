<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\PunchRecord;

use Doctrine\ORM\Mapping as ORM;
use Neos\Flow\Annotations as Flow;
use Vendor\Demo\Domain\Model\Employee\EmployeeId;

/**
 * @Flow\Entity
 */
class PunchRecord
{
    /**
     * @param PunchRecordId           $id
     * @param EmployeeId              $employeeId
     * @param PunchRecordType         $type
     * @param \DateTimeImmutable      $createdAt
     * @param \DateTimeImmutable|null $updatedAt
     */
    public function __construct(
        #[ORM\Column(type: 'guid')]
        private readonly PunchRecordId $id,
        #[ORM\Column(type: 'guid')]
        private readonly EmployeeId $employeeId,
        #[ORM\Column(type: 'string')]
        private PunchRecordType $type,
        #[ORM\Column(type: 'datetime')]
        private \DateTimeImmutable $punchInAt,
        #[ORM\Column(type: 'datetime')]
        private readonly \DateTimeImmutable $createdAt,
        #[ORM\Column(type: 'datetime')]
        private ?\DateTimeImmutable $updatedAt = null,
    ) {
    }

    public function id(): PunchRecordId
    {
        return $this->id;
    }

    public function type(): PunchRecordType
    {
        return $this->type;
    }

    public function punchInAt(): \DateTimeImmutable
    {
        return $this->punchInAt;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function changeType(PunchRecordType $type): void
    {
        $this->type = $type;
    }

    public function changePunchInAt(\DateTimeImmutable $datetime): void
    {
        $this->punchInAt = $datetime;
    }

    public function changeUpdatedAt(\DateTimeImmutable $datetime): void
    {
        $this->updatedAt = $datetime;
    }
}
