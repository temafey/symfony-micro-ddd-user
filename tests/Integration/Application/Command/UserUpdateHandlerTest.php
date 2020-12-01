<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Integration\Application\Command;

use Backend\Api\User\Domain\Event\UserWasUpdatedEvent;
use Exception;

/**
 * Class UserUpdateHandlerTest.
 *
 * @category Tests\Integration\Application\Command\Program\Age
 */
class UserUpdateHandlerTest extends CommandTestCase
{
    /**
     * @test
     *
     * @group integration
     *
     * @covers       \Backend\Api\User\Application\CommandHandler\UserUpdateHandler::handle
     * @covers       \Backend\Api\User\Application\CommandHandler\UserUpdateHandler::__construct
     *
     * @dataProvider \Backend\Api\User\Tests\DataProvider\UserDataProvider::getUserUpdates()
     *
     * @param mixed[] $user
     * @param mixed[] $updatedUser
     *
     * @throws Exception
     */
    public function UserUpdateCommandShouldFireUserIdWasAddedEventTest(
        array $user,
        array $updatedUser
    ): void {
        $processUuid = array_shift($user);
        $updatedProcessUuid = array_shift($updatedUser);
        $uuid = array_shift($user);
        $updatedUuid = array_shift($updatedUser);
        [$user, $userTimes] = $this->buildUserValueObject(...$user);
        $userTimes = [
            'toNative' => 0,
            'id' => ['getId' => 6, 'toNative' => 1],
            'password' => ['getPassword' => 6, 'toNative' => 1],
            'name' => ['getName' => 6, 'toNative' => 1],
            'nickname' => ['getNickname' => 6, 'toNative' => 1],
            'age' => ['getAge' => 6, 'toNative' => 2],
            'createdAt' => ['getCreatedAt' => 6, 'toNative' => 1],
            'updatedAt' => ['getUpdatedAt' => (null === $user['updatedAt'] ? 3 : 6), 'toNative' => 1],
        ];
        $times = [
            'processUuid' => ['toNative' => 1, 'getUuid' => 0, 'toString' => 0],
            'uuid' => ['toNative' => 13, 'getUuid' => 0, 'toString' => 0],
            'user' => $userTimes,
        ];
        $this->handleUserRegisterCommand($processUuid, $uuid, $user, $times);

        [$updatedUser, $userTimes] = $this->buildUserValueObject(...$updatedUser);
        $userTimes = [
            'toNative' => 1,
            'id' => ['getId' => 4, 'toNative' => 1],
            'password' => ['getPassword' => 4, 'toNative' => 1],
            'name' => ['getName' => 4, 'toNative' => 1],
            'nickname' => ['getNickname' => 4, 'toNative' => 1],
            'age' => ['getAge' => 4, 'toNative' => 2],
            'createdAt' => ['getCreatedAt' => 4, 'toNative' => 1],
            'updatedAt' => ['getUpdatedAt' => 4, 'toNative' => 1],
        ];
        $times = [
            'processUuid' => ['toNative' => 0, 'getUuid' => 0, 'toString' => 0],
            'uuid' => ['toNative' => 1, 'getUuid' => 0, 'toString' => 0],
            'user' => $userTimes,
        ];
        $this->handleUserUpdateCommand($updatedProcessUuid, $updatedUuid, $updatedUser, $times);

        $events = $this->getEvents();
        self::assertCount(3, $events);
        /** @var UserWasUpdatedEvent $event */
        $event = $events[2]->getPayload();

        self::assertInstanceOf(UserWasUpdatedEvent::class, $event);
        self::assertSame($processUuid, $event->getProcessUuid()->toNative());
        self::assertSame($uuid, $event->getUuid()->toNative());
        self::assertSame($updatedUser, $event->getUser()->toNative());
    }
}
