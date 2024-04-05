<?php

declare(strict_types=1);

namespace Vendor\Demo\Application\UseCase\Company;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Security\AccountFactory;
use Neos\Flow\Security\Context;
use Ramsey\Uuid\Uuid;
use Vendor\Demo\Domain\Model\Employee\EmployeeEmail;
use Vendor\Demo\Domain\Model\Employee\EmployeeId;
use Vendor\Demo\Domain\Model\Employee\EmployeeName;
use Vendor\Demo\Domain\Model\Employee\EmployeeRole;
use Vendor\Demo\Domain\Repository\CompanyRepository;

class AddEmployee
{
    /**
     * @Flow\Inject
     */
    protected Context $securityContext;

    /**
     * @Flow\Inject
     */
    protected AccountFactory $accountFactory;

    public function __construct(
        private readonly CompanyRepository $companyRepository,
    ) {
    }

    public function execute(string $email, string $name): void
    {
        if (!$account = $this->securityContext->getAccount()) {
            throw new \InvalidArgumentException('Account not found');
        }

        if (!$company = $this->companyRepository->findByAccount($account)) {
            throw new \InvalidArgumentException('Company not found');
        }

        $company->addEmployee(
            new EmployeeId(Uuid::uuid4()->toString()),
            new EmployeeName($name),
            new EmployeeEmail($email),
            EmployeeRole::employee(),
        );

        $this->companyRepository->save($company);
    }
}
