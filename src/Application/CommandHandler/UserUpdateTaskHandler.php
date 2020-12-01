<?php

declare(strict_types=1);

namespace Backend\Api\User\Application\CommandHandler;

use Backend\Api\User\Domain\Command\UserUpdateTaskCommand;
use Backend\Api\User\Domain\Repository\UserTaskRepositoryInterface;
use Throwable;

/**
 * Class UserUpdateTaskHandler.
 */
final class UserUpdateTaskHandler implements CommandHandlerInterface
{
    /**
     * EventSourcing repository for UserEntity.
     *
     * @var UserTaskRepositoryInterface
     */
    private UserTaskRepositoryInterface $userTaskRepository;

    /**
     * ImportUserDtoHandler constructor.
     *
     * @param UserTaskRepositoryInterface $userTaskRepository
     */
    public function __construct(
        UserTaskRepositoryInterface $userTaskRepository
    )
    {
        $this->userTaskRepository = $userTaskRepository;
    }

    /**
     * Handle UserUpdateTaskCommand command.
     *
     * @param UserUpdateTaskCommand $command
     *
     * @return bool
     *
     * @throws Throwable
     */
    public function handle(UserUpdateTaskCommand $command): bool
    {
        $this->userTaskRepository->addUpdateTask($command->getProcessUuid(), $command->getUserUuid(), $command->getUser());

        return true;
    }
}
