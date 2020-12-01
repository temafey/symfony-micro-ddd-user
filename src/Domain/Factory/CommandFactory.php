<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Factory;

use Backend\Api\User\Application\Dto\UserDto;
use Backend\Api\User\Domain\Command\UserAddIdCommand;
use Backend\Api\User\Domain\Command\UserDeleteCommand;
use Backend\Api\User\Domain\Command\UserDeleteTaskCommand;
use Backend\Api\User\Domain\Command\UserRegisterCommand;
use Backend\Api\User\Domain\Command\UserRegisterTaskCommand;
use Backend\Api\User\Domain\Command\UserUpdateCommand;
use Backend\Api\User\Domain\Command\UserUpdateTaskCommand;
use Backend\Api\User\Domain\Query\FetchOneCommand;
use Backend\Api\User\Domain\Query\FindCommand;
use Backend\Api\User\Domain\Query\FindLiteCommand;
use Backend\Api\User\Domain\Query\SignInCommand;
use Backend\Api\User\Domain\ValueObject\FindCriteria;
use Backend\Api\User\Domain\ValueObject\Id;
use Backend\Api\User\Domain\ValueObject\Nickname;
use Backend\Api\User\Domain\ValueObject\Password;
use Backend\Api\User\Domain\ValueObject\User;
use Backend\Api\User\Domain\ValueObject\Uuid;
use Exception;
use MicroModule\Base\Domain\Command\CommandInterface;
use MicroModule\Base\Domain\Exception\FactoryException;
use MicroModule\Base\Domain\Factory\CommandFactoryInterface;
use MicroModule\ValueObject\Identity\UUID as ProcessUuid;

/**
 * Class CommandFactory.
 *
 * @SuppressWarnings(PHPMD)
 */
class CommandFactory implements CommandFactoryInterface
{
    public const FETCH_ONE_COMMAND = 'FetchOneCommand';
    public const FIND_COMMAND = 'FindCommand';
    public const FIND_LITE_COMMAND = 'FindLiteCommand';
    public const SIGN_IN_COMMAND = 'SignInCommand';
    public const REGISTER_TASK_COMMAND = 'UserRegisterTaskCommand';
    public const REGISTER_COMMAND = 'UserRegisterCommand';
    public const UPDATE_TASK_COMMAND = 'UserUpdateTaskCommand';
    public const UPDATE_COMMAND = 'UserUpdateCommand';
    public const DELETE_TASK_COMMAND = 'UserDeleteTaskCommand';
    public const DELETE_COMMAND = 'UserDeleteCommand';
    public const ADD_ID_COMMAND = 'UserAddIdCommand';

    /**
     * Make CommandBus command instance by constant type.
     *
     * @param mixed... $args
     *
     * @return CommandInterface
     *
     * @throws FactoryException
     * @throws Exception
     */
    public function makeCommandInstanceByType(...$args): CommandInterface
    {
        $commandType = array_shift($args);

        switch ($commandType) {
            case self::FETCH_ONE_COMMAND:
                return $this->makeFetchOneCommand(...$args);

            case self::FIND_COMMAND:
                return $this->makeFindCommand(...$args);

            case self::FIND_LITE_COMMAND:
                return $this->makeFindLiteCommand(...$args);

            case self::SIGN_IN_COMMAND:
                return $this->makeSignInCommand(...$args);

            case self::REGISTER_TASK_COMMAND:
                return $this->makeUserRegisterTaskCommand(...$args);

            case self::REGISTER_COMMAND:
                return $this->makeUserRegisterCommand(...$args);

            case self::UPDATE_TASK_COMMAND:
                return $this->makeUserUpdateTaskCommand(...$args);

            case self::UPDATE_COMMAND:
                return $this->makeUserUpdateCommand(...$args);

            case self::DELETE_TASK_COMMAND:
                return $this->makeUserDeleteTaskCommand(...$args);

            case self::DELETE_COMMAND:
                return $this->makeUserDeleteCommand(...$args);

            case self::ADD_ID_COMMAND:
                return $this->makeUserAddIdCommand(...$args);

            default:
                throw new FactoryException(sprintf('Command bus for type `%s` not found!', (string)$commandType));
        }
    }

    /**
     * Build and return FetchOneCommand object.
     *
     * @param string $uuid
     *
     * @return FetchOneCommand
     *
     * @throws Exception
     *
     * @psalm-suppress ArgumentTypeCoercion
     */
    public function makeFetchOneCommand(string $uuid): FetchOneCommand
    {
        $processUuid = ProcessUuid::fromNative(null);
        $uuid = Uuid::fromNative($uuid);

        return new FetchOneCommand($processUuid, $uuid);
    }

    /**
     * Build and return makeFindCommand object.
     *
     * @param mixed[] $criteria
     *
     * @return FindCommand
     *
     * @throws Exception
     *
     * @psalm-suppress ArgumentTypeCoercion
     */
    public function makeFindCommand(array $criteria): FindCommand
    {
        $processUuid = ProcessUuid::fromNative(null);
        $findCriteria = FindCriteria::fromNative($criteria);

        return new FindCommand($processUuid, $findCriteria);
    }

