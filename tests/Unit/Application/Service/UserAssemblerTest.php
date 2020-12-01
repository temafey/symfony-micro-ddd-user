<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Application\Service;

use Backend\Api\User\Application\Dto\UserDto;
use Backend\Api\User\Application\Service\UserAssembler;
use Backend\Api\User\Tests\Unit\Mock\Domain\EntityMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;

/**
 * Test for class UserAssembler.
 *
 * @class UserAssemblerTest
 */
class UserAssemblerTest extends UnitTestCase
{
    use ValueObjectMockHelper, EntityMockHelper;

    /**
     * Test for "Assemble UserDto object from UserEntity.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\Service\UserAssembler::writeDto
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\Service\UserAssemblerDataProvider::getDataForWriteDtoMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function writeDtoShouldReturnUserDtoTest(array $mockArgs, array $mockTimes): void
    {
        $test = new UserAssembler();
        $domainEntityUserEntityMock = $this->createDomainEntityUserEntityMock($mockArgs['UserEntity'], $mockTimes['UserEntity']);
        $result = $test->writeDto($domainEntityUserEntityMock);
        self::assertInstanceOf(UserDto::class, $result);
        self::assertEquals($mockArgs['UserEntity']['getUuid']['toNative'], $result->getUuid());
        self::assertEquals($mockArgs['UserEntity']['getPassword']['toNative'], $result->getPassword());
        self::assertEquals($mockArgs['UserEntity']['getName']['toNative'], $result->getFirstname());
        self::assertEquals($mockArgs['UserEntity']['getAge']['toNative'], $result->getAge());
        self::assertEquals($mockArgs['UserEntity']['getNickname']['toNative'], $result->getNickname());
    }
}
