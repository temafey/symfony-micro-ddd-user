<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Integration\Application\Command;

use Backend\Api\User\Domain\Event\UserWasDeletedEvent;

/**
 * Class UserDeleteHandlerTest.
 *
 * @category Tests\Integration\Application\Command\Program\Age
 */
class UserDeleteHandlerTest extends CommandTestCase
{
    /**
     * @test
     *
     * @group integration
     *
     * @covers       \Backend\Api\User\Application\CommandHandler\UserDeleteHandler::handle
     * @covers       \Backend\Api\User\Application\CommandHandler\UserDeleteHandler::__construct
     *
     * @dataProvider \Backend\Api\User\Tests\DataProvider\UserDataProvider::getUsers()
     *
     * @param string      $processUuid
     * @param string      $uuid
     * @param int         $id
     * @param int         $password
     * @param string      $name
     * @param string      $nickname
     * @param int         $age
     * @param string|null $createdAt
     * @param string|null $updatedAt
     */
    public function UserDeleteCommandShouldFireUserWasDeletedEventTest(
        string $processUuid,
        string $uuid,
        int $id,
        int $password,
        string $name,
        string $nickname,
        int $age,
        ?string $createdAt,
        ?string $updatedAt
    ): void {
        [$user, $userTimes] = $this->buildUserValueObject($id, $password, $name, $nickname, $age, $createdAt, $updatedAt);
        $userTimes = [
            'toNative' => 0,
            'id' => ['getId' => 6, 'toNative' => 1],
            'password' => ['getPassword' => 6, 'toNative' => 1],
            'name' => ['getName' => 6, 'toNative' => 1],
            'nickname' => ['getNickname' => 6, 'toNative' => 1],
            'age' => ['getAge' => 6, 'toNative' => 2],
            'createdAt' => ['getCreatedAt' => 6, 'toNative' => 1],
            'updatedAt' => ['getUpdatedAt' => (null === $updatedAt ? 3 : 6), 'toNative' => 1],
        ];
        $times = [
            'processUuid' => ['toNative' => 1, 'getUuid' => 0, 'toString' => 0],
            'uuid' => ['toNative' => 12, 'getUuid' => 0, 'toString' => 0],
            'user' => $userTimes,
        ];
        $this->handleUserRegisterCommand($processUuid, $uuid, $user, $times);
        $times = [
            'processUuid' => ['toNative' => 0, 'getUuid' => 0, 'toString' => 0],
            'uuid' => ['toNative' => 1, 'getUuid' => 0, 'toString' => 0],
        ];
        $this->handleUserDeleteCommand($processUuid, $uuid, $times);

        $events = $this->getEvents();
        self::assertCount(3, $events);
        /** @var UserWasDeletedEvent $event */
        $event = $events[2]->getPayload();

        self::assertInstanceOf(UserWasDeletedEvent::class, $event);
        self::assertSame($processUuid, $event->getProcessUuid()->toNative());
        self::assertSame($uuid, $event->getUuid()->toNative());
    }
}
