<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Integration\Application\Command;

use Backend\Api\User\Domain\Factory\CommandFactory;
use Exception;
use MicroModule\Task\Application\Processor\JobCommandBusProcessor;

/**
 * Class UserDeleteTaskHandlerTest.
 *
 * @category Tests\Integration\Application\Command\Program\Age
 */
class UserDeleteTaskHandlerTest extends CommandTestCase
{
    /**
     * @test
     *
     * @group integration
     *
     * @covers       \Backend\Api\User\Application\CommandHandler\UserDeleteTaskHandler::handle
     * @covers       \Backend\Api\User\Application\CommandHandler\UserDeleteTaskHandler::__construct
     *
     * @dataProvider \Backend\Api\User\Tests\DataProvider\UserDataProvider::getUsers()
     *
     * @param string $processUuid
     * @param string $uuid
     *
     * @throws Exception
     */
    public function UserDeleteTaskCommandShouldFireDeleteUserJobToRepositoryTest(
        string $processUuid,
        string $uuid
    ): void {
        $times = [
            'processUuid' => ['toNative' => 1, 'getUuid' => 0, 'toString' => 0],
            'uuid' => ['toNative' => 1, 'getUuid' => 0, 'toString' => 0],
        ];
        $this->handleUserDeleteTaskCommand($processUuid, $uuid, $times);
        $queueTraces = $this->getProducer()->getCommandTraces(JobCommandBusProcessor::getRoute());

        self::assertCount(1, $queueTraces);
        self::assertEquals(CommandFactory::DELETE_COMMAND, $queueTraces[0]['body']['type']);
        self::assertEquals($processUuid, $queueTraces[0]['body']['args'][0]);
        self::assertEquals($uuid, $queueTraces[0]['body']['args'][1]);
    }
}
