<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Application\Projector;

use Backend\Api\User\Application\Projector\UserProjector;
use Backend\Api\User\Domain\Exception\ValueObjectInvalidException;
use Backend\Api\User\Tests\Unit\Mock\Domain\EntityMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\EventMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\FactoryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\RepositoryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Vendor\Broadway\EventHandlingVendorMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;

/**
 * Test for class UserProjector.
 *
 * @class UserProjectorTest
 */
class UserProjectorTest2 extends UnitTestCase
{
    use RepositoryMockHelper, ValueObjectMockHelper, EntityMockHelper, FactoryMockHelper, EventMockHelper, EventHandlingVendorMockHelper;

    /**
     * Test for "Apply UserWasRegisteredEvent event.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\Projector\UserProjector::applyUserWasRegisteredEvent
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\Projector\UserProjectorDataProvider2::getAddNewUserData()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws ValueObjectInvalidException
     */
    public function applyUserWasRegisteredEventShouldAddNewUserToDatabaseAndApplyUserIdWasCreatedEventTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryCommandRepositoryInterfaceMock = $this->createDomainRepositoryCommandRepositoryInterfaceMock($mockTimes['CommandRepositoryInterface']);
        $domainRepositoryQueryRepositoryInterfaceMock = $this->createDomainRepositoryQueryRepositoryInterfaceMock($mockArgs['QueryRepositoryInterface'], $mockTimes['QueryRepositoryInterface']);
        $domainFactoryUserFactoryMock = $this->createDomainFactoryUserFactoryMock($mockArgs['UserFactory'], $mockTimes['UserFactory']);
        $broadwayEventHandlingEventBusMock = $this->createBroadwayEventHandlingEventBusMock($mockTimes['EventBus']);
        $domainFactoryEventFactoryMock = $this->createDomainFactoryEventFactoryMock($mockArgs['EventFactory'], $mockTimes['EventFactory']);
        $test = new UserProjector($domainRepositoryCommandRepositoryInterfaceMock, $domainRepositoryQueryRepositoryInterfaceMock, $domainFactoryUserFactoryMock, $broadwayEventHandlingEventBusMock, $domainFactoryEventFactoryMock);
        $domainEventUserWasRegisteredEventMock = $this->createDomainEventUserWasRegisteredEventMock($mockArgs['UserWasRegisteredEvent'], $mockTimes['UserWasRegisteredEvent']);
        $test->applyUserWasRegisteredEvent($domainEventUserWasRegisteredEventMock);
    }

    /**
     * Test for "Apply UserWasRegisteredEvent event.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\Projector\UserProjector::applyUserWasUpdatedEvent
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\Projector\UserProjectorDataProvider2::getUpdateUserData()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws ValueObjectInvalidException
     */
    public function applyUserWasUpdatedEventShouldUpdateUserInDatabaseTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryCommandRepositoryInterfaceMock = $this->createDomainRepositoryCommandRepositoryInterfaceMock($mockTimes['CommandRepositoryInterface']);
        $domainRepositoryQueryRepositoryInterfaceMock = $this->createDomainRepositoryQueryRepositoryInterfaceMock($mockArgs['QueryRepositoryInterface'], $mockTimes['QueryRepositoryInterface']);
        $domainFactoryUserFactoryMock = $this->createDomainFactoryUserFactoryMock($mockArgs['UserFactory'], $mockTimes['UserFactory']);
        $broadwayEventHandlingEventBusMock = $this->createBroadwayEventHandlingEventBusMock($mockTimes['EventBus']);
        $domainFactoryEventFactoryMock = $this->createDomainFactoryEventFactoryMock($mockArgs['EventFactory'], $mockTimes['EventFactory']);
        $test = new UserProjector($domainRepositoryCommandRepositoryInterfaceMock, $domainRepositoryQueryRepositoryInterfaceMock, $domainFactoryUserFactoryMock, $broadwayEventHandlingEventBusMock, $domainFactoryEventFactoryMock);
        $domainEventUserWasUpdatedEventMock = $this->createDomainEventUserWasUpdatedEventMock($mockArgs['UserWasUpdatedEvent'], $mockTimes['UserWasUpdatedEvent']);
        $test->applyUserWasUpdatedEvent($domainEventUserWasUpdatedEventMock);
    }

    /**
     * Test for "Apply UserWasRegisteredEvent event.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\Projector\UserProjector::applyUserWasDeletedEvent
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\Projector\UserProjectorDataProvider2::getDeleteUserData()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function applyUserWasDeletedEventShouldDeleteUserFromDatabaseTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryCommandRepositoryInterfaceMock = $this->createDomainRepositoryCommandRepositoryInterfaceMock($mockTimes['CommandRepositoryInterface']);
        $domainRepositoryQueryRepositoryInterfaceMock = $this->createDomainRepositoryQueryRepositoryInterfaceMock($mockArgs['QueryRepositoryInterface'], $mockTimes['QueryRepositoryInterface']);
        $domainFactoryUserFactoryMock = $this->createDomainFactoryUserFactoryMock($mockArgs['UserFactory'], $mockTimes['UserFactory']);
        $broadwayEventHandlingEventBusMock = $this->createBroadwayEventHandlingEventBusMock($mockTimes['EventBus']);
        $domainFactoryEventFactoryMock = $this->createDomainFactoryEventFactoryMock($mockArgs['EventFactory'], $mockTimes['EventFactory']);
        $test = new UserProjector($domainRepositoryCommandRepositoryInterfaceMock, $domainRepositoryQueryRepositoryInterfaceMock, $domainFactoryUserFactoryMock, $broadwayEventHandlingEventBusMock, $domainFactoryEventFactoryMock);
        $domainEventUserWasDeletedEventMock = $this->createDomainEventUserWasDeletedEventMock($mockArgs['UserWasDeletedEvent'], $mockTimes['UserWasDeletedEvent']);
        $test->applyUserWasDeletedEvent($domainEventUserWasDeletedEventMock);
    }
}
