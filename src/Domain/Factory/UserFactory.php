<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Factory;

use Backend\Api\User\Domain\Entity\UserEntity;
use Backend\Api\User\Domain\Entity\UserReadInterface;
use Backend\Api\User\Domain\Exception\ValueObjectInvalidException;
use Backend\Api\User\Domain\ValueObject\User as UserValueObject;
use Backend\Api\User\Domain\ValueObject\Uuid;
use MicroModule\ValueObject\Identity\UUID as ProcessUuid;

/**
 * Class UserFactory.
 *
 * @category Domain\Factory
 */
class UserFactory
{
    /**
     * Factory method for initialize new UserEntity object.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $uuid
     * @param UserValueObject $userValueObject
     *
     * @return UserEntity
     */
    public function createInstance(
        ProcessUuid $processUuid,
        Uuid $uuid,
        UserValueObject $userValueObject
    ): UserEntity
    {
        return UserEntity::register($processUuid, $uuid, $userValueObject);
    }

    /**
     * Factory method for initialize actual UserEntity object.
     *
     * @param Uuid $uuid
     * @param UserValueObject $userValueObject
     *
     * @return UserReadInterface
     *
     * @throws ValueObjectInvalidException
     */
    public function makeActualInstance(Uuid $uuid, UserValueObject $userValueObject): UserReadInterface
    {
        return UserEntity::createActual($uuid, $userValueObject);
    }
}
