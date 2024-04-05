<?php

namespace Vendor\Demo\Security\Token;

use Neos\Flow\Mvc\ActionRequest;
use Neos\Flow\Security\Authentication\Token\AbstractToken;
use Neos\Utility\ObjectAccess;

final class EmailPasswordFromRequestToken extends AbstractToken
{
    private const DEFAULT_EMAIL_POST_FIELD = 'email';
    private const DEFAULT_PASSWORD_POST_FIELD = 'password';

    /**
     * @var string
     */
    protected $credentials = ['email' => '', 'password' => ''];

    public function updateCredentials(ActionRequest $actionRequest): void
    {
        if ('POST' !== $actionRequest->getHttpRequest()->getMethod()) {
            return;
        }

        $allArguments = array_merge($actionRequest->getArguments(), $actionRequest->getInternalArguments());
        $emailFieldName = $this->options['emailPostField'] ?? self::DEFAULT_EMAIL_POST_FIELD;
        $passwordFieldName = $this->options['passwordPostField'] ?? self::DEFAULT_PASSWORD_POST_FIELD;
        $email = ObjectAccess::getPropertyPath($allArguments, $emailFieldName);
        $password = ObjectAccess::getPropertyPath($allArguments, $passwordFieldName);

        if (!empty($email) && !empty($password)) {
            $this->credentials['email'] = $email;
            $this->credentials['password'] = $password;
            $this->setAuthenticationStatus(self::AUTHENTICATION_NEEDED);
        }
    }

    public function getEmail(): string
    {
        return $this->credentials['email'];
    }

    public function getPassword(): string
    {
        return $this->credentials['password'];
    }
}
