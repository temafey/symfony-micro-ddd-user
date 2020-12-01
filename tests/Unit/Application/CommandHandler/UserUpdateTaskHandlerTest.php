<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Application\CommandHandler;

use Backend\Api\User\Application\CommandHandler\UserUpdateTaskHandler;
use Backend\Api\User\Tests\Unit\Mock\Domain\CommandMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\RepositoryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Throwable;

/**
 * Test for class UserUpdateTaskHandler.
 *
 * @class UserUpdateTaskHandlerTest
 */
class UserUpdateTaskHandlerTest extends UnitTestCase
{
    use RepositoryMockHelper, ValueObjectMockHelper, CommandMockHelper;

    /**
     * Test for "Handle UserUpdateTaskCommand command.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\CommandHandler\UserUpdateTaskHandler::__construct
     * @covers       \Backend\Api\User\Application\CommandHandler\UserUpdateTaskHandler::handle
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\CommandHandler\UserUpdateTaskHandlerDataProvider::getDataForHandleMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Throwable
     */
    public function handleShouldProcessCommandAndReturnBoolTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryUserTaskRepositoryInterfaceMock = $this->createDomainRepositoryUserTaskRepositoryInterfaceMock($mockTimes['UserTaskRepositoryInterface']);
        $test = new UserUpdateTaskHandler($domainRepositoryUserTaskRepositoryInterfaceMock);
        $applicationCommandUserUpdateTaskCommandMock = $this->createDomainCommandUserUpdateTaskCommandMock($mockArgs['UserUpdateTaskCommand'], $mockTimes['UserUpdateTaskCommand']);
        $result = $test->handle($applicationCommandUserUpdateTaskCommandMock);
        self::assertTrue($result);
    }
}
