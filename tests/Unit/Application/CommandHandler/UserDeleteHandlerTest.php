<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Application\CommandHandler;

use Backend\Api\User\Application\CommandHandler\UserDeleteHandler;
use Backend\Api\User\Tests\Unit\Mock\Domain\CommandMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\EntityMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\RepositoryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Throwable;

/**
 * Test for class UserDeleteHandler.
 *
 * @class UserDeleteHandlerTest
 */
class UserDeleteHandlerTest extends UnitTestCase
{
    use ValueObjectMockHelper, EntityMockHelper, RepositoryMockHelper, CommandMockHelper;

    /**
     * @covers       \Backend\Api\User\Application\CommandHandler\UserDeleteHandler::__construct
     * @covers       \Backend\Api\User\Application\CommandHandler\UserDeleteHandler::handle
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\CommandHandler\UserDeleteHandler::handle
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\CommandHandler\UserDeleteHandlerDataProvider::getDataForHandleMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Throwable
     */
    public function handleShouldProcessCommandAndReturnVoidTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryUserRepositoryInterfaceMock = $this->createDomainRepositoryUserRepositoryInterfaceMock($mockArgs['UserRepositoryInterface'], $mockTimes['UserRepositoryInterface']);
        $test = new UserDeleteHandler($domainRepositoryUserRepositoryInterfaceMock);
        $applicationCommandUserDeleteCommandMock = $this->createDomainCommandUserDeleteCommandMock($mockArgs['UserDeleteCommand'], $mockTimes['UserDeleteCommand']);
        $test->handle($applicationCommandUserDeleteCommandMock);
    }
}
