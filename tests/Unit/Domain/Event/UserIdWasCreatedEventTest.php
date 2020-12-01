<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\Event;

use Assert\AssertionFailedException;
use Backend\Api\User\Domain\Event\UserIdWasCreatedEvent;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use InvalidArgumentException;

/**
 * Test for class UserIdWasCreatedEvent.
 *
 * @class UserIdWasCreatedEventTest
 */
class UserIdWasCreatedEventTest extends UnitTestCase
{
    use ValueObjectMockHelper;

    /**
     * Test for "Return Id".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Event\UserIdWasCreatedEvent::getProcessUuid
     * @covers       \Backend\Api\User\Domain\Event\UserIdWasCreatedEvent::getUuid
     * @covers       \Backend\Api\User\Domain\Event\UserIdWasCreatedEvent::getId
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserIdWasCreatedEventDataProvider::getDataForGetMethods()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function testGetMethods(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectIdMock = $this->createDomainValueObjectIdMock($mockArgs['Id'], $mockTimes['Id']);
        $test = new UserIdWasCreatedEvent($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectIdMock);

        self::assertSame($mockArgs['UUID']['toNative'], $test->getProcessUuid()->toNative());
        self::assertSame($mockArgs['Uuid']['toNative'], $test->getUuid()->toNative());
        self::assertSame($mockArgs['Id']['toNative'], $test->getId()->toNative());
    }

    /**
     * Test for "Initialize event from data array".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Event\UserIdWasCreatedEvent::deserialize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserIdWasCreatedEventDataProvider::getDataForDeserializeMethod()
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
            'id' => $mockArgs['Id']['toNative'],
        ];
        $test = UserIdWasCreatedEvent::deserialize($data);
        self::assertInstanceOf(UserIdWasCreatedEvent::class, $test);
        self::assertSame($mockArgs['UUID']['toNative'], $test->getProcessUuid()->toNative());
        self::assertSame($mockArgs['Uuid']['toNative'], $test->getUuid()->toNative());
        self::assertSame($mockArgs['Id']['toNative'], $test->getId()->toNative());
    }

    /**
     * Test for "Initialize event from data array".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Event\UserIdWasCreatedEvent::deserialize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserIdWasCreatedEventDataProvider::getDataForDeserializeMethod()
     *
     * @param mixed[] $mockArgs
     *
     * @throws AssertionFailedException
     */
    public function eventShouldFailWhenDeserializeWithWrongDataTest(array $mockArgs): void
    {
        $data = [
            'process_uuid' => (string) $mockArgs['Id']['toNative'],
            'uuid' => $mockArgs['Uuid']['toNative'],
            'id' => $mockArgs['UUID']['toNative'],
        ];
        $this->expectException(InvalidArgumentException::class);
        UserIdWasCreatedEvent::deserialize($data);
    }

    /**
     * Test for "Convert event object to array".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Event\UserIdWasCreatedEvent::serialize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserIdWasCreatedEventDataProvider::getDataForSerializeMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function serializeShouldReturnArrayTest(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectIdMock = $this->createDomainValueObjectIdMock($mockArgs['Id'], $mockTimes['Id']);
        $test = new UserIdWasCreatedEvent($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectIdMock);
        $result = $test->serialize();

        self::assertArrayHasKey('process_uuid', $result);
        self::assertArrayHasKey('uuid', $result);
        self::assertArrayHasKey('id', $result);
        self::assertSame($mockArgs['UUID']['toNative'], $result['process_uuid']);
        self::assertSame($mockArgs['Uuid']['toNative'], $result['uuid']);
        self::assertSame($mockArgs['Id']['toNative'], $result['id']);
    }
}
