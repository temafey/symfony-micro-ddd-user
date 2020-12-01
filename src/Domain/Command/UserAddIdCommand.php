<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Command;

use Backend\Api\User\Domain\ValueObject\Id;
use Backend\Api\User\Domain\ValueObject\Uuid;
use MicroModule\ValueObject\Identity\UUID as ProcessUuid;

/**
 * Class UserAddIdCommand.
 */
class UserAddIdCommand extends UserCommand
{
    /**
     * User primary key value.
     *
     * @var Uuid
     */
    private Uuid $uuid;

    /**
     * User unique integer identifier.
     *
     * @var Id
     */
    private Id $id;

    /**
     * InitUserCommand constructor.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $uuid
     * @param Id $id
     */
    public function __construct(ProcessUuid $processUuid, Uuid $uuid, Id $id)
    {
        parent::__construct($processUuid);
        $this->uuid = $uuid;
        $this->id = $id;
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

    /**
     * Return Id value object.
     *
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }
}
