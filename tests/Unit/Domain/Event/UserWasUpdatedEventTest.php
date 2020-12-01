<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\Event;

use Assert\AssertionFailedException;
use Backend\Api\User\Domain\Event\UserWasUpdatedEvent;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;
use InvalidArgumentException;

/**
 * Test for class UserWasUpdatedEvent.
 *
 * @class UserWasUpdatedEventTest
 */
class UserWasUpdatedEventTest extends UnitTestCase
{
    use ValueObjectMockHelper;

    /**
     * Test for "Return User".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Event\UserWasUpdatedEvent::getProcessUuid
     * @covers       \Backend\Api\User\Domain\Event\UserWasUpdatedEvent::getUuid
     * @covers       \Backend\Api\User\Domain\Event\UserWasUpdatedEvent::getUser
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserWasUpdatedEventDataProvider::getDataForGetMethods()
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
        $test = new UserWasUpdatedEvent($microCommonValueObjectUserentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectUserMock);

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
     * @covers       \Backend\Api\User\Domain\Event\UserWasUpdatedEvent::deserialize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserWasUpdatedEventDataProvider::getDataForDeserializeMethod()
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
        $test = UserWasUpdatedEvent::deserialize($data);
        self::assertInstanceOf(UserWasUpdatedEvent::class, $test);
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
     * @covers       \Backend\Api\User\Domain\Event\UserWasUpdatedEvent::deserialize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserWasUpdatedEventDataProvider::getDataForDeserializeMethod()
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
        UserWasUpdatedEvent::deserialize($data);
    }

    /**
     * Test for "Convert event object to array".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Event\UserWasUpdatedEvent::serialize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserWasUpdatedEventDataProvider::getDataForSerializeMethod()
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
        $test = new UserWasUpdatedEvent($microCommonValueObjectUserentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectUserMock);
        $result = $test->serialize();

        self::assertArrayHasKey('process_uuid', $result);
        self::assertArrayHasKey('uuid', $result);
        self::assertArrayHasKey('user', $result);
        self::assertSame($mockArgs['UUID']['toNative'], $result['process_uuid']);
        self::assertSame($mockArgs['Uuid']['toNative'], $result['uuid']);
        self::assertSame($mockArgs['User']['toNative'], $result['user']);
    }
}
