<?php

declare(strict_types=1);

namespace Backend\Api\User\Infrastructure\Repository;

use Backend\Api\User\Domain\Repository\QueryLiteRepositoryInterface;
use Backend\Api\User\Domain\Repository\ReadModelStoreInterface;
use Backend\Api\User\Domain\ValueObject\FindCriteria;
use Backend\Api\User\Domain\ValueObject\Uuid;
use Backend\Api\User\Infrastructure\Repository\Storage\NotFoundException;
use Exception;
use MicroModule\Base\Utils\LoggerTrait;

/**
 * Class QueryLiteRepository.
 *
 * @category Infrastructure\Query
 */
class QueryLiteRepository implements QueryLiteRepositoryInterface
{
    use LoggerTrait;

    /**
     * ReadModel repository.
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
     * Find and return user entity by user uuid.
     *
     * @param Uuid $uuid
     *
     * @return mixed[]|null
     *
     * @throws Exception
     */
    public function findByUuid(Uuid $uuid): ?array
    {
        try {
            return $this->readModelStore->findOne($uuid->toNative());
        } catch (NotFoundException $e) {
            return null;
        }
    }

    /**
     * Find and return array of UserEntity by FindCriteria.
     *
     * @param FindCriteria $findCriteria
     *
     * @return mixed[]|null
     */
    public function findByCriteria(FindCriteria $findCriteria): ?array
    {
        try {
            return $this->readModelStore->findBy($findCriteria->toNative());
        } catch (NotFoundException $e) {
            return null;
        }
    }
}
