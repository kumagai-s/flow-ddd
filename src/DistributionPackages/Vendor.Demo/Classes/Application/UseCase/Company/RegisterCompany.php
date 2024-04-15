<?php

namespace Vendor\Demo\Application\UseCase\Company;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Security\Account;
use Neos\Flow\Security\AccountFactory;
use Vendor\Demo\Domain\Model\Company\Company;
use Vendor\Demo\Domain\Model\Company\CompanyName;
use Vendor\Demo\Domain\Model\Employee\EmployeeEmail;
use Vendor\Demo\Domain\Model\Employee\EmployeeName;
use Vendor\Demo\Domain\Repository\CompanyRepository;
use Vendor\Demo\Domain\Repository\EmployeeRepository;

#[Flow\Scope('singleton')]
class RegisterCompany
{
    /**
     * @Flow\Inject
     *
     * @var AccountFactory
     */
    protected $accountFactory;

    public function __construct(
        private readonly CompanyRepository $companyRepository,
        private readonly EmployeeRepository $employeeRepository,
    ) {
    }

    public function execute(
        string $email,
        string $password,
        string $companyName,
        string $employeeName,
    ): Account {
        $company = new Company();
        $company->setName(new CompanyName($companyName));

        $account = $this->accountFactory->createAccountWithPassword($email, $password);

        $company->addAccount($account);
        $this->companyRepository->save($company);

        $employee = $company->addEmployee(
            new EmployeeName($employeeName),
            new EmployeeEmail($account->getAccountIdentifier()),
        );

        $this->employeeRepository->save($employee);

        return $account;
    }
}
