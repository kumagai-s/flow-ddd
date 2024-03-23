<?php
declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Company;

use Neos\Flow\Annotations as Flow;
use Vendor\Demo\Domain\Model\Employee\EmployeeId;

class Company
{
    /**
     * @param CompanyId $id
     * @param array<EmployeeId> $employees
     * @param CompanyName $name
     */
    public function __construct(
        private CompanyId $id,
        private array $employees,
        private CompanyName $name,
    ) {}

    public function id(): CompanyId
    {
        return $this->id;
    }
    
    public function name(): CompanyName
    {
        return $this->name;
    }
}