<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Query;

use Backend\Api\User\Domain\ValueObject\FindCriteria;
use Exception;
use MicroModule\Base\Domain\Command\CommandInterface;
use MicroModule\ValueObject\Identity\UUID as ProcessUuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class FindCommand.
 */
class FindCommand implements CommandInterface
{
    /**
     * Process uuid ValueObject.
     *
     * @var ProcessUuid
     */
    private ProcessUuid $processUuid;

    /**
     * FindCriteria ValueObject.
     *
     * @var FindCriteria
     */
    private FindCriteria $findCriteria;

    /**
     * FetchOneCommand constructor.
     *
     * @param ProcessUuid $processUuid
     * @param FindCriteria $findCriteria
     */
    public function __construct(ProcessUuid $processUuid, FindCriteria $findCriteria)
    {
        $this->processUuid = $processUuid;
        $this->findCriteria = $findCriteria;
    }

    /**
     * Return FindCriteria ValueObject.
     *
     * @return FindCriteria
     */
    public function getFindCriteria(): FindCriteria
    {
        return $this->findCriteria;
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
