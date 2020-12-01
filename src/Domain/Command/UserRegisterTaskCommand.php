<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Command;

use Backend\Api\User\Domain\ValueObject\User;
use MicroModule\ValueObject\Identity\UUID;

/**
 * Class UserRegisterTaskCommand.
 */
final class UserRegisterTaskCommand extends UserCommand
{
    /**
     * User ValueObject.
     *
     * @var User
     */
    private User $user;

    /**
     * InitUserCommand constructor.
     *
     * @param UUID $processUuid
     * @param User $user
     */
    public function __construct(UUID $processUuid, User $user)
    {
        parent::__construct($processUuid);
        $this->user = $user;
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
