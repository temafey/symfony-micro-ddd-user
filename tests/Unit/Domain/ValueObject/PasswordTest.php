<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\ValueObject;

use Backend\Api\User\Domain\ValueObject\Password;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use MicroModule\ValueObject\Number\Integer;
use MicroModule\ValueObject\Number\Real;
use TypeError;

/**
 * Test for class Password.
 *
 * @class PasswordTest
 */
class PasswordTest extends UnitTestCase
{
    use ValueObjectMockHelper;

    /**
     * Test for "Tells whether two Integer are equal by comparing their values".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\Password::sameValueAs
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\PasswordDataProvider::getDataForSameValueAsMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function sameValueAsShouldReturnBoolTest(array $mockArgs, array $mockTimes): void
    {
        $value = $mockArgs['value'];
        $test = new Password($value);
        $microDomainValueObjectPasswordMock = $this->createDomainValueObjectPasswordMock($mockArgs['ValueObjectPassword'], $mockTimes['ValueObjectPassword']);
        $result = $test->sameValueAs($microDomainValueObjectPasswordMock);
        self::assertTrue($result);
    }

    /**
     * Test for "Returns the value of the integer number".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\Password::toNative
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\PasswordDataProvider::getDataForToNativeMethod()
     *
     * @param mixed[] $mockArgs
     */
    public function toNativeShouldReturnIntegerTest(array $mockArgs): void
    {
        $value = $mockArgs['value'];
        $test = new Password($value);

        $result = $test->toNative();
        self::assertEquals($mockArgs['toNative'], $result);
    }

    /**
     * Test for "Returns the value of the integer number".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\Password::toNative
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\PasswordDataProvider::getInvalidData()
     *
     * @param mixed[] $mockArgs
     */
    public function invalidNativeArgumentTest(array $mockArgs): void
    {
        $this->expectException(TypeError::class);
        $value = $mockArgs['value'];
        new Password($value);
    }

    /**
     * Test for "Returns a Real with the value of the Integer".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\Password::toReal
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\PasswordDataProvider::getDataForToRealMethod()
     *
     * @param mixed[] $mockArgs
     */
    public function toRealShouldReturnRealTest(array $mockArgs): void
    {
        $value = $mockArgs['value'];
        $test = new Password($value);

        $result = $test->toReal();
        self::assertInstanceOf(Real::class, $result);
    }

    /**
     * Test for "Increment value".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\Password::inc
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\PasswordDataProvider::getDataForIncMethod()
     *
     * @param mixed[] $mockArgs
     */
    public function incShouldReturnIntegerTest(array $mockArgs): void
    {
        $value = $mockArgs['value'];
        $test = new Password($value);

        $result = $test->inc();
        self::assertInstanceOf(Integer::class, $result);
    }

    /**
     * Test for "Decrement value".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\Password::decr
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\PasswordDataProvider::getDataForDecrMethod()
     *
     * @param mixed[] $mockArgs
     */
    public function decrShouldReturnIntegerTest(array $mockArgs): void
    {
        $value = $mockArgs['value'];
        $test = new Password($value);

        $result = $test->decr();
        self::assertInstanceOf(Integer::class, $result);
    }

    /**
     * Test for "Returns a Real object given a PHP native float as parameter".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\Password::fromNative
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\PasswordDataProvider::getDataForFromNativeMethod()
     *
     * @param mixed[] $mockArgs
     */
    public function fromNativeShouldReturnIntegerTest(array $mockArgs): void
    {
        $value = $mockArgs['value'];
        $test = Password::fromNative($value);
        self::assertInstanceOf(Integer::class, $test);
        self::assertInstanceOf(Password::class, $test);
    }
}
