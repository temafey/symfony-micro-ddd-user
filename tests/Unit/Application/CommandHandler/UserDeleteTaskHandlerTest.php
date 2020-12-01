<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Application\CommandHandler;

use Backend\Api\User\Application\CommandHandler\UserDeleteTaskHandler;
use Backend\Api\User\Tests\Unit\Mock\Domain\CommandMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\RepositoryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Throwable;

/**
 * Test for class UserDeleteTaskHandler.
 *
 * @class UserDeleteTaskHandlerTest
 */
class UserDeleteTaskHandlerTest extends UnitTestCase
{
    use RepositoryMockHelper, ValueObjectMockHelper, CommandMockHelper;

    /**
     * Test for "Handle UserDeleteTaskCommand command.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\CommandHandler\UserDeleteTaskHandler::__construct
     * @covers       \Backend\Api\User\Application\CommandHandler\UserDeleteTaskHandler::handle
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\CommandHandler\UserDeleteTaskHandlerDataProvider::getDataForHandleMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Throwable
     */
    public function handleShouldProcessCommandAndReturnBoolTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryUserTaskRepositoryInterfaceMock = $this->createDomainRepositoryUserTaskRepositoryInterfaceMock($mockTimes['UserTaskRepositoryInterface']);
        $test = new UserDeleteTaskHandler($domainRepositoryUserTaskRepositoryInterfaceMock);
        $applicationCommandUserDeleteTaskCommandMock = $this->createDomainCommandUserDeleteTaskCommandMock($mockArgs['UserDeleteTaskCommand'], $mockTimes['UserDeleteTaskCommand']);
        $result = $test->handle($applicationCommandUserDeleteTaskCommandMock);
        self::assertTrue($result);
    }
}
