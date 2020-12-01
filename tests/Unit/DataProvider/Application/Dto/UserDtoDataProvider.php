<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\DataProvider\Application\Dto;

/**
 * DataProvider for class {testClassName}.
 */
class UserDtoDataProvider
{
    /**
     * Return test data for Backend\Api\User\Application\Dto\UserDto.
     *
     * @return mixed[]
     */
    public function getData(): array
    {
        return [
            0 => [
                0 => [
                    'password' => 'test_pass',
                    'name' => 'Miss Susan Bashirian IV',
                    'data' => [
                        'uuid' => 'fde506f7-2306-309d-b53b-8a6296b4a9ab',
                        'version' => '0.1',
                        'name' => 'Miss Susan Bashirian IV',
                        'password' => 'test_pass',
                        'nickname' => 'https://www.rempel.net/sit-est-odit-qui-ex-quasi-suscipit',
                        'age' => 9,
                        'createdAt' => '2019-05-02',
                        'updatedAt' => '1971-11-19',
                    ],
                ],
                1 => [],
            ],
            1 => [
                0 => [
                    'password' => 'test_pass',
                    'name' => 'Amir Wintheiser',
                    'data' => [
                        'uuid' => '73fa2a35-f929-3381-8460-f38373ad5feb',
                        'version' => 'omnis',
                        'name' => 'Amir Wintheiser',
                        'password' => 'test_pass',
                        'nickname' => 'http://www.metz.biz/quibusdam-sed-quod-consequatur-magni-praesentium-quis-voluptatem',
                        'age' => 2,
                        'createdAt' => '1992-04-21',
                        'updatedAt' => '2016-01-03',
                    ],
                ],
                1 => [],
            ],
            2 => [
                0 => [
                    'password' => 'test_pass',
                    'name' => 'Prof. Tristian Harber',
                    'data' => [
                        'uuid' => '367da075-c818-3e21-88b5-17e27d836472',
                        'version' => '1',
                        'name' => 'Prof. Tristian Harber',
                        'password' => 'test_pass',
                        'nickname' => 'http://www.runolfsson.com/accusantium-aliquid-perspiciatis-sint-perferendis-ratione-et-beatae.html',
                        'age' => 3,
                        'createdAt' => '1980-03-10',
                        'updatedAt' => '1982-10-08',
                    ],
                ],
                1 => [],
            ],
        ];
    }
}
