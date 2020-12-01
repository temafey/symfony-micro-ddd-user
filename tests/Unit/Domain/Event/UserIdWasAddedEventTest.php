<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\Event;

use Assert\AssertionFailedException;
use Backend\Api\User\Domain\Event\UserIdWasAddedEvent;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use InvalidArgumentException;

/**
 * Test for class UserIdWasAddedEvent.
 *
 * @class UserIdWasAddedEventTest
 */
class UserIdWasAddedEventTest extends UnitTestCase
{
    use ValueObjectMockHelper;

    /**
     * Test for "Return Id".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Event\UserIdWasAddedEvent::getProcessUuid
     * @covers       \Backend\Api\User\Domain\Event\UserIdWasAddedEvent::getUuid
     * @covers       \Backend\Api\User\Domain\Event\UserIdWasAddedEvent::getId
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserIdWasAddedEventDataProvider::getDataForGetMethods()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function testGetMethods(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectIdMock = $this->createDomainValueObjectIdMock($mockArgs['Id'], $mockTimes['Id']);
        $test = new UserIdWasAddedEvent($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectIdMock);

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
     * @covers       \Backend\Api\User\Domain\Event\UserIdWasAddedEvent::deserialize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserIdWasAddedEventDataProvider::getDataForDeserializeMethod()
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
        $test = UserIdWasAddedEvent::deserialize($data);

        self::assertInstanceOf(UserIdWasAddedEvent::class, $test);
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
     * @covers       \Backend\Api\User\Domain\Event\UserIdWasAddedEvent::deserialize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserIdWasAddedEventDataProvider::getDataForDeserializeMethod()
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
        UserIdWasAddedEvent::deserialize($data);
    }

    /**
     * Test for "Convert event object to array".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Event\UserIdWasAddedEvent::serialize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserIdWasAddedEventDataProvider::getDataForSerializeMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function serializeShouldReturnArrayTest(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectIdMock = $this->createDomainValueObjectIdMock($mockArgs['Id'], $mockTimes['Id']);
        $test = new UserIdWasAddedEvent($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectIdMock);
        $result = $test->serialize();

        self::assertArrayHasKey('process_uuid', $result);
        self::assertArrayHasKey('uuid', $result);
        self::assertArrayHasKey('id', $result);
        self::assertSame($mockArgs['UUID']['toNative'], $result['process_uuid']);
        self::assertSame($mockArgs['Uuid']['toNative'], $result['uuid']);
        self::assertSame($mockArgs['Id']['toNative'], $result['id']);
    }
}
