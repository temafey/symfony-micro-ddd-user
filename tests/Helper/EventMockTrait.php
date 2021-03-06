<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Helper;

use Backend\Api\User\Domain\Event\UserEvent;
use Backend\Api\User\Domain\Event\UserWasRegisteredEvent;
use Backend\Api\User\Domain\Factory\EventFactory;
use Backend\Api\User\Domain\ValueObject\Id;
use Broadway\Domain\DomainEventStream;
use Broadway\Domain\DomainMessage;
use Broadway\Domain\Metadata;
use MicroModule\ValueObject\Identity\UUID;
use Mockery;
use Mockery\MockInterface;

/**
 * Trait EventMockTrait.
 *
 * @category Tests\Unit\Utils
 */
trait EventMockTrait
{
    /**
     * Create EventFactory mock.
     *
     * @param mixed[] $events
     * @param mixed[] $times
     *
     * @return MockInterface
     */
    protected function createEventFactoryMock(array $events, array $times): MockInterface
    {
        $mock = Mockery::mock(EventFactory::class);

        if (isset($events['UserWasRegisteredEvent'])) {
            $makeEventMethod = $mock
                ->shouldReceive('makeUserWasRegisteredEvent');

            if (null === $times['UserWasRegisteredEvent']['make']) {
                $makeEventMethod->zeroOrMoreTimes();
            } else {
                $makeEventMethod->times($times['UserWasRegisteredEvent']['make']);
            }
            $eventMock = $this->createUserWasRegisteredEventMock($events['UserWasRegisteredEvent'], $times['UserWasRegisteredEvent']['mock']);
            $makeEventMethod->andReturn($eventMock);
        }

        if (isset($events['makeEventStream'])) {
            $makeEventMethod = $mock
                ->shouldReceive('makeEventStream');

            if (null === $times['makeEventStream']) {
                $makeEventMethod->zeroOrMoreTimes();
            } else {
                $makeEventMethod->times($times['makeEventStream']);
            }
            $makeEventMethod->withArgs(static function ($arg) {
                if ($arg instanceof UserEvent) {
                    return true;
                }

                return false;
            });

            $makeEventMethod->andReturnUsing(static function (UserEvent $event) {
                $domainMessage = DomainMessage::recordNow($event->getUuid()->toNative(), 1, new Metadata([]), $event);

                return new DomainEventStream([$domainMessage]);
            }, $events['makeEventStream']);
        }

        return $mock;
    }

    /**
     * Create UserWasRegisteredEvent mock.
     *
     * @param mixed[] $event
     * @param mixed[] $times
     *
     * @return MockInterface
     */
    protected function createUserWasRegisteredEventMock(array $event, array $times): MockInterface
    {
        return $this->createUserEventMock(
            UserWasRegisteredEvent::class,
            $event['uuid'],
            $event['id'],
            $event['user'],
            $times
        );
    }

    /**
     * Create UserEvent mock.
     *
     * @param string  $eventClassName
     * @param string  $uuid
     * @param string  $id
     * @param mixed[] $times
     * @param mixed[] $serialize
     *
     * @return MockInterface
     */
    protected function createUserEventMock(string $eventClassName, string $uuid, string $id, array $times, array $serialize = []): MockInterface
    {
        $mock = Mockery::namedMock('Mock\\' . $eventClassName, $eventClassName);
        $eventMethod = $mock
            ->shouldReceive('getUuid');

        if (null === $times['getUuid']) {
            $eventMethod->zeroOrMoreTimes();
        } else {
            $eventMethod->times($times['getUuid']);
        }
        $eventMethod->andReturn($this->createUuidValueObjectMock(UUID::class, $uuid, $times['getUuidMock']));

        $eventMethod = $mock
            ->shouldReceive('getId');

        if (null === $times['getId']) {
            $eventMethod->zeroOrMoreTimes();
        } else {
            $eventMethod->times($times['getId']);
        }
        $eventMethod->andReturn($this->createUuidValueObjectMock(Id::class, $id, $times['getIdMock']));

        $eventMethod = $mock
            ->shouldReceive('serialize');

        if (null === $times['serialize']) {
            $eventMethod->zeroOrMoreTimes();
        } else {
            $eventMethod->times($times['serialize']);
        }
        $eventMethod->andReturn(array_merge_recursive(['uuid' => $uuid, 'id' => $id], $serialize));

        return $mock;
    }
}
