<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\Command;

use Backend\Api\User\Domain\Command\UserRegisterTaskCommand;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;
use MicroModule\Base\Domain\Command\CommandInterface;

/**
 * Test for class UserRegisterTaskCommand.
 *
 * @class UserRegisterTaskCommandTest
 */
class UserRegisterTaskCommandTest extends UnitTestCase
{
    use ValueObjectMockHelper;

    /**
     * Test for get methods in UserRegisterTaskCommand.
     *
     * @test
     *
     * @group unit
     *
     *
     * @covers       \Backend\Api\User\Domain\Command\UserRegisterTaskCommand::__construct
     * @covers       \Backend\Api\User\Domain\Command\UserRegisterTaskCommand::getProcessUuid
     * @covers       \Backend\Api\User\Domain\Command\UserRegisterTaskCommand::getUuid
     * @covers       \Backend\Api\User\Domain\Command\UserRegisterTaskCommand::getUser
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Command\UserRegisterTaskCommandDataProvider::getDataForGetUserMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function UserRegisterTaskCommandShouldInstanceOfCommandInterfaceTest(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $test = new UserRegisterTaskCommand($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUserMock);

        self::assertInstanceOf(CommandInterface::class, $test);
        self::assertSame($mockArgs['UUID']['toNative'], $test->getProcessUuid()->toNative());
        self::assertSame($mockArgs['UUID']['getUuid']['toString'], $test->getUuid()->toString());
        self::assertSame($mockArgs['User']['toNative'], $test->getUser()->toNative());
    }
}
