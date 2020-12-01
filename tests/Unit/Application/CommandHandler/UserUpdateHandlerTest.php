<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Application\CommandHandler;

use Backend\Api\User\Application\CommandHandler\UserUpdateHandler;
use Backend\Api\User\Tests\Unit\Mock\Domain\CommandMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\EntityMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\RepositoryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Throwable;

/**
 * Test for class UserUpdateHandler.
 *
 * @class UserUpdateHandlerTest
 */
class UserUpdateHandlerTest extends UnitTestCase
{
    use ValueObjectMockHelper, EntityMockHelper, RepositoryMockHelper, CommandMockHelper;

    /**
     * Test for "Handle UpdateUserCommand command.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\CommandHandler\UserUpdateHandler::__construct
     * @covers       \Backend\Api\User\Application\CommandHandler\UserUpdateHandler::handle
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\CommandHandler\UserUpdateHandlerDataProvider::getDataForHandleMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Throwable
     */
    public function handleShouldProcessCommandAndReturnVoidTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryUserRepositoryInterfaceMock = $this->createDomainRepositoryUserRepositoryInterfaceMock($mockArgs['UserRepositoryInterface'], $mockTimes['UserRepositoryInterface']);
        $test = new UserUpdateHandler($domainRepositoryUserRepositoryInterfaceMock);
        $applicationCommandUserUpdateCommandMock = $this->createDomainCommandUserUpdateCommandMock($mockArgs['UserUpdateCommand'], $mockTimes['UserUpdateCommand']);
        $test->handle($applicationCommandUserUpdateCommandMock);
    }
}
