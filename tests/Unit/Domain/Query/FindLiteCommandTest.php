<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\Query;

use Backend\Api\User\Domain\Query\FindLiteCommand;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;
use MicroModule\Base\Domain\Command\CommandInterface;

/**
 * Test for class FindLiteCommand.
 *
 * @class FindLiteCommandTest
 */
class FindLiteCommandTest extends UnitTestCase
{
    use ValueObjectMockHelper;

    /**
     * Test for "Return Uuid.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Query\FindLiteCommand::getUuid
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Query\FindLiteCommandDataProvider::getDataForGetUuidMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function FindLiteCommandShouldInstanceOfCommandInterfaceTest(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectFindCriteriaMock = $this->createDomainValueObjectFindCriteriaMock($mockArgs['FindCriteria'], $mockTimes['FindCriteria']);
        $test = new FindLiteCommand($microCommonValueObjectIdentityUUIDMock, $domainValueObjectFindCriteriaMock);
        self::assertInstanceOf(CommandInterface::class, $test);
        self::assertSame($mockArgs['UUID']['getUuid']['toString'], $test->getUuid()->toString());
        self::assertSame($mockArgs['FindCriteria']['toNative'], $test->getFindCriteria()->toNative());
    }
}
