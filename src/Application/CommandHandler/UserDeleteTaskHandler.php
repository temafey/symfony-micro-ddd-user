<?php

declare(strict_types=1);

namespace Backend\Api\User\Application\CommandHandler;

use Backend\Api\User\Domain\Command\UserDeleteTaskCommand;
use Backend\Api\User\Domain\Repository\UserTaskRepositoryInterface;
use Throwable;

/**
 * Class UserDeleteTaskHandler.
 */
final class UserDeleteTaskHandler implements CommandHandlerInterface
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
     * Handle UserDeleteTaskCommand command.
     *
     * @param UserDeleteTaskCommand $command
     *
     * @return bool
     *
     * @throws Throwable
     */
    public function handle(UserDeleteTaskCommand $command): bool
    {
        $this->userTaskRepository->addDeleteTask($command->getProcessUuid(), $command->getUserUuid());

        return true;
    }
}
