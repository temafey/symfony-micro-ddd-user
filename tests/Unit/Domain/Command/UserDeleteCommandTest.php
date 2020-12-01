<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\Command;

use Backend\Api\User\Domain\Command\UserDeleteCommand;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;
use MicroModule\Base\Domain\Command\CommandInterface;

/**
 * Test for class UserDeleteCommand.
 *
 * @class UserDeleteCommandTest
 */
class UserDeleteCommandTest extends UnitTestCase
{
    use ValueObjectMockHelper;

    /**
     * Test for get methods in UserDeleteCommand.
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Command\UserDeleteCommand::__construct
     * @covers       \Backend\Api\User\Domain\Command\UserDeleteCommand::getProcessUuid
     * @covers       \Backend\Api\User\Domain\Command\UserDeleteCommand::getUuid
     * @covers       \Backend\Api\User\Domain\Command\UserDeleteCommand::getUserUuid
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Command\UserDeleteCommandDataProvider::getDataForGetUserUuidMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function UserDeleteCommandShouldInstanceOfCommandInterfaceTest(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $test = new UserDeleteCommand($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock);

        self::assertInstanceOf(CommandInterface::class, $test);
        self::assertSame($mockArgs['UUID']['toNative'], $test->getProcessUuid()->toNative());
        self::assertSame($mockArgs['UUID']['getUuid']['toString'], $test->getUuid()->toString());
        self::assertSame($mockArgs['Uuid']['toNative'], $test->getUserUuid()->toNative());
    }
}
