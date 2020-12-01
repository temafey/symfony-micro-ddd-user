<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\ValueObject;

use Backend\Api\User\Domain\Exception\ValueObjectInvalidException;
use Backend\Api\User\Domain\Exception\ValueObjectInvalidNativeValueException;
use Broadway\Serializer\Serializable;
use DateTime;
use Exception;
use MicroModule\ValueObject\DateTime\Exception\InvalidDateException;
use MicroModule\ValueObject\ValueObjectInterface;

/**
 * Class User.
 *
 * @SuppressWarnings(PHPMD)
 */
class User implements ValueObjectInterface, Serializable
{
    /**
     * Fields, that should be compared.
     *
     * @var array
     */
    public const COMPARED_FIELDS = [
        'nickname',
        'password',
        'name',
        'age',
    ];

    /**
     * Id ValueObject.
     *
     * @var Id|null
     */
    private ?Id $id = null;

    /**
     * Nickname ValueObject.
     *
     * @var Nickname|null
     */
    private ?Nickname $nickname = null;

    /**
     * Password ValueObject.
     *
     * @var Password|null
     */
    private ?Password $password = null;

    /**
     * Name ValueObject.
     *
     * @var Name|null
     */
    private ?Name $name = null;

    /**
     * Age ValueObject.
     *
     * @var Age|null
     */
    private ?Age $age = null;

    /**
     * CreatedAt ValueObject.
     *
     * @var CreatedAt|null
     */
    private ?CreatedAt $createdAt = null;

    /**
     * UpdatedAt ValueObject.
     *
     * @var UpdatedAt|null
     */
    private ?UpdatedAt $updatedAt = null;

    /**
     * Make User from user DTO object.
     *
     * @return User
     *
     * @throws Exception
     */
    public static function fromNative(): ValueObjectInterface
    {
        $user = func_get_arg(0);

        if (is_array($user)) {
            return static::fromArray($user);
        }

        if (is_string($user)) {
            $user = unserialize($user, ['allowed_classes' => false]);

            return static::fromArray($user);
        }

        throw new ValueObjectInvalidNativeValueException('Invalid native value');
    }

    /**
     * Build User object from array.
     *
     * @param mixed[] $user
     *
     * @return User
     *
     * @throws InvalidDateException
     *
     * @suppress PhanTypeMismatchArgument
     * @psalm-suppress ArgumentTypeCoercion
     */
    private static function fromArray(array $user): self
    {
        $userValueObject = new self();

        if (isset($user['id'])) {
            $userValueObject->id = Id::fromNative($user['id']);
        }

        if (isset($user['nickname'])) {
            $userValueObject->nickname = Nickname::fromNative($user['nickname']);
        }

        if (isset($user['password'])) {
            $userValueObject->password = Password::fromNative($user['password']);
        }

        if (isset($user['firstname']) && isset($user['lastname'])) {
            $userValueObject->name = Name::fromNative($user['firstname'], '', $user['lastname']);
        }

        if (isset($user['age'])) {
            $userValueObject->age = Age::fromNative($user['age']);
        }

        if (isset($user['createdAt'])) {
            $userValueObject->createdAt = CreatedAt::fromNative($user['createdAt']);
        }

        if (isset($user['created_at'])) {
            $userValueObject->createdAt = CreatedAt::fromNative($user['created_at']);
        }

        if (isset($user['updatedAt'])) {
            $userValueObject->updatedAt = UpdatedAt::fromNative($user['updatedAt']);
        }

        if (isset($user['updated_at'])) {
            $userValueObject->updatedAt = UpdatedAt::fromNative($user['updated_at']);
        }

        return $userValueObject;
    }

    /**
     * Convert to array.
     *
     * @return mixed[]
     *
     * @throws Exception
     */
    public function toArray(): array
    {
        $user = [];

        if (null !== $this->id) {
            $user['id'] = $this->id->toNative();
        }

        if (null !== $this->nickname) {
            $user['nickname'] = $this->nickname->toNative();
        }

        if (null !== $this->password) {
            $user['password'] = $this->password->toNative();
        }

        if (null !== $this->name) {
            $user['firstname'] = $this->name->getFirstName()->toNative();
            $user['lastname'] = $this->name->getLastName()->toNative();
        }

        if (null !== $this->age) {
            $user['age'] = $this->age->toNative();
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
     * Tells whether two Collection are equal by comparing their size and users (user order matters).
     *
     * @param ValueObjectInterface $valueObject
     *
     * @return bool
     *
     * @throws ValueObjectInvalidException
     */
    public function sameValueAs(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof static) {
            return false;
        }

        foreach (self::COMPARED_FIELDS as $field) {
            $getMethodName = 'get' . ucfirst($field);
            $field = $this->{$getMethodName}();
            $userProperty = $valueObject->{$getMethodName}();

            if (null === $field && null === $userProperty) {
                continue;
            }

            if (null === $field || null === $userProperty) {
                return false;
            }

            if (
                !$field instanceof ValueObjectInterface ||
                !$userProperty instanceof ValueObjectInterface
            ) {
                throw new ValueObjectInvalidException('Some of value not instance of \'ValueObjectInterface\'');
            }

            if (!$field->sameValueAs($userProperty)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Return native value.
     *
     * @return mixed[]
     *
     * @throws Exception
     */
    public function toNative()
    {
        return $this->toArray();
    }

    /**
     * Returns a native string representation of the Collection object.
     *
     * @return string
     *
     * @throws Exception
     */
    public function __toString(): string
    {
        return serialize($this->toArray());
    }

    /**
     * Return Id ValueObject.
     *
     * @return Id|null
     */
    public function getId(): ?Id
    {
        return $this->id;
    }

    /**
     * Return Nickname ValueObject.
     *
     * @return Nickname|null
     */
    public function getNickname(): ?Nickname
    {
        return $this->nickname;
    }

    /**
     * Return Password ValueObject.
     *
     * @return Password|null
     */
    public function getPassword(): ?Password
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
     * Return CreatedAt ValueObject.
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
     * Convert array to User ValueObject.
     *
     * @param mixed[] $user
     *
     * @return User
     *
     * @throws Exception
     */
    public static function deserialize(array $user): self
    {
        return static::fromNative($user);
    }

    /**
     * Convert User ValueObject to array.
     *
     * @return mixed[]
     *
     * @throws Exception
     */
    public function serialize(): array
    {
        return $this->toNative();
    }
}
