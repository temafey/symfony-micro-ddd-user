<?php

declare(strict_types=1);

namespace Backend\Api\User\Domain\Exception;

use RuntimeException;

/**
 * Exception thrown if an user is not found.
 */
final class UserNotFoundException extends RuntimeException
{
}
