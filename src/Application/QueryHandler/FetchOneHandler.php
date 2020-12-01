<?php

declare(strict_types=1);

namespace Backend\Api\User\Application\QueryHandler;

use Backend\Api\User\Application\Dto\UserDto;
use Backend\Api\User\Application\Service\UserAssembler;
use Backend\Api\User\Domain\Query\FetchOneCommand;
use Backend\Api\User\Domain\Repository\QueryRepositoryInterface;
use Exception;

/**
 * Class FetchOneHandler.
 */
final class FetchOneHandler implements CommandHandlerInterface
{
    /**
     * EventSourcing repository for UserEntity.
     *
     * @var QueryRepositoryInterface
     */
    private QueryRepositoryInterface $queryRepository;

    /**
     * Dto assembler.
     *
     * @var UserAssembler
     */
    private UserAssembler $userAssembler;

    /**
     * FetchOneHandler constructor.
     *
     * @param QueryRepositoryInterface $queryRepository
     * @param UserAssembler $userAssembler
     */
    public function __construct(
        QueryRepositoryInterface $queryRepository,
        UserAssembler $userAssembler
    )
    {
        $this->queryRepository = $queryRepository;
        $this->userAssembler = $userAssembler;
    }

    /**
     * Handle FetchOneCommand command.
     *
     * @param FetchOneCommand $command
     *
     * @return UserDto|null
     *
     * @throws Exception
     */
    public function handle(FetchOneCommand $command): ?UserDto
    {
        $userEntity = $this->queryRepository->findByUuid($command->getUserUuid());

        if (null === $userEntity) {
            return null;
        }

        return $this->userAssembler->writeDto($userEntity);
    }
}
