<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Factory;

use Backend\Api\User\Domain\Event\UserEvent;
use Backend\Api\User\Domain\Event\UserIdWasAddedEvent;
use Backend\Api\User\Domain\Event\UserIdWasCreatedEvent;
use Backend\Api\User\Domain\Event\UserSignedInEvent;
use Backend\Api\User\Domain\Event\UserWasDeletedEvent;
use Backend\Api\User\Domain\Event\UserWasRegisteredEvent;
use Backend\Api\User\Domain\Event\UserWasUpdatedEvent;
use Backend\Api\User\Domain\ValueObject\Id;
use Backend\Api\User\Domain\ValueObject\User;
use Backend\Api\User\Domain\ValueObject\Uuid;
use Broadway\Domain\DomainEventStream;
use Broadway\Domain\DomainMessage;
use Broadway\Domain\Metadata;
use MicroModule\ValueObject\Identity\UUID as ProcessUuid;

/**
 * Class EventFactory.
 *
 * @category Domain\Factory
 * @SuppressWarnings(PHPMD)
 */
class EventFactory
{
    /**
     * Factory method for initialize new UserEvent object.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $uuid
     * @param User $user
     *
     * @return UserWasRegisteredEvent
     */
    public function makeUserWasRegisteredEvent(ProcessUuid $processUuid, Uuid $uuid, User $user): UserWasRegisteredEvent
    {
        return new UserWasRegisteredEvent($processUuid, $uuid, $user);
    }

    /**
     * Factory method for initialize new UserEvent object.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $uuid
     * @param User $user
     *
     * @return UserWasUpdatedEvent
     */
    public function makeUserWasUpdatedEvent(ProcessUuid $processUuid, Uuid $uuid, User $user): UserWasUpdatedEvent
    {
        return new UserWasUpdatedEvent($processUuid, $uuid, $user);
    }

    /**
     * Factory method for initialize new UserEvent object.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $uuid
     *
     * @return UserWasDeletedEvent
     */
    public function makeUserWasDeletedEvent(ProcessUuid $processUuid, Uuid $uuid): UserWasDeletedEvent
    {
        return new UserWasDeletedEvent($processUuid, $uuid);
    }

    /**
     * Factory method for initialize new UserEvent object.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $uuid
     * @param Id $id
     *
     * @return UserIdWasCreatedEvent
     */
    public function makeUserIdWasCreatedEvent(ProcessUuid $processUuid, Uuid $uuid, Id $id): UserIdWasCreatedEvent
    {
        return new UserIdWasCreatedEvent($processUuid, $uuid, $id);
    }

    /**
     * Factory method for initialize new UserWasSignInEvent object.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $uuid
     *
     * @return UserSignedInEvent
     */
    public function makeUserSignedInEvent(ProcessUuid $processUuid, Uuid $uuid): UserSignedInEvent
    {
        return new UserSignedInEvent($processUuid, $uuid);
    }

    /**
     * Factory method for initialize new UserEvent object.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $uuid
     * @param Id $id
     *
     * @return UserIdWasAddedEvent
     */
    public function makeUserIdWasAddedEvent(ProcessUuid $processUuid, Uuid $uuid, Id $id): UserIdWasAddedEvent
    {
        return new UserIdWasAddedEvent($processUuid, $uuid, $id);
    }

    /**
     * Make and return event stream aggregator.
     *
     * @param UserEvent $event
     *
     * @return DomainEventStream
     */
    public function makeEventStream(UserEvent $event): DomainEventStream
    {
        $domainMessage = DomainMessage::recordNow($event->getUuid()->toNative(), 1, new Metadata([]), $event);

        return new DomainEventStream([$domainMessage]);
    }
}
