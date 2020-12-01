<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Helper;

use Backend\Api\User\Domain\Entity\UserEntity;
use Backend\Api\User\Domain\Factory\UserFactory;
use Backend\Api\User\Domain\ValueObject\CreatedAt;
use Backend\Api\User\Domain\ValueObject\Id;
use Backend\Api\User\Domain\ValueObject\Name;
use Backend\Api\User\Domain\ValueObject\Nickname;
use Backend\Api\User\Domain\ValueObject\Password;
use Backend\Api\User\Domain\ValueObject\UpdatedAt;
use MicroModule\ValueObject\Identity\UUID as ValueObjectUUID;
use Mockery;
use Mockery\MockInterface;

/**
 * Trait EntityMockTrait.
 *
 * @category Tests\Unit\Utils
 */
trait EntityMockTrait
{
    /**
     * Create UserEntity mock.
     *
     * @param mixed[] $user
     * @param mixed[] $times
     *
     * @return MockInterface
     */
    protected function createUserEntityMock(array $user, array $times = []): MockInterface
    {
        $mock = Mockery::mock(UserEntity::class);

        if (null !== $user['id']) {
            if (!isset($times['id'])) {
                $times['id'] = null;
            }
            $getValueObjectMethod = $mock
                ->shouldReceive('getId');

            if (null === $times['id'][0]) {
                $getValueObjectMethod->zeroOrMoreTimes();
            } else {
                $getValueObjectMethod->times($times['id'][0]);
            }
            $getValueObjectMethod->andReturn($this->createUuidValueObjectMock(Id::class, $user['id'], (is_array($times['id']) ? $times['id'][1] : $times['id'])));

            $setValueObjectMethod = $mock
                ->shouldReceive('setId');
            $setValueObjectMethod->zeroOrMoreTimes();
        }

        if (array_key_exists('processUuid', $user)) {
            if (!isset($times['processUuid'])) {
                $times['processUuid'] = null;
            }
            $getValueObjectMethod = $mock
                ->shouldReceive('getProcessUuid');

            if (null === $times['id'][0]) {
                $getValueObjectMethod->zeroOrMoreTimes();
            } else {
                $getValueObjectMethod->times($times['processUuid'][0]);
            }
            $getValueObjectMethod->andReturn($this->createUuidValueObjectMock(ValueObjectUUID::class, $user['processUuid'], (is_array($times['processUuid']) ? $times['processUuid'][1] : $times['processUuid'])));
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

        if (array_key_exists('assembleToValueObject', $times)) {
            $getValueObjectMethod = $mock
                ->shouldReceive('assembleToValueObject');

            if (null === $times['assembleToValueObject']) {
                $getValueObjectMethod->zeroOrMoreTimes();
            } else {
                $getValueObjectMethod->times((is_array($times['assembleToValueObject']) ? $times['assembleToValueObject'][0] : $times['assembleToValueObject']));
            }

            if (null === $user['assembleToValueObject']) {
                $getValueObjectMethod->andReturn(null);
            } else {
                $getValueObjectMethod->andReturn($this->createUserValueObjectMock($user['assembleToValueObject'], (is_array($times['assembleToValueObject']) ? $times['assembleToValueObject'][1] : $times['assembleToValueObject'])));
            }
        }

        if (array_key_exists('createActual', $times)) {
            $getValueObjectMethod = $mock
                ->shouldReceive('createActual');

            if (null === $times['createActual']) {
                $getValueObjectMethod->zeroOrMoreTimes();
            } else {
                $getValueObjectMethod->times((is_array($times['createActual']) ? $times['createActual'][0] : $times['createActual']));
            }

            if (null === $user['createActual']) {
                $getValueObjectMethod->andReturn(null);
            } else {
                $getValueObjectMethod->andReturn($this->createUserValueObjectMock($user['createActual'], (is_array($times['createActual']) ? $times['createActual'][1] : $times['createActual'])));
            }
        }

        if (array_key_exists('create', $times)) {
            $getValueObjectMethod = $mock
                ->shouldReceive('create');

            if (null === $times['create']) {
                $getValueObjectMethod->zeroOrMoreTimes();
            } else {
                $getValueObjectMethod->times($times['create']);
            }
        }

        if (array_key_exists('update', $times)) {
            $getValueObjectMethod = $mock
                ->shouldReceive('update');

            if (null === $times['update']) {
                $getValueObjectMethod->zeroOrMoreTimes();
            } else {
                $getValueObjectMethod->times($times['update']);
            }
        }

        if (array_key_exists('delete', $times)) {
            $getValueObjectMethod = $mock
                ->shouldReceive('delete');

            if (null === $times['delete']) {
                $getValueObjectMethod->zeroOrMoreTimes();
            } else {
                $getValueObjectMethod->times($times['delete']);
            }
        }

        return $mock;
    }

    /**
     * Create UserFactory mock.
     *
     * @param mixed[] $user
     * @param mixed[] $times
     *
     * @return MockInterface
     */
    protected function createUserFactoryMock(array $user, array $times = ['createInstance' => 0, 'makeActualInstance' => 0, 'user' => []]): MockInterface
    {
        $mock = Mockery::mock(UserFactory::class);
        $makeInstanceMethod = $mock
            ->shouldReceive('createInstance');

        if (null === $times['createInstance']) {
            $makeInstanceMethod->zeroOrMoreTimes();
        } else {
            $makeInstanceMethod->times($times[0]);
        }
        $makeInstanceMethod->andReturn($this->createUserEntityMock($user, $times['user']));

        $makeInstanceMethod = $mock
            ->shouldReceive('makeActualInstance');

        if (null === $times['makeActualInstance']) {
            $makeInstanceMethod->zeroOrMoreTimes();
        } else {
            $makeInstanceMethod->times($times[2]);
        }
        $makeInstanceMethod->andReturn($this->createUserEntityMock($user, $times['user']));

        return $mock;
    }
}
