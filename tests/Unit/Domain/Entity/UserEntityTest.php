<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Domain\Entity;

use Backend\Api\User\Domain\Entity\UserEntity;
use Backend\Api\User\Domain\Event\UserIdWasAddedEvent;
use Backend\Api\User\Domain\Event\UserWasDeletedEvent;
use Backend\Api\User\Domain\Event\UserWasRegisteredEvent;
use Backend\Api\User\Domain\Event\UserWasUpdatedEvent;
use Backend\Api\User\Domain\Exception\ValueObjectInvalidException;
use Backend\Api\User\Domain\ValueObject\User as UserValueObject;
use Backend\Api\User\Tests\Unit\Mock\Domain\EventMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\FactoryMockHelper;
use Backend\Api\User\Tests\Unit\Mock\Domain\ValueObjectMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;
use Exception;

/**
 * Test for class UserEntity.
 *
 * @class UserEntityTest
 */
class UserEntityTest extends UnitTestCase
{
    use ValueObjectMockHelper, EventMockHelper, FactoryMockHelper;

    /**
     * Test for "Factory method for create new UserEntity object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Entity\UserEntity::register
     * @covers       \Backend\Api\User\Domain\Entity\UserEntity::isNew
     * @covers       \Backend\Api\User\Domain\Entity\UserEntity::normalize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Entity\UserEntityDataProvider::getDataForCreateMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function createShouldInitializeAndReturnUserEntityAndShouldFireUserWasRegisteredEventTest(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $domainFactoryEventFactoryMock = $this->createDomainFactoryEventFactoryMock($mockArgs['EventFactory'], $mockTimes['EventFactory']);
        $test = UserEntity::register($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectUserMock, $domainFactoryEventFactoryMock);
        self::assertTrue($test->isNew());
        self::assertInstanceOf(UserEntity::class, $test);
        self::assertEquals($mockArgs['EventFactory']['makeUserWasRegisteredEvent']['getUuid']['toNative'], $test->getUuid()->toNative());
        self::assertEquals($mockArgs['EventFactory']['makeUserWasRegisteredEvent']['getUser']['getId']['toNative'], $test->getId()->toNative());
        self::assertEquals($mockArgs['EventFactory']['makeUserWasRegisteredEvent']['getUser']['getName']['toNative'], $test->getName()->toNative());

        $events = $test->getUncommittedEvents();
        self::assertCount(1, $events->getIterator(), 'Only 1 event(s) should be in the buffer');
        $event = $events->getIterator()->current();
        self::assertInstanceOf(UserWasRegisteredEvent::class, $event->getPayload(), 'Event should be UserWasRegisteredEvent');
    }

    /**
     * Test for "Apply unique id to new User".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Entity\UserEntity::addId
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Entity\UserEntityDataProvider::getDataForAddIdMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function addIdShouldFireUserIdWasAddedEventTest(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $domainFactoryEventFactoryMock = $this->createDomainFactoryEventFactoryMock($mockArgs['EventFactory'], $mockTimes['EventFactory']);
        $test = UserEntity::register($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectUserMock, $domainFactoryEventFactoryMock);
        $domainValueObjectIdMock = $this->createDomainValueObjectIdMock($mockArgs['Id'], $mockTimes['Id']);
        $test->addId($domainValueObjectIdMock);
        self::assertEquals($mockArgs['EventFactory']['makeUserWasRegisteredEvent']['getUuid']['toNative'], $test->getUuid()->toNative());
        self::assertEquals($mockArgs['EventFactory']['makeUserWasRegisteredEvent']['getUser']['getName']['toNative'], $test->getName()->toNative());
        self::assertEquals($mockArgs['EventFactory']['makeUserIdWasAddedEvent']['getId']['toNative'], $test->getId()->toNative());

        $events = $test->getUncommittedEvents();
        self::assertCount(2, $events->getIterator(), 'Only 2 event(s) should be in the buffer');
        $event = $events->getIterator()->offsetGet(1);
        self::assertInstanceOf(UserIdWasAddedEvent::class, $event->getPayload(), 'Event should be UserIdWasAddedEvent');
    }

    /**
     * Test for "Update UserEntity".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Entity\UserEntity::update
     * @covers       \Backend\Api\User\Domain\Entity\UserEntity::isWasUpdated
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Entity\UserEntityDataProvider::getDataForUpdateMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function updateShouldFireUserWasUpdatedEventTest(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $domainFactoryEventFactoryMock = $this->createDomainFactoryEventFactoryMock($mockArgs['EventFactory'], $mockTimes['EventFactory']);
        $test = UserEntity::register($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectUserMock, $domainFactoryEventFactoryMock);

        self::assertEquals($mockArgs['EventFactory']['makeUserWasRegisteredEvent']['getUuid']['toNative'], $test->getUuid()->toNative());
        self::assertEquals($mockArgs['EventFactory']['makeUserWasRegisteredEvent']['getUser']['getName']['toNative'], $test->getName()->toNative());
        self::assertEquals($mockArgs['EventFactory']['makeUserWasRegisteredEvent']['getUser']['getNickname']['toNative'], $test->getNickname()->toNative());
        self::assertEquals($mockArgs['EventFactory']['makeUserWasRegisteredEvent']['getUser']['getAge']['toNative'], $test->getAge()->toNative());
        self::assertEquals($mockArgs['EventFactory']['makeUserWasRegisteredEvent']['getUser']['getPassword']['toNative'], $test->getPassword()->toNative());

        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $test->update($domainValueObjectUserMock);

        self::assertEquals($mockArgs['EventFactory']['makeUserWasUpdatedEvent']['getUser']['getName']['toNative'], $test->getName()->toNative());
        self::assertEquals($mockArgs['EventFactory']['makeUserWasUpdatedEvent']['getUser']['getNickname']['toNative'], $test->getNickname()->toNative());
        self::assertEquals($mockArgs['EventFactory']['makeUserWasUpdatedEvent']['getUser']['getAge']['toNative'], $test->getAge()->toNative());
        self::assertEquals($mockArgs['EventFactory']['makeUserWasUpdatedEvent']['getUser']['getPassword']['toNative'], $test->getPassword()->toNative());

        self::assertTrue($test->isWasUpdated());
        $events = $test->getUncommittedEvents();
        self::assertCount(2, $events->getIterator(), 'Only 2 event(s) should be in the buffer');
        $event = $events->getIterator()->offsetGet(1);
        self::assertInstanceOf(UserWasUpdatedEvent::class, $event->getPayload(), 'Event should be UserWasUpdatedEvent');
    }

    /**
     * Test for "Delete user".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Entity\UserEntity::delete
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Entity\UserEntityDataProvider::getDataForDeleteMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function deleteShouldFireUserWasDeletedEventTest(array $mockArgs, array $mockTimes): void
    {
        $microCommonValueObjectIdentityUUIDMock = $this->createMicroModuleValueObjectIdentityUUIDMock($mockArgs['UUID'], $mockTimes['UUID']);
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $domainFactoryEventFactoryMock = $this->createDomainFactoryEventFactoryMock($mockArgs['EventFactory'], $mockTimes['EventFactory']);
        $test = UserEntity::register($microCommonValueObjectIdentityUUIDMock, $domainValueObjectUuidMock, $domainValueObjectUserMock, $domainFactoryEventFactoryMock);
        $test->delete();
        self::assertTrue($test->isWasDeleted());

        $events = $test->getUncommittedEvents();
        self::assertCount(2, $events->getIterator(), 'Only 2 event(s) should be in the buffer');
        $event = $events->getIterator()->offsetGet(1);
        self::assertInstanceOf(UserWasDeletedEvent::class, $event->getPayload(), 'Event should be UserWasDeletedEvent');
    }

    /**
     * Test for "Factory method for create actual UserEntity object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Entity\UserEntity::createActual
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Entity\UserEntityDataProvider::getDataForCreateActualMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws ValueObjectInvalidException
     */
    public function createActualShouldReturnUserEntityTest(array $mockArgs, array $mockTimes): void
    {
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $domainFactoryEventFactoryMock = $this->createDomainFactoryEventFactoryMock($mockArgs['EventFactory'], $mockTimes['EventFactory']);
        $test = UserEntity::createActual($domainValueObjectUuidMock, $domainValueObjectUserMock, $domainFactoryEventFactoryMock);
        self::assertInstanceOf(UserEntity::class, $test);
    }

