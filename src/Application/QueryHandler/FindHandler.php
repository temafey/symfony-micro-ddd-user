<?php

declare(strict_types=1);

namespace Backend\Api\User\Application\QueryHandler;

use Backend\Api\User\Application\Dto\UserDto;
use Backend\Api\User\Application\Service\UserAssembler;
use Backend\Api\User\Domain\Query\FindCommand;
use Backend\Api\User\Domain\Repository\QueryRepositoryInterface;
use Exception;

/**
 * Class FindHandler.
 */
final class FindHandler implements CommandHandlerInterface
{
    /**
     * EventSourcing repository for UserEntity.
     *
     * @var QueryRepositoryInterface
     */
    private QueryRepositoryInterface $queryRepository;

    /**
     * Dto Assembler.
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
     * Handle FindCommand command.
     *
     * @param FindCommand $command
     *
     * @return UserDto[]|null
     *
     * @throws Exception
     */
    public function handle(FindCommand $command): ?array
    {
        $userEntities = $this->queryRepository->findByCriteria($command->getFindCriteria());

        if (null === $userEntities) {
            return null;
        }
        $userDtoCollection = [];

        foreach ($userEntities as $userEntity) {
            $userDtoCollection[] = $this->userAssembler->writeDto($userEntity);
        }

        return $userDtoCollection;
    }
}
