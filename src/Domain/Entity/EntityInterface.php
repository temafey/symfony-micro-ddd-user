<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Entity;

/**
 * Interface EntityInterface.
 *
 * @category Domain\Entity
 * @sub-package User
 */
interface EntityInterface
{
    /**
     * Return entity primary key value.
     *
     * @return string|int
     */
    public function getPrimaryKeyValue();

    /**
     * Convert entity object to array.
     *
     * @return mixed[]
     */
    public function normalize(): array;
}
