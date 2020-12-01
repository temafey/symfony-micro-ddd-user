<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Repository;

use Backend\Api\User\Domain\Entity\UserEntity;
use Backend\Api\User\Domain\ValueObject\Uuid;

/**
 * Interface UserRepositoryInterface.
 *
 * @category Domain\Repository
 * @sub-package User
 */
interface UserRepositoryInterface
{
    /**
     * Return UserEntity with applied events.
     *
     * @param Uuid $userId
     *
     * @return UserEntity
     */
    public function get(Uuid $userId): UserEntity;

    /**
     * Save UserEntity last uncommitted events.
     *
     * @param UserEntity $user
     */
    public function store(UserEntity $user): void;
}
