<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Application\QueryHandler;

use Backend\Api\User\Application\Dto\UserDto;
use Backend\Api\User\Application\QueryHandler\FetchOneHandler;
use Backend\Api\User\Tests\Unit\Mock\Application\DtoMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Application\ServiceMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\EntityMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\QueryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\RepositoryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;

/**
 * Test for class FetchOneHandler.
 *
 * @class FetchOneHandlerTest
 */
class FetchOneHandlerTest extends UnitTestCase
{
    use ValueObjectMockHelper, EntityMockHelper, RepositoryMockHelper, DtoMockHelper, ServiceMockHelper, QueryMockHelper;

    /**
     * Test for "Handle FetchOneCommand command.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\QueryHandler\FetchOneHandler::handle
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\QueryHandler\FetchOneHandlerDataProvider::getFetchOneHandlerData()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function handleShouldProcessCommandAndReturnMasterDataUserDtoTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryQueryRepositoryInterfaceMock = $this->createDomainRepositoryQueryRepositoryInterfaceMock($mockArgs['QueryRepositoryInterface'], $mockTimes['QueryRepositoryInterface']);
        $applicationServiceUserAssemblerMock = $this->createApplicationServiceUserAssemblerMock($mockArgs['UserAssembler'], $mockTimes['UserAssembler']);
        $test = new FetchOneHandler($domainRepositoryQueryRepositoryInterfaceMock, $applicationServiceUserAssemblerMock);
        $applicationQueryFetchOneCommandMock = $this->createDomainQueryFetchOneCommandMock($mockArgs['FetchOneCommand'], $mockTimes['FetchOneCommand']);
        $result = $test->handle($applicationQueryFetchOneCommandMock);
        self::assertInstanceOf(UserDto::class, $result);
    }
}
