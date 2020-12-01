<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Infrastructure\Repository;

use Backend\Api\User\Domain\Exception\UserDeleteException;
use Backend\Api\User\Domain\Exception\UserInsertException;
use Backend\Api\User\Domain\Exception\UserUpdateException;
use Backend\Api\User\Infrastructure\Repository\CommandRepository;
use Backend\Api\User\Tests\Unit\Mock\Domain\EntityMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\RepositoryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;

/**
 * Test for class CommandRepository.
 *
 * @class CommandRepositoryTest
 */
class CommandRepositoryTest extends UnitTestCase
{
    use RepositoryMockHelper, ValueObjectMockHelper, EntityMockHelper;

    /**
     * Test for "Add new user entity".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Infrastructure\Repository\CommandRepository::add
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Infrastructure\Repository\CommandRepositoryDataProvider::getDataForAddMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws UserInsertException
     */
    public function addShouldCallInsertOneInStorageTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryReadModelStoreInterfaceMock = $this->createDomainRepositoryReadModelStoreInterfaceMock($mockArgs['ReadModelStoreInterface'], $mockTimes['ReadModelStoreInterface']);
        $test = new CommandRepository($domainRepositoryReadModelStoreInterfaceMock);
        $domainEntityUserEntityMock = $this->createDomainEntityUserEntityMock($mockArgs['UserEntity'], $mockTimes['UserEntity']);
        $test->add($domainEntityUserEntityMock);
    }

    /**
     * Test for "Update user entity".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Infrastructure\Repository\CommandRepository::update
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Infrastructure\Repository\CommandRepositoryDataProvider::getDataForUpdateMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws UserUpdateException
     */
    public function updateShouldCallUpdateOneStorageTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryReadModelStoreInterfaceMock = $this->createDomainRepositoryReadModelStoreInterfaceMock($mockArgs['ReadModelStoreInterface'], $mockTimes['ReadModelStoreInterface']);
        $test = new CommandRepository($domainRepositoryReadModelStoreInterfaceMock);
        $domainEntityUserEntityMock = $this->createDomainEntityUserEntityMock($mockArgs['UserEntity'], $mockTimes['UserEntity']);
        $test->update($domainEntityUserEntityMock);
    }

    /**
     * Test for "Delete user entity".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Infrastructure\Repository\CommandRepository::delete
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Infrastructure\Repository\CommandRepositoryDataProvider::getDataForDeleteMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws UserDeleteException
     */
    public function deleteShouldCallDeleteOneStorageTest(array $mockArgs, array $mockTimes): void
    {
        $domainRepositoryReadModelStoreInterfaceMock = $this->createDomainRepositoryReadModelStoreInterfaceMock($mockArgs['ReadModelStoreInterface'], $mockTimes['ReadModelStoreInterface']);
        $test = new CommandRepository($domainRepositoryReadModelStoreInterfaceMock);
        $domainEntityUserEntityMock = $this->createDomainEntityUserEntityMock($mockArgs['UserEntity'], $mockTimes['UserEntity']);
        $test->delete($domainEntityUserEntityMock);
    }
}
