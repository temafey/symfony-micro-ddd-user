<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\Command;

use Backend\Api\User\Domain\Command\UserUpdateTaskCommand;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;
use MicroModule\Base\Domain\Command\CommandInterface;

/**
 * Test for class UserUpdateTaskCommand.
 *
 * @class UserUpdateTaskCommandTest
 */
class UserUpdateTaskCommandTest extends UnitTestCase
{
    use ValueObjectMockHelper;

    /**
     * Test for get methods in UserUpdateTaskCommand.
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Command\UserUpdateTaskCommand::__construct
     * @covers       \Backend\Api\User\Domain\Command\UserUpdateTaskCommand::getProcessUuid
     * @covers       \Backend\Api\User\Domain\Command\UserUpdateTaskCommand::getUuid
     * @covers       \Backend\Api\User\Domain\Command\UserUpdateTaskCommand::getUserUuid
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Command\UserUpdateTaskCommandDataProvider::getDataForGetUserUuidMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function UserUpdateTaskCommandShouldInstanceOfCommandInterfaceTest(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $test = new UserUpdateTaskCommand($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectUserMock);

        self::assertInstanceOf(CommandInterface::class, $test);
        self::assertSame($mockArgs['UUID']['toNative'], $test->getProcessUuid()->toNative());
        self::assertSame($mockArgs['UUID']['getUuid']['toString'], $test->getUuid()->toString());
        self::assertSame($mockArgs['Uuid']['toNative'], $test->getUserUuid()->toNative());
        self::assertSame($mockArgs['User']['toNative'], $test->getUser()->toNative());
    }
}
