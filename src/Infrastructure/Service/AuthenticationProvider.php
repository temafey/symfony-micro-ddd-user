<?php

declare(strict_types=1);

namespace Backend\Api\User\Infrastructure\Service;

use Backend\Api\User\Domain\Entity\UserReadInterface;
use Backend\Api\User\Domain\Service\AuthenticationProviderInterface;
use MicroModule\JWT\Factory;

/**
 * Class AuthenticationProvider.
 */
class AuthenticationProvider implements AuthenticationProviderInterface
{
    /**
     * JWT factory.
     *
     * @var Factory
     */
    private Factory $jwtFactory;

    /**
     * AuthenticationProvider constructor.
     *
     * @param Factory $jwtFactory
     */
    public function __construct(Factory $jwtFactory)
    {
        $this->jwtFactory = $jwtFactory;
    }

    /**
     * Generate and return new valid token.
     *
     * @param UserReadInterface $userRead
     *
     * @return string
     */
    public function generateToken(UserReadInterface $userRead): string
    {
        $audience = $userRead->getUuid()->toNative();
        $claims = [
            'nickname' => $userRead->getNickname(),
        ];
        $this->jwtFactory->setAudience($audience);

        return $this->jwtFactory->generateToken($claims);
    }

    /**
     * Verify token.
     *
     * @param string $token
     *
     * @return bool
     */
    public function verifyToken(string $token): bool
    {
        $result = $this->jwtFactory->verifyToken($token);

        return true === $result[Factory::VALID_PARAM_NAME];
    }
}
