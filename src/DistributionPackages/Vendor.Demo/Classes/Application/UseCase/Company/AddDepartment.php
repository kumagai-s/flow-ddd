<?php

declare(strict_types=1);

namespace Vendor\Demo\Application\UseCase\Company;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Security\Context;
use Ramsey\Uuid\Uuid;
use Vendor\Demo\Domain\Model\Department\DepartmentId;
use Vendor\Demo\Domain\Model\Department\DepartmentName;
use Vendor\Demo\Domain\Repository\CompanyRepository;

class AddDepartment
{
    /**
     * @Flow\Inject
     */
    protected Context $securityContext;

    public function __construct(
        private readonly CompanyRepository $companyRepository,
    ) {
    }

    public function execute(string $name): void
    {
        if (!$account = $this->securityContext->getAccount()) {
            throw new \InvalidArgumentException('Account not found');
        }

        if (!$company = $this->companyRepository->findByAccount($account)) {
            throw new \InvalidArgumentException('Company not found');
        }

        $company->addDepartment(
            new DepartmentId(Uuid::uuid4()->toString()),
            new DepartmentName($name),
        );

        $this->companyRepository->save($company);
    }
}
