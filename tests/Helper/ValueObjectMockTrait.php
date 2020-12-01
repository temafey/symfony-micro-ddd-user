<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Helper;

use Backend\Api\User\Domain\Factory\ValueObjectFactory;
use Backend\Api\User\Domain\ValueObject\Age;
use Backend\Api\User\Domain\ValueObject\CreatedAt;
use Backend\Api\User\Domain\ValueObject\Id;
use Backend\Api\User\Domain\ValueObject\Name;
use Backend\Api\User\Domain\ValueObject\Nickname;
use Backend\Api\User\Domain\ValueObject\Password;
use Backend\Api\User\Domain\ValueObject\UpdatedAt;
use Backend\Api\User\Domain\ValueObject\User;
use DateTime;
use MicroModule\Base\Domain\ValueObject\ObjectStorage;
use MicroModule\ValueObject\Identity\UUID as ValueObjectUUID;
use MicroModule\ValueObject\Number\Integer as ValueObjectInteger;
use MicroModule\ValueObject\Number\Natural;
use MicroModule\ValueObject\StringLiteral\StringLiteral;
use MicroModule\ValueObject\Structure\Collection;
use Mockery;
use Mockery\MockInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Trait ValueObjectMockTrait.
 *
 * @category Tests\Unit\Utils
 */
trait ValueObjectMockTrait
{
    /**
     * Create Uuid mock.
     *
     * @param string      $className
     * @param string|null $uuid
     * @param mixed[]     $times
     *
     * @return MockInterface|Uuid
     *
     * @SuppressWarnings(PHPMD)
     */
    protected function createUuidValueObjectMock(string $className, ?string $uuid, array $times = ['toNative' => 0, 'getUuid' => 0, 'toString' => 0]): MockInterface
    {
        $mock = Mockery::mock($className);
        $uuidMockedToStringMethod = $mock
            ->shouldReceive('toNative');

        if (null === $times['toNative']) {
            $uuidMockedToStringMethod->zeroOrMoreTimes();
        } else {
            $uuidMockedToStringMethod->times($times['toNative']);
        }
        $uuidMockedGetUuidMethod = $mock
            ->shouldReceive('getUuid');

        if (null === $times['getUuid']) {
            $uuidMockedGetUuidMethod->zeroOrMoreTimes();
        } else {
            $uuidMockedGetUuidMethod->times($times['getUuid']);
        }
        $uuidMockedToStringMethod->andReturn($uuid);
        $ramseyUuidMock = $this->createRamseyUuidMock($uuid, $times['toString']);
        $uuidMockedGetUuidMethod->andReturn($ramseyUuidMock);

        return $mock;
    }

    /**
     * Create UuidInterface mock.
     *
     * @param string   $uuid
     * @param int|null $times
     *
     * @return MockInterface|UuidInterface
     *
     * @SuppressWarnings(PHPMD)
     */
    protected function createRamseyUuidMock(string $uuid, ?int $times = 0): MockInterface
    {
        $mock = Mockery::mock(UuidInterface::class);
        $uuidMockedToStringMethod = $mock
            ->shouldReceive('toString');

        if (null === $times) {
            $uuidMockedToStringMethod->zeroOrMoreTimes();
        } else {
            $uuidMockedToStringMethod->times($times);
        }
        $uuidMockedToStringMethod->andReturn($uuid);

        return $mock;
    }

    /**
     * Create StringLiteral mock.
     *
     * @param string      $className
     * @param string|null $value
     * @param int|null    $times
     *
     * @return MockInterface|StringLiteral
     */
    protected function createStringLiteralValueObjectMock(string $className, $value, ?int $times = 0): MockInterface
    {
        $mock = Mockery::mock($className);
        $mockedToNativeMethod = $mock
            ->shouldReceive('toNative');

        if (null === $times) {
            $mockedToNativeMethod->zeroOrMoreTimes();
        } else {
            $mockedToNativeMethod->times($times);
        }
        $mockedToNativeMethod->andReturn($value);

        return $mock;
    }

