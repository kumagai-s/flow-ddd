<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\PunchRecord;

use Doctrine\ORM\Mapping as ORM;
use Neos\Flow\Annotations as Flow;
use Vendor\Demo\Domain\Model\Employee\Employee;

/**
 * @Flow\Entity
 *
 * @ORM\Table(name="punch_records")
 */
class PunchRecord
{
    /**
     * @ORM\ManyToOne(targetEntity=Employee::class, inversedBy="punchRecords")
     *
     * @ORM\JoinColumn(name="employee_id")
     */
    protected Employee $employee;

    public function __construct(
        /**
         * @ORM\Embedded(columnPrefix=false)
         *
         * @var PunchRecordType
         */
        protected PunchRecordType $type,

        /**
         * @ORM\Column(name="punch_in_at", type="datetime")
         *
         * @var \DateTime
         */
        private \DateTime $punchInAt,
    ) {
    }

    public function getType(): PunchRecordType
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getPunchInAt(): \DateTime
    {
        return $this->punchInAt;
    }

    public function setPunchInAt(\DateTime $punchInAt): void
    {
        $this->punchInAt = $punchInAt;
    }
}
