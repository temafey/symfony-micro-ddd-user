<?php

declare(strict_types=1);

namespace Backend\Api\User\Presentation\Rpc;

use Backend\Api\User\Application\Dto\UserDto;
use Backend\Api\User\Domain\Factory\CommandFactory;
use Backend\Api\User\Domain\Service\JsonRpcMethodWithDocInterface;
use Exception;
use League\Tactician\CommandBus;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Required;
use Yoanm\JsonRpcParamsSymfonyValidator\Domain\MethodWithValidatedParamsInterface;
use Yoanm\JsonRpcServer\Domain\JsonRpcMethodInterface;
use Yoanm\JsonRpcServerDoc\Domain\Model\ErrorDoc;
use Yoanm\JsonRpcServerDoc\Domain\Model\Type\NumberDoc;
use Yoanm\JsonRpcServerDoc\Domain\Model\Type\ObjectDoc;
use Yoanm\JsonRpcServerDoc\Domain\Model\Type\StringDoc;
use Yoanm\JsonRpcServerDoc\Domain\Model\Type\TypeDoc;

/**
 * Class UpdateMethod.
 *
 * @SuppressWarnings(PHPMD)
 */
class UpdateMethod implements JsonRpcMethodInterface, MethodWithValidatedParamsInterface, JsonRpcMethodWithDocInterface
{
    /**
     * CommandBus object.
     *
     * @var CommandBus
     */
    private CommandBus $commandBus;

    /**
     * Command factory.
     *
     * @var CommandFactory
     */
    private CommandFactory $commandFactory;

    /**
     * FetchMethod constructor.
     *
     * @param CommandBus $commandBus
     * @param CommandFactory $commandFactory
     */
    public function __construct(CommandBus $commandBus, CommandFactory $commandFactory)
    {
        $this->commandBus = $commandBus;
        $this->commandFactory = $commandFactory;
    }

    /**
     * RPC api method update new user.
     *
     * @param mixed[]|null $paramList
     *
     * @return mixed[]|null
     *
     * @throws Exception
     */
    public function apply(?array $paramList = null)
    {
        if (null === $paramList) {
            return null;
        }
        $userDto = UserDto::denormalize($paramList);

        return $this->commandBus->handle($this->commandFactory->makeUserUpdateTaskCommand($paramList['uuid'], $userDto));
    }

    /**
     * Return constraint rules for rpc method.
     *
     * @return Constraint
     */
    public function getParamsConstraint(): Constraint
    {
        return new Collection(['fields' => [
            'version' => new Required([
                new Length(['min' => 5, 'max' => 7]),
            ]),
            'uuid' => new Required([
                new Length(['min' => 36, 'max' => 36]),
            ]),
            'password' => new Required([
                new Length(['min' => 8, 'max' => 100]),
            ]),
            'firstname' => new Required([
                new Length(['min' => 2, 'max' => 100]),
            ]),
            'lastname' => new Required([
                new Length(['min' => 2, 'max' => 100]),
            ]),
            'age' => new Optional([
                new Length(['min' => 1, 'max' => 150]),
            ]),
        ]]);
    }

    /**
     * Return rpc method description.
     *
     * @return string
     */
    public function getDocDescription(): string
    {
        return 'Update user method';
    }

    /**
     * Return rpc method tag.
     *
     * @return string
     */
    public function getDocTag(): string
    {
        return 'main';
    }

    /**
     * Return rpc method error types.
     *
     * @return ErrorDoc[]
     */
    public function getDocErrors(): array
    {
        return [new ErrorDoc('Error 1', 1)];
    }

    /**
     * Return rpc method response type.
     *
     * @return TypeDoc
     */
    public function getDocResponse(): TypeDoc
    {
        $response = new ObjectDoc();
        $response->setNullable(false);

        $response->addSibling(
            (new StringDoc())
                ->setNullable(false)
                ->setDescription('Version user')
                ->setName('version')
        );

        $response->addSibling(
            (new StringDoc())
                ->setNullable(false)
                ->setDescription('Uuid user')
                ->setName('uuid')
        );

        $response->addSibling(
            (new NumberDoc())
                ->setNullable(false)
                ->setDescription('User password')
                ->setName('password')
        );

        $response->addSibling(
            (new StringDoc())
                ->setNullable(false)
                ->setDescription('User firstname')
                ->setName('firstname')
        );

        $response->addSibling(
            (new StringDoc())
                ->setNullable(false)
                ->setDescription('User lastname')
                ->setName('lastname')
        );

        $response->addSibling(
            (new NumberDoc())
                ->setNullable(false)
                ->setDescription('User age')
                ->setName('age')
        );

        return $response;
    }
}
