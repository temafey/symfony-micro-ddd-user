<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Application\Factory;

use Backend\Api\User\Domain\Command\UserAddIdCommand;
use Backend\Api\User\Domain\Command\UserDeleteCommand;
use Backend\Api\User\Domain\Command\UserDeleteTaskCommand;
use Backend\Api\User\Domain\Command\UserRegisterCommand;
use Backend\Api\User\Domain\Command\UserRegisterTaskCommand;
use Backend\Api\User\Domain\Command\UserUpdateCommand;
use Backend\Api\User\Domain\Command\UserUpdateTaskCommand;
use Backend\Api\User\Domain\Factory\CommandFactory;
use Backend\Api\User\Domain\Query\FetchOneCommand;
use Backend\Api\User\Domain\Query\FindCommand;
use Backend\Api\User\Tests\Unit\Mock\Application\DtoMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;
use MicroModule\Base\Domain\Command\CommandInterface;
use MicroModule\Base\Domain\Exception\FactoryException;

/**
 * Test for class CommandFactory.
 *
 * @class CommandFactoryTest
 */
class CommandFactoryTest extends UnitTestCase
{
    use DtoMockHelper, ValueObjectMockHelper;

    /**
     * Test for "Build and return FetchOneCommand object.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\CommandFactory::makeCommandInstanceByType
     * @covers       \Backend\Api\User\Domain\Factory\CommandFactory::makeFetchOneCommand
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\Factory\CommandFactoryDataProvider::getDataForMakeFetchOneCommandMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws FactoryException
     */
    public function makeFetchOneCommandShouldReturnFetchOneCommandTest(array $mockArgs): void
    {
        $test = new CommandFactory();
        $uuid = $mockArgs['makeFetchOneCommand'];
        $result = $test->makeCommandInstanceByType(CommandFactory::FETCH_ONE_COMMAND, $uuid);
        self::assertInstanceOf(CommandInterface::class, $result);
        self::assertInstanceOf(FetchOneCommand::class, $result);
        $result = $test->makeFetchOneCommand($uuid);
        self::assertInstanceOf(CommandInterface::class, $result);
        self::assertInstanceOf(FetchOneCommand::class, $result);
    }

    /**
     * Test for "Build and return makeFindCommand object.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\CommandFactory::makeCommandInstanceByType
     * @covers       \Backend\Api\User\Domain\Factory\CommandFactory::makeFindCommand
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\Factory\CommandFactoryDataProvider::getDataForMakeFindCommandMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws FactoryException
     */
    public function makeFindCommandShouldReturnFindCommandTest(array $mockArgs): void
    {
        $test = new CommandFactory();
        $criteria = $mockArgs['makeFindCommand'];
        $result = $test->makeCommandInstanceByType(CommandFactory::FIND_COMMAND, $criteria);
        self::assertInstanceOf(CommandInterface::class, $result);
        self::assertInstanceOf(FindCommand::class, $result);
        $result = $test->makeFindCommand($criteria);
        self::assertInstanceOf(CommandInterface::class, $result);
        self::assertInstanceOf(FindCommand::class, $result);
    }

    /**
     * Test for "Build and return UserRegisterTaskCommand object.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\CommandFactory::makeCommandInstanceByType
     * @covers       \Backend\Api\User\Domain\Factory\CommandFactory::makeUserRegisterTaskCommand
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\Factory\CommandFactoryDataProvider::getDataForMakeUserRegisterTaskCommandMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function makeUserRegisterTaskCommandShouldReturnUserRegisterTaskCommandTest(array $mockArgs, array $mockTimes): void
    {
        $test = new CommandFactory();
        $domainDtoUserDtoMock = $this->createApplicationDtoUserDtoMock($mockArgs['UserDto'], $mockTimes['UserDto']);
        $result = $test->makeCommandInstanceByType(CommandFactory::REGISTER_TASK_COMMAND, $domainDtoUserDtoMock);
        self::assertInstanceOf(CommandInterface::class, $result);
        self::assertInstanceOf(UserRegisterTaskCommand::class, $result);
        $result = $test->makeUserRegisterTaskCommand($domainDtoUserDtoMock);
        self::assertInstanceOf(CommandInterface::class, $result);
        self::assertInstanceOf(UserRegisterTaskCommand::class, $result);
    }

    /**
     * Test for "Build and return UserRegisterTaskCommand object.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\CommandFactory::makeCommandInstanceByType
     * @covers       \Backend\Api\User\Domain\Factory\CommandFactory::makeUserUpdateTaskCommand
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\Factory\CommandFactoryDataProvider::getDataForMakeUserUpdateTaskCommandMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function makeUserUpdateTaskCommandShouldReturnUserUpdateTaskCommandTest(array $mockArgs, array $mockTimes): void
    {
        $test = new CommandFactory();
        $uuid = $mockArgs['makeUserUpdateTaskCommand'];
        $domainDtoUserDtoMock = $this->createApplicationDtoUserDtoMock($mockArgs['UserDto'], $mockTimes['UserDto']);
        $result = $test->makeCommandInstanceByType(CommandFactory::UPDATE_TASK_COMMAND, $uuid, $domainDtoUserDtoMock);
        self::assertInstanceOf(CommandInterface::class, $result);
        self::assertInstanceOf(UserUpdateTaskCommand::class, $result);
        $result = $test->makeUserUpdateTaskCommand($uuid, $domainDtoUserDtoMock);
        self::assertInstanceOf(CommandInterface::class, $result);
        self::assertInstanceOf(UserUpdateTaskCommand::class, $result);
    }

    /**
     * Test for "Build and return UserDeleteTaskCommand object.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\CommandFactory::makeCommandInstanceByType
     * @covers       \Backend\Api\User\Domain\Factory\CommandFactory::makeUserDeleteTaskCommand
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\Factory\CommandFactoryDataProvider::getDataForMakeUserDeleteTaskCommandMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws Exception
     */
    public function makeUserDeleteTaskCommandShouldReturnUserDeleteTaskCommandTest(array $mockArgs): void
    {
        $test = new CommandFactory();
        $uuid = $mockArgs['makeUserDeleteTaskCommand'];
        $result = $test->makeCommandInstanceByType(CommandFactory::DELETE_TASK_COMMAND, $uuid);
        self::assertInstanceOf(CommandInterface::class, $result);
        self::assertInstanceOf(UserDeleteTaskCommand::class, $result);
        $result = $test->makeUserDeleteTaskCommand($uuid);
        self::assertInstanceOf(CommandInterface::class, $result);
        self::assertInstanceOf(UserDeleteTaskCommand::class, $result);
    }

