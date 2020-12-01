<?php

declare(strict_types=1);

namespace Backend\Api\User\Infrastructure\Repository;

use Backend\Api\User\Domain\Entity\UserEntity;
use Backend\Api\User\Domain\Entity\UserReadInterface;
use Backend\Api\User\Domain\Exception\ValueObjectInvalidException;
use Backend\Api\User\Domain\Factory\UserFactory;
use Backend\Api\User\Domain\Factory\ValueObjectFactory;
use Backend\Api\User\Domain\Repository\QueryRepositoryInterface;
use Backend\Api\User\Domain\Repository\ReadModelStoreInterface;
use Backend\Api\User\Domain\ValueObject\FindCriteria;
use Backend\Api\User\Domain\ValueObject\Nickname;
use Backend\Api\User\Domain\ValueObject\Uuid;
use Backend\Api\User\Infrastructure\Repository\Storage\NotFoundException;
use Exception;
use MicroModule\Base\Utils\LoggerTrait;

/**
 * Class QueryRepository.
 *
 * @category Infrastructure\Query
 */
class QueryRepository implements QueryRepositoryInterface
{
    use LoggerTrait;

    /**
     * ReadModel repository.
     *
     * @var ReadModelStoreInterface
     */
    private ReadModelStoreInterface $readModelStore;

    /**
     * ValueObject factory.
     *
     * @var ValueObjectFactory
     */
    private ValueObjectFactory $valueObjectFactory;

    /**
     * UserEntity factory.
     *
     * @var UserFactory
     */
    private UserFactory $userFactory;

    /**
     * RequestRepositoryRepository constructor.
     *
     * @param ReadModelStoreInterface $readModelStore
     * @param ValueObjectFactory $valueObjectFactory
     * @param UserFactory $userFactory
     */
    public function __construct(
        ReadModelStoreInterface $readModelStore,
        ValueObjectFactory $valueObjectFactory,
        UserFactory $userFactory
    )
    {
        $this->readModelStore = $readModelStore;
        $this->valueObjectFactory = $valueObjectFactory;
        $this->userFactory = $userFactory;
    }

    /**
     * Find and return user entity by user uuid.
     *
     * @param Uuid $uuid
     *
     * @return UserEntity|null
     *
     * @throws Exception
     */
    public function findByUuid(Uuid $uuid): ?UserReadInterface
    {
        try {
            $result = $this->readModelStore->findOne($uuid->toNative());
        } catch (NotFoundException $e) {
            return null;
        }

        if (null === $result) {
            return null;
        }
        $uuidValueObject = $this->valueObjectFactory->makeUuid($result['uuid']);
        $userValueObject = $this->valueObjectFactory->makeUser($result);

        return $this->userFactory->makeActualInstance($uuidValueObject, $userValueObject);
    }

    /**
     * Find and return array of UserEntity by FindCriteria.
     *
     * @param FindCriteria $findCriteria
     *
     * @return UserEntity[]|null
     *
     * @throws ValueObjectInvalidException
     * @throws Exception
     * @throws Exception
     */
    public function findByCriteria(FindCriteria $findCriteria): ?array
    {
        try {
            $result = $this->readModelStore->findBy($findCriteria->toNative());
        } catch (NotFoundException $e) {
            return null;
        }
        $userCollection = [];

        foreach ($result as $user) {
            $uuidValueObject = $this->valueObjectFactory->makeUuid($user['uuid']);
            $userValueObject = $this->valueObjectFactory->makeUser($user);
            $userCollection[] = $this->userFactory->makeActualInstance($uuidValueObject, $userValueObject);
        }

        return $userCollection;
    }

    /**
     * Find and return user entity by user nickname.
     *
     * @param Nickname $nickname
     *
     * @return UserReadInterface|null
     *
     * @throws Exception
     */
    public function findByNickname(Nickname $nickname): ?UserReadInterface
    {
        try {
            $result = $this->readModelStore->findOneBy(['nickname' => $nickname->toNative()]);
        } catch (NotFoundException $e) {
            return null;
        }

        if (null === $result) {
            return null;
        }
        $uuidValueObject = $this->valueObjectFactory->makeUuid($result['uuid']);
        $userValueObject = $this->valueObjectFactory->makeUser($result);

        return $this->userFactory->makeActualInstance($uuidValueObject, $userValueObject);
    }
}
