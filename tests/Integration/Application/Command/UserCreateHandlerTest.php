<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Integration\Application\Command;

use Backend\Api\User\Domain\Event\UserIdWasCreatedEvent;
use Backend\Api\User\Domain\Event\UserWasRegisteredEvent;
use Exception;

/**
 * Class UserRegisterHandlerTest.
 *
 * @category Tests\Integration\Application\Command\Program\Age
 */
class UserRegisterHandlerTest extends CommandTestCase
{
    /**
     * @test
     *
     * @group integration
     *
     * @covers       \Backend\Api\User\Application\CommandHandler\UserRegisterHandler::handle
     * @covers       \Backend\Api\User\Application\CommandHandler\UserRegisterHandler::__construct
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
     *
     * @throws Exception
     */
    public function UserRegisterCommandShouldFireUserWasRegisteredEventAndUserIdWasCreatedEventTest(
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
            'toNative' => 1,
            'id' => ['getId' => 4, 'toNative' => 1],
            'password' => ['getPassword' => 4, 'toNative' => 1],
            'name' => ['getName' => 4, 'toNative' => 1],
            'nickname' => ['getNickname' => 4, 'toNative' => 1],
            'age' => ['getAge' => 4, 'toNative' => 2],
            'createdAt' => ['getCreatedAt' => 4, 'toNative' => 1],
            'updatedAt' => ['getUpdatedAt' => (null === $updatedAt ? 2 : 4), 'toNative' => 1],
        ];
        $times = [
            'processUuid' => ['toNative' => 2, 'getUuid' => 0, 'toString' => 0],
            'uuid' => ['toNative' => 9, 'getUuid' => 0, 'toString' => 0],
            'user' => $userTimes,
        ];
        $this->handleUserRegisterCommand($processUuid, $uuid, $user, $times);

        $events = $this->getEvents();
        self::assertCount(2, $events);
        /** @var UserWasRegisteredEvent $userWasCreatedEvent */
        $userWasCreatedEvent = $events[0]->getPayload();
        /** @var UserIdWasCreatedEvent $iUserIdWasCreatedEvent */
        $iUserIdWasCreatedEvent = $events[1]->getPayload();

        self::assertInstanceOf(UserWasRegisteredEvent::class, $userWasCreatedEvent);
        self::assertSame($processUuid, $userWasCreatedEvent->getProcessUuid()->toNative());
        self::assertSame($uuid, $userWasCreatedEvent->getUuid()->toNative());
        self::assertSame($user, $userWasCreatedEvent->getUser()->toNative());

        self::assertInstanceOf(UserIdWasCreatedEvent::class, $iUserIdWasCreatedEvent);
        self::assertSame($processUuid, $iUserIdWasCreatedEvent->getProcessUuid()->toNative());
        self::assertSame($uuid, $iUserIdWasCreatedEvent->getUuid()->toNative());
        self::assertSame($id, $iUserIdWasCreatedEvent->getId()->toNative());
    }
}
