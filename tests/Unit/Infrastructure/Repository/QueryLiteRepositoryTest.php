<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Infrastructure\Repository;

use Backend\Api\User\Infrastructure\Repository\QueryLiteRepository;
use Backend\Api\User\Tests\Unit\Mock\Domain\RepositoryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;

/**
 * Test for class QueryLiteRepository.
 *
 * @class QueryLiteRepositoryTest
 */
class QueryLiteRepositoryTest extends UnitTestCase
{
    use RepositoryMockHelper, ValueObjectMockHelper;

    /**
     * Test for "Find and return user entity by user uuid".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Infrastructure\Repository\QueryLiteRepository::findByUuid
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Infrastructure\Repository\QueryLiteRepositoryDataProvider::getDataForFindByUuidMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function findByUuidShouldReturnUserEntityTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryReadModelStoreInterfaceMock = $this->createDomainRepositoryReadModelStoreInterfaceMock($mockArgs['ReadModelStoreInterface'], $mockTimes['ReadModelStoreInterface']);
        $test = new QueryLiteRepository($domainRepositoryReadModelStoreInterfaceMock);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $result = $test->findByUuid($domainValueObjectUuidMock);

        self::assertEquals($mockArgs['ReadModelStoreInterface']['findOne'], $result);
    }

    /**
     * Test for "Find and return array of UserEntity by FindCriteria".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Infrastructure\Repository\QueryLiteRepository::findByCriteria
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Infrastructure\Repository\QueryLiteRepositoryDataProvider::getDataForFindByCriteriaMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function findByCriteriaShouldReturnArrayTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryReadModelStoreInterfaceMock = $this->createDomainRepositoryReadModelStoreInterfaceMock($mockArgs['ReadModelStoreInterface'], $mockTimes['ReadModelStoreInterface']);
        $test = new QueryLiteRepository($domainRepositoryReadModelStoreInterfaceMock);
        $domainValueObjectFindCriteriaMock = $this->createDomainValueObjectFindCriteriaMock($mockArgs['FindCriteria'], $mockTimes['FindCriteria']);
        $result = $test->findByCriteria($domainValueObjectFindCriteriaMock);

        self::assertEquals($mockArgs['ReadModelStoreInterface']['findBy'], $result);
    }
}
