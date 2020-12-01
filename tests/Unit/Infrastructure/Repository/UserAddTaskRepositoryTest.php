<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Infrastructure\Repository;

use Backend\Api\User\Infrastructure\Repository\UserAddTaskRepository;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Vendor\Enqueue\ClientVendorMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;

/**
 * Test for class UserAddTaskRepository.
 *
 * @class UserAddTaskRepositoryTest
 */
class UserAddTaskRepositoryTest extends UnitTestCase
{
    use ValueObjectMockHelper, ClientVendorMockHelper;

    /**
     * Test for "Send job task to queue".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Infrastructure\Repository\UserAddTaskRepository::addRegisterTask
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Infrastructure\Repository\UserAddTaskRepositoryDataProvider::getDataForAddCreateTaskMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function addCreateTaskCallSendCommandInQueueProducerTest(array $mockArgs, array $mockTimes): void
    {
        $enqueueClientProducerInterfaceMock = $this->createEnqueueClientProducerInterfaceMock($mockArgs['ProducerInterface'], $mockTimes['ProducerInterface']);
        $test = new UserAddTaskRepository($enqueueClientProducerInterfaceMock);
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $test->addRegisterTask($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUserMock);
    }

    /**
     * Test for "Send job task to queue".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Infrastructure\Repository\UserAddTaskRepository::addUpdateTask
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Infrastructure\Repository\UserAddTaskRepositoryDataProvider::getDataForAddUpdateTaskMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function addUpdateTaskCallSendCommandInQueueProducedTest(array $mockArgs, array $mockTimes): void
    {
        $enqueueClientProducerInterfaceMock = $this->createEnqueueClientProducerInterfaceMock($mockArgs['ProducerInterface'], $mockTimes['ProducerInterface']);
        $test = new UserAddTaskRepository($enqueueClientProducerInterfaceMock);
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $test->addUpdateTask($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectUserMock);
    }

    /**
     * Test for "Send job task to queue".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Infrastructure\Repository\UserAddTaskRepository::addDeleteTask
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Infrastructure\Repository\UserAddTaskRepositoryDataProvider::getDataForAddDeleteTaskMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function addDeleteTaskShouldCallSendCommandInQueueProduceTest(array $mockArgs, array $mockTimes): void
    {
        $enqueueClientProducerInterfaceMock = $this->createEnqueueClientProducerInterfaceMock($mockArgs['ProducerInterface'], $mockTimes['ProducerInterface']);
        $test = new UserAddTaskRepository($enqueueClientProducerInterfaceMock);
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $test->addDeleteTask($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock);
    }
}
