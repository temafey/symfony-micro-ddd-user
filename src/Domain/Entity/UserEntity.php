<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Entity;

use Assert\AssertionFailedException;
use Backend\Api\User\Domain\Event\UserIdWasAddedEvent;
use Backend\Api\User\Domain\Event\UserWasDeletedEvent;
use Backend\Api\User\Domain\Event\UserWasRegisteredEvent;
use Backend\Api\User\Domain\Event\UserWasUpdatedEvent;
use Backend\Api\User\Domain\Exception\InvalidCredentialsException;
use Backend\Api\User\Domain\Exception\ValueObjectInvalidException;
use Backend\Api\User\Domain\Factory\EventFactory;
use Backend\Api\User\Domain\ValueObject\Age;
use Backend\Api\User\Domain\ValueObject\CreatedAt;
use Backend\Api\User\Domain\ValueObject\Id;
use Backend\Api\User\Domain\ValueObject\Name;
use Backend\Api\User\Domain\ValueObject\Nickname;
use Backend\Api\User\Domain\ValueObject\Password;
use Backend\Api\User\Domain\ValueObject\UpdatedAt;
use Backend\Api\User\Domain\ValueObject\User as UserValueObject;
use Backend\Api\User\Domain\ValueObject\Uuid;
use Broadway\EventSourcing\EventSourcedAggregateRoot;
use DateTime;
use Exception;
use MicroModule\Snapshotting\EventSourcing\AggregateAssemblerInterface;
use MicroModule\ValueObject\Identity\UUID as ProcessUuid;
use MicroModule\ValueObject\ValueObjectInterface;

/**
 * Class UserEntity.
 *
 * @category Domain\Entity
 * @sub-package User
 *
 * @SuppressWarnings(PHPMD)
 */
class UserEntity extends EventSourcedAggregateRoot implements AggregateAssemblerInterface, EntityInterface, UserReadInterface
{
    /**
     * EventFactory object.
     *
     * @var EventFactory
     */
    protected EventFactory $eventFactory;

    /**
     * Is was any updates from last time.
     *
     * @var bool
     */
    protected bool $wasUpdated = false;

    /**
     * Is was user deleted.
     *
     * @var bool
     */
    protected bool $wasDeleted = false;

    /**
     * Is this user new.
     *
     * @var bool
     */
    protected bool $isNew = false;

    /**
     * Process uuid.
     *
     * @var ProcessUuid
     */
    protected ProcessUuid $processUuid;

    /**
     * User uuid.
     *
     * @var Uuid
     */
    protected Uuid $uuid;

    /**
     * User id.
     *
     * @var Id|null
     */
    protected ?Id $id = null;

    /**
     * User Nickname ValueObject.
     *
     * @var Nickname
     */
    private Nickname $nickname;

    /**
     * User Password ValueObject.
     *
     * @var Password
     */
    private ?Password $password;

    /**
     * User Name ValueObject.
     *
     * @var Name
     */
    private ?Name $name;

    /**
     * User Age ValueObject.
     *
     * @var Age
     */
    private ?Age $age;

    /**
     * User CreatedAt ValueObject.
     *
     * @var CreatedAt|null
     */
    private ?CreatedAt $createdAt = null;

    /**
     * User UpdatedAt ValueObject.
     *
     * @var UpdatedAt|null
     */
    private ?UpdatedAt $updatedAt = null;

    /**
     * UserEntity constructor.
     *
     * @param EventFactory|null $eventFactory
     */
    public function __construct(?EventFactory $eventFactory = null)
    {
        $this->eventFactory = $eventFactory ?? new EventFactory();
    }

    /**
     * Factory method for register new user.
     *
     * @param ProcessUuid $processUuid
     * @param Uuid $uuid
     * @param UserValueObject $userValueObject
     * @param EventFactory|null $eventFactory
     *
     * @return UserEntity
     *
     * @throws AssertionFailedException
     */
    public static function register(
        ProcessUuid $processUuid,
        Uuid $uuid,
        UserValueObject $userValueObject,
        ?EventFactory $eventFactory = null
    ): self
    {
        $userEntity = new self($eventFactory);
        $userValueObject->getPassword()->encode();
        $userEntity->apply($userEntity->eventFactory->makeUserWasRegisteredEvent($processUuid, $uuid, $userValueObject));

        return $userEntity;
    }

