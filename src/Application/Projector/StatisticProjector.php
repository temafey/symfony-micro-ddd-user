<?php

declare(strict_types=1);

namespace Backend\Api\User\Application\Projector;

use Backend\Api\User\Domain\Event\UserWasDeletedEvent;
use Backend\Api\User\Domain\Event\UserWasRegisteredEvent;
use Backend\Api\User\Domain\Event\UserWasUpdatedEvent;
use Backend\Api\User\Domain\Exception\UserNotFoundException;
use Backend\Api\User\Domain\Factory\CommandFactory;
use Backend\Api\User\Domain\Repository\CommandRepositoryInterface;
use Backend\Api\User\Domain\Repository\QueryRepositoryInterface;
use Backend\Api\User\Domain\Repository\UserRepositoryInterface;
use Broadway\ReadModel\Projector;
use League\Tactician\CommandBus;
use MicroModule\Base\Domain\Factory\CommandFactoryInterface;

/**
 * Class UserProjector.
 *
 * @SuppressWarnings(PHPMD)
 */
class StatisticProjector extends Projector
{
    /**
     * Event repository.
     *
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * CQRS command repository.
     *
     * @var CommandRepositoryInterface
     */
    private CommandRepositoryInterface $commandRepository;

    /**
     * CQRS query repository.
     *
     * @var QueryRepositoryInterface
     */
    private QueryRepositoryInterface $queryRepository;

    /**
     * @var CommandBus
     */
    private CommandBus $commandBus;

    /**
     * @var CommandFactoryInterface
     */
    private CommandFactoryInterface $commandFactory;

    /**
     * UserProjector constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param CommandRepositoryInterface $commandRepository
     * @param QueryRepositoryInterface $queryRepository
     * @param CommandBus $programBus
     * @param CommandFactoryInterface $commandFactory
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        CommandRepositoryInterface $commandRepository,
        QueryRepositoryInterface $queryRepository,
        CommandBus $programBus,
        CommandFactoryInterface $commandFactory
    )
    {
        $this->userRepository = $userRepository;
        $this->commandRepository = $commandRepository;
        $this->queryRepository = $queryRepository;
        $this->commandBus = $programBus;
        $this->commandFactory = $commandFactory;
    }

    /**
     * Apply UserWasRegisteredEvent event.
     *
     * @param UserWasRegisteredEvent $event
     */
    public function applyUserWasRegisteredEvent(UserWasRegisteredEvent $event): void
    {
        $userEntity = $this->userRepository->get($event->getUuid());
        $this->commandRepository->add($userEntity);
        $userEntity = $this->queryRepository->findByUuid($event->getUuid());

        if (null === $userEntity) {
            throw new UserNotFoundException(sprintf('UserEntity not found with uuid \'%s\'.', $event->getUuid()->toNative()));
        }
        $command = $this->commandFactory->makeCommandInstanceByType(
            CommandFactory::ADD_ID_COMMAND,
            $event->getProcessUuid(),
            $userEntity->getUuid(),
            $userEntity->getId()
        );
        $this->commandBus->handle($command);
    }

    /**
     * Apply UserWasRegisteredEvent event.
     *
     * @param UserWasUpdatedEvent $event
     */
    public function applyUserWasUpdatedEvent(UserWasUpdatedEvent $event): void
    {
        $userEntity = $this->userRepository->get($event->getUuid());
        $this->commandRepository->update($userEntity);
    }

    /**
     * Apply UserWasRegisteredEvent event.
     *
     * @param UserWasDeletedEvent $event
     */
    public function applyUserWasDeletedEvent(UserWasDeletedEvent $event): void
    {
        $userEntity = $this->queryRepository->findByUuid($event->getUuid());

        if (null === $userEntity) {
            throw new UserNotFoundException(sprintf('UserEntity not found with uuid \'%s\'.', $event->getUuid()->toNative()));
        }
        $this->commandRepository->delete($userEntity);
    }
}
