<?php

declare(strict_types=1);

namespace Vendor\Demo\Infrastructure\Repository\Doctrine;

/*
 * This file is part of the Neos.Welcome package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;
use Vendor\Demo\Domain\Interface\IUserRepository;

/**
 * @Flow\Scope("singleton")
 */
class UserRepository extends Repository implements IUserRepository
{
    // add customized methods here
}
