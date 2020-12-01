<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\Factory;

use Backend\Api\User\Domain\Event\UserIdWasAddedEvent;
use Backend\Api\User\Domain\Event\UserIdWasCreatedEvent;
use Backend\Api\User\Domain\Event\UserWasDeletedEvent;
use Backend\Api\User\Domain\Event\UserWasRegisteredEvent;
use Backend\Api\User\Domain\Event\UserWasUpdatedEvent;
use Backend\Api\User\Domain\Factory\EventFactory;
use Backend\Api\User\Tests\Unit\Mock\Domain\EventMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Broadway\Domain\DomainEventStream;

/**
 * Test for class EventFactory.
 *
 * @class EventFactoryTest
 */
class EventFactoryTest extends UnitTestCase
{
    use ValueObjectMockHelper, EventMockHelper;

    /**
     * Test for "Factory method for initialize new UserEvent object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\EventFactory::makeUserWasRegisteredEvent
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Factory\EventFactoryDataProvider::getDataForMakeUserWasRegisteredEventMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function makeUserWasRegisteredEventShouldReturnUserWasRegisteredEventTest(array $mockArgs, array $mockTimes): void
    {
        $test = new EventFactory();
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $result = $test->makeUserWasRegisteredEvent($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectUserMock);
        self::assertInstanceOf(UserWasRegisteredEvent::class, $result);
    }

    /**
     * Test for "Factory method for initialize new UserEvent object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\EventFactory::makeUserWasUpdatedEvent
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Factory\EventFactoryDataProvider::getDataForMakeUserWasUpdatedEventMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function makeUserWasUpdatedEventShouldReturnUserWasUpdatedEventTest(array $mockArgs, array $mockTimes): void
    {
        $test = new EventFactory();
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $result = $test->makeUserWasUpdatedEvent($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectUserMock);
        self::assertInstanceOf(UserWasUpdatedEvent::class, $result);
    }

    /**
     * Test for "Factory method for initialize new UserEvent object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\EventFactory::makeUserWasDeletedEvent
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Factory\EventFactoryDataProvider::getDataForMakeUserWasDeletedEventMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function makeUserWasDeletedEventShouldReturnUserWasDeletedEventTest(array $mockArgs, array $mockTimes): void
    {
        $test = new EventFactory();
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $result = $test->makeUserWasDeletedEvent($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock);
        self::assertInstanceOf(UserWasDeletedEvent::class, $result);
    }

    /**
     * Test for "Factory method for initialize new UserEvent object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\EventFactory::makeUserIdWasCreatedEvent
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Factory\EventFactoryDataProvider::getDataForMakeUserIdWasCreatedEventMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function makeUserIdWasCreatedEventShouldReturnUserIdWasCreatedEventTest(array $mockArgs, array $mockTimes): void
    {
        $test = new EventFactory();
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectIdMock = $this->createDomainValueObjectIdMock($mockArgs['Id'], $mockTimes['Id']);
        $result = $test->makeUserIdWasCreatedEvent($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectIdMock);
        self::assertInstanceOf(UserIdWasCreatedEvent::class, $result);
    }

    /**
     * Test for "Factory method for initialize new UserEvent object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\EventFactory::makeUserIdWasAddedEvent
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Factory\EventFactoryDataProvider::getDataForMakeUserIdWasAddedEventMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function makeUserIdWasAddedEventShouldReturnUserIdWasAddedEventTest(array $mockArgs, array $mockTimes): void
    {
        $test = new EventFactory();
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectIdMock = $this->createDomainValueObjectIdMock($mockArgs['Id'], $mockTimes['Id']);
        $result = $test->makeUserIdWasAddedEvent($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectIdMock);
        self::assertInstanceOf(UserIdWasAddedEvent::class, $result);
    }

    /**
     * Test for "Make and return event stream aggregator".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\EventFactory::makeEventStream
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Factory\EventFactoryDataProvider::getDataForMakeEventStreamMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function makeEventStreamShouldReturnDomainEventStreamTest(array $mockArgs, array $mockTimes): void
    {
        $test = new EventFactory();
        $domainEventUserEventMock = $this->createDomainEventUserEventMock($mockArgs['UserEvent'], $mockTimes['UserEvent']);
        $result = $test->makeEventStream($domainEventUserEventMock);
        self::assertInstanceOf(DomainEventStream::class, $result);
    }
}
