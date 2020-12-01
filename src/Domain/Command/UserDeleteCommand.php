<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Command;

use Backend\Api\User\Domain\ValueObject\Uuid;
use MicroModule\ValueObject\Identity\UUID as ProcessUuid;

/**
 * Class UserDeleteCommand.
 */
class UserDeleteCommand extends UserCommand
{
    /**
     * User primary key value.
     *
     * @var Uuid
     */
    private Uuid $uuid;

    /**
     * InitUserCommand constructor.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $uuid
     */
    public function __construct(ProcessUuid $processUuid, Uuid $uuid)
    {
        parent::__construct($processUuid);
        $this->uuid = $uuid;
    }

    /**
     * Return Uuid object.
     *
     * @return Uuid
     */
    public function getUserUuid(): Uuid
    {
        return $this->uuid;
    }
}
