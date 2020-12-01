<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Repository;

use Backend\Api\User\Domain\Entity\UserEntity;

/**
 * Interface CommandRepositoryInterface.
 *
 * @category Domain\Query\Repository
 */
interface CommandRepositoryInterface
{
    /**
     * Add new user entity.
     *
     * @param UserEntity $userEntity
     */
    public function add(UserEntity $userEntity): void;

    /**
     * Update user entity.
     *
     * @param UserEntity $userEntity
     */
    public function update(UserEntity $userEntity): void;

    /**
     * Delete user entity.
     *
     * @param UserEntity $userEntity
     */
    public function delete(UserEntity $userEntity): void;
}
