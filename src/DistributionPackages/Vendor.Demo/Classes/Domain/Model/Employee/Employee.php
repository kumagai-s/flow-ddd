<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Employee;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Neos\Flow\Annotations as Flow;
use Vendor\Demo\Domain\Model\Company\Company;
use Vendor\Demo\Domain\Model\PunchRecord\PunchRecord;
use Vendor\Demo\Domain\Model\PunchRecord\PunchRecordType;

/**
 * @Flow\Entity
 *
 * @ORM\Table(name="employees")
 */
class Employee
{
    /**
     * @ORM\Embedded(columnPrefix=false)
     */
    protected EmployeeName $name;

    /**
     * @ORM\Embedded(columnPrefix=false)
     */
    protected EmployeeEmail $email;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="employees")
     *
     * @ORM\JoinColumn(name="company_id")
     *
     * @var Company
     */
    protected $company;

    /**
     * @var Collection<PunchRecord>
     *
     * @ORM\OneToMany(targetEntity=PunchRecord::class, mappedBy="employee")
     */
    protected $punchRecords;

    public function __construct()
    {
        $this->punchRecords = new ArrayCollection();
    }

    public function getName(): EmployeeName
    {
        return $this->name;
    }

    public function setName(EmployeeName $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): EmployeeEmail
    {
        return $this->email;
    }

    public function setEmail(EmployeeEmail $email): void
    {
        $this->email = $email;
    }

    public function getPunchRecords(): ArrayCollection|PersistentCollection
    {
        return $this->punchRecords;
    }

    public function punchIn(\DateTime $punchInAt): void
    {
        $lastPunchRecord = $this->punchRecords->last();

        if (null !== $lastPunchRecord && $lastPunchRecord->getType()->isPunchIn()) {
            $type = PunchRecordType::punchOut();
        } else {
            $type = PunchRecordType::punchIn();
        }

        $this->punchRecords->add(new PunchRecord($type, $punchInAt));
    }

    public function removePunchRecord(PunchRecord $punchRecord): void
    {
        $this->punchRecords->removeElement($punchRecord);
    }
}
