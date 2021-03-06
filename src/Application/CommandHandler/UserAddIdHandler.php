<?php

declare(strict_types=1);

namespace Backend\Api\User\Application\CommandHandler;

use Backend\Api\User\Domain\Command\UserAddIdCommand;
use Backend\Api\User\Domain\Repository\UserRepositoryInterface;
use Throwable;

/**
 * Class UserAddIdHandler.
 */
final class UserAddIdHandler implements CommandHandlerInterface
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
     * Handle UserAddIdCommand command.
     *
     * @param UserAddIdCommand $command
     *
     * @throws Throwable
     *
     * @suppress PhanTypeMismatchArgument
     */
    public function handle(UserAddIdCommand $command): void
    {
        $user = $this->userRepository->get($command->getUserUuid());
        $user->addId($command->getId());
        $this->userRepository->store($user);
    }
}
