<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Factory;

use Backend\Api\User\Domain\ValueObject\Age;
use Backend\Api\User\Domain\ValueObject\CreatedAt;
use Backend\Api\User\Domain\ValueObject\Id;
use Backend\Api\User\Domain\ValueObject\Name;
use Backend\Api\User\Domain\ValueObject\Nickname;
use Backend\Api\User\Domain\ValueObject\Password;
use Backend\Api\User\Domain\ValueObject\UpdatedAt;
use Backend\Api\User\Domain\ValueObject\User;
use Backend\Api\User\Domain\ValueObject\Uuid;
use Exception;
use MicroModule\ValueObject\DateTime\Exception\InvalidDateException;

/**
 * Class ValueObjectFactory.
 *
 * @category Domain\Factory
 *
 * @SuppressWarnings(PHPMD)
 */
class ValueObjectFactory
{
    /**
     * Factory method for initialize new User value object.
     *
     * @param mixed $user
     *
     * @return User
     *
     * @throws Exception
     */
    public function makeUser($user): User
    {
        return User::fromNative($user);
    }

    /**
     * Factory method for initialize new userId value object.
     *
     * @param int|null $userId
     *
     * @return Id
     *
     * @suppress PhanPartialTypeMismatchReturn
     */
    public function makeId(?int $userId = null): Id
    {
        return Id::fromNative($userId);
    }

    /**
     * Factory method for initialize new uuid value object.
     *
     * @param string|null $uuid
     *
     * @return Uuid
     *
     * @throws Exception
     *
     * @suppress PhanPartialTypeMismatchReturn
     */
    public function makeUuid(?string $uuid = null): Uuid
    {
        return Uuid::fromNative($uuid);
    }

    /**
     * Factory method for initialize new Password value object.
     *
     * @param int $password
     *
     * @return Password
     *
     * @suppress PhanPartialTypeMismatchReturn
     */
    public function makePassword(int $password): Password
    {
        return Password::fromNative($password);
    }

    /**
     * Factory method for initialize new Name value object.
     *
     * @param string $name
     *
     * @return Name
     *
     * @suppress PhanPartialTypeMismatchReturn
     */
    public function makeName(string $name): Name
    {
        return Name::fromNative($name);
    }

    /**
     * Factory method for initialize new Nickname value object.
     *
     * @param string $nickname
     *
     * @return Nickname
     *
     * @suppress PhanPartialTypeMismatchReturn
     */
    public function makeNickname(string $nickname): Nickname
    {
        return Nickname::fromNative($nickname);
    }

    /**
     * Factory method for initialize new Age value object.
     *
     * @param int $age
     *
     * @return Age
     *
     * @suppress PhanPartialTypeMismatchReturn
     */
    public function makeAge(int $age): Age
    {
        return Age::fromNative($age);
    }

    /**
     * Factory method for initialize new CreatedAt value object.
     *
     * @param string $createdAt
     *
     * @return CreatedAt
     *
     * @throws InvalidDateException
     *
     * @suppress PhanPartialTypeMismatchReturn
     */
    public function makeCreatedAt(string $createdAt): CreatedAt
    {
        return CreatedAt::fromNative($createdAt);
    }

    /**
     * Factory method for initialize new UpdatedAt value object.
     *
     * @param string $updatedAt
     *
     * @return UpdatedAt
     *
     * @throws InvalidDateException
     *
     * @suppress PhanPartialTypeMismatchReturn
     */
    public function makeUpdatedAt(string $updatedAt): UpdatedAt
    {
        return UpdatedAt::fromNative($updatedAt);
    }
}
