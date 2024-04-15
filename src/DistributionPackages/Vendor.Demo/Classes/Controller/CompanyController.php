<?php

declare(strict_types=1);

namespace Vendor\Demo\Controller;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use Vendor\Demo\Application\UseCase\Company\RegisterCompany;

class CompanyController extends ActionController
{
    /**
     * @Flow\Inject
     *
     * @var \Neos\Flow\Mvc\View\JsonView
     */
    protected $view;

    public function __construct(
        private readonly RegisterCompany $registerCompany,
    ) {
    }

    /**
     * サービスの初回登録.
     */
    public function registerAction(string $email, string $password, string $companyName, string $employeeName): void
    {
        $account = $this->registerCompany->execute(
            $email,
            $password,
            $companyName,
            $employeeName,
        );

        $this->view->assign('value', [
            'account' => [
                'email'    => $account->getAccountIdentifier(),
                'password' => $account->getCredentialsSource(),
            ],
        ]);
    }
}
