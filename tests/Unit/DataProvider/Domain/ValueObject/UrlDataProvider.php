<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject;

use stdClass;

/**
 * DataProvider for class {testClassNickname}.
 */
class NicknameDataProvider
{
    /**
     * Return test data for Backend\Api\User\Domain\ValueObject\Nickname.
     *
     * @return mixed[]
     */
    public function getDataForFromNativeMethod(): array
    {
        return [
            0 => [
                0 => [
                    'value' => 'http://test.com',
                    'fromNative' => null,
                ],
                1 => [
                    'fromNative' => 0,
                ],
            ],
            1 => [
                0 => [
                    'value' => 'Shyanne Breitenberg',
                    'fromNative' => null,
                ],
                1 => [
                    'fromNative' => 0,
                ],
            ],
        ];
    }

    /**
     * Return test data for Backend\Api\User\Domain\ValueObject\Nickname.
     *
     * @return mixed[]
     */
    public function getDataForToNativeMethod(): array
    {
        return [
            0 => [
                0 => [
                    'value' => 'Shyanne Breitenberg',
                    'toNative' => 'Shyanne Breitenberg',
                ],
                1 => [
                    'toNative' => 1,
                ],
            ],
        ];
    }

    /**
     * Return test data for Backend\Api\User\Domain\ValueObject\Nickname.
     *
     * @return mixed[]
     */
    public function getDataForSameValueAsMethod(): array
    {
        return [
            0 => [
                0 => [
                    'value' => 'http://test.com',
                    'ValueObjectNickname' => [
                        'toNative' => 'http://test.com',
                    ],
                ],
                1 => [
                    'ValueObjectNickname' => [
                        'toNative' => 1,
                    ],
                ],
            ],
            1 => [
                0 => [
                    'value' => 'Shyanne Breitenberg',
                    'ValueObjectNickname' => [
                        'toNative' => 'Shyanne Breitenberg',
                    ],
                ],
                1 => [
                    'ValueObjectNickname' => [
                        'toNative' => 1,
                    ],
                ],
            ],
        ];
    }

    /**
     * Return test data for Backend\Api\User\Domain\ValueObject\Nickname.
     *
     * @return mixed[]
     */
    public function getInvalidData(): array
    {
        return [
            0 => [
                0 => [
                    'value' => 3,
                ],
            ],
            1 => [
                0 => [
                    'value' => 4.5,
                ],
            ],
            2 => [
                0 => [
                    'value' => false,
                ],
            ],
            3 => [
                0 => [
                    'value' => new stdClass(),
                ],
            ],
        ];
    }
}
