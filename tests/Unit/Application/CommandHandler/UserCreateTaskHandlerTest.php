<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Application\CommandHandler;

use Backend\Api\User\Application\CommandHandler\UserRegisterTaskHandler;
use Backend\Api\User\Tests\Unit\Mock\Domain\CommandMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\RepositoryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Throwable;

/**
 * Test for class UserRegisterTaskHandler.
 *
 * @class UserRegisterTaskHandlerTest
 */
class UserRegisterTaskHandlerTest extends UnitTestCase
{
    use RepositoryMockHelper, ValueObjectMockHelper, CommandMockHelper;

    /**
     * Test for "Handle UserRegisterTaskCommand command.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\CommandHandler\UserRegisterTaskHandler::__construct
     * @covers       \Backend\Api\User\Application\CommandHandler\UserRegisterTaskHandler::handle
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\CommandHandler\UserRegisterTaskHandlerDataProvider::getDataForHandleMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Throwable
     */
    public function handleShouldProcessCommandAndReturnBoolTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryUserTaskRepositoryInterfaceMock = $this->createDomainRepositoryUserTaskRepositoryInterfaceMock($mockTimes['UserTaskRepositoryInterface']);
        $test = new UserRegisterTaskHandler($domainRepositoryUserTaskRepositoryInterfaceMock);
        $applicationCommandUserRegisterTaskCommandMock = $this->createDomainCommandUserRegisterTaskCommandMock($mockArgs['UserRegisterTaskCommand'], $mockTimes['UserRegisterTaskCommand']);
        $result = $test->handle($applicationCommandUserRegisterTaskCommandMock);

        self::assertTrue($result);
    }
}