    /**
     * Create Integer mock.
     *
     * @param string          $className
     * @param int|string|null $value
     * @param int|null        $times
     *
     * @return MockInterface|ValueObjectInteger
     */
    protected function createIntegerValueObjectMock(string $className, $value, ?int $times = 0): MockInterface
    {
        $mock = Mockery::mock($className);
        $mockedToNativeMethod = $mock
            ->shouldReceive('toNative');

        if (null === $times) {
            $mockedToNativeMethod->zeroOrMoreTimes();
        } else {
            $mockedToNativeMethod->times($times);
        }
        $mockedToNativeMethod->andReturn($value);

        $mock
            ->shouldReceive('inc')
            ->times(0)
            ->andReturn(++$value);

        return $mock;
    }

    /**
     * Create Natural mock.
     *
     * @param string   $className
     * @param int|null $value
     * @param int|null $times
     *
     * @return MockInterface|ValueObjectInteger
     */
    protected function createNaturalValueObjectMock(string $className, $value, ?int $times = 0): MockInterface
    {
        return $this->createIntegerValueObjectMock($className, $value, $times);
    }

    /**
     * Create Date mock.
     *
     * @param string      $className
     * @param string|null $value
     * @param int|null    $times
     *
     * @return MockInterface|StringLiteral
     */
    protected function createDateValueObjectMock(string $className, $value, ?int $times = 0): MockInterface
    {
        $mock = Mockery::mock($className);
        $mockedToNativeMethod = $mock
            ->shouldReceive('toNative');

        if (null === $times) {
            $mockedToNativeMethod->zeroOrMoreTimes();
        } else {
            $mockedToNativeMethod->times($times);
        }

        $mockDate = Mockery::mock(DateTime::class);
        $mockedFormatMethod = $mockDate
            ->shouldReceive('format');

        if (null === $times) {
            $mockedFormatMethod->zeroOrMoreTimes();
        } else {
            $mockedFormatMethod->times($times);
        }
        $mockedFormatMethod->andReturn($value);

        $mockedToNativeMethod->andReturn($mockDate);

        return $mock;
    }

    /**
     * Create ObjectStorage mock.
     *
     * @param string       $className
     * @param mixed[]|null $value
     * @param int|null     $times
     *
     * @return MockInterface|ObjectStorage
     */
    protected function createObjectStorageValueObjectMock(string $className, ?array $value, ?int $times = 0): MockInterface
    {
        $mock = Mockery::mock($className);
        $mockedToNativeMethod = $mock
            ->shouldReceive('toArray');

        if (null === $times) {
            $mockedToNativeMethod->zeroOrMoreTimes();
        } else {
            $mockedToNativeMethod->times($times);
        }
        $mockedToNativeMethod->andReturn($value);

        return $mock;
    }

    /**
     * Create Collection mock.
     *
     * @param string       $className
     * @param mixed[]|null $value
     * @param mixed[]|null $times
     *
     * @return MockInterface|Collection
     */
    protected function createCollectionValueObjectMock(string $className, ?array $value, $times = null): MockInterface
    {
        $mock = Mockery::mock($className);

        if (null === $times) {
            $times = [
                'toNative' => null,
                'toArray' => null,
                'count' => null,
            ];
        } elseif (!is_array($times)) {
            $times = [
                'toNative' => $times,
                'toArray' => $times,
                'count' => null,
            ];
        }

        $valueObjects = [];

        foreach ($value as $user) {
            $valueObjects[] = StringLiteral::fromNative($user);
        }

        $mockedToNativeMethod = $mock
            ->shouldReceive('toNative');

        if (null === $times['toNative']) {
            $mockedToNativeMethod->zeroOrMoreTimes();
        } else {
            $mockedToNativeMethod->times($times['toNative']);
        }
        $mockedToNativeMethod->andReturn($value);

        $mockedToNativeMethod = $mock
            ->shouldReceive('toArray');

        if (null === $times['toArray']) {
            $mockedToNativeMethod->zeroOrMoreTimes();
        } else {
            $mockedToNativeMethod->times($times['toArray']);
        }
        $mockedToNativeMethod->andReturnUsing(static function ($argument = true) use ($valueObjects, $value) {
            if (false === $argument) {
                return $valueObjects;
            }

            return $value;
        });

        $mockedToNativeMethod = $mock
            ->shouldReceive('count');

        if (null === $times['count']) {
            $mockedToNativeMethod->zeroOrMoreTimes();
        } else {
            $mockedToNativeMethod->times($times['count']);
        }
        $mockedToNativeMethod->andReturn($this->createNaturalValueObjectMock(Natural::class, count($value), $times['count']));

        return $mock;
    }

