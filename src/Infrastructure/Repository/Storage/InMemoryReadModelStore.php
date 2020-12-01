<?php

declare(strict_types=1);

namespace Backend\Api\User\Infrastructure\Repository\Storage;

use Backend\Api\User\Domain\Entity\EntityInterface;
use Backend\Api\User\Domain\Repository\ReadModelStoreInterface;
use UnexpectedValueException;

/**
 * In-memory implementation of an snapshot store.
 *
 * Useful for testing code that uses an snapshot store.
 */
final class InMemoryReadModelStore implements ReadModelStoreInterface
{
    /**
     * ReadModels in memory storage.
     *
     * @var mixed[]
     */
    private array $users = [];

    /**
     * Table primary key.
     *
     * @var string
     */
    private string $primaryKey;

    /**
     * InMemoryReadModelStore constructor.
     *
     * @param string $primaryKey
     */
    public function __construct(
        string $primaryKey
    )
    {
        $this->primaryKey = $primaryKey;
    }

    /**
     * Finds an object by its primary key / identifier.
     *
     * @param mixed $uuid
     *
     * @return mixed[]|null
     */
    public function findOne($uuid): ?array
    {
        return $this->users[$uuid] ?? null;
    }

    /**
     * Finds all objects in the repository.
     *
     * @return mixed[]
     */
    public function findAll(): array
    {
        return $this->users;
    }

    /**
     * Finds objects by a set of criteria.
     *
     * Optionally sorting and limiting details can be passed. An implementation may throw
     * an UnexpectedValueException if certain values of the sorting or limiting details are
     * not supported.
     *
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     *
     * @return mixed[]
     *
     * @throws UnexpectedValueException
     *
     * @suppress PhanUnusedPublicFinalMethodParameter
     */
    public function findBy(array $criteria, ?array $orderBy = null, ?int $limit = null, ?int $offset = null): array
    {
        return $this->users;
    }

    /**
     * Finds a single object by a set of criteria.
     *
     * @param mixed[] $criteria
     *
     * @return mixed[]|null
     *
     * @suppress PhanUnusedPublicFinalMethodParameter
     */
    public function findOneBy(array $criteria): ?array
    {
        if (!isset($criteria[$this->primaryKey])) {
            throw new NotFoundException('Primary key not found in criteria');
        }

        return $this->users[$criteria[$this->primaryKey]];
    }

    /**
     * Insert new user into storage.
     *
     * @param EntityInterface $entity
     */
    public function insertOne(EntityInterface $entity): void
    {
        $this->users[$entity->getPrimaryKeyValue()] = $entity->normalize();
    }

    /**
     * Update one user in store.
     *
     * @param EntityInterface $entity
     */
    public function updateOne(EntityInterface $entity): void
    {
        $idNative = $entity->getPrimaryKeyValue();
        $this->users[$idNative] = array_merge($this->users[$idNative], $entity->normalize());
    }

    /**
     * Append new snapshot payload into storage.
     *
     * @param EntityInterface $entity
     */
    public function deleteOne(EntityInterface $entity): void
    {
        unset($this->users[$entity->getPrimaryKeyValue()]);
    }
}
