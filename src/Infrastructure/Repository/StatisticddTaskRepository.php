<?php

declare(strict_types=1);

namespace Backend\Api\User\Infrastructure\Repository;

use Backend\Api\User\Domain\Factory\CommandFactory;
use Backend\Api\User\Domain\Repository\UserTaskRepositoryInterface;
use Backend\Api\User\Domain\ValueObject\User;
use Backend\Api\User\Domain\ValueObject\Uuid;
use Enqueue\Client\ProducerInterface;
use Exception;
use MicroModule\Base\Utils\LoggerTrait;
use MicroModule\Task\Application\Processor\JobCommandBusProcessor;
use MicroModule\ValueObject\Identity\UUID as ProcessUuid;

/**
 * Class UserAddTaskRepository.
 *
 * @category Infrastructure\Query\Queue
 */
class StatisticddTaskRepository implements UserTaskRepositoryInterface
{
    use LoggerTrait;

    public const QUEUE_MASTER_DATA = 'user.add';

    /**
     * Queue producer.
     *
     * @var ProducerInterface
     */
    private ProducerInterface $queueProducer;

    /**
     * UserAddTaskRepository constructor.
     *
     * @param ProducerInterface $taskProducer
     */
    public function __construct(ProducerInterface $taskProducer)
    {
        $this->queueProducer = $taskProducer;
    }

    /**
     * Send job task to queue.
     *
     * @param ProcessUuid $processUuid
     * @param User $user
     *
     * @throws Exception
     */
    public function addRegisterTask(ProcessUuid $processUuid, User $user): void
    {
        $args = [
            $processUuid->toNative(),
            $user->toNative(),
        ];
        $message = ['type' => CommandFactory::REGISTER_COMMAND, 'args' => $args];
        $this->queueProducer->sendCommand(JobCommandBusProcessor::getRoute(), $message);
    }

    /**
     * Send job task to queue.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $userUuid
     * @param User $user
     *
     * @throws Exception
     */
    public function addUpdateTask(ProcessUuid $processUuid, Uuid $userUuid, User $user): void
    {
        $args = [
            $processUuid->toNative(),
            $userUuid->toNative(),
            $user->toNative(),
        ];
        $message = ['type' => CommandFactory::UPDATE_COMMAND, 'args' => $args];
        $this->queueProducer->sendCommand(JobCommandBusProcessor::getRoute(), $message);
    }

    /**
     * Send job task to queue.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $userUuid
     *
     * @throws Exception
     */
    public function addDeleteTask(ProcessUuid $processUuid, Uuid $userUuid): void
    {
        $args = [
            $processUuid->toNative(),
            $userUuid->toNative(),
        ];
        $message = ['type' => CommandFactory::DELETE_COMMAND, 'args' => $args];
        $this->queueProducer->sendCommand(JobCommandBusProcessor::getRoute(), $message);
    }
}
