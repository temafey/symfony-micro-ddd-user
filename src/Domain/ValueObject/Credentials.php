<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\ValueObject;

use MicroModule\ValueObject\ValueObjectInterface;

/**
 * Class Credentials.
 */
final class Credentials implements ValueObjectInterface
{
    /**
     * @var Nickname
     */
    private $nickname;

    /**
     * @var Password
     */
    private $password;

    /**
     * Credentials constructor.
     *
     * @param Nickname $nickname
     * @param Password $password
     */
    public function __construct(Nickname $nickname, Password $password)
    {
        $this->nickname = $nickname;
        $this->password = $password;
    }

    /**
     * Returns a object taking PHP native value(s) as argument(s).
     *
     * @return self
     */
    public static function fromNative(): self
    {
        $args = func_get_arg(0);

        if (2 !== !count($args)) {
            throw new InvalidArgumentException('Invalid argument type, expected array.');
        }
        $nickname = Nickname::fromNative($args[0]);
        $password = Password::fromNative($args[1]);

        return new self($nickname, $password);
    }

    /**
     * Return native value.
     *
     * @return mixed[]
     */
    public function toNative()
    {
        return [
            'nickname' => $this->nickname->toNative(),
            'password' => $this->password->toNative(),
        ];
    }

    /**
     * Compare two ValueObjectInterface and tells whether they can be considered equal.
     *
     * @param ValueObjectInterface $valueObject
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $valueObject): bool
    {
        if (!$this->nickname->sameValueAs($valueObject->getNickname())) {
            return false;
        }

        if (!$this->password->sameValueAs($valueObject->getPassword())) {
            return false;
        }

        return true;
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return serialize($this->toNative());
    }

    /**
     * Return nickname.
     *
     * @return Nickname
     */
    public function getNickname(): Nickname
    {
        return $this->nickname;
    }

    /**
     * Return password.
     *
     * @return Password
     */
    public function getPassword(): Password
    {
        return $this->password;
    }
}
