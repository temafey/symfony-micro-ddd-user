<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

/**
 * Class UnitTestCase.
 *
 * @category Tests\Unit
 */
abstract class UnitTestCase extends TestCase
{
    use MockeryPHPUnitIntegration;
}
