<?php

declare(strict_types=1);

namespace Backend\Api\User\Application\CommandHandler;

use Backend\Api\User\Domain\Command\UserDeleteCommand;
use Backend\Api\User\Domain\Repository\UserRepositoryInterface;
use Throwable;

/**
 * Class UserDeleteHandler.
 */
final class UserDeleteHandler implements CommandHandlerInterface
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
     * Handle UserDeleteCommand command.
     *
     * @param UserDeleteCommand $command
     *
     * @throws Throwable
     *
     * @suppress PhanTypeMismatchArgument
     */
    public function handle(UserDeleteCommand $command): void
    {
        $user = $this->userRepository->get($command->getUserUuid());
        $user->delete();
        $this->userRepository->store($user);
    }
}
