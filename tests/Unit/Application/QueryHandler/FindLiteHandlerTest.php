<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Application\QueryHandler;

use Backend\Api\User\Application\QueryHandler\FindLiteHandler;
use Backend\Api\User\Tests\Unit\Mock\Domain\EntityMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\QueryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\RepositoryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;

/**
 * Test for class FindLiteHandler.
 *
 * @class FindLiteHandlerTest
 */
class FindLiteHandlerTest extends UnitTestCase
{
    use ValueObjectMockHelper, EntityMockHelper, RepositoryMockHelper, QueryMockHelper;

    /**
     * Test for "Handle FindLiteCommand command.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\QueryHandler\FindLiteHandler::handle
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\QueryHandler\FindLiteHandlerDataProvider::getDataForHandleMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function handleShouldProcessCommandAndReturnArrayTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryQueryRepositoryInterfaceMock = $this->createDomainRepositoryQueryLiteRepositoryInterfaceMock($mockArgs['QueryRepositoryInterface'], $mockTimes['QueryRepositoryInterface']);
        $test = new FindLiteHandler($domainRepositoryQueryRepositoryInterfaceMock);
        $applicationQueryFindLiteCommandMock = $this->createDomainQueryFindLiteCommandMock($mockArgs['FindLiteCommand'], $mockTimes['FindLiteCommand']);
        $result = $test->handle($applicationQueryFindLiteCommandMock);

        self::assertTrue(true);
        self::assertCount(1, $result);
        self::assertEquals($mockArgs['handle'][0]['getId']['toNative'], $result[0]['getId']['toNative']);
        self::assertEquals($mockArgs['handle'][0]['getName']['toNative'], $result[0]['getName']['toNative']);
        self::assertEquals($mockArgs['handle'][0]['getNickname']['toNative'], $result[0]['getNickname']['toNative']);
        //self::assertEquals($handles, $result);
    }
}
