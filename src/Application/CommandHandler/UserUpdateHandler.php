<?php

declare(strict_types=1);

namespace Backend\Api\User\Application\CommandHandler;

use Backend\Api\User\Domain\Command\UserUpdateCommand;
use Backend\Api\User\Domain\Repository\UserRepositoryInterface;
use Throwable;

/**
 * Class UserUpdateHandler.
 */
final class UserUpdateHandler implements CommandHandlerInterface
{
    /**
     * EventSourcing repository for UserEntity.
     *
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * RequestHandler constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle UpdateUserCommand command.
     *
     * @param UserUpdateCommand $command
     *
     * @throws Throwable
     *
     * @suppress PhanTypeMismatchArgument
     */
    public function handle(UserUpdateCommand $command): void
    {
        $user = $this->userRepository->get($command->getUserUuid());
        $user->update($command->getUser());
        $this->userRepository->store($user);
    }
}
