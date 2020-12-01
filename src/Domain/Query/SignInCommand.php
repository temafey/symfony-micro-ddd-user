<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Query;

use Backend\Api\User\Domain\ValueObject\Nickname;
use Backend\Api\User\Domain\ValueObject\Password;
use MicroModule\Base\Domain\Command\CommandInterface;
use MicroModule\ValueObject\Identity\UUID as ProcessUuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class SignInCommand.
 */
class SignInCommand implements CommandInterface
{
    /**
     * Process uuid ValueObject.
     *
     * @var ProcessUuid
     */
    private ProcessUuid $processUuid;

    /**
     * User nickname.
     *
     * @var Nickname
     */
    private Nickname $nickname;

    /**
     * User password.
     *
     * @var Password
     */
    private Password $password;

    /**
     * SignInCommand constructor.
     *
     * @param ProcessUuid $processUuid
     * @param Nickname $nickname
     * @param Password $password
     */
    public function __construct(ProcessUuid $processUuid, Nickname $nickname, Password $password)
    {
        $this->processUuid = $processUuid;
        $this->nickname = $nickname;
        $this->password = $password;
    }

    /**
     * Return Uuid.
     *
     * @return UuidInterface
     */
    public function getUuid(): UuidInterface
    {
        return $this->processUuid->getUuid();
    }

    /**
     * Return user nickname.
     *
     * @return Nickname
     */
    public function getNickname(): Nickname
    {
        return $this->nickname;
    }

    /**
     * Return user password.
     *
     * @return Password
     */
    public function getPassword(): Password
    {
        return $this->password;
    }
}
