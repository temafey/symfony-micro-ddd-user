<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\ValueObject;

use Backend\Api\User\Domain\Exception\ValueObjectInvalidException;
use Backend\Api\User\Domain\Exception\ValueObjectInvalidNativeValueException;
use Backend\Api\User\Domain\ValueObject\User;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Broadway\Serializer\Serializable;
use Exception;
use MicroModule\ValueObject\ValueObjectInterface;

/**
 * Test for class User.
 *
 * @class UserTest
 */
class UserTest extends UnitTestCase
{
    use ValueObjectMockHelper;

    /**
     * Test for "Returns a User object given a PHP native string as parameter".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\User::fromNative
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\UserDataProvider::getDataForFromNativeMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws Exception
     */
    public function fromNativeShouldReturnUserTest(array $mockArgs): void
    {
        $value = $mockArgs['value'];
        $test = User::fromNative($value);

        self::assertInstanceOf(User::class, $test);
        self::assertInstanceOf(Serializable::class, $test);
        self::assertInstanceOf(ValueObjectInterface::class, $test);
    }

    /**
     * Test for "Returns the value of the integer number".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\Id::toNative
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\UserDataProvider::getInvalidData()
     *
     * @param mixed[] $mockArgs
     *
     * @throws Exception
     */
    public function invalidNativeArgumentTest(array $mockArgs): void
    {
        $this->expectException(ValueObjectInvalidNativeValueException::class);
        $value = $mockArgs['value'];
        User::fromNative($value);
    }

    /**
     * Test for "Returns the value of the string".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\User::toNative
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\UserDataProvider::getDataForToNativeMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws Exception
     */
    public function toNativeShouldReturnArrayTest(array $mockArgs): void
    {
        $value = $mockArgs['value'];
        $test = User::fromNative($value);
        $result = $test->toNative();

        self::assertEquals($mockArgs['toNative'], $result);
    }

    /**
     * Test for "Tells whether two string literals are equal by comparing their values".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\User::sameValueAs
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\UserDataProvider::getDataForSameValueAsMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws ValueObjectInvalidException
     * @throws Exception
     * @throws Exception
     * @throws Exception
     */
    public function sameValueAsShouldReturnBoolTest(array $mockArgs): void
    {
        $value = $mockArgs['value'];
        $test = User::fromNative($value);
        $test2 = User::fromNative($mockArgs['ValueObjectUser']);
        $test3 = User::fromNative([]);

        self::assertTrue($test->sameValueAs($test2));
        self::assertFalse($test->sameValueAs($test3));
    }

    /**
     * Test for "Convert array to User ValueObject".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\User::deserialize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\UserDataProvider::getDataForDeserializeMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws Exception
     */
    public function deserializeShouldReturnUserTest(array $mockArgs): void
    {
        $data = $mockArgs['data'];
        $test = User::deserialize($data);
        $result = $test->toNative();

        self::assertInstanceOf(User::class, $test);
        self::assertEquals($data, $result);
    }

    /**
     * Test for "Convert User ValueObject to array".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\User::serialize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\UserDataProvider::getDataForSerializeMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws Exception
     */
    public function serializeShouldReturnArrayTest(array $mockArgs): void
    {
        $data = $mockArgs['serialize'];
        $test = User::fromNative($data);
        $result = $test->serialize();

        self::assertEquals($mockArgs['serialize'], $result);
    }
}
