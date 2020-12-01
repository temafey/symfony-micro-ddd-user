<?php

declare(strict_types=1);

namespace Backend\Api\User\Presentation\Rpc;

use Backend\Api\User\Domain\Factory\CommandFactory;
use Exception;
use League\Tactician\CommandBus;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Required;
use Yoanm\JsonRpcServer\Domain\JsonRpcMethodInterface;
use Yoanm\JsonRpcServerDoc\Domain\Model\ErrorDoc;
use Yoanm\JsonRpcServerDoc\Domain\Model\Type\NumberDoc;
use Yoanm\JsonRpcServerDoc\Domain\Model\Type\ObjectDoc;
use Yoanm\JsonRpcServerDoc\Domain\Model\Type\StringDoc;
use Yoanm\JsonRpcServerDoc\Domain\Model\Type\TypeDoc;

/**
 * Class FindMethod.
 *
 * @SuppressWarnings(PHPMD)
 */
class FindMethod implements JsonRpcMethodInterface
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
     * RPC api method fetch one user.
     *
     * @param mixed[]|null $paramList
     *
     * @return mixed|mixed[]|null
     *
     * @throws Exception
     */
    public function apply(?array $paramList = null)
    {
        if (null === $paramList) {
            $paramList = [];
        }

        return $this->commandBus->handle($this->commandFactory->makeFindLiteCommand($paramList));
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
            'uuid' => new Optional([
                new Length(['min' => 36, 'max' => 36]),
            ]),
            'nickname' => new Required([
                new Length(['min' => 5, 'max' => 100]),
            ]),
            'firstname' => new Required([
                new Length(['min' => 2, 'max' => 100]),
            ]),
            'lastname' => new Required([
                new Length(['min' => 2, 'max' => 100]),
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
        return 'Find users by criteria';
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
            (new NumberDoc())
                ->setNullable(false)
                ->setDescription('Id user')
                ->setName('uuid')
        );

        $response->addSibling(
            (new NumberDoc())
                ->setNullable(false)
                ->setDescription('User nickname')
                ->setName('nickname')
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

        return $response;
    }
}
