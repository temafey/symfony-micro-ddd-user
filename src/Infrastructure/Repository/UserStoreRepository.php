<?php

declare(strict_types=1);

namespace Backend\Api\User\Infrastructure\Repository;

use Backend\Api\User\Domain\Entity\UserEntity;
use Backend\Api\User\Domain\Repository\UserRepositoryInterface;
use Backend\Api\User\Domain\ValueObject\Uuid;
use InvalidArgumentException;
use MicroModule\Snapshotting\EventSourcing\SnapshottingEventSourcingRepository;
use MicroModule\Snapshotting\EventSourcing\SnapshottingEventSourcingRepositoryException;

/**
 * Class UserStore.
 *
 * @category Infrastructure\Repository
 * @sub-package UserCollection
 */
class UserStoreRepository extends SnapshottingEventSourcingRepository implements UserRepositoryInterface
{
    /**
     * Return UserEntity with applied events.
     *
     * @param Uuid $userId
     *
     * @return UserEntity
     */
    public function get(Uuid $userId): UserEntity
    {
        $userEntity = $this->load($userId->toNative());

        if (!$userEntity instanceof UserEntity) {
            throw new InvalidArgumentException('return object should implements UserEntity');
        }

        return $userEntity;
    }

    /**
     * Save UserEntity last uncommitted events.
     *
     * @param UserEntity $userEntity
     *
     * @throws SnapshottingEventSourcingRepositoryException
     */
    public function store(UserEntity $userEntity): void
    {
        $this->save($userEntity);
    }
}