    /**
     * Test for "Assemble entity from value object".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Entity\UserEntity::assembleFromValueObject
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Entity\UserEntityDataProvider::getDataForAssembleFromValueObjectMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws ValueObjectInvalidException
     */
    public function assembleFromValueObjectTest(array $mockArgs, array $mockTimes): void
    {
        $domainFactoryEventFactoryMock = $this->createDomainFactoryEventFactoryMock($mockArgs['EventFactory'], $mockTimes['EventFactory']);
        $test = new UserEntity($domainFactoryEventFactoryMock);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $test->assembleFromValueObject($domainValueObjectUserMock);

        self::assertEquals($mockArgs['User']['getId']['toNative'], $test->getId()->toNative());
        self::assertEquals($mockArgs['User']['getName']['toNative'], $test->getName()->toNative());
        self::assertEquals($mockArgs['User']['getNickname']['toNative'], $test->getNickname()->toNative());
        self::assertEquals($mockArgs['User']['getAge']['toNative'], $test->getAge()->toNative());
        self::assertEquals($mockArgs['User']['getPassword']['toNative'], $test->getPassword()->toNative());
    }

    /**
     * Test for "Assemble value object from entity".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Entity\UserEntity::assembleToValueObject
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Entity\UserEntityDataProvider::getDataForAssembleToValueObjectMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function assembleToValueObjectShouldReturnValueObjectInterfaceTest(array $mockArgs, array $mockTimes): void
    {
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $domainFactoryEventFactoryMock = $this->createDomainFactoryEventFactoryMock($mockArgs['EventFactory'], $mockTimes['EventFactory']);
        $test = UserEntity::createActual($domainValueObjectUuidMock, $domainValueObjectUserMock, $domainFactoryEventFactoryMock);

        $result = $test->assembleToValueObject();
        self::assertInstanceOf(UserValueObject::class, $result);
        self::assertEquals($mockArgs['User']['getId']['toNative'], $result->getId()->toNative());
        self::assertEquals($mockArgs['User']['getName']['toNative'], $result->getName()->toNative());
        self::assertEquals($mockArgs['User']['getNickname']['toNative'], $result->getNickname()->toNative());
        self::assertEquals($mockArgs['User']['getAge']['toNative'], $result->getAge()->toNative());
        self::assertEquals($mockArgs['User']['getPassword']['toNative'], $result->getPassword()->toNative());
    }

    /**
     * Test for "Convert entity object to array".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Entity\UserEntity::normalize
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Entity\UserEntityDataProvider::getDataForNormalizeMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws Exception
     */
    public function normalizeShouldReturnArrayTest(array $mockArgs, array $mockTimes): void
    {
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $domainFactoryEventFactoryMock = $this->createDomainFactoryEventFactoryMock($mockArgs['EventFactory'], $mockTimes['EventFactory']);
        $test = UserEntity::createActual($domainValueObjectUuidMock, $domainValueObjectUserMock, $domainFactoryEventFactoryMock);

        $result = $test->normalize();
        self::assertEquals($mockArgs['User']['getId']['toNative'], $result['id']);
        self::assertEquals($mockArgs['User']['getName']['toNative'], $result['name']);
        self::assertEquals($mockArgs['User']['getNickname']['toNative'], $result['nickname']);
        self::assertEquals($mockArgs['User']['getAge']['toNative'], $result['age']);
        self::assertEquals($mockArgs['User']['getPassword']['toNative'], $result['password']);
    }

