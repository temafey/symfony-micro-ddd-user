<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\Factory;

use Backend\Api\User\Domain\Entity\UserEntity;
use Backend\Api\User\Domain\Exception\ValueObjectInvalidException;
use Backend\Api\User\Domain\Factory\UserFactory;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;

/**
 * Test for class UserFactory.
 *
 * @class UserFactoryTest
 */
class UserFactoryTest extends UnitTestCase
{
    use ValueObjectMockHelper;

    /**
     * Test for "Factory method for initialize new UserEntity object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\UserFactory::createInstance
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Factory\UserFactoryDataProvider::getDataForCreateInstanceMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function createInstanceShouldReturnUserEntityTest(array $mockArgs, array $mockTimes): void
    {
        $test = new UserFactory();
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $result = $test->createInstance($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectUserMock);
        self::assertInstanceOf(UserEntity::class, $result);
    }

    /**
     * Test for "Factory method for initialize actual UserEntity object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\UserFactory::makeActualInstance
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Factory\UserFactoryDataProvider::getDataForMakeActualInstanceMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws ValueObjectInvalidException
     */
    public function makeActualInstanceShouldReturnUserEntityTest(array $mockArgs, array $mockTimes): void
    {
        $test = new UserFactory();
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $result = $test->makeActualInstance($domainValueObjectUuidMock, $domainValueObjectUserMock);
        self::assertInstanceOf(UserEntity::class, $result);
    }
}
