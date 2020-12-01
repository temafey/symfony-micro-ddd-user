<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Event;

use Assert\Assertion;
use Assert\AssertionFailedException;
use Backend\Api\User\Domain\ValueObject\Id;
use Backend\Api\User\Domain\ValueObject\Uuid;
use Exception;
use MicroModule\ValueObject\Identity\UUID as ProcessUuid;

/**
 * Class UserIdWasCreatedEvent.
 *
 * @category Domain\Event
 * @sub-package User
 */
class UserIdWasCreatedEvent extends UserEvent
{
    /**
     * Id ValueObject.
     *
     * @var Id
     */
    private Id $id;

    /**
     * UserWasInit constructor.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $userUuid
     * @param Id $userId
     */
    public function __construct(ProcessUuid $processUuid, Uuid $userUuid, Id $userId)
    {
        parent::__construct($processUuid, $userUuid);

        $this->id = $userId;
    }

    /**
     * Return Id.
     *
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * Initialize event from data array.
     *
     * @param mixed[] $data
     *
     * @return static
     *
     * @throws AssertionFailedException
     * @throws Exception
     *
     * @suppress PhanTypeMismatchArgument, PhanTypeInvalidThrowsIsInterface
     * @psalm-suppress ArgumentTypeCoercion
     */
    public static function deserialize(array $data): UserEvent
    {
        Assertion::keyExists($data, 'process_uuid');
        Assertion::keyExists($data, 'uuid');
        Assertion::keyExists($data, 'id');

        return new static(
            ProcessUuid::fromNative($data['process_uuid']),
            Uuid::fromNative($data['uuid']),
            Id::fromNative((int)$data['id'])
        );
    }

    /**
     * Convert event object to array.
     *
     * @return mixed[]
     */
    public function serialize(): array
    {
        return [
            'process_uuid' => $this->getProcessUuid()->toNative(),
            'uuid' => $this->getUuid()->toNative(),
            'id' => $this->getId()->toNative(),
        ];
    }
}
