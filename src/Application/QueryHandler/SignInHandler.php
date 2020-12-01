<?php

declare(strict_types=1);

namespace Backend\Api\User\Application\QueryHandler;

use Backend\Api\User\Domain\Entity\UserReadInterface;
use Backend\Api\User\Domain\Exception\InvalidCredentialsException;
use Backend\Api\User\Domain\Query\SignInCommand;
use Backend\Api\User\Domain\Repository\QueryRepositoryInterface;
use Backend\Api\User\Domain\Repository\UserRepositoryInterface;
use Backend\Api\User\Domain\Service\AuthenticationProviderInterface;
use Backend\Api\User\Domain\ValueObject\Nickname;

/**
 * Class SignInHandler.
 */
class SignInHandler implements CommandHandlerInterface
{
    /**
     * User event repository.
     *
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userEventRepository;

    /**
     * User read repository.
     *
     * @var QueryRepositoryInterface
     */
    private QueryRepositoryInterface $queryRepository;

    /**
     * User authentication provider.
     *
     * @var AuthenticationProviderInterface
     */
    private AuthenticationProviderInterface $authenticationProvider;

    /**
     * SignInHandler constructor.
     *
     * @param UserRepositoryInterface $userEventRepository
     * @param QueryRepositoryInterface $queryRepository
     * @param AuthenticationProviderInterface $authenticationProvider
     */
    public function __construct(
        UserRepositoryInterface $userEventRepository,
        QueryRepositoryInterface $queryRepository,
        AuthenticationProviderInterface $authenticationProvider
    )
    {
        $this->userEventRepository = $userEventRepository;
        $this->queryRepository = $queryRepository;
        $this->authenticationProvider = $authenticationProvider;
    }

    /**
     * Handle UserAddIdCommand command.
     *
     * @param SignInCommand $command
     *
     * @return string
     *
     * @throws InvalidCredentialsException
     */
    public function handle(SignInCommand $command): string
    {
        $userEntity = $this->findByNickname($command->getNickname());
        $user = $this->userEventRepository->get($userEntity->getUuid());
        $user->signIn($command->getPassword());
        $this->userEventRepository->store($user);

        return $this->authenticationProvider->generateToken($userEntity);
    }

    /**
     * Try to find user by their nickname.
     *
     * @param Nickname $nickname
     *
     * @return UserReadInterface
     *
     * @throws InvalidCredentialsException
     */
    private function findByNickname(Nickname $nickname): UserReadInterface
    {
        $userEntity = $this->queryRepository->findByNickname($nickname);

        if (null === $userEntity) {
            throw new InvalidCredentialsException(sprintf('UserEntity not found with nickname \'%s\'.', $nickname->toNative()));
        }

        return $userEntity;
    }
}
