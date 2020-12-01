<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\Command;

use Backend\Api\User\Domain\Command\UserUpdateCommand;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;
use MicroModule\Base\Domain\Command\CommandInterface;

/**
 * Test for class UserUpdateCommand.
 *
 * @class UserUpdateCommandTest
 */
class UserUpdateCommandTest extends UnitTestCase
{
    use ValueObjectMockHelper;

    /**
     * Test for get methods in UserUpdateCommand.
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Command\UserUpdateCommand::__construct
     * @covers       \Backend\Api\User\Domain\Command\UserUpdateCommand::getProcessUuid
     * @covers       \Backend\Api\User\Domain\Command\UserUpdateCommand::getUuid
     * @covers       \Backend\Api\User\Domain\Command\UserUpdateCommand::getUserUuid
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Command\UserUpdateCommandDataProvider::getDataForGetUserUuidMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function UserUpdateCommandShouldInstanceOfCommandInterfaceTest(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $test = new UserUpdateCommand($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectUserMock);

        self::assertInstanceOf(CommandInterface::class, $test);
        self::assertSame($mockArgs['UUID']['toNative'], $test->getProcessUuid()->toNative());
        self::assertSame($mockArgs['UUID']['getUuid']['toString'], $test->getUuid()->toString());
        self::assertSame($mockArgs['Uuid']['toNative'], $test->getUserUuid()->toNative());
        self::assertSame($mockArgs['User']['toNative'], $test->getUser()->toNative());
    }
}
