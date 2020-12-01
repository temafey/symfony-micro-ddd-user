<?php

declare(strict_types=1);

namespace Backend\Api\User\Infrastructure\Repository;

use Backend\Api\User\Domain\Entity\UserEntity;
use Backend\Api\User\Domain\Exception\UserDeleteException;
use Backend\Api\User\Domain\Exception\UserInsertException;
use Backend\Api\User\Domain\Exception\UserUpdateException;
use Backend\Api\User\Domain\Repository\CommandRepositoryInterface;
use Backend\Api\User\Domain\Repository\ReadModelStoreInterface;
use Backend\Api\User\Infrastructure\Repository\Storage\NotFoundException;
use MicroModule\Base\Utils\LoggerTrait;

/**
 * Class CommandRepository.
 *
 * @category Infrastructure\Command
 */
class CommandRepository implements CommandRepositoryInterface
{
    use LoggerTrait;

    /**
     * Read model ReadModelStoreInterface.
     *
     * @var ReadModelStoreInterface
     */
    private ReadModelStoreInterface $readModelStore;

    /**
     * RequestRepositoryRepository constructor.
     *
     * @param ReadModelStoreInterface $readModelStore
     */
    public function __construct(ReadModelStoreInterface $readModelStore)
    {
        $this->readModelStore = $readModelStore;
    }

    /**
     * Add new user entity.
     *
     * @param UserEntity $userEntity
     *
     * @throws UserInsertException
     */
    public function add(UserEntity $userEntity): void
    {
        try {
            $this->readModelStore->insertOne($userEntity);
        } catch (NotFoundException $e) {
            throw new UserInsertException('User was not inserted in read model.');
        }
    }

    /**
     * Update user entity.
     *
     * @param UserEntity $userEntity
     *
     * @throws UserUpdateException
     */
    public function update(UserEntity $userEntity): void
    {
        try {
            $this->readModelStore->updateOne($userEntity);
        } catch (NotFoundException $e) {
            throw new UserUpdateException('User was not updated in read model.');
        }
    }

    /**
     * Delete user entity.
     *
     * @param UserEntity $userEntity
     *
     * @throws UserDeleteException
     */
    public function delete(UserEntity $userEntity): void
    {
        try {
            $this->readModelStore->deleteOne($userEntity);
        } catch (NotFoundException $e) {
            throw new UserDeleteException('User was not deleted in read model.');
        }
    }
}
