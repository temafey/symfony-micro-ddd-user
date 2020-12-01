<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Event;

use Assert\Assertion;
use Assert\AssertionFailedException;
use Backend\Api\User\Domain\ValueObject\User;
use Backend\Api\User\Domain\ValueObject\Uuid;
use Exception;
use MicroModule\ValueObject\Identity\UUID as ProcessUuid;

/**
 * Class UserWasUpdatedEvent.
 *
 * @category Domain\Event
 * @sub-package User
 */
final class UserWasUpdatedEvent extends UserEvent
{
    /**
     * User ValueObject.
     *
     * @var User
     */
    private User $user;

    /**
     * UserWasInit constructor.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $userUuid
     * @param User $user
     */
    public function __construct(ProcessUuid $processUuid, Uuid $userUuid, User $user)
    {
        parent::__construct($processUuid, $userUuid);

        $this->user = $user;
    }

    /**
     * Return User.
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
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
     * @throws Exception
     * @throws Exception
     *
     * @suppress PhanTypeMismatchArgument, PhanTypeInvalidThrowsIsInterface
     * @psalm-suppress ArgumentTypeCoercion
     */
    public static function deserialize(array $data): UserEvent
    {
        Assertion::keyExists($data, 'process_uuid');
        Assertion::keyExists($data, 'uuid');
        Assertion::keyExists($data, 'user');

        return new static(
            ProcessUuid::fromNative($data['process_uuid']),
            Uuid::fromNative($data['uuid']),
            User::fromNative($data['user'])
        );
    }

    /**
     * Convert event object to array.
     *
     * @return mixed[]
     *
     * @throws Exception
     */
    public function serialize(): array
    {
        return [
            'process_uuid' => $this->getProcessUuid()->toNative(),
            'uuid' => $this->getUuid()->toNative(),
            'user' => $this->getUser()->toNative(),
        ];
    }
}
