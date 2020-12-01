<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Repository;

use Backend\Api\User\Domain\ValueObject\User;
use MicroModule\ValueObject\Identity\UUID as ProcessUuid;

/**
 * Interface StatisticTaskRepositoryInterface.
 */
interface StatisticTaskRepositoryInterface
{
    /**
     * Send job task to queue.
     *
     * @param ProcessUuid $processUuid
     * @param User $user
     */
    public function addStatisticTask(ProcessUuid $processUuid, User $user): void;
}