    /**
     * Create Program mock.
     *
     * @param mixed[] $user
     * @param mixed[] $times
     *
     * @return MockInterface
     */
    protected function createUserValueObjectMock(array $user, array $times = []): MockInterface
    {
        $mock = Mockery::mock(User::class);

        if (array_key_exists('toNative', $times)) {
            $getValueObjectMethod = $mock
                ->shouldReceive('toNative');

            if (null === $times['toNative']) {
                $getValueObjectMethod->zeroOrMoreTimes();
            } else {
                $getValueObjectMethod->times($times['toNative']);
            }
            $getValueObjectMethod->andReturn($user);
        }

        if (array_key_exists('id', $times)) {
            $getValueObjectMethod = $mock
                ->shouldReceive('getId');

            if (null === $times['id']) {
                $getValueObjectMethod->zeroOrMoreTimes();
            } else {
                $getValueObjectMethod->times((is_array($times['id']) ? $times['id']['getId'] : $times['id']));
            }

            if (null === $user['id']) {
                $getValueObjectMethod->andReturnNull();
            } else {
                $getValueObjectMethod->andReturn($this->createIntegerValueObjectMock(Id::class, $user['id'], (is_array($times['id']) ? $times['id']['toNative'] : $times['id'])));
            }
        }

        if (array_key_exists('password', $times)) {
            $getValueObjectMethod = $mock
                ->shouldReceive('getPassword');

            if (null === $times['password']) {
                $getValueObjectMethod->zeroOrMoreTimes();
            } else {
                $getValueObjectMethod->times((is_array($times['password']) ? $times['password']['getPassword'] : $times['password']));
            }

            if (null === $user['password']) {
                $getValueObjectMethod->andReturnNull();
            } else {
                $getValueObjectMethod->andReturn($this->createIntegerValueObjectMock(Password::class, $user['password'], (is_array($times['password']) ? $times['password']['toNative'] : $times['password'])));
            }
        }

        if (array_key_exists('name', $times)) {
            $getValueObjectMethod = $mock
                ->shouldReceive('getName');

            if (null === $times['name']) {
                $getValueObjectMethod->zeroOrMoreTimes();
            } else {
                $getValueObjectMethod->times((is_array($times['name']) ? $times['name']['getName'] : $times['name']));
            }

            if (null === $user['name']) {
                $getValueObjectMethod->andReturnNull();
            } else {
                $getValueObjectMethod->andReturn($this->createStringLiteralValueObjectMock(Name::class, $user['name'], (is_array($times['name']) ? $times['name']['toNative'] : $times['name'])));
            }
        }

        if (array_key_exists('age', $times)) {
            $getValueObjectMethod = $mock
                ->shouldReceive('getAge');

            if (null === $times['age']) {
                $getValueObjectMethod->zeroOrMoreTimes();
            } else {
                $getValueObjectMethod->times((is_array($times['age']) ? $times['age']['getAge'] : $times['age']));
            }

            if (null === $user['age']) {
                $getValueObjectMethod->andReturnNull();
            } else {
                $ageValueObjectMock = $this->createAgeValueObject($user['age'], $times['age']);
                $getValueObjectMethod->andReturn($ageValueObjectMock);
            }
        }

        if (array_key_exists('nickname', $times)) {
            $getValueObjectMethod = $mock
                ->shouldReceive('getNickname');

            if (null === $times['nickname']) {
                $getValueObjectMethod->zeroOrMoreTimes();
            } else {
                $getValueObjectMethod->times((is_array($times['nickname']) ? $times['nickname']['getNickname'] : $times['nickname']));
            }

            if (null === $user['nickname']) {
                $getValueObjectMethod->andReturnNull();
            } else {
                $getValueObjectMethod->andReturn($this->createStringLiteralValueObjectMock(Nickname::class, $user['nickname'], (is_array($times['nickname']) ? $times['nickname']['toNative'] : $times['nickname'])));
            }
        }

        if (array_key_exists('createdAt', $times)) {
            $getValueObjectMethod = $mock
                ->shouldReceive('getCreatedAt');

            if (null === $times['createdAt']) {
                $getValueObjectMethod->zeroOrMoreTimes();
            } else {
                $getValueObjectMethod->times((is_array($times['createdAt']) ? $times['createdAt']['getCreatedAt'] : $times['createdAt']));
            }

            if (null === $user['createdAt']) {
                $getValueObjectMethod->andReturnNull();
            } else {
                $getValueObjectMethod->andReturn($this->createDateValueObjectMock(CreatedAt::class, $user['createdAt'], (is_array($times['createdAt']) ? $times['createdAt']['toNative'] : $times['createdAt'])));
            }
        }

        if (array_key_exists('updatedAt', $times)) {
            $getValueObjectMethod = $mock
                ->shouldReceive('getUpdatedAt');

            if (null === $times['updatedAt']) {
                $getValueObjectMethod->zeroOrMoreTimes();
            } else {
                $getValueObjectMethod->times((is_array($times['updatedAt']) ? $times['updatedAt']['getUpdatedAt'] : $times['updatedAt']));
            }

            if (null === $user['updatedAt']) {
                $getValueObjectMethod->andReturnNull();
            } else {
                $getValueObjectMethod->andReturn($this->createDateValueObjectMock(UpdatedAt::class, $user['updatedAt'], (is_array($times['updatedAt']) ? $times['updatedAt']['toNative'] : $times['createdAt'])));
            }
        }

        return $mock;
    }

