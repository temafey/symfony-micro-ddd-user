<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Application\CommandHandler;

use Backend\Api\User\Application\CommandHandler\UserRegisterHandler;
use Backend\Api\User\Tests\Unit\Mock\Domain\CommandMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\EntityMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\FactoryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\RepositoryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;

/**
 * Test for class UserRegisterHandler.
 *
 * @class UserRegisterHandlerTest
 */
class UserRegisterHandlerTest extends UnitTestCase
{
    use ValueObjectMockHelper, EntityMockHelper, RepositoryMockHelper, FactoryMockHelper, CommandMockHelper;

    /**
     * Test for "Handle ImportUserDtoCommand command.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\CommandHandler\UserRegisterHandler::__construct
     * @covers       \Backend\Api\User\Application\CommandHandler\UserRegisterHandler::handle
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\CommandHandler\UserRegisterHandlerDataProvider::getDataForHandleMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function handleShouldProcessCommandAndReturnVoidTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryUserRepositoryInterfaceMock = $this->createDomainRepositoryUserRepositoryInterfaceMock($mockArgs['UserRepositoryInterface'], $mockTimes['UserRepositoryInterface']);
        $domainFactoryUserFactoryMock = $this->createDomainFactoryUserFactoryMock($mockArgs['UserFactory'], $mockTimes['UserFactory']);
        $test = new UserRegisterHandler($domainRepositoryUserRepositoryInterfaceMock, $domainFactoryUserFactoryMock);
        $applicationCommandUserRegisterCommandMock = $this->createDomainCommandUserRegisterCommandMock($mockArgs['UserRegisterCommand'], $mockTimes['UserRegisterCommand']);
        $test->handle($applicationCommandUserRegisterCommandMock);
    }
}
