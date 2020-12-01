<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\Event;

use Assert\AssertionFailedException;
use Backend\Api\User\Domain\Event\UserWasDeletedEvent;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;

/**
 * Test for class UserWasDeletedEvent.
 *
 * @class UserWasDeletedEventTest
 */
class UserWasDeletedEventTest extends UnitTestCase
{
    use ValueObjectMockHelper;

    /**
     * Test for "Return Id".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Event\UserWasDeletedEvent::getProcessUuid
     * @covers       \Backend\Api\User\Domain\Event\UserWasDeletedEvent::getUuid
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserWasDeletedEventDataProvider::getDataForGetMethods()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function testGetMethods(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $test = new UserWasDeletedEvent($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock);

        self::assertSame($mockArgs['UUID']['toNative'], $test->getProcessUuid()->toNative());
        self::assertSame($mockArgs['Uuid']['toNative'], $test->getUuid()->toNative());
    }

    /**
     * Test for "Initialize event from data array".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Event\UserWasDeletedEvent::deserialize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserWasDeletedEventDataProvider::getDataForDeserializeMethod()
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
        ];
        $test = UserWasDeletedEvent::deserialize($data);
        self::assertInstanceOf(UserWasDeletedEvent::class, $test);
        self::assertSame($mockArgs['UUID']['toNative'], $test->getProcessUuid()->toNative());
        self::assertSame($mockArgs['Uuid']['toNative'], $test->getUuid()->toNative());
    }

    /**
     * Test for "Convert event object to array".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Event\UserWasDeletedEvent::serialize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Event\UserWasDeletedEventDataProvider::getDataForSerializeMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function serializeShouldReturnArrayTest(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $test = new UserWasDeletedEvent($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock);
        $result = $test->serialize();

        self::assertArrayHasKey('process_uuid', $result);
        self::assertArrayHasKey('uuid', $result);
        self::assertSame($mockArgs['UUID']['toNative'], $result['process_uuid']);
        self::assertSame($mockArgs['Uuid']['toNative'], $result['uuid']);
    }
}
