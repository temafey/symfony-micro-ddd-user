<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Integration\Application\Command;

use Backend\Api\User\Domain\Command\UserAddIdCommand;
use Backend\Api\User\Domain\Command\UserDeleteCommand;
use Backend\Api\User\Domain\Command\UserDeleteTaskCommand;
use Backend\Api\User\Domain\Command\UserRegisterCommand;
use Backend\Api\User\Domain\Command\UserRegisterTaskCommand;
use Backend\Api\User\Domain\Command\UserUpdateCommand;
use Backend\Api\User\Domain\Command\UserUpdateTaskCommand;
use Backend\Api\User\Domain\Event\UserEvent;
use Backend\Api\User\Domain\Factory\CommandFactory;
use Backend\Api\User\Domain\ValueObject\Id;
use Backend\Api\User\Domain\ValueObject\Uuid;
use Backend\Api\User\Tests\Integration\ApplicationTestCase;
use Broadway\Domain\DomainMessage;
use Enqueue\Client\TraceableProducer;
use MicroModule\ValueObject\Identity\UUID as ProcessUuid;

/**
 * Class CommandTestCase.
 *
 * @category Tests\Integration\Application\Command\Program\Validate
 */
abstract class CommandTestCase extends ApplicationTestCase
{
    /**
     * Command factory service.
     *
     * @var string
     */
    protected $commandFactoryName = CommandFactory::class;

    /**
     * Name for testing command bus.
     *
     * @var string
     */
    protected $commandBusName = 'tactician.commandbus.command.create.user';

    /**
     * Handle Api UserRegisterTaskCommand.
     *
     * @param string  $processUuid
     * @param mixed[] $user
     * @param mixed[] $times
     */
    protected function handleUserRegisterTaskCommand(
        string $processUuid,
        array $user,
        array $times = [
            'processUuid' => ['toNative' => 0, 'getUuid' => 0, 'toString' => 0],
            'user' => ['toNative' => 0],
        ]
    ): void {
        $processUuidMock = $this->createUuidValueObjectMock(ProcessUuid::class, $processUuid, $times['processUuid']);
        $userMock = $this->createUserValueObjectMock($user, $times['user']);
        $command = new UserRegisterTaskCommand($processUuidMock, $userMock);
        $this->handle($command);
    }

    /**
     * Handle Api UserDeleteTaskCommand.
     *
     * @param string  $processUuid
     * @param string  $uuid
     * @param mixed[] $times
     */
    protected function handleUserDeleteTaskCommand(
        string $processUuid,
        string $uuid,
        array $times = [
            'processUuid' => ['toNative' => 0, 'getUuid' => 0, 'toString' => 0],
            'uuid' => ['toNative' => 0, 'getUuid' => 0, 'toString' => 0],
        ]
    ): void {
        $processUuidMock = $this->createUuidValueObjectMock(ProcessUuid::class, $processUuid, $times['processUuid']);
        $uuidMock = $this->createUuidValueObjectMock(Uuid::class, $uuid, $times['uuid']);
        $command = new UserDeleteTaskCommand($processUuidMock, $uuidMock);
        $this->handle($command);
    }

    /**
     * Handle Api UserUpdateTaskCommand.
     *
     * @param string  $processUuid
     * @param string  $uuid
     * @param mixed[] $user
     * @param mixed[] $times
     */
    protected function handleUserUpdateTaskCommand(
        string $processUuid,
        string $uuid,
        array $user,
        array $times = [
            'processUuid' => ['toNative' => 0, 'getUuid' => 0, 'toString' => 0],
            'user' => ['toNative' => 0],
        ]
    ): void {
        $processUuidMock = $this->createUuidValueObjectMock(ProcessUuid::class, $processUuid, $times['processUuid']);
        $uuidMock = $this->createUuidValueObjectMock(Uuid::class, $uuid, $times['uuid']);
        $userMock = $this->createUserValueObjectMock($user, $times['user']);
        $command = new UserUpdateTaskCommand($processUuidMock, $uuidMock, $userMock);
        $this->handle($command);
    }

