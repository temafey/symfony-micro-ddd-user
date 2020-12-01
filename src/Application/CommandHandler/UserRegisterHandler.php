<?php

declare(strict_types=1);

namespace Backend\Api\User\Application\CommandHandler;

use Backend\Api\User\Domain\Command\UserRegisterCommand;
use Backend\Api\User\Domain\Factory\UserFactory;
use Backend\Api\User\Domain\Repository\UserRepositoryInterface;
use Exception;

/**
 * Class UserRegisterHandler.
 */
final class UserRegisterHandler implements CommandHandlerInterface
{
    /**
     * Domain UserFactory factory.
     *
     * @var UserFactory
     */
    private UserFactory $userFactory;

    /**
     * EventSourcing repository for UserEntity.
     *
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * ImportUserDtoHandler constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param UserFactory $userFactory
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UserFactory $userFactory
    )
    {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
    }

    /**
     * Handle ImportUserDtoCommand command.
     *
     * @param UserRegisterCommand $command
     *
     * @throws Exception
     */
    public function handle(UserRegisterCommand $command): void
    {
        $processUuid = $command->getProcessUuid();
        $uuid = $command->getUserUuid();
        $userValueObject = $command->getUser();
        $userEntity = $this->userFactory->createInstance($processUuid, $uuid, $userValueObject);
        $this->userRepository->store($userEntity);
    }
}
