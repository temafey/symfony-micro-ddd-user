<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Command;

use Backend\Api\User\Domain\ValueObject\User;
use Backend\Api\User\Domain\ValueObject\Uuid;
use MicroModule\ValueObject\Identity\UUID as ProcessUuid;

/**
 * Class UserUpdateCommand.
 */
class UserUpdateCommand extends UserCommand
{
    /**
     * User primary key value.
     *
     * @var Uuid
     */
    private Uuid $uuid;

    /**
     * User ValueObject.
     *
     * @var User
     */
    private User $user;

    /**
     * InitUserCommand constructor.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $uuid
     * @param User $user
     */
    public function __construct(ProcessUuid $processUuid, Uuid $uuid, User $user)
    {
        parent::__construct($processUuid);
        $this->uuid = $uuid;
        $this->user = $user;
    }

    /**
     * Return Uuid object.
     *
     * @return Uuid
     */
    public function getUserUuid(): Uuid
    {
        return $this->uuid;
    }

    /**
     * Return User value object.
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
