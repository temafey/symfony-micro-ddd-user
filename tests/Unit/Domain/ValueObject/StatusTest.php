<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\ValueObject;

use Backend\Api\User\Domain\Exception\AgeInvalidException;
use Backend\Api\User\Domain\ValueObject\Age;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use MicroModule\ValueObject\Number\Integer;
use MicroModule\ValueObject\Number\Real;
use TypeError;

/**
 * Test for class Age.
 *
 * @class AgeTest
 */
class AgeTest extends UnitTestCase
{
    use ValueObjectMockHelper;

    /**
     * Test for "Returns a Real object given a PHP native float as parameter".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\Age::fromNative
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\AgeDataProvider::getDataForFromNativeMethod()
     *
     * @param mixed[] $mockArgs
     */
    public function fromNativeShouldReturnIntegerTest(array $mockArgs): void
    {
        $value = $mockArgs['value'];
        $test = Age::fromNative($value);

        self::assertInstanceOf(Integer::class, $test);
        self::assertInstanceOf(Age::class, $test);
    }

    /**
     * Test for "Tells whether two Integer are equal by comparing their values".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\Age::sameValueAs
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\AgeDataProvider::getDataForSameValueAsMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws AgeInvalidException
     */
    public function sameValueAsShouldReturnBoolTest(array $mockArgs, array $mockTimes): void
    {
        $value = $mockArgs['value'];
        $test = new Age($value);
        $microDomainValueObjectAgeMock = $this->createDomainValueObjectAgeMock($mockArgs['ValueObjectAge'], $mockTimes['ValueObjectAge']);
        $result = $test->sameValueAs($microDomainValueObjectAgeMock);

        self::assertTrue($result);
    }

    /**
     * Test for "Returns the value of the integer number".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\Age::toNative
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\AgeDataProvider::getDataForToNativeMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws AgeInvalidException
     */
    public function toNativeShouldReturnIntegerTest(array $mockArgs): void
    {
        $value = $mockArgs['value'];
        $test = new Age($value);
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
     * @covers       \Backend\Api\User\Domain\ValueObject\Age::toNative
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\AgeDataProvider::getInvalidTypeErrorData()
     *
     * @param mixed[] $mockArgs
     *
     * @throws AgeInvalidException
     */
    public function invalidNativeArgumentTypeErrorExceptionTest(array $mockArgs): void
    {
        $this->expectException(TypeError::class);
        $value = $mockArgs['value'];
        new Age($value);
    }

    /**
     * Test for "Returns the value of the integer number".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\Age::toNative
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\AgeDataProvider::getInvalidAgeInvalidExceptionData()
     *
     * @param mixed[] $mockArgs
     *
     * @throws AgeInvalidException
     */
    public function invalidNativeArgumentAgeInvalidExceptionTest(array $mockArgs): void
    {
        $this->expectException(AgeInvalidException::class);
        $value = $mockArgs['value'];
        new Age($value);
    }

    /**
     * Test for "Returns a Real with the value of the Integer".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\Age::toReal
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\AgeDataProvider::getDataForToRealMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws AgeInvalidException
     */
    public function toRealShouldReturnRealTest(array $mockArgs): void
    {
        $value = $mockArgs['value'];
        $test = new Age($value);
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
     * @covers       \Backend\Api\User\Domain\ValueObject\Age::inc
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\AgeDataProvider::getDataForIncMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws AgeInvalidException
     */
    public function incShouldChangeAgeValueTest(array $mockArgs): void
    {
        $value = $mockArgs['value'];
        $test = new Age($value);
        $result = $test->inc();

        self::assertInstanceOf(Integer::class, $result);
        self::assertTrue($test->sameValueAs($result));
    }

    /**
     * Test for "Decrement value".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\Age::decr
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\AgeDataProvider::getDataForDecrMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws AgeInvalidException
     */
    public function decrShouldChangeAgeValueTest(array $mockArgs): void
    {
        $value = $mockArgs['value'];
        $test = new Age($value);
        $result = $test->decr();

        self::assertInstanceOf(Integer::class, $result);
        self::assertTrue($test->sameValueAs($result));
    }
}