    /**
     * Apply event UserWasRegisteredEvent.
     *
     * @param UserWasRegisteredEvent $event
     *
     * @throws ValueObjectInvalidException
     *
     * @suppress PhanTypeMismatchArgument
     * @psalm-suppress ArgumentTypeCoercion
     */
    protected function applyUserWasRegisteredEvent(UserWasRegisteredEvent $event): void
    {
        $this->setNew();
        $this->processUuid = $event->getProcessUuid();
        $this->uuid = $event->getUuid();
        $this->assembleFromValueObject($event->getUser());
    }

    /**
     * Apply unique id to new User.
     *
     * @param Id $id
     */
    public function addId(Id $id): void
    {
        $this->apply($this->eventFactory->makeUserIdWasAddedEvent($this->processUuid, $this->uuid, $id));
    }

    /**
     * Apply event UserWasUpdatedEvent.
     *
     * @param UserIdWasAddedEvent $event
     *
     * @throws Exception
     *
     * @suppress PhanUnusedProtectedNoOverrideMethodParameter
     * @psalm-suppress ArgumentTypeCoercion
     */
    protected function applyUserIdWasAddedEvent(UserIdWasAddedEvent $event): void
    {
        $this->id = $event->getId();
    }

    /**
     * Update UserEntity.
     *
     * @param UserValueObject $userValueObject
     */
    public function update(UserValueObject $userValueObject): void
    {
        if (null !== $userValueObject->getPassword()) {
            $userValueObject->getPassword()->encode();
        }
        $this->apply($this->eventFactory->makeUserWasUpdatedEvent($this->processUuid, $this->uuid, $userValueObject));
    }

    /**
     * Apply event UserWasUpdatedEvent.
     *
     * @param UserWasUpdatedEvent $event
     *
     * @throws Exception
     *
     * @suppress PhanUnusedProtectedNoOverrideMethodParameter
     * @psalm-suppress ArgumentTypeCoercion
     */
    protected function applyUserWasUpdatedEvent(UserWasUpdatedEvent $event): void
    {
        $this->setWasUpdated();
        $this->assembleFromValueObject($event->getUser());
    }

    /**
     * Delete user.
     */
    public function delete(): void
    {
        if ($this->isWasDeleted()) {
            return;
        }
        $this->apply($this->eventFactory->makeUserWasDeletedEvent($this->processUuid, $this->uuid));
    }

    /**
     * Apply event UserWasDeletedEvent.
     *
     * @param UserWasDeletedEvent $event
     *
     * @throws Exception
     *
     * @suppress PhanUnusedProtectedNoOverrideMethodParameter
     * @psalm-suppress ArgumentTypeCoercion
     */
    protected function applyUserWasDeletedEvent(UserWasDeletedEvent $event): void
    {
        $this->setWasDeleted();
    }

    /**
     * User sign in action.
     *
     * @param Password $plainPassword
     *
     * @throws InvalidCredentialsException
     */
    public function signIn(Password $plainPassword): void
    {
        $match = $this->password->match($plainPassword);

        if (!$match) {
            throw new InvalidCredentialsException('Invalid credentials entered.');
        }
        $this->apply($this->eventFactory->makeUserSignedInEvent($this->processUuid, $this->uuid));
    }

    /**
     * Factory method for create actual UserEntity object.
     *
     * @param Uuid $uuid
     * @param UserValueObject $userValueObject
     * @param EventFactory|null $eventFactory
     *
     * @return UserEntity
     *
     * @throws ValueObjectInvalidException
     */
    public static function createActual(
        Uuid $uuid,
        UserValueObject $userValueObject,
        ?EventFactory $eventFactory = null
    ): self
    {
        $userEntity = new self($eventFactory);
        $userEntity->uuid = $uuid;
        $userEntity->assembleFromValueObject($userValueObject);

        return $userEntity;
    }

    /**
     * Is user was updated from last time.
     *
     * @return bool
     */
    public function isWasUpdated(): bool
    {
        return $this->wasUpdated;
    }

    /**
     * Set was updated flag.
     *
     * @param bool $isWasUpdated
     *
     * @return $this
     */
    public function setWasUpdated(bool $isWasUpdated = true): self
    {
        $this->wasUpdated = $isWasUpdated;

        return $this;
    }

    /**
     * Is user was deleted.
     *
     * @return bool
     */
    public function isWasDeleted(): bool
    {
        return $this->wasDeleted;
    }

    /**
     * Set was deleted flag.
     *
     * @param bool $isWasDeleted
     *
     * @return $this
     */
    public function setWasDeleted(bool $isWasDeleted = true): self
    {
        $this->wasDeleted = $isWasDeleted;

        return $this;
    }

