<?php

declare(strict_types=1);

namespace Vendor\Demo\Application\UseCase\Employee;

use Neos\Flow\Security\Context;
use Vendor\Demo\Domain\Repository\CompanyRepository;
use Vendor\Demo\Domain\Repository\EmployeeRepository;
use Vendor\Demo\Domain\Repository\PunchRecordRepository;

class PunchIn
{
    protected Context $securityContext;

    public function __construct(
        private readonly CompanyRepository $companyRepository,
        private readonly EmployeeRepository $employeeRepository,
        private readonly PunchRecordRepository $punchRecordRepository,
    ) {
    }

    public function execute(\DateTime $punchInAt): void
    {
        if (!$account = $this->securityContext->getAccount()) {
            throw new \InvalidArgumentException('Account not found');
        }

        if (!$company = $this->companyRepository->findByAccount($account)) {
            throw new \InvalidArgumentException('Company not found');
        }

        if (!$employee = $this->employeeRepository->findByAccountAndCompany($account, $company)) {
            throw new \InvalidArgumentException('Employee not found');
        }

        $employee->punchIn($punchInAt);
    }
}