    /**
     * Create ValueObjectFactory mock.
     *
     * @param mixed[] $user
     * @param mixed[] $times
     *
     * @return MockInterface
     */
    protected function createValueObjectFactoryMock(array $user, array $times = []): MockInterface
    {
        $mock = Mockery::mock(ValueObjectFactory::class);

        if (array_key_exists('user', $user)) {
            if (!isset($times['user'])) {
                $times['user'] = null;
            }
            $makeValueObjectMethod = $mock
                ->shouldReceive('makeUser');

            if (null === $times['user']) {
                $makeValueObjectMethod->zeroOrMoreTimes();
            } else {
                $makeValueObjectMethod->times((is_array($times['user']) ? $times['user']['makeUser'] : $times['user']));
            }
            $makeValueObjectMethod->andReturn($this->createUserValueObjectMock($user['user'], (is_array($times['user']) ? $times['user']['toNative'] : $times['user'])));
        }

        if (array_key_exists('uuid', $times)) {
            $makeValueObjectMethod = $mock
                ->shouldReceive('makeUuid');

            if (null === $times['uuid']) {
                $makeValueObjectMethod->zeroOrMoreTimes();
            } else {
                $makeValueObjectMethod->times((is_array($times['uuid']) ? $times['uuid']['makeUuid'] : $times['uuid']));
            }
            $makeValueObjectMethod->andReturn($this->createUuidValueObjectMock(ValueObjectUUID::class, $user['uuid'], (is_array($times['uuid']) ? $times['uuid']['toNative'] : $times['uuid'])));
        }

        if (array_key_exists('uuid', $times)) {
            $makeValueObjectMethod = $mock
                ->shouldReceive('makeUuid');

            if (null === $times['uuid']) {
                $makeValueObjectMethod->zeroOrMoreTimes();
            } else {
                $makeValueObjectMethod->times((is_array($times['uuid']) ? $times['uuid']['makeUuid'] : $times['uuid']));
            }
            $makeValueObjectMethod->andReturn($this->createUuidValueObjectMock(\Backend\Api\User\Domain\ValueObject\Uuid::class, $user['uuid'], (is_array($times['uuid']) ? $times['uuid']['toNative'] : $times['uuid'])));
        }

        if (array_key_exists('id', $times)) {
            $makeValueObjectMethod = $mock
                ->shouldReceive('makeId');

            if (null === $times['id']) {
                $makeValueObjectMethod->zeroOrMoreTimes();
            } else {
                $makeValueObjectMethod->times((is_array($times['id']) ? $times['id']['makeId'] : $times['id']));
            }

            if (null === $user['id']) {
                $makeValueObjectMethod->andReturnNull();
            } else {
                $makeValueObjectMethod->andReturn($this->createIntegerValueObjectMock(Id::class, $user['id'], (is_array($times['id']) ? $times['id']['toNative'] : $times['id'])));
            }
        }

        if (array_key_exists('password', $times)) {
            $makeValueObjectMethod = $mock
                ->shouldReceive('makePassword');

            if (null === $times['password']) {
                $makeValueObjectMethod->zeroOrMoreTimes();
            } else {
                $makeValueObjectMethod->times((is_array($times['password']) ? $times['password']['makePassword'] : $times['password']));
            }

            if (null === $user['password']) {
                $makeValueObjectMethod->andReturnNull();
            } else {
                $makeValueObjectMethod->andReturn($this->createIntegerValueObjectMock(Password::class, $user['password'], (is_array($times['password']) ? $times['password']['toNative'] : $times['password'])));
            }
        }

        if (array_key_exists('name', $times)) {
            $makeValueObjectMethod = $mock
                ->shouldReceive('makeName');

            if (null === $times['name']) {
                $makeValueObjectMethod->zeroOrMoreTimes();
            } else {
                $makeValueObjectMethod->times((is_array($times['name']) ? $times['name']['makeName'] : $times['name']));
            }

            if (null === $user['name']) {
                $makeValueObjectMethod->andReturnNull();
            } else {
                $makeValueObjectMethod->andReturn($this->createStringLiteralValueObjectMock(Name::class, $user['name'], (is_array($times['name']) ? $times['name']['toNative'] : $times['name'])));
            }
        }

        if (array_key_exists('age', $times)) {
            $makeValueObjectMethod = $mock
                ->shouldReceive('makeAge');

            if (null === $times['age']) {
                $makeValueObjectMethod->zeroOrMoreTimes();
            } else {
                $makeValueObjectMethod->times((is_array($times['age']) ? $times['age']['makeAge'] : $times['age']));
            }

            if (null === $user['age']) {
                $makeValueObjectMethod->andReturnNull();
            } else {
                $ageValueObjectMock = $this->createAgeValueObject($user['age'], $times['age']);
                $makeValueObjectMethod->andReturn($ageValueObjectMock);
            }
        }

        if (array_key_exists('nickname', $times)) {
            $makeValueObjectMethod = $mock
                ->shouldReceive('makeNickname');

            if (null === $times['nickname']) {
                $makeValueObjectMethod->zeroOrMoreTimes();
            } else {
                $makeValueObjectMethod->times((is_array($times['nickname']) ? $times['nickname']['makeNickname'] : $times['nickname']));
            }

            if (null === $user['nickname']) {
                $makeValueObjectMethod->andReturnNull();
            } else {
                $makeValueObjectMethod->andReturn($this->createStringLiteralValueObjectMock(Nickname::class, $user['nickname'], (is_array($times['nickname']) ? $times['nickname']['toNative'] : $times['nickname'])));
            }
        }

        if (array_key_exists('createdAt', $times)) {
            $makeValueObjectMethod = $mock
                ->shouldReceive('makeCreatedAt');

            if (null === $times['createdAt']) {
                $makeValueObjectMethod->zeroOrMoreTimes();
            } else {
                $makeValueObjectMethod->times((is_array($times['createdAt']) ? $times['createdAt']['makeCreatedAt'] : $times['createdAt']));
            }

            if (null === $user['createdAt']) {
                $makeValueObjectMethod->andReturnNull();
            } else {
                $makeValueObjectMethod->andReturn($this->createDateValueObjectMock(CreatedAt::class, $user['createdAt'], (is_array($times['createdAt']) ? $times['createdAt']['toNative'] : $times['createdAt'])));
            }
        }

        if (array_key_exists('updatedAt', $times)) {
            $makeValueObjectMethod = $mock
                ->shouldReceive('makeUpdatedAt');

            if (null === $times['updatedAt']) {
                $makeValueObjectMethod->zeroOrMoreTimes();
            } else {
                $makeValueObjectMethod->times((is_array($times['updatedAt']) ? $times['updatedAt']['makeUpdatedAt'] : $times['updatedAt']));
            }

            if (null === $user['updatedAt']) {
                $makeValueObjectMethod->andReturnNull();
            } else {
                $makeValueObjectMethod->andReturn($this->createDateValueObjectMock(UpdatedAt::class, $user['updatedAt'], (is_array($times['updatedAt']) ? $times['updatedAt']['toNative'] : $times['createdAt'])));
            }
        }

        return $mock;
    }

