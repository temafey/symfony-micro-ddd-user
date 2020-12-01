<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Infrastructure\Repository;

use Backend\Api\User\Domain\Entity\UserEntity;
use Backend\Api\User\Infrastructure\Repository\UserStoreRepository;
use Backend\Api\User\Tests\Unit\Mock\Domain\EntityMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Vendor\Broadway\EventSourcingVendorMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Vendor\Broadway\EventStoreVendorMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Vendor\MicroModule\SnapshottingVendorMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Broadway\Domain\AggregateRoot;
use MicroModule\Snapshotting\EventSourcing\SnapshottingEventSourcingRepositoryException;

/**
 * Test for class UserStoreRepository.
 *
 * @class UserStoreRepositoryTest
 */
class UserStoreRepositoryTest extends UnitTestCase
{
    use ValueObjectMockHelper, EntityMockHelper, EventSourcingVendorMockHelper, EventStoreVendorMockHelper, SnapshottingVendorMockHelper;

    /**
     * Test for "Return UserEntity with applied events".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Infrastructure\Repository\UserStoreRepository::get
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Infrastructure\Repository\UserStoreRepositoryDataProvider::getDataForGetMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function getShouldReturnUserEntityTest(array $mockArgs, array $mockTimes): void
    {
        $broadwayEventSourcingEventSourcingRepositoryMock = $this->createBroadwayEventSourcingEventSourcingRepositoryMock($mockArgs['EventSourcingRepository'], $mockTimes['EventSourcingRepository']);
        $broadwayEventStoreEventStoreMock = $this->createBroadwayEventStoreEventStoreMock($mockArgs['EventStore'], $mockTimes['EventStore']);
        $microCommonSnapshottingSnapshotSnapshotRepositoryInterfaceMock = $this->createMicroModuleSnapshotRepositoryInterfaceMock($mockArgs['SnapshotRepositoryInterface'], $mockTimes['SnapshotRepositoryInterface']);
        $microCommonSnapshottingSnapshotTriggerInterfaceMock = $this->createMicroModuleSnapshotTriggerInterfaceMock($mockArgs['TriggerInterface'], $mockTimes['TriggerInterface']);
        $test = new UserStoreRepository($broadwayEventSourcingEventSourcingRepositoryMock, $broadwayEventStoreEventStoreMock, $microCommonSnapshottingSnapshotSnapshotRepositoryInterfaceMock, $microCommonSnapshottingSnapshotTriggerInterfaceMock);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $result = $test->get($domainValueObjectUuidMock);

        self::assertInstanceOf(UserEntity::class, $result);
    }

    /**
     * Test for "Save UserEntity last uncommitted events".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Infrastructure\Repository\UserStoreRepository::store
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Infrastructure\Repository\UserStoreRepositoryDataProvider::getDataForStoreMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws SnapshottingEventSourcingRepositoryException
     */
    public function storeShouldCallSaveInStorageTest(array $mockArgs, array $mockTimes): void
    {
        $broadwayEventSourcingEventSourcingRepositoryMock = $this->createBroadwayEventSourcingEventSourcingRepositoryMock($mockArgs['EventSourcingRepository'], $mockTimes['EventSourcingRepository']);
        $broadwayEventStoreEventStoreMock = $this->createBroadwayEventStoreEventStoreMock($mockArgs['EventStore'], $mockTimes['EventStore']);
        $microCommonSnapshottingSnapshotSnapshotRepositoryInterfaceMock = $this->createMicroModuleSnapshotRepositoryInterfaceMock($mockArgs['SnapshotRepositoryInterface'], $mockTimes['SnapshotRepositoryInterface']);
        $microCommonSnapshottingSnapshotTriggerInterfaceMock = $this->createMicroModuleSnapshotTriggerInterfaceMock($mockArgs['TriggerInterface'], $mockTimes['TriggerInterface']);
        $test = new UserStoreRepository($broadwayEventSourcingEventSourcingRepositoryMock, $broadwayEventStoreEventStoreMock, $microCommonSnapshottingSnapshotSnapshotRepositoryInterfaceMock, $microCommonSnapshottingSnapshotTriggerInterfaceMock);
        $domainEntityUserEntityMock = $this->createDomainEntityUserEntityMock($mockArgs['UserEntity'], $mockTimes['UserEntity']);
        $test->store($domainEntityUserEntityMock);
    }

    /**
     * Test for "{@inheritdoc}".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Infrastructure\Repository\UserStoreRepository::load
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Infrastructure\Repository\UserStoreRepositoryDataProvider::getDataForLoadMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function loadShouldReturnAggregateRootTest(array $mockArgs, array $mockTimes): void
    {
        $broadwayEventSourcingEventSourcingRepositoryMock = $this->createBroadwayEventSourcingEventSourcingRepositoryMock($mockArgs['EventSourcingRepository'], $mockTimes['EventSourcingRepository']);
        $broadwayEventStoreEventStoreMock = $this->createBroadwayEventStoreEventStoreMock($mockArgs['EventStore'], $mockTimes['EventStore']);
        $microCommonSnapshottingSnapshotSnapshotRepositoryInterfaceMock = $this->createMicroModuleSnapshotRepositoryInterfaceMock($mockArgs['SnapshotRepositoryInterface'], $mockTimes['SnapshotRepositoryInterface']);
        $microCommonSnapshottingSnapshotTriggerInterfaceMock = $this->createMicroModuleSnapshotTriggerInterfaceMock($mockArgs['TriggerInterface'], $mockTimes['TriggerInterface']);
        $test = new UserStoreRepository($broadwayEventSourcingEventSourcingRepositoryMock, $broadwayEventStoreEventStoreMock, $microCommonSnapshottingSnapshotSnapshotRepositoryInterfaceMock, $microCommonSnapshottingSnapshotTriggerInterfaceMock);
        $id = $mockArgs['id'];
        $result = $test->load($id);

        self::assertInstanceOf(AggregateRoot::class, $result);
    }
}
