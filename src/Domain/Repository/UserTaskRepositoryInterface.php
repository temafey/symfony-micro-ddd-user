<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Repository;

use Backend\Api\User\Domain\ValueObject\User;
use Backend\Api\User\Domain\ValueObject\Uuid;
use MicroModule\ValueObject\Identity\UUID as ProcessUuid;

/**
 * Interface UserTaskRepositoryInterface.
 */
interface UserTaskRepositoryInterface
{
    /**
     * Send job task to queue.
     *
     * @param ProcessUuid $processUuid
     * @param User $user
     */
    public function addRegisterTask(ProcessUuid $processUuid, User $user): void;

    /**
     * Send job task to queue.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $userUuid
     * @param User $user
     */
    public function addUpdateTask(ProcessUuid $processUuid, Uuid $userUuid, User $user): void;

    /**
     * Send job task to queue.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $userUuid
     */
    public function addDeleteTask(ProcessUuid $processUuid, Uuid $userUuid): void;
}
