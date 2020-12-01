<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\Factory;

use Backend\Api\User\Domain\Factory\ValueObjectFactory;
use Backend\Api\User\Domain\ValueObject\Age;
use Backend\Api\User\Domain\ValueObject\CreatedAt;
use Backend\Api\User\Domain\ValueObject\Id;
use Backend\Api\User\Domain\ValueObject\Name;
use Backend\Api\User\Domain\ValueObject\Nickname;
use Backend\Api\User\Domain\ValueObject\Password;
use Backend\Api\User\Domain\ValueObject\UpdatedAt;
use Backend\Api\User\Domain\ValueObject\User;
use Backend\Api\User\Domain\ValueObject\Uuid;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;
use MicroModule\ValueObject\DateTime\Exception\InvalidDateException;

/**
 * Test for class ValueObjectFactory.
 *
 * @class ValueObjectFactoryTest
 */
class ValueObjectFactoryTest extends UnitTestCase
{
    /**
     * Test for "Factory method for initialize new User value object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\ValueObjectFactory::makeUser
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Factory\ValueObjectFactoryDataProvider::getDataForMakeUserMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws Exception
     */
    public function makeUserShouldReturnUserTest(array $mockArgs): void
    {
        $test = new ValueObjectFactory();
        $user = $mockArgs['User'];
        $result = $test->makeUser($user);
        self::assertInstanceOf(User::class, $result);
    }

    /**
     * Test for "Factory method for initialize new userId value object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\ValueObjectFactory::makeId
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Factory\ValueObjectFactoryDataProvider::getDataForMakeIdMethod()
     *
     * @param mixed[] $mockArgs
     */
    public function makeIdShouldReturnIdTest(array $mockArgs): void
    {
        $test = new ValueObjectFactory();
        $userId = $mockArgs['userId'];
        $result = $test->makeId($userId);
        self::assertInstanceOf(Id::class, $result);
    }

    /**
     * Test for "Factory method for initialize new uuid value object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\ValueObjectFactory::makeUuid
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Factory\ValueObjectFactoryDataProvider::getDataForMakeUuidMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws Exception
     */
    public function makeUuidShouldReturnUuidTest(array $mockArgs): void
    {
        $test = new ValueObjectFactory();
        $uuid = $mockArgs['uuid'];
        $result = $test->makeUuid($uuid);
        self::assertInstanceOf(Uuid::class, $result);
    }

    /**
     * Test for "Factory method for initialize new Password value object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\ValueObjectFactory::makePassword
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Factory\ValueObjectFactoryDataProvider::getDataForMakePasswordMethod()
     *
     * @param mixed[] $mockArgs
     */
    public function makePasswordShouldReturnPasswordTest(array $mockArgs): void
    {
        $test = new ValueObjectFactory();
        $password = $mockArgs['password'];
        $result = $test->makePassword($password);
        self::assertInstanceOf(Password::class, $result);
    }

    /**
     * Test for "Factory method for initialize new Name value object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\ValueObjectFactory::makeName
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Factory\ValueObjectFactoryDataProvider::getDataForMakeNameMethod()
     *
     * @param mixed[] $mockArgs
     */
    public function makeNameShouldReturnNameTest(array $mockArgs): void
    {
        $test = new ValueObjectFactory();
        $name = $mockArgs['name'];
        $result = $test->makeName($name);
        self::assertInstanceOf(Name::class, $result);
    }

    /**
     * Test for "Factory method for initialize new Nickname value object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\ValueObjectFactory::makeNickname
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Factory\ValueObjectFactoryDataProvider::getDataForMakeNicknameMethod()
     *
     * @param mixed[] $mockArgs
     */
    public function makeNicknameShouldReturnNicknameTest(array $mockArgs): void
    {
        $test = new ValueObjectFactory();
        $nickname = $mockArgs['nickname'];
        $result = $test->makeNickname($nickname);
        self::assertInstanceOf(Nickname::class, $result);
    }

    /**
     * Test for "Factory method for initialize new Age value object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\ValueObjectFactory::makeAge
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Factory\ValueObjectFactoryDataProvider::getDataForMakeAgeMethod()
     *
     * @param mixed[] $mockArgs
     */
    public function makeAgeShouldReturnAgeTest(array $mockArgs): void
    {
        $test = new ValueObjectFactory();
        $age = $mockArgs['age'];
        $result = $test->makeAge($age);
        self::assertInstanceOf(Age::class, $result);
    }

    /**
     * Test for "Factory method for initialize new CreatedAt value object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\ValueObjectFactory::makeCreatedAt
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Factory\ValueObjectFactoryDataProvider::getDataForMakeCreatedAtMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws InvalidDateException
     */
    public function makeCreatedAtShouldReturnCreatedAtTest(array $mockArgs): void
    {
        $test = new ValueObjectFactory();
        $createdAt = $mockArgs['createdAt'];
        $result = $test->makeCreatedAt($createdAt);
        self::assertInstanceOf(CreatedAt::class, $result);
    }

    /**
     * Test for "Factory method for initialize new UpdatedAt value object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Factory\ValueObjectFactory::makeUpdatedAt
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Factory\ValueObjectFactoryDataProvider::getDataForMakeUpdatedAtMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws InvalidDateException
     */
    public function makeUpdatedAtShouldReturnUpdatedAtTest(array $mockArgs): void
    {
        $test = new ValueObjectFactory();
        $updatedAt = $mockArgs['updatedAt'];
        $result = $test->makeUpdatedAt($updatedAt);
        self::assertInstanceOf(UpdatedAt::class, $result);
    }
}
