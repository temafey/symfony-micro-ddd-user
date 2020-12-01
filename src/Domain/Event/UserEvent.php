<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Event;

use Assert\Assertion;
use Assert\AssertionFailedException;
use Backend\Api\User\Domain\ValueObject\Uuid;
use Broadway\Serializer\Serializable;
use Exception;
use MicroModule\ValueObject\Identity\UUID as ProcessUuid;
use RuntimeException;

/**
 * Abstract class UserEvent.
 *
 * @category Domain\Event
 * @sub-package User
 */
abstract class UserEvent implements Serializable
{
    /**
     * ProcessUuid ValueObject.
     *
     * @var ProcessUuid
     */
    private ProcessUuid $processUuid;

    /**
     * Uuid ValueObject.
     *
     * @var Uuid
     */
    private Uuid $uuid;

    /**
     * UserEvent constructor.
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
     * Return user uuid.
     *
     * @return Uuid
     */
    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    /**
     * Return process uuid.
     *
     * @return ProcessUuid
     */
    public function getProcessUuid(): ProcessUuid
    {
        return $this->processUuid;
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
     * @suppress PhanTypeInstantiateAbstractStatic, PhanTypeInvalidThrowsIsInterface
     * @psalm-suppress ArgumentTypeCoercion
     */
    public static function deserialize(array $data): self
    {
        if (__CLASS__ === static::class) {
            throw new RuntimeException('You can\'t instantiate abstract class');
        }

        Assertion::keyExists($data, 'process_uuid');
        Assertion::keyExists($data, 'uuid');

        return new static(
            ProcessUuid::fromNative($data['process_uuid']),
            Uuid::fromNative($data['uuid'])
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
        ];
    }
}
