<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\Event;

use Assert\AssertionFailedException;
use Backend\Api\User\Domain\Event\UserWasRegisteredEvent;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;
use InvalidArgumentException;

/**
 * Test for class UserWasRegisteredEvent.
 *
 * @class UserWasRegisteredEventTest
 */
class UserWasRegisteredEventTest extends UnitTestCase
{
    use ValueObjectMockHelper;

    /**
     * Test for "Return User".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Event\UserWasRegisteredEvent::getProcessUuid
     * @covers       \Backend\Api\User\Domain\Event\UserWasRegisteredEvent::getUuid
     * @covers       \Backend\Api\User\Domain\Event\UserWasRegisteredEvent::getUser
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserWasRegisteredEventDataProvider::getDataForGetMethods()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function testGetMethods(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectUserentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $test = new UserWasRegisteredEvent($microCommonValueObjectUserentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectUserMock);

        self::assertSame($mockArgs['UUID']['toNative'], $test->getProcessUuid()->toNative());
        self::assertSame($mockArgs['Uuid']['toNative'], $test->getUuid()->toNative());
        self::assertSame($mockArgs['User']['toNative'], $test->getUser()->toNative());
    }

    /**
     * Test for "Initialize event from data array".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Event\UserWasRegisteredEvent::deserialize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserWasRegisteredEventDataProvider::getDataForDeserializeMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws AssertionFailedException
     */
    public function deserializeShouldReturnUserEventTest(array $mockArgs): void
    {
        $data = [
            'process_uuid' => $mockArgs['UUID']['toNative'],
            'uuid' => $mockArgs['Uuid']['toNative'],
            'user' => $mockArgs['User']['toNative'],
        ];
        $test = UserWasRegisteredEvent::deserialize($data);
        self::assertInstanceOf(UserWasRegisteredEvent::class, $test);
        self::assertSame($mockArgs['UUID']['toNative'], $test->getProcessUuid()->toNative());
        self::assertSame($mockArgs['Uuid']['toNative'], $test->getUuid()->toNative());
        self::assertSame($mockArgs['User']['toNative'], $test->getUser()->toNative());
    }

    /**
     * Test for "Initialize event from data array".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Event\UserWasRegisteredEvent::deserialize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserWasRegisteredEventDataProvider::getDataForDeserializeMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws AssertionFailedException
     */
    public function eventShouldFailWhenDeserializeWithWrongDataTest(array $mockArgs): void
    {
        $data = [
            'process_uuid' => $mockArgs['User']['toNative']['name'],
            'uuid' => $mockArgs['Uuid']['toNative'],
            'user' => $mockArgs['User']['toNative'],
        ];
        $this->expectException(InvalidArgumentException::class);
        UserWasRegisteredEvent::deserialize($data);
    }

    /**
     * Test for "Convert event object to array".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Event\UserWasRegisteredEvent::serialize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserWasRegisteredEventDataProvider::getDataForSerializeMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function serializeShouldReturnArrayTest(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectUserentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $test = new UserWasRegisteredEvent($microCommonValueObjectUserentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectUserMock);
        $result = $test->serialize();

        self::assertArrayHasKey('process_uuid', $result);
        self::assertArrayHasKey('uuid', $result);
        self::assertArrayHasKey('user', $result);
        self::assertSame($mockArgs['UUID']['toNative'], $result['process_uuid']);
        self::assertSame($mockArgs['Uuid']['toNative'], $result['uuid']);
        self::assertSame($mockArgs['User']['toNative'], $result['user']);
    }
}
