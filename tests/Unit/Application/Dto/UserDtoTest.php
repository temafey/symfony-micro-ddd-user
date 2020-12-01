<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Application\Dto;

use Backend\Api\User\Application\Dto\UserDto;
use Backend\Api\User\Tests\Unit\UnitTestCase;

/**
 * Test for class UserDto.
 *
 * @class UserDtoTest
 */
class UserDtoTest extends UnitTestCase
{
    /**
     * Test for "Convert array to dto object.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\Dto\UserDto::denormalize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\Dto\UserDtoDataProvider::getData()
     *
     * @param mixed[] $mockArgs
     */
    public function denormalizeShouldReturnUserDtoTest(array $mockArgs): void
    {
        $data = $mockArgs['data'];
        $test = UserDto::denormalize($data);

        self::assertInstanceOf(UserDto::class, $test);
        self::assertEquals($data['version'], $test->getVersion());
        self::assertEquals($data['uuid'], $test->getUuid());
        self::assertEquals($data['name'], $test->getFirstname());
        self::assertEquals($data['password'], $test->getPassword());
        self::assertEquals($data['nickname'], $test->getNickname());
        self::assertEquals($data['age'], $test->getAge());
        self::assertEquals($data['createdAt'], $test->getCreatedAt());
        self::assertEquals($data['updatedAt'], $test->getUpdatedAt());
    }

    /**
     * Test for "Convert object dto to array.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\Dto\UserDto::normalize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\Dto\UserDtoDataProvider::getData()
     *
     * @param mixed[] $mockArgs
     */
    public function normalizeShouldReturnArrayTest(array $mockArgs): void
    {
        $data = $mockArgs['data'];
        $password = $mockArgs['password'];
        $name = $mockArgs['name'];
        $test = new UserDto($password, $name);
        $test->setUuid($data['uuid']);
        $test->setFirstname($data['name']);
        $test->setPassword($data['password']);
        $test->setNickname($data['nickname']);
        $test->setAge($data['age']);
        $test->setCreatedAt($data['createdAt']);
        $test->setUpdatedAt($data['updatedAt']);
        $data['version'] = $test->getVersion();

        $result = $test->normalize();
        self::assertEquals($data, $result);
    }
}
