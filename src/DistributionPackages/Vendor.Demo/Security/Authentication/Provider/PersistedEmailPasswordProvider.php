<?php

declare(strict_types=1);

namespace Vendor\Demo\Security\Provider;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\PersistenceManagerInterface;
use Neos\Flow\Security\Account;
use Neos\Flow\Security\AccountRepository;
use Neos\Flow\Security\Authentication\Provider\AbstractProvider;
use Neos\Flow\Security\Authentication\Token\UsernamePasswordTokenInterface;
use Neos\Flow\Security\Authentication\TokenInterface;
use Neos\Flow\Security\Context;
use Neos\Flow\Security\Cryptography\HashService;
use Neos\Flow\Security\Cryptography\PrecomposedHashProvider;
use Neos\Flow\Security\Exception\UnsupportedAuthenticationTokenException;
use Vendor\Demo\Security\Token\EmailPasswordFromRequestToken;

/**
 * @Flow\Scope("singleton")
 */
final class PersistedEmailPasswordProvider extends AbstractProvider
{
    /**
     * @var AccountRepository
     *
     * @Flow\Inject
     */
    protected $accountRepository;

    protected EmployeeRepository $employeeRepository;

    /**
     * @var HashService
     *
     * @Flow\Inject
     */
    protected $hashService;

    /**
     * @var Context
     *
     * @Flow\Inject
     */
    protected $securityContext;

    /**
     * @var PersistenceManagerInterface
     *
     * @Flow\Inject
     */
    protected $persistenceManager;

    /**
     * The PrecomposedHashProvider has to be injected non-lazy to prevent timing differences.
     *
     * @var PrecomposedHashProvider
     *
     * @Flow\Inject(lazy=false)
     */
    protected $precomposedHashProvider;

    /**
     * Returns the class names of the tokens this provider can authenticate.
     *
     * @return array
     */
    public function getTokenClassNames()
    {
        return [EmailPasswordFromRequestToken::class];
    }

    public function authenticate(TokenInterface $authenticationToken): void
    {
        if (!($authenticationToken instanceof EmailPasswordFromRequestToken)) {
            throw new UnsupportedAuthenticationTokenException(sprintf('This provider cannot authenticate the given token. The token must implement %s', UsernamePasswordTokenInterface::class), 1217339840);
        }

        /** @var Account|null $account */
        $account = null;

        if (TokenInterface::AUTHENTICATION_SUCCESSFUL !== $authenticationToken->getAuthenticationStatus()) {
            $authenticationToken->setAuthenticationStatus(TokenInterface::NO_CREDENTIALS_GIVEN);
        }

        $email = $authenticationToken->getEmail();
        $password = $authenticationToken->getPassword();

        if ('' === $email || '' === $password) {
            return;
        }

        $providerName = $this->options['lookupProviderName'] ?? $this->name;
        $this->securityContext->withoutAuthorizationChecks(function () use (&$account, $providerName) {
            $account = $this->accountRepository
                ->findActiveByAccountIdentifierAndAuthenticationProviderName(
                    $account->getAccountIdentifier(),
                    $providerName
                );
        });

        $authenticationToken->setAuthenticationStatus(TokenInterface::WRONG_CREDENTIALS);

        if (null === $account) {
            // validate anyways (with a precomposed hash) in order to prevent timing attacks on this provider
            $this->hashService->validatePassword($password, $this->precomposedHashProvider->getPrecomposedHash());

            return;
        }

        $employee = $this->employeeRepository->findByAccountIdAndComapnyIdAndEmail(
            $account->getAccountIdentifier(),

            $email
        );

        if (null === $employee) {
            return;
        }

        if ($this->hashService->validatePassword($password, $account->getCredentialsSource())) {
            $account->authenticationAttempted(TokenInterface::AUTHENTICATION_SUCCESSFUL);
            $authenticationToken->setAuthenticationStatus(TokenInterface::AUTHENTICATION_SUCCESSFUL);
            $authenticationToken->setAccount($account);
        } else {
            $account->authenticationAttempted(TokenInterface::WRONG_CREDENTIALS);
        }
        $this->accountRepository->update($account);
        $this->persistenceManager->allowObject($account);
    }
}
