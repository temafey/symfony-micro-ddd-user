<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Application\QueryHandler;

use Backend\Api\User\Application\QueryHandler\FindHandler;
use Backend\Api\User\Tests\Unit\Mock\Application\DtoMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Application\ServiceMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\EntityMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\QueryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\RepositoryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;

/**
 * Test for class FindHandler.
 *
 * @class FindHandlerTest
 */
class FindHandlerTest extends UnitTestCase
{
    use ValueObjectMockHelper, EntityMockHelper, RepositoryMockHelper, DtoMockHelper, ServiceMockHelper, QueryMockHelper;

    /**
     * Test for "Handle FindCommand command.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\QueryHandler\FindHandler::handle
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\QueryHandler\FindHandlerDataProvider::getDataForHandleMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function handleShouldProcessCommandAndReturnUserDtoTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryQueryRepositoryInterfaceMock = $this->createDomainRepositoryQueryRepositoryInterfaceMock($mockArgs['QueryRepositoryInterface'], $mockTimes['QueryRepositoryInterface']);
        $applicationServiceUserAssemblerMock = $this->createApplicationServiceUserAssemblerMock($mockArgs['UserAssembler'], $mockTimes['UserAssembler']);
        $test = new FindHandler($domainRepositoryQueryRepositoryInterfaceMock, $applicationServiceUserAssemblerMock);
        $handles = [];

        foreach ($mockArgs['handle'] as $i => $domainDtoUserDtoMock) {
            $handles[] = $this->createApplicationDtoUserDtoMock($domainDtoUserDtoMock, $mockTimes['handle'][$i]);
        }
        $applicationQueryFindCommandMock = $this->createDomainQueryFindCommandMock($mockArgs['FindCommand'], $mockTimes['FindCommand']);
        $result = $test->handle($applicationQueryFindCommandMock);
        self::assertEquals($handles, $result);
    }
}
