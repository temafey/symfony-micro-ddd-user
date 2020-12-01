<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Command;

use Exception;
use MicroModule\Base\Domain\Command\CommandInterface;
use MicroModule\ValueObject\Identity\UUID;
use Ramsey\Uuid\UuidInterface;

/**
 * Class UserCommand.
 */
abstract class UserCommand implements CommandInterface
{
    /**
     * Process uuid.
     *
     * @var UUID
     */
    private UUID $processUuid;

    /**
     * InitUserCommand constructor.
     *
     * @param UUID $processUuid
     */
    public function __construct(UUID $processUuid)
    {
        $this->processUuid = $processUuid;
    }

    /**
     * Return UUID.
     *
     * @return UUID
     *
     * @throws Exception
     */
    public function getProcessUuid(): UUID
    {
        return $this->processUuid;
    }

    /**
     * Return Uuid.
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
