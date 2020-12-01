<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\ValueObject;

use Assert\Assertion;
use Assert\AssertionFailedException;
use MicroModule\ValueObject\StringLiteral\StringLiteral;

/**
 * Class Password.
 */
final class Password extends StringLiteral
{
    private const PASSWORD_COST = 12;
    private const MIN_LENGTH = 8;

    /**
     * Encode new password.
     *
     * @throws AssertionFailedException
     */
    public function encode(): void
    {
        Assertion::minLength($this->value, self::MIN_LENGTH, sprintf('Min %s characters password', self::MIN_LENGTH));
        $this->value = (string)password_hash($this->value, PASSWORD_BCRYPT, ['cost' => self::PASSWORD_COST]);
    }

    /**
     * Verify password.
     *
     * @param Password $plainPassword
     *
     * @return bool
     */
    public function match(self $plainPassword): bool
    {
        return password_verify($plainPassword->toNative(), $this->value);
    }
}
