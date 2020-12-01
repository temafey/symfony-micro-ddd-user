<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Service;

use Backend\Api\User\Domain\Entity\UserEntity;
use Backend\Api\User\Domain\ValueObject\User;
use Backend\Api\User\Domain\ValueObject\Uuid;

/**
 * Interface UserServiceInterface.
 *
 * @category Domain\Service
 */
interface UserServiceInterface
{
    /**
     * Make and return UserEntity object.
     *
     * @param UUID $uuid
     * @param Uuid $id
     * @param User $user
     *
     * @return UserEntity
     */
    public function getUser(UUID $uuid, Uuid $id, User $user): UserEntity;

    /**
     * Make and return UserEntity object.
     *
     * @param UUID $uuid
     * @param Uuid $id
     *
     * @return UserEntity
     */
    public function createUser(UUID $uuid, Uuid $id): UserEntity;

    /**
     * Check is user was imported and assemble it with new data.
     *
     * @param UserEntity $userEntity
     *
     * @return UserEntity
     */
    public function assembleUser(UserEntity $userEntity): UserEntity;
}