    /**
     * Test for "Return entity primary key value".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Entity\UserEntity::getPrimaryKeyValue
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Entity\UserEntityDataProvider::getDataForGetPrimaryKeyValueMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws ValueObjectInvalidException
     */
    public function getPrimaryKeyValueShouldReturnIntTest(array $mockArgs, array $mockTimes): void
    {
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $domainFactoryEventFactoryMock = $this->createDomainFactoryEventFactoryMock($mockArgs['EventFactory'], $mockTimes['EventFactory']);
        $test = UserEntity::createActual($domainValueObjectUuidMock, $domainValueObjectUserMock, $domainFactoryEventFactoryMock);

        $result = $test->getPrimaryKeyValue();
        self::assertEquals($mockArgs['Uuid']['toNative'], $result);
    }

    /**
     * Test for "Return current aggregate root unique key".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Domain\Entity\UserEntity::getAggregateRootId
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Domain\Entity\UserEntityDataProvider::getDataForGetAggregateRootIdMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     *
     * @throws ValueObjectInvalidException
     */
    public function getAggregateRootIdShouldReturnStringTest(array $mockArgs, array $mockTimes): void
    {
        $domainValueObjectUuidMock = $this->createDomainValueObjectUuidMock($mockArgs['Uuid'], $mockTimes['Uuid']);
        $domainValueObjectUserMock = $this->createDomainValueObjectUserMock($mockArgs['User'], $mockTimes['User']);
        $domainFactoryEventFactoryMock = $this->createDomainFactoryEventFactoryMock($mockArgs['EventFactory'], $mockTimes['EventFactory']);
        $test = UserEntity::createActual($domainValueObjectUuidMock, $domainValueObjectUserMock, $domainFactoryEventFactoryMock);

        $result = $test->getAggregateRootId();
        self::assertEquals($mockArgs['Uuid']['toNative'], $result);
    }
}