    /**
     * Test for "Build and return ImportUserStartCommand object.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\CommandFactory::makeCommandInstanceByType
     * @covers       \Backend\Api\User\Domain\Factory\CommandFactory::makeUserRegisterCommand
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\Factory\CommandFactoryDataProvider::getDataForMakeUserRegisterCommandMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws Exception
     */
    public function makeUserRegisterCommandShouldReturnUserRegisterCommandTest(array $mockArgs): void
    {
        $test = new CommandFactory();
        $uuid = $mockArgs['makeUserRegisterCommand'];
        $user = $mockArgs['user'];
        $result = $test->makeCommandInstanceByType(CommandFactory::REGISTER_COMMAND, $uuid, $user);
        self::assertInstanceOf(CommandInterface::class, $result);
        self::assertInstanceOf(UserRegisterCommand::class, $result);
        $result = $test->makeUserRegisterCommand($uuid, $user);
        self::assertInstanceOf(CommandInterface::class, $result);
        self::assertInstanceOf(UserRegisterCommand::class, $result);
    }

    /**
     * Test for "Build and return UpdateUserCommand object.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\CommandFactory::makeCommandInstanceByType
     * @covers       \Backend\Api\User\Domain\Factory\CommandFactory::makeUserUpdateCommand
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\Factory\CommandFactoryDataProvider::getDataForMakeUserUpdateCommandMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws Exception
     */
    public function makeUserUpdateCommandShouldReturnUserUpdateCommandTest(array $mockArgs): void
    {
        $test = new CommandFactory();
        $processUuid = $mockArgs['UUID']['toNative'];
        $uuid = $mockArgs['makeUserUpdateCommand'];
        $user = $mockArgs['user'];
        $result = $test->makeCommandInstanceByType(CommandFactory::UPDATE_COMMAND, $processUuid, $uuid, $user);
        self::assertInstanceOf(CommandInterface::class, $result);
        self::assertInstanceOf(UserUpdateCommand::class, $result);
        $result = $test->makeUserUpdateCommand($processUuid, $uuid, $user);
        self::assertInstanceOf(CommandInterface::class, $result);
        self::assertInstanceOf(UserUpdateCommand::class, $result);
    }

    /**
     * Test for "Build and return UserDeleteCommand object.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\CommandFactory::makeCommandInstanceByType
     * @covers       \Backend\Api\User\Domain\Factory\CommandFactory::makeUserDeleteCommand
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\Factory\CommandFactoryDataProvider::getDataForMakeUserDeleteCommandMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws Exception
     */
    public function makeUserDeleteCommandShouldReturnUserDeleteCommandTest(array $mockArgs): void
    {
        $test = new CommandFactory();
        $processUuid = $mockArgs['UUID']['toNative'];
        $uuid = $mockArgs['makeUserDeleteCommand'];
        $result = $test->makeCommandInstanceByType(CommandFactory::DELETE_COMMAND, $processUuid, $uuid);
        self::assertInstanceOf(CommandInterface::class, $result);
        self::assertInstanceOf(UserDeleteCommand::class, $result);
        $result = $test->makeUserDeleteCommand($processUuid, $uuid);
        self::assertInstanceOf(CommandInterface::class, $result);
        self::assertInstanceOf(UserDeleteCommand::class, $result);
    }

    /**
     * Test for "Build and return UserDeleteCommand object.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\CommandFactory::makeUserAddIdCommand
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\Factory\CommandFactoryDataProvider::getDataForMakeUserAddIdCommandMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws FactoryException
     */
    public function makeUserAddIdCommandShouldReturnUserAddIdCommandTest(array $mockArgs, array $mockTimes): void
    {
        $test = new CommandFactory();
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectIdMock = $this->createDomainValueObjectIdMock($mockArgs['Id'], $mockTimes['Id']);
        $result = $test->makeCommandInstanceByType(CommandFactory::ADD_ID_COMMAND, $microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectIdMock);
        self::assertInstanceOf(CommandInterface::class, $result);
        self::assertInstanceOf(UserAddIdCommand::class, $result);
        $result = $test->makeUserAddIdCommand($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectIdMock);
        self::assertInstanceOf(CommandInterface::class, $result);
        self::assertInstanceOf(UserAddIdCommand::class, $result);
    }
}
