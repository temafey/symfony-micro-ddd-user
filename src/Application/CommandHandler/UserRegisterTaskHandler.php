<?php

declare(strict_types=1);

namespace Backend\Api\User\Application\CommandHandler;

use Backend\Api\User\Domain\Command\UserRegisterTaskCommand;
use Backend\Api\User\Domain\Repository\QueryRepositoryInterface;
use Backend\Api\User\Domain\Repository\UserTaskRepositoryInterface;
use Backend\Api\User\Domain\ValueObject\Nickname;
use Throwable;

/**
 * Class UserRegisterTaskHandler.
 */
final class UserRegisterTaskHandler implements CommandHandlerInterface
{
    /**
     * EventSourcing repository for UserEntity.
     *
     * @var UserTaskRepositoryInterface
     */
    private UserTaskRepositoryInterface $userTaskRepository;

    /**
     * @var QueryRepositoryInterface
     */
    private QueryRepositoryInterface $queryRepository;

    /**
     * ImportUserDtoHandler constructor.
     *
     * @param UserTaskRepositoryInterface $userTaskRepository
     * @param QueryRepositoryInterface $queryRepository
     */
    public function __construct(
        UserTaskRepositoryInterface $userTaskRepository,
        QueryRepositoryInterface $queryRepository
    )
    {
        $this->userTaskRepository = $userTaskRepository;
        $this->queryRepository = $queryRepository;
    }

    /**
     * Handle UserRegisterTaskCommand command.
     *
     * @param UserRegisterTaskCommand $command
     *
     * @return string|null
     *
     * @throws Throwable
     */
    public function handle(UserRegisterTaskCommand $command): ?string
    {
        if ($this->isUserExists($command->getUser()->getNickname())) {
            return null;
        }
        $this->userTaskRepository->addRegisterTask($command->getProcessUuid(), $command->getUser());

        return $command->getProcessUuid()->toNative();
    }

    /**
     * Try to find user by their nickname.
     *
     * @param Nickname $nickname
     *
     * @return bool
     */
    private function isUserExists(Nickname $nickname): bool
    {
        $userEntity = $this->queryRepository->findByNickname($nickname);

        return null !== $userEntity;
    }
}
