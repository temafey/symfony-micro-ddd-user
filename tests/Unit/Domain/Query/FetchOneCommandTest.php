<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\Query;

use Backend\Api\User\Domain\Query\FetchOneCommand;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;
use MicroModule\Base\Domain\Command\CommandInterface;

/**
 * Test for class FetchOneCommand.
 *
 * @class FetchOneCommandTest
 */
class FetchOneCommandTest extends UnitTestCase
{
    use ValueObjectMockHelper;

    /**
     * Test for "Return Uid ValueObject.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Query\FetchOneCommand::getUserUuid
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Query\FetchOneCommandDataProvider::getFetchOneCommandData()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function FetchOneCommandShouldInstanceOfCommandInterfaceTest(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $test = new FetchOneCommand($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock);
        self::assertInstanceOf(CommandInterface::class, $test);
        self::assertSame($mockArgs['UUID']['getUuid']['toString'], $test->getUuid()->toString());
        self::assertSame($mockArgs['Uuid']['toNative'], $test->getUserUuid()->toNative());
    }
}
