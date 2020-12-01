<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Infrastructure\Repository;

use Backend\Api\User\Domain\Entity\UserEntity;
use Backend\Api\User\Domain\Exception\ValueObjectInvalidException;
use Backend\Api\User\Infrastructure\Repository\QueryRepository;
use Backend\Api\User\Tests\Unit\Mock\Domain\EntityMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\FactoryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\RepositoryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;

/**
 * Test for class QueryRepository.
 *
 * @class QueryRepositoryTest
 */
class QueryRepositoryTest extends UnitTestCase
{
    use RepositoryMockHelper, ValueObjectMockHelper, FactoryMockHelper, EntityMockHelper;

    /**
     * Test for "Find and return user entity by user uuid".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Infrastructure\Repository\QueryRepository::findByUuid
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Infrastructure\Repository\QueryRepositoryDataProvider::getDataForFindByUuidMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function findByUuidShouldReturnUserEntityTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryReadModelStoreInterfaceMock = $this->createDomainRepositoryReadModelStoreInterfaceMock($mockArgs['ReadModelStoreInterface'], $mockTimes['ReadModelStoreInterface']);
        $domainFactoryValueObjectFactoryMock = $this->createDomainFactoryValueObjectFactoryMock($mockArgs['ValueObjectFactory'], $mockTimes['ValueObjectFactory']);
        $domainFactoryUserFactoryMock = $this->createDomainFactoryUserFactoryMock($mockArgs['UserFactory'], $mockTimes['UserFactory']);
        $test = new QueryRepository($domainRepositoryReadModelStoreInterfaceMock, $domainFactoryValueObjectFactoryMock, $domainFactoryUserFactoryMock);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $result = $test->findByUuid($domainValueObjectUuidMock);

        self::assertInstanceOf(UserEntity::class, $result);
    }

    /**
     * Test for "Find and return array of UserEntity by FindCriteria".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Infrastructure\Repository\QueryRepository::findByCriteria
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Infrastructure\Repository\QueryRepositoryDataProvider::getDataForFindByCriteriaMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws ValueObjectInvalidException
     */
    public function findByCriteriaShouldReturnUserEntityTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryReadModelStoreInterfaceMock = $this->createDomainRepositoryReadModelStoreInterfaceMock($mockArgs['ReadModelStoreInterface'], $mockTimes['ReadModelStoreInterface']);
        $domainFactoryValueObjectFactoryMock = $this->createDomainFactoryValueObjectFactoryMock($mockArgs['ValueObjectFactory'], $mockTimes['ValueObjectFactory']);
        $domainFactoryUserFactoryMock = $this->createDomainFactoryUserFactoryMock($mockArgs['UserFactory'], $mockTimes['UserFactory']);
        $test = new QueryRepository($domainRepositoryReadModelStoreInterfaceMock, $domainFactoryValueObjectFactoryMock, $domainFactoryUserFactoryMock);

        $domainValueObjectFindCriteriaMock = $this->createDomainValueObjectFindCriteriaMock($mockArgs['FindCriteria'], $mockTimes['FindCriteria']);
        $result = $test->findByCriteria($domainValueObjectFindCriteriaMock);

        self::assertCount(1, $result);

        foreach ($mockArgs['findByCriteria'] as $i => $domainEntityExpected) {
            self::assertEquals($domainEntityExpected['getUuid']['toNative'], $result[$i]->getUuid()->toNative());
            self::assertEquals($domainEntityExpected['getId']['toNative'], $result[$i]->getId()->toNative());
            self::assertEquals($domainEntityExpected['getName']['toNative'], $result[$i]->getName()->toNative());
            self::assertEquals($domainEntityExpected['getPassword']['toNative'], $result[$i]->getPassword()->toNative());
            self::assertEquals($domainEntityExpected['getAge']['toNative'], $result[$i]->getAge()->toNative());
            self::assertEquals($domainEntityExpected['getNickname']['toNative'], $result[$i]->getNickname()->toNative());
        }
    }
}