    /**
     * Build and return makeFindCommand object.
     *
     * @param mixed[] $criteria
     *
     * @return FindLiteCommand
     *
     * @throws Exception
     *
     * @psalm-suppress ArgumentTypeCoercion
     */
    public function makeFindLiteCommand(array $criteria): FindLiteCommand
    {
        $processUuid = ProcessUuid::fromNative(null);
        $findCriteria = FindCriteria::fromNative($criteria);

        return new FindLiteCommand($processUuid, $findCriteria);
    }

    /**
     * Build and return makeFindCommand object.
     *
     * @param string $nickname
     * @param string $password
     *
     * @return SignInCommand
     *
     * @throws Exception
     *
     * @psalm-suppress ArgumentTypeCoercion
     */
    public function makeSignInCommand(string $nickname, string $password): SignInCommand
    {
        $processUuid = ProcessUuid::fromNative(null);
        $nickname = Nickname::fromNative($nickname);
        $password = Password::fromNative($password);

        return new SignInCommand($processUuid, $nickname, $password);
    }

    /**
     * Build and return UserRegisterTaskCommand object.
     *
     * @param UserDto $userDto
     *
     * @return UserRegisterTaskCommand
     *
     * @throws Exception
     */
    public function makeUserRegisterTaskCommand(UserDto $userDto): UserRegisterTaskCommand
    {
        $uuid = ProcessUuid::fromNative(null);
        $user = User::fromNative($userDto->normalize());

        return new UserRegisterTaskCommand($uuid, $user);
    }

    /**
     * Build and return UserRegisterTaskCommand object.
     *
     * @param string $uuid
     * @param UserDto $userDto
     *
     * @return UserUpdateTaskCommand
     *
     * @throws Exception
     *
     * @psalm-suppress ArgumentTypeCoercion
     */
    public function makeUserUpdateTaskCommand(string $uuid, UserDto $userDto): UserUpdateTaskCommand
    {
        $processUuid = ProcessUuid::fromNative(null);
        $uuid = Uuid::fromNative($uuid);
        $user = User::fromNative($userDto->normalize());

        return new UserUpdateTaskCommand($processUuid, $uuid, $user);
    }

    /**
     * Build and return UserDeleteTaskCommand object.
     *
     * @param string $uuid
     *
     * @return UserDeleteTaskCommand
     *
     * @throws Exception
     *
     * @psalm-suppress ArgumentTypeCoercion
     */
    public function makeUserDeleteTaskCommand(string $uuid): UserDeleteTaskCommand
    {
        $processUuid = ProcessUuid::fromNative(null);
        $uuid = Uuid::fromNative($uuid);

        return new UserDeleteTaskCommand($processUuid, $uuid);
    }

    /**
     * Build and return ImportUserStartCommand object.
     *
     * @param string $processUuid
     * @param mixed[] $user
     *
     * @return UserRegisterCommand
     *
     * @throws Exception
     *
     * @psalm-suppress ArgumentTypeCoercion
     */
    public function makeUserRegisterCommand(string $processUuid, array $user): UserRegisterCommand
    {
        $uuid = Uuid::fromNative($processUuid);
        $processUuid = ProcessUuid::fromNative($processUuid);
        $user = User::fromNative($user);

        return new UserRegisterCommand($processUuid, $uuid, $user);
    }

    /**
     * Build and return UpdateUserCommand object.
     *
     * @param string $processUuid
     * @param string $uuid
     * @param mixed[] $user
     *
     * @return UserUpdateCommand
     *
     * @throws Exception
     *
     * @psalm-suppress ArgumentTypeCoercion
     */
    public function makeUserUpdateCommand(string $processUuid, string $uuid, array $user): UserUpdateCommand
    {
        $processUuid = ProcessUuid::fromNative($processUuid);
        $uuid = Uuid::fromNative($uuid);
        $user = User::fromNative($user);

        return new UserUpdateCommand($processUuid, $uuid, $user);
    }

    /**
     * Build and return UserDeleteCommand object.
     *
     * @param string $processUuid
     * @param string $uuid
     *
     * @return UserDeleteCommand
     *
     * @throws Exception
     *
     * @psalm-suppress ArgumentTypeCoercion
     */
    public function makeUserDeleteCommand(string $processUuid, string $uuid): UserDeleteCommand
    {
        $processUuid = ProcessUuid::fromNative($processUuid);
        $uuid = Uuid::fromNative($uuid);

        return new UserDeleteCommand($processUuid, $uuid);
    }

    /**
     * Build and return UserDeleteCommand object.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $uuid
     * @param Id $id
     *
     * @return UserAddIdCommand
     *
     * @psalm-suppress ArgumentTypeCoercion
     */
    public function makeUserAddIdCommand(ProcessUuid $processUuid, Uuid $uuid, Id $id): UserAddIdCommand
    {
        return new UserAddIdCommand($processUuid, $uuid, $id);
    }
}
