<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Service;

use Backend\Api\User\Domain\Entity\UserReadInterface;

/**
 * Interface AuthenticationProviderInterface.
 */
interface AuthenticationProviderInterface
{
    /**
     * Generate and return new valid token.
     *
     * @param UserReadInterface $userRead
     *
     * @return string
     */
    public function generateToken(UserReadInterface $userRead): string;

    /**
     * Verify token.
     *
     * @param string $token
     *
     * @return bool
     */
    public function verifyToken(string $token): bool;
}
