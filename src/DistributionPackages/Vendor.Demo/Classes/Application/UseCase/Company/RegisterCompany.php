<?php

namespace Vendor\Demo\Application\UseCase\Company;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Security\Account;
use Neos\Flow\Security\AccountFactory;
use Neos\Flow\Security\AccountRepository;
use Ramsey\Uuid\Uuid;
use Vendor\Demo\Domain\Model\Company\Company;
use Vendor\Demo\Domain\Model\Company\CompanyId;
use Vendor\Demo\Domain\Model\Company\CompanyName;
use Vendor\Demo\Domain\Model\Employee\EmployeeEmail;
use Vendor\Demo\Domain\Model\Employee\EmployeeId;
use Vendor\Demo\Domain\Model\Employee\EmployeeName;
use Vendor\Demo\Domain\Model\Employee\EmployeeRole;
use Vendor\Demo\Domain\Repository\CompanyRepository;

#[Flow\Scope('singleton')]
class RegisterCompany
{
    /**
     * @Flow\Inject
     * @var \Neos\Flow\Security\AccountFactory
     */
    protected $accountFactory;

    public function __construct(
        private readonly CompanyRepository $companyRepository,
    ) {
    }

    public function execute(
        string $email,
        string $password,
        string $companyName,
        string $employeeName,
    ): Account {
        $company = new Company(
            id: new CompanyId($this->companyRepository->nextIdentity()),
            name: new CompanyName($companyName),
            createdAt: new \DateTimeImmutable(),
            updatedAt: null,
            deletedAt: null,
        );

        $account = $this->accountFactory->createAccountWithPassword($email, $password);

        $company->addAccount($account);

        $company->addEmployee(
            id: new EmployeeId(Uuid::uuid4()->toString()),
            name: new EmployeeName($employeeName),
            email: new EmployeeEmail($account->getAccountIdentifier()),
            role: EmployeeRole::admin(),
        );

        $this->companyRepository->save($company);

        return $account;
    }
}
