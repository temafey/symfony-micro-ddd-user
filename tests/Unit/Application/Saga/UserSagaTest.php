<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Application\Saga;

use Backend\Api\User\Application\Saga\UserSaga;
use Backend\Api\User\Tests\Unit\Mock\Domain\EventMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Vendor\Broadway\SagaVendorMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Vendor\League\TacticianVendorMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Vendor\MicroModule\BaseVendorMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Broadway\Saga\State;

/**
 * Test for class UserSaga.
 *
 * @class UserSagaTest
 */
class UserSagaTest extends UnitTestCase
{
    use BaseVendorMockHelper, ValueObjectMockHelper, EventMockHelper, TacticianVendorMockHelper, SagaVendorMockHelper;

    /**
     * Test for "@return Closure[]".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\Saga\UserSaga::configuration
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\Saga\UserSagaDataProvider::getDataForConfigurationMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function configurationShouldReturnClosureTest(array $mockArgs, array $mockTimes): void
    {
        $configurations = UserSaga::configuration();

        foreach ($mockArgs['configuration'] as $key => $event) {
            self::arrayHasKey($key)->evaluate($configurations);
            $mockEvent = $this->{'createDomainEvent' . $key . 'Mock'}($mockArgs, $mockTimes);
            $result = $configurations[$key]($mockEvent);

            self::assertEquals($result, $event);
        }
    }

    /**
     * Test for "Handle UserIdWasCreatedEvent event, initialize and handle ProgramDtoWasImportedEvent.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\Saga\UserSaga::handleUserIdWasCreatedEvent
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\Saga\UserSagaDataProvider::getDataForHandleUserIdWasCreatedEventMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function handleUserIdWasCreatedEventShouldReturnStateTest(array $mockArgs, array $mockTimes): void
    {
        $leagueTacticianCommandBusMock = $this->createLeagueTacticianCommandBusMock($mockArgs['CommandBus'], $mockTimes['CommandBus']);
        $microCommonBaseApplicationFactoryCommandFactoryInterfaceMock = $this->createMicroModuleBaseApplicationFactoryCommandFactoryInterfaceMock($mockArgs['CommandFactoryInterface'], $mockTimes['CommandFactoryInterface']);
        $test = new UserSaga($leagueTacticianCommandBusMock, $microCommonBaseApplicationFactoryCommandFactoryInterfaceMock);
        $broadwaySagaStateMock = $this->createBroadwaySagaStateMock($mockArgs['State'], $mockTimes['State']);
        $domainEventUserIdWasCreatedEventMock = $this->createDomainEventUserIdWasCreatedEventMock($mockArgs['UserIdWasCreatedEvent'], $mockTimes['UserIdWasCreatedEvent']);
        $result = $test->handleUserIdWasCreatedEvent($broadwaySagaStateMock, $domainEventUserIdWasCreatedEventMock);

        self::assertInstanceOf(State::class, $result);
    }
}
