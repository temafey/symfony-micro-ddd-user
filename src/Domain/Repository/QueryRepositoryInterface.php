<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Repository;

use Backend\Api\User\Domain\Entity\UserEntity;
use Backend\Api\User\Domain\Entity\UserReadInterface;
use Backend\Api\User\Domain\ValueObject\FindCriteria;
use Backend\Api\User\Domain\ValueObject\Nickname;
use Backend\Api\User\Domain\ValueObject\Uuid;

/**
 * Interface QueryRepositoryInterface.
 *
 * @category Domain\Query\Repository
 */
interface QueryRepositoryInterface
{
    /**
     * Find and return user entity by user uuid.
     *
     * @param Uuid $uuid
     *
     * @return UserReadInterface|null
     */
    public function findByUuid(Uuid $uuid): ?UserReadInterface;

    /**
     * Find and return array of UserEntity by FindCriteria.
     *
     * @param FindCriteria $findCriteria
     *
     * @return UserEntity[]|mixed[]|null
     */
    public function findByCriteria(FindCriteria $findCriteria): ?array;

    /**
     * Find and return UserEntity by nickname.
     *
     * @param Nickname $nickname
     *
     * @return UserReadInterface|null
     */
    public function findByNickname(Nickname $nickname): ?UserReadInterface;
}
