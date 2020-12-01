<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Entity;

use Backend\Api\User\Domain\ValueObject\Id;
use Backend\Api\User\Domain\ValueObject\Nickname;
use Backend\Api\User\Domain\ValueObject\Password;
use Backend\Api\User\Domain\ValueObject\Uuid;

/**
 * Interface UserReadInterface.
 */
interface UserReadInterface
{
    /**
     * Return user uuid value object.
     *
     * @return Uuid
     */
    public function getUuid(): Uuid;

    /**
     * Return user id value object.
     *
     * @return Id
     */
    public function getId(): Id;

    /**
     * Return user nickname value object.
     *
     * @return Nickname
     */
    public function getNickname(): Nickname;

    /**
     * Return user password value object.
     *
     * @return Password
     */
    public function getPassword(): Password;
}
