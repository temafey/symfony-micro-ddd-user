<?php

declare(strict_types=1);

namespace Backend\Api\User\Infrastructure\Repository;

use Backend\Api\User\Domain\Entity\UserEntity;
use Broadway\EventHandling\EventBus;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventSourcing\EventStreamDecorator;
use Broadway\EventStore\EventStore;

/**
 * Class UserEventSourcingStoreRepository.
 *
 * @category Infrastructure\Repository
 * @sub-package UserCollection
 */
class UserEventSourcingStoreRepository extends EventSourcingRepository
{
    /**
     * UserStore constructor.
     *
     * @param EventStore $eventStore
     * @param EventBus $eventBus
     * @param EventStreamDecorator[] $eventStreamDecorators
     */
    public function __construct(
        EventStore $eventStore,
        EventBus $eventBus,
        array $eventStreamDecorators = []
    )
    {
        parent::__construct(
            $eventStore,
            $eventBus,
            UserEntity::class,
            new PublicConstructorAggregateFactory(),
            $eventStreamDecorators
        );
    }
}
