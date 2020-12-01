<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Helper;

use Backend\Api\User\Domain\Entity\UserEntity;
use Backend\Api\User\Domain\Repository\UserRepositoryInterface;
use Backend\Api\User\Domain\ValueObject\Uuid;
use InvalidArgumentException;
use Mockery;
use Mockery\MockInterface;

/**
 * Trait RepositoryMockTrait.
 *
 * @category Tests\Unit\Utils
 */
trait RepositoryMockTrait
{
    /**
     * @param mixed[]|null $user
     * @param mixed[]      $times
     *
     * @return MockInterface
     */
    protected function createUserRepositoryMock(?array $user, $times = ['get' => 0, 'store' => 0, 'user' => []]): MockInterface
    {
        $mock = Mockery::mock(UserRepositoryInterface::class);

        if (array_key_exists('get', $times)) {
            $method = $mock
                ->shouldReceive('get')
                ->with(Mockery::type(Uuid::class));

            if (null === $times['get']) {
                $method->zeroOrMoreTimes();
            } else {
                $method->times($times['get']);
            }

            if (null === $user) {
                $method->andThrow(InvalidArgumentException::class);
            } else {
                $method->andReturn($this->createUserEntityMock($user, $user['user']));
            }
        }

        if (array_key_exists('store', $times)) {
            $method = $mock
                ->shouldReceive('store')
                ->with(Mockery::type(UserEntity::class));

            if (null === $times['store']) {
                $method->zeroOrMoreTimes();
            } else {
                $method->times($times['store']);
            }
        }

        return $mock;
    }
}
