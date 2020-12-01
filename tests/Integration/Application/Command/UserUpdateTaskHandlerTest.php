<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Integration\Application\Command;

use Backend\Api\User\Domain\Factory\CommandFactory;
use Exception;
use MicroModule\Task\Application\Processor\JobCommandBusProcessor;

/**
 * Class UserUpdateTaskHandlerTest.
 *
 * @category Tests\Integration\Application\Command\Program\Age
 */
class UserUpdateTaskHandlerTest extends CommandTestCase
{
    /**
     * @test
     *
     * @group integration
     *
     * @covers       \Backend\Api\User\Application\CommandHandler\UserUpdateTaskHandler::handle
     * @covers       \Backend\Api\User\Application\CommandHandler\UserUpdateTaskHandler::__construct
     *
     * @dataProvider \Backend\Api\User\Tests\DataProvider\UserDataProvider::getUpdateUsers()
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
    public function UserUpdateTaskCommandShouldFireUpdateUserJobToRepositoryTest(
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
            'id' => ['getId' => 0, 'toNative' => 0],
            'password' => ['getPassword' => 0, 'toNative' => 0],
            'name' => ['getName' => 0, 'toNative' => 0],
            'nickname' => ['getNickname' => 0, 'toNative' => 0],
            'age' => ['getAge' => 0, 'toNative' => 0],
            'createdAt' => ['getCreatedAt' => 0, 'toNative' => 0],
            'updatedAt' => ['getUpdatedAt' => 0, 'toNative' => 0],
        ];
        $times = [
            'processUuid' => ['toNative' => 1, 'getUuid' => 0, 'toString' => 0],
            'uuid' => ['toNative' => 1, 'getUuid' => 0, 'toString' => 0],
            'user' => $userTimes,
        ];
        $this->handleUserUpdateTaskCommand($processUuid, $uuid, $user, $times);

        $queueTraces = $this->getProducer()->getCommandTraces(JobCommandBusProcessor::getRoute());
        self::assertCount(1, $queueTraces);
        self::assertEquals(CommandFactory::UPDATE_COMMAND, $queueTraces[0]['body']['type']);
        self::assertEquals($processUuid, $queueTraces[0]['body']['args'][0]);
        self::assertEquals($uuid, $queueTraces[0]['body']['args'][1]);
        self::assertEquals($user, $queueTraces[0]['body']['args'][2]);
    }
}
