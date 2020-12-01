<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\ValueObject;

use Backend\Api\User\Domain\ValueObject\Nickname;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use MicroModule\ValueObject\StringLiteral\StringLiteral;
use TypeError;

/**
 * Test for class Nickname.
 *
 * @class NicknameTest
 */
class NicknameTest extends UnitTestCase
{
    use ValueObjectMockHelper;

    /**
     * Test for "Returns a StringLiteral object given a PHP native string as parameter".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\Nickname::fromNative
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\NicknameDataProvider::getDataForFromNativeMethod()
     *
     * @param mixed[] $mockArgs
     */
    public function fromNativeShouldReturnStringLiteralTest(array $mockArgs): void
    {
        $value = $mockArgs['value'];
        $test = Nickname::fromNative($value);
        self::assertInstanceOf(StringLiteral::class, $test);
        self::assertInstanceOf(Nickname::class, $test);
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
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\NicknameDataProvider::getInvalidData()
     *
     * @param mixed[] $mockArgs
     */
    public function invalidNativeArgumentTest(array $mockArgs): void
    {
        $this->expectException(TypeError::class);
        $value = $mockArgs['value'];
        new Nickname($value);
    }

    /**
     * Test for "Returns the value of the string".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\Nickname::toNative
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\NicknameDataProvider::getDataForToNativeMethod()
     *
     * @param mixed[] $mockArgs
     */
    public function toNativeShouldReturnStringTest(array $mockArgs): void
    {
        $value = $mockArgs['value'];
        $test = new Nickname($value);
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
     * @covers       \Backend\Api\User\Domain\ValueObject\Nickname::sameValueAs
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject\NicknameDataProvider::getDataForSameValueAsMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function sameValueAsShouldReturnBoolTest(array $mockArgs, array $mockTimes): void
    {
        $value = $mockArgs['value'];
        $test = new Nickname($value);
        $microValueObjectNicknameMock = $this->createDomainValueObjectNicknameMock($mockArgs['ValueObjectNickname'], $mockTimes['ValueObjectNickname']);
        $result = $test->sameValueAs($microValueObjectNicknameMock);

        self::assertTrue($result);
    }

    /**
     * Test for "Tells whether the StringLiteral is empty".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\ValueObject\Nickname::isEmpty
     */
    public function isEmptyShouldReturnBoolTest(): void
    {
        $test = new Nickname('');
        $result = $test->isEmpty();

        self::assertTrue($result);
    }
}
