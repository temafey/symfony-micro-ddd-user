<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Application\CommandHandler;

use Backend\Api\User\Application\CommandHandler\UserAddIdHandler;
use Backend\Api\User\Tests\Unit\Mock\Domain\CommandMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\EntityMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\RepositoryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Throwable;

/**
 * Test for class UserAddIdHandler.
 *
 * @class UserAddIdHandlerTest
 */
class UserAddIdHandlerTest extends UnitTestCase
{
    use ValueObjectMockHelper, EntityMockHelper, RepositoryMockHelper, CommandMockHelper;

    /**
     * Test for "Handle UserAddIdCommand command.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\CommandHandler\UserAddIdHandler::handle
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\CommandHandler\UserAddIdHandlerDataProvider::getDataForHandleMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Throwable
     */
    public function handleShouldProcessCommandAndReturnVoidTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryUserRepositoryInterfaceMock = $this->createDomainRepositoryUserRepositoryInterfaceMock($mockArgs['UserRepositoryInterface'], $mockTimes['UserRepositoryInterface']);
        $test = new UserAddIdHandler($domainRepositoryUserRepositoryInterfaceMock);
        $applicationCommandUserAddIdCommandMock = $this->createDomainCommandUserAddIdCommandMock($mockArgs['UserAddIdCommand'], $mockTimes['UserAddIdCommand']);
        $test->handle($applicationCommandUserAddIdCommandMock);
    }
}