    /**
     * Create Age value object mock.
     *
     * @param mixed $value
     * @param mixed $times
     *
     * @return MockInterface
     */
    protected function createAgeValueObject($value, $times): MockInterface
    {
        $externalAgeValueObjectMock = $this->createStringLiteralValueObjectMock(Age::class, $value, $times['toNative']);

        if (array_key_exists('isActive', $times)) {
            $externalAgeValueObjectMethod = $externalAgeValueObjectMock
                ->shouldReceive('isActive');

            if (null === $times['isActive']) {
                $externalAgeValueObjectMethod->zeroOrMoreTimes();
            } else {
                $externalAgeValueObjectMethod->times($times['isActive']);
            }
            $externalAgeValueObjectMethod->andReturn(Age::ITEM_STATUS_ACTIVE === $value);
        }

        return $externalAgeValueObjectMock;
    }

    /**
     * Build and return array with user data mock structure and methods calling times structure.
     *
     * @param int         $id
     * @param int         $password
     * @param string      $name
     * @param string      $nickname
     * @param int         $age
     * @param string|null $createdAt
     * @param string|null $updatedAt
     *
     * @return mixed[]
     */
    protected function buildUserValueObject(
        int $id,
        int $password,
        string $name,
        string $nickname,
        int $age,
        ?string $createdAt,
        ?string $updatedAt
    ): array {
        $user = [
            'id' => $id,
            'password' => $password,
            'name' => $name,
            'nickname' => $nickname,
            'age' => $age,
            'createdAt' => $createdAt,
            'updatedAt' => $updatedAt,
        ];
        $times = [
            'toNative' => 0,
            'id' => ['getId' => 0, 'toNative' => 0],
            'password' => ['getPassword' => 0, 'toNative' => 0],
            'name' => ['getName' => 0, 'toNative' => 0],
            'nickname' => ['getNickname' => 0, 'toNative' => 0],
            'age' => ['getAge' => 0, 'toNative' => 0],
            'createdAt' => ['getCreatedAt' => 0, 'toNative' => 0],
            'updatedAt' => ['getUpdatedAt' => 0, 'toNative' => 0],
        ];

        return [$user, $times];
    }
}
