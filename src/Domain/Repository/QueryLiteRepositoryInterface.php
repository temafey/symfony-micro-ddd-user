<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Repository;

use Backend\Api\User\Domain\ValueObject\FindCriteria;
use Backend\Api\User\Domain\ValueObject\Uuid;

/**
 * Interface QueryRepositoryInterface.
 *
 * @category Domain\Query\Repository
 */
interface QueryLiteRepositoryInterface
{
    /**
     * Find and return user entity by user uuid.
     *
     * @param Uuid $uuid
     *
     * @return mixed[]|null
     */
    public function findByUuid(Uuid $uuid): ?array;

    /**
     * Find and return array of UserEntity by FindCriteria.
     *
     * @param FindCriteria $findCriteria
     *
     * @return mixed[]|null
     */
    public function findByCriteria(FindCriteria $findCriteria): ?array;
}
