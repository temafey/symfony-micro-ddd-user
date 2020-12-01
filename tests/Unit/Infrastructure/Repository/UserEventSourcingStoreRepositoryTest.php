<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Infrastructure\Repository;

use Backend\Api\User\Domain\Entity\UserEntity;
use Backend\Api\User\Infrastructure\Repository\UserEventSourcingStoreRepository;
use Backend\Api\User\Tests\Unit\Mock\Domain\EntityMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Vendor\Broadway\EventHandlingVendorMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Vendor\Broadway\EventStoreVendorMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;

/**
 * Test for class UserEventSourcingStoreRepository.
 *
 * @class UserEventSourcingStoreRepositoryTest
 */
class UserEventSourcingStoreRepositoryTest extends UnitTestCase
{
    use EntityMockHelper, ValueObjectMockHelper, EventStoreVendorMockHelper, EventHandlingVendorMockHelper;

    /**
     * Test for "{@inheritdoc}".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Infrastructure\Repository\UserEventSourcingStoreRepository::load
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Infrastructure\Repository\UserEventSourcingStoreRepositoryDataProvider::getDataForLoadMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function loadShouldReturnUserEntityTest(array $mockArgs, array $mockTimes): void
    {
        $broadwayEventStoreEventStoreMock = $this->createBroadwayEventStoreEventStoreMock($mockArgs['EventStore'], $mockTimes['EventStore']);
        $broadwayEventHandlingEventBusMock = $this->createBroadwayEventHandlingEventBusMock($mockTimes['EventBus']);
        $eventStreamDecorators = [];
        $test = new UserEventSourcingStoreRepository($broadwayEventStoreEventStoreMock, $broadwayEventHandlingEventBusMock, $eventStreamDecorators);
        $id = $mockArgs['id'];
        $result = $test->load($id);
        self::assertInstanceOf(UserEntity::class, $result);
    }

    /**
     * Test for "{@inheritdoc}".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Infrastructure\Repository\UserEventSourcingStoreRepository::save
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Infrastructure\Repository\UserEventSourcingStoreRepositoryDataProvider::getDataForSaveMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function saveShouldPublishEventToEventBusTest(array $mockArgs, array $mockTimes): void
    {
        $broadwayEventStoreEventStoreMock = $this->createBroadwayEventStoreEventStoreMock($mockArgs['EventStore'], $mockTimes['EventStore']);
        $broadwayEventHandlingEventBusMock = $this->createBroadwayEventHandlingEventBusMock($mockTimes['EventBus']);
        $eventStreamDecorators = [];
        $test = new UserEventSourcingStoreRepository($broadwayEventStoreEventStoreMock, $broadwayEventHandlingEventBusMock, $eventStreamDecorators);
        $broadwayDomainAggregateRootMock = $this->createDomainEntityUserEntityMock($mockArgs['UserEntity'], $mockTimes['UserEntity']);
        $test->save($broadwayDomainAggregateRootMock);
    }
}
