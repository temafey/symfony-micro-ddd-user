<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\Command;

use Backend\Api\User\Domain\Command\UserAddIdCommand;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;
use MicroModule\Base\Domain\Command\CommandInterface;

/**
 * Test for class UserAddIdCommand.
 *
 * @class UserAddIdCommandTest
 */
class UserAddIdCommandTest extends UnitTestCase
{
    use ValueObjectMockHelper;

    /**
     * Test for get methods in UserAddIdCommand.
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Command\UserAddIdCommand::__construct
     * @covers       \Backend\Api\User\Domain\Command\UserAddIdCommand::getProcessUuid
     * @covers       \Backend\Api\User\Domain\Command\UserAddIdCommand::getUuid
     * @covers       \Backend\Api\User\Domain\Command\UserAddIdCommand::getUserUuid
     * @covers       \Backend\Api\User\Domain\Command\UserAddIdCommand::getId
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Command\UserAddIdCommandDataProvider::getUserAddIdCommandData()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function UserAddIdCommandShouldInstanceOfCommandInterfaceTest(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectIdMock = $this->createDomainValueObjectIdMock($mockArgs['Id'], $mockTimes['Id']);
        $test = new UserAddIdCommand($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectIdMock);

        self::assertInstanceOf(CommandInterface::class, $test);
        self::assertSame($mockArgs['UUID']['toNative'], $test->getProcessUuid()->toNative());
        self::assertSame($mockArgs['UUID']['getUuid']['toString'], $test->getUuid()->toString());
        self::assertSame($mockArgs['Uuid']['toNative'], $test->getUserUuid()->toNative());
        self::assertSame($mockArgs['Id']['toNative'], $test->getId()->toNative());
    }
}
