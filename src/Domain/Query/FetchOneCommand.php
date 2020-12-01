<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Query;

use Backend\Api\User\Domain\ValueObject\Uuid;
use Exception;
use MicroModule\Base\Domain\Command\CommandInterface;
use MicroModule\ValueObject\Identity\UUID as ProcessUuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class FetchOneCommand.
 */
class FetchOneCommand implements CommandInterface
{
    /**
     * Process uuid ValueObject.
     *
     * @var ProcessUuid
     */
    private ProcessUuid $processUuid;

    /**
     * User uuid ValueObject.
     *
     * @var Uuid
     */
    private Uuid $uuid;

    /**
     * FetchOneCommand constructor.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $uuid
     */
    public function __construct(ProcessUuid $processUuid, Uuid $uuid)
    {
        $this->processUuid = $processUuid;
        $this->uuid = $uuid;
    }

    /**
     * Return Uid ValueObject.
     *
     * @return Uuid
     */
    public function getUserUuid(): Uuid
    {
        return $this->uuid;
    }

    /**
     * Return process Uuid  ValueObject.
     *
     * @return UuidInterface
     *
     * @throws Exception
     */
    public function getUuid(): UuidInterface
    {
        return $this->processUuid->getUuid();
    }
}