    /**
     * Is the new user.
     *
     * @return bool
     */
    public function isNew(): bool
    {
        return $this->isNew;
    }

    /**
     * Set user new.
     *
     * @param bool $isNew
     *
     * @return $this
     */
    public function setNew(bool $isNew = true): self
    {
        $this->isNew = $isNew;

        return $this;
    }

    /**
     * Return Uuid ValueObject.
     *
     * @return Uuid
     */
    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    /**
     * Return Id ValueObject.
     *
     * @return Id
     *
     * @suppress PhanPartialTypeMismatchReturn
     * @psalm-suppress InvalidNullableReturnType
     * @psalm-suppress NullableReturnStatement
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * Return Nickname ValueObject.
     *
     * @return Nickname
     */
    public function getNickname(): Nickname
    {
        return $this->nickname;
    }

    /**
     * Return Password ValueObject.
     *
     * @return Password
     */
    public function getPassword(): Password
    {
        return $this->password;
    }

    /**
     * Return Name ValueObject.
     *
     * @return Name|null
     */
    public function getName(): ?Name
    {
        return $this->name;
    }

    /**
     * Return Age ValueObject.
     *
     * @return Age|null
     */
    public function getAge(): ?Age
    {
        return $this->age;
    }

    /**
     * Return CreateAt ValueObject.
     *
     * @return CreatedAt|null
     */
    public function getCreatedAt(): ?CreatedAt
    {
        return $this->createdAt;
    }

    /**
     * Return UpdatedAt ValueObject.
     *
     * @return UpdatedAt|null
     */
    public function getUpdatedAt(): ?UpdatedAt
    {
        return $this->updatedAt;
    }

    /**
     * Assemble entity from value object.
     *
     * @param ValueObjectInterface $valueObject
     *
     * @throws ValueObjectInvalidException
     *
     * @suppress PhanPossiblyNullTypeMismatchProperty
     * @psalm-suppress PossiblyNullPropertyAssignmentValue
     */
    public function assembleFromValueObject(ValueObjectInterface $valueObject): void
    {
        if (!$valueObject instanceof UserValueObject) {
            throw new ValueObjectInvalidException('UserEntity can be assembled only with User value object!');
        }

        if (null !== $valueObject->getNickname()) {
            $this->nickname = $valueObject->getNickname();
        }

        if (null !== $valueObject->getId()) {
            $this->id = $valueObject->getId();
        }

        if (null !== $valueObject->getPassword()) {
            $this->password = $valueObject->getPassword();
        }

        if (null !== $valueObject->getName()) {
            $this->name = $valueObject->getName();
        }

        if (null !== $valueObject->getAge()) {
            $this->age = $valueObject->getAge();
        }

        if (null !== $valueObject->getCreatedAt()) {
            $this->createdAt = $valueObject->getCreatedAt();
        }

        if (null !== $valueObject->getUpdatedAt()) {
            $this->updatedAt = $valueObject->getUpdatedAt();
        }
    }

    /**
     * Assemble value object from entity.
     *
     * @return UserValueObject
     *
     * @throws Exception
     */
    public function assembleToValueObject(): ValueObjectInterface
    {
        $user = $this->normalize();

        return UserValueObject::fromNative($user);
    }

    /**
     * Convert entity object to array.
     *
     * @return mixed[]
     *
     * @throws Exception
     */
    public function normalize(): array
    {
        $user = [];
        $user['uuid'] = $this->getUuid()->toNative();
        $user['nickname'] = $this->getNickname()->toNative();
        $user['password'] = $this->password->toNative();
        $user['firstname'] = $this->name->getFirstName()->toNative();
        $user['lastname'] = $this->name->getLastName()->toNative();
        $user['age'] = $this->age->toNative();

        if (null !== $this->id) {
            $user['id'] = $this->id->toNative();
        }

        if (null !== $this->createdAt) {
            $user['createdAt'] = $this->createdAt->toNative()->format(DateTime::ATOM);
        }

        if (null !== $this->updatedAt) {
            $user['updatedAt'] = $this->updatedAt->toNative()->format(DateTime::ATOM);
        }

        return $user;
    }

    /**
     * Return entity primary key value.
     *
     * @return int|string
     */
    public function getPrimaryKeyValue()
    {
        return $this->getAggregateRootId();
    }

    /**
     * Return current aggregate root unique key.
     *
     * @return string
     */
    public function getAggregateRootId(): string
    {
        return $this->uuid->toNative();
    }
}
