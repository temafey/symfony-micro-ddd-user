<?php

declare(strict_types=1);

namespace Backend\Api\User\Application\Service;

use Backend\Api\User\Application\Dto\UserDto;
use Backend\Api\User\Domain\Entity\UserEntity;
use Exception;

/**
 * Class UserAssembler.
 */
class UserAssembler
{
    /**
     * Assemble UserDto object from UserEntity.
     *
     * @param UserEntity $userEntity
     *
     * @return UserDto
     *
     * @throws Exception
     *
     * @suppress PhanPossiblyNonClassMethodCall
     * @psalm-suppress PossiblyNullReference
     * @SuppressWarnings(PHPMD)
     */
    public function writeDto(UserEntity $userEntity): UserDto
    {
        $userDto = new UserDto(
            $userEntity->getNickname()->toNative()
        );

        $userDto->setUuid($userEntity->getUuid()->toNative());
        $userDto->setAge($userEntity->getAge()->toNative());

        if (null !== $userEntity->getName()) {
            $userDto->setFirstname($userEntity->getName()->getFirstName()->toNative());
            $userDto->setLastname($userEntity->getName()->getLastName()->toNative());
        }

        if (null !== $userEntity->getAge()) {
            $userDto->setAge($userEntity->getAge()->toNative());
        }

        if (null !== $userEntity->getCreatedAt()) {
            $userDto->setCreatedAt((string)$userEntity->getCreatedAt());
        }

        if (null !== $userEntity->getUpdatedAt()) {
            $userDto->setUpdatedAt((string)$userEntity->getUpdatedAt());
        }

        return $userDto;
    }
}