    /**
     * Handle Api UserRegisterCommand.
     *
     * @param string  $processUuid
     * @param string  $uuid
     * @param mixed[] $user
     * @param mixed[] $times
     */
    protected function handleUserRegisterCommand(
        string $processUuid,
        string $uuid,
        array $user,
        array $times = [
            'processUuid' => ['toNative' => 0, 'getUuid' => 0, 'toString' => 0],
            'uuid' => ['toNative' => 0, 'getUuid' => 0, 'toString' => 0],
            'user' => ['toNative' => 0],
        ]
    ): void {
        $processUuidMock = $this->createUuidValueObjectMock(ProcessUuid::class, $processUuid, $times['processUuid']);
        $uuidMock = $this->createUuidValueObjectMock(Uuid::class, $uuid, $times['uuid']);
        $userMock = $this->createUserValueObjectMock($user, $times['user']);
        $command = new UserRegisterCommand($processUuidMock, $uuidMock, $userMock);
        $this->handle($command);
    }

    /**
     * Handle Api UserUpdateCommand.
     *
     * @param string  $processUuid
     * @param string  $uuid
     * @param mixed[] $user
     * @param mixed[] $times
     */
    protected function handleUserUpdateCommand(
        string $processUuid,
        string $uuid,
        array $user,
        array $times = [
            'processUuid' => ['toNative' => 0, 'getUuid' => 0, 'toString' => 0],
            'uuid' => ['toNative' => 0, 'getUuid' => 0, 'toString' => 0],
            'user' => ['toNative' => 0],
        ]
    ): void {
        $processUuidMock = $this->createUuidValueObjectMock(ProcessUuid::class, $processUuid, $times['processUuid']);
        $uuidMock = $this->createUuidValueObjectMock(Uuid::class, $uuid, $times['uuid']);
        $userMock = $this->createUserValueObjectMock($user, $times['user']);
        $command = new UserUpdateCommand($processUuidMock, $uuidMock, $userMock);
        $this->handle($command);
    }

    /**
     * Handle Api UserAddIdCommand.
     *
     * @param string  $processUuid
     * @param string  $uuid
     * @param int     $id
     * @param mixed[] $times
     */
    protected function handleUserAddIdCommand(
        string $processUuid,
        string $uuid,
        int $id,
        $times = [
            'processUuid' => ['toNative' => 0, 'getUuid' => 0, 'toString' => 0],
            'uuid' => ['toNative' => 0, 'getUuid' => 0, 'toString' => 0],
            'id' => 1,
        ]
    ): void {
        $processUuidMock = $this->createUuidValueObjectMock(ProcessUuid::class, $processUuid, $times['processUuid']);
        $uuidMock = $this->createUuidValueObjectMock(Uuid::class, $uuid, $times['uuid']);
        $idMock = $this->createIntegerValueObjectMock(Id::class, $id, $times['id']);

        $command = new UserAddIdCommand($processUuidMock, $uuidMock, $idMock);
        $this->handle($command);
    }

    /**
     * Handle Api UserDeleteCommand.
     *
     * @param string  $processUuid
     * @param string  $uuid
     * @param mixed[] $times
     */
    protected function handleUserDeleteCommand(
        string $processUuid,
        string $uuid,
        $times = [
            'processUuid' => ['toNative' => 0, 'getUuid' => 0, 'toString' => 0],
            'uuid' => ['toNative' => 0, 'getUuid' => 0, 'toString' => 0],
        ]
    ): void {
        $processUuidMock = $this->createUuidValueObjectMock(ProcessUuid::class, $processUuid, $times['processUuid']);
        $uuidMock = $this->createUuidValueObjectMock(Uuid::class, $uuid, $times['uuid']);

        $command = new UserDeleteCommand($processUuidMock, $uuidMock);
        $this->handle($command);
    }

    /**
     * Events.
     *
     * @var DomainMessage[]
     */
    private $events = [];

    /**
     * Collect new and return all evaluated events.
     *
     * @return DomainMessage[]
     */
    protected function getEvents(): array
    {
        $events = parent::getEvents();

        if ($events) {
            array_push($this->events, ...$events);
        }

        return $this->events;
    }

    /**
     * Fetch and return event by event position in stack.
     *
     * @param int $eventPosition
     *
     * @return UserEvent
     */
    protected function getEvent(int $eventPosition): UserEvent
    {
        $events = $this->getEvents();

        return $events[$eventPosition]->getPayload();
    }

    /**
     * @return TraceableProducer
     */
    protected function getProducer(): TraceableProducer
    {
        return $this->service('enqueue.client.task.producer');
    }
}
