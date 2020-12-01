<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\DataProvider\Domain\ValueObject;

use stdClass;

/**
 * DataProvider for class {testClassName}.
 */
class UserDataProvider
{
    /**
     * Return test data for Backend\Api\User\Domain\ValueObject\User.
     *
     * @return mixed[]
     */
    public function getDataForFromNativeMethod(): array
    {
        return [
            0 => [
                0 => [
                    'value' => [
                        'uuid' => 'fde506f7-2306-309d-b53b-8a6296b4a9ab',
                        'version' => '0.1',
                        'name' => 'Miss Susan Bashirian IV',
                        'password' => 9,
                        'nickname' => 'https://www.rempel.net/sit-est-odit-qui-ex-quasi-suscipit',
                        'age' => 1,
                        'createdAt' => '2019-05-02T00:00:00+00:00',
                        'updatedAt' => '2020-02-03T00:00:00+00:00',
                    ],
                ],
            ],
            1 => [
                0 => [
                    'value' => serialize([
                        'uuid' => 'fde506f7-2306-309d-b53b-8a6296b4a9ab',
                        'version' => '0.1',
                        'name' => 'Miss Susan Bashirian IV',
                        'password' => 9,
                        'nickname' => 'https://www.rempel.net/sit-est-odit-qui-ex-quasi-suscipit',
                        'age' => 1,
                        'createdAt' => '2019-05-02T00:00:00+00:00',
                        'updatedAt' => '2020-02-03T00:00:00+00:00',
                    ]),
                ],
            ],
        ];
    }

    /**
     * Return test data for Backend\Api\User\Domain\ValueObject\User.
     *
     * @return mixed[]
     */
    public function getDataForToNativeMethod(): array
    {
        return [
            0 => [
                0 => [
                    'value' => [
                        'name' => 'Miss Susan Bashirian IV',
                        'password' => 9,
                        'nickname' => 'https://www.rempel.net/sit-est-odit-qui-ex-quasi-suscipit',
                        'age' => 1,
                        'createdAt' => '2019-05-02T00:00:00+00:00',
                        'updatedAt' => '2020-02-03T00:00:00+00:00',
                    ],
                    'toNative' => [
                        'name' => 'Miss Susan Bashirian IV',
                        'password' => 9,
                        'nickname' => 'https://www.rempel.net/sit-est-odit-qui-ex-quasi-suscipit',
                        'age' => 1,
                        'createdAt' => '2019-05-02T00:00:00+00:00',
                        'updatedAt' => '2020-02-03T00:00:00+00:00',
                    ],
                ],
                1 => [
                    'toNative' => 1,
                ],
            ],
        ];
    }

    /**
     * Return test data for Backend\Api\User\Domain\ValueObject\User.
     *
     * @return mixed[]
     */
    public function getDataForSameValueAsMethod(): array
    {
        return [
            0 => [
                0 => [
                    'value' => [
                        'name' => 'Miss Susan Bashirian IV',
                        'password' => 9,
                        'nickname' => 'https://www.rempel.net/sit-est-odit-qui-ex-quasi-suscipit',
                        'age' => 1,
                        'createdAt' => '2019-05-02T00:00:00+00:00',
                        'updatedAt' => '2020-02-03T00:00:00+00:00',
                    ],
                    'ValueObjectUser' => [
                        'name' => 'Miss Susan Bashirian IV',
                        'password' => 9,
                        'nickname' => 'https://www.rempel.net/sit-est-odit-qui-ex-quasi-suscipit',
                        'age' => 1,
                        'createdAt' => '2019-05-02T00:00:00+00:00',
                        'updatedAt' => '2020-02-03T00:00:00+00:00',
                    ],
                ],
                1 => [
                    'ValueObjectUser' => [
                        'toNative' => 1,
                    ],
                ],
            ],
        ];
    }

    /**
     * Return test data for Backend\Api\User\Domain\ValueObject\User.
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

    /**
     * Return test data for Backend\Api\User\Domain\ValueObject\User.
     *
     * @return mixed[]
     */
    public function getDataForDeserializeMethod(): array
    {
        return [
            0 => [
                0 => [
                    'deserialize' => null,
                    'data' => [
                        'name' => 'Miss Susan Bashirian IV',
                        'password' => 9,
                        'nickname' => 'https://www.rempel.net/sit-est-odit-qui-ex-quasi-suscipit',
                        'age' => 1,
                        'createdAt' => '2019-05-02T00:00:00+00:00',
                        'updatedAt' => '2020-02-03T00:00:00+00:00',
                    ],
                ],
            ],
        ];
    }

    /**
     * Return test data for Backend\Api\User\Domain\ValueObject\User.
     *
     * @return mixed[]
     */
    public function getDataForSerializeMethod(): array
    {
        return [
            0 => [
                0 => [
                    'serialize' => [
                        'name' => 'Miss Susan Bashirian IV',
                        'password' => 9,
                        'nickname' => 'https://www.rempel.net/sit-est-odit-qui-ex-quasi-suscipit',
                        'age' => 1,
                        'createdAt' => '2019-05-02T00:00:00+00:00',
                        'updatedAt' => '2020-02-03T00:00:00+00:00',
                    ],
                ],
            ],
        ];
    }
}
