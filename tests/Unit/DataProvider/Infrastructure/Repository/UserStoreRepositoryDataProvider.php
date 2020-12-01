<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\DataProvider\Infrastructure\Repository;

/**
 * DataProvider for class {testClassName}.
 */
class UserStoreRepositoryDataProvider
{
    /**
     * Return test data for Backend\Api\User\Infrastructure\Repository\UserStoreRepository.
     *
     * @return mixed[]
     */
    public function getDataForGetMethod(): array
    {
        return [
            0 => [
                0 => [
                    'EventSourcingRepository' => [
                        'load' => [
                            'getUncommittedEvents' => [
                                'getIterator' => [
                                ],
                            ],
                            'getAggregateRootId' => 'qui',
                        ],
                        'save' => null,
                    ],
                    'EventStore' => [
                        'load' => [
                            'getIterator' => [
                            ],
                        ],
                        'loadFromPlayhead' => [
                            'getIterator' => [
                            ],
                        ],
                        'append' => null,
                    ],
                    'SnapshotRepositoryInterface' => [
                        'load' => [
                            'getPlayhead' => 5,
                            'getAggregateRoot' => [
                                'apply' => null,
                                'getUncommittedEvents' => [
                                    'getIterator' => [
                                    ],
                                ],
                                'initializeState' => 'Louisiana',
                                'getPlayhead' => 3,
                                'getAggregateRootId' => 'sint',
                            ],
                        ],
                        'save' => null,
                    ],
                    'TriggerInterface' => [
                        'shouldSnapshot' => 'nisi',
                    ],
                    'get' => null,
                    'Uuid' => [
                        'toNative' => 'cbfed0a7-23bc-36c1-8253-b518bfa3cef6',
                        'getUuid' => [
                            'toString' => 'a0d6d717-cba3-32c8-98d1-068301a9841d',
                        ],
                        'sameValueAs' => true,
                        'isEmpty' => true,
                    ],
                ],
                1 => [
                    'EventSourcingRepository' => [
                        'times' => 0,
                        'load' => [
                            'times' => 0,
                            'getUncommittedEvents' => [
                                'times' => 0,
                                'getIterator' => [
                                    'times' => 0,
                                ],
                            ],
                            'getAggregateRootId' => 0,
                        ],
                        'save' => 0,
                    ],
                    'EventStore' => [
                        'times' => 0,
                        'load' => [
                            'times' => 0,
                            'getIterator' => [
                                'times' => 0,
                            ],
                        ],
                        'loadFromPlayhead' => [
                            'times' => 1,
                            'getIterator' => [
                                'times' => 0,
                            ],
                        ],
                        'append' => 0,
                    ],
                    'SnapshotRepositoryInterface' => [
                        'times' => 0,
                        'load' => [
                            'times' => 1,
                            'getPlayhead' => 1,
                            'getAggregateRoot' => [
                                'times' => 1,
                                'apply' => 0,
                                'getUncommittedEvents' => [
                                    'times' => 0,
                                    'getIterator' => [
                                        'times' => 0,
                                    ],
                                ],
                                'initializeState' => 1,
                                'getPlayhead' => 0,
                                'getAggregateRootId' => 0,
                            ],
                        ],
                        'save' => 0,
                    ],
                    'TriggerInterface' => [
                        'times' => 0,
                        'shouldSnapshot' => 0,
                    ],
                    'get' => 0,
                    'Uuid' => [
                        'times' => 0,
                        'toNative' => 1,
                        'getUuid' => [
                            'times' => 0,
                            'toString' => 0,
                        ],
                        'sameValueAs' => 0,
                        'isEmpty' => 0,
                    ],
                ],
            ],
        ];
    }

    /**
     * Return test data for Backend\Api\User\Infrastructure\Repository\UserStoreRepository.
     *
     * @return mixed[]
     */
    public function getDataForStoreMethod(): array
    {
        return [
            0 => [
                0 => [
                    'EventSourcingRepository' => [
                        'load' => [
                            'getUncommittedEvents' => [
                                'getIterator' => [
                                ],
                            ],
                            'getAggregateRootId' => 'qui',
                        ],
                        'save' => null,
                    ],
                    'EventStore' => [
                        'load' => [
                            'getIterator' => [
                            ],
                        ],
                        'loadFromPlayhead' => [
                            'getIterator' => [
                            ],
                        ],
                        'append' => null,
                    ],
                    'SnapshotRepositoryInterface' => [
                        'load' => [
                            'getPlayhead' => 5,
                            'getAggregateRoot' => [
                                'apply' => null,
                                'getUncommittedEvents' => [
                                    'getIterator' => [
                                    ],
                                ],
                                'initializeState' => 'Louisiana',
                                'getPlayhead' => 3,
                                'getAggregateRootId' => 'sint',
                            ],
                        ],
                        'save' => null,
                    ],
                    'TriggerInterface' => [
                        'shouldSnapshot' => 'nisi',
                    ],
                    'UserEntity' => [
                        'addId' => null,
                        'delete' => null,
                        'getUuid' => [
                            'toNative' => '87e33cb2-ccb7-36db-b074-e0e67439f2dc',
                            'getUuid' => [
                                'toString' => '2f8cff50-f51f-36a0-8d6a-33ebde6a96fd',
                            ],
                            'sameValueAs' => true,
                            'isEmpty' => true,
                        ],
                        'getId' => [
                            'sameValueAs' => true,
                            'toNative' => 6,
                            'inc' => [
                                'sameValueAs' => false,
                                'toNative' => 3,
                            ],
                            'decr' => [
                                'sameValueAs' => true,
                                'toNative' => 2,
                            ],
                        ],
                        'getPassword' => [
                            'sameValueAs' => true,
                            'toNative' => 8,
                            'inc' => [
                                'sameValueAs' => false,
                                'toNative' => 4,
                            ],
                            'decr' => [
                                'sameValueAs' => false,
                                'toNative' => 9,
                            ],
                        ],
                        'getName' => [
                            'toNative' => 'Mrs. Minnie Turner II',
                            'sameValueAs' => true,
                            'isEmpty' => true,
                        ],
                        'getAge' => [
                            'isActive' => true,
                            'sameValueAs' => true,
                            'toNative' => 7,
                            'inc' => [
                                'sameValueAs' => true,
                                'toNative' => 9,
                            ],
                            'decr' => [
                                'sameValueAs' => false,
                                'toNative' => 1,
                            ],
                        ],
                        'getNickname' => [
                            'toNative' => 'https://bartoletti.com/distinctio-sit-quod-architecto.html',
                            'sameValueAs' => true,
                            'isEmpty' => true,
                        ],
                        'getCreatedAt' => [
                            'toNative' => [
                                'getTimestamp' => '23:13:46',
                            ],
                        ],
                        'getUpdatedAt' => [
                            'toNative' => [
                                'getTimestamp' => '07:09:43',
                            ],
                            'sameValueAs' => true,
                            'getDate' => [
                                'toNative' => [
                                    'getTimestamp' => '20:05:02',
                                ],
                            ],
                            'getTime' => [
                                'toNative' => [
                                    'getTimestamp' => '11:08:58',
                                ],
                            ],
                            'toNativeDateTime' => [
                                'getTimestamp' => '07:20:44',
                            ],
                        ],
                        'initializeState' => 'Maine',
                        'getPlayhead' => 9,
                    ],
                ],
                1 => [
                    'EventSourcingRepository' => [
                        'times' => 0,
                        'load' => [
                            'times' => 0,
                            'getUncommittedEvents' => [
                                'times' => 0,
                                'getIterator' => [
                                    'times' => 0,
                                ],
                            ],
                            'getAggregateRootId' => 0,
                        ],
                        'save' => 1,
                    ],
                    'EventStore' => [
                        'times' => 0,
                        'load' => [
                            'times' => 0,
                            'getIterator' => [
                                'times' => 0,
                            ],
                        ],
                        'loadFromPlayhead' => [
                            'times' => 0,
                            'getIterator' => [
                                'times' => 0,
                            ],
                        ],
                        'append' => 0,
                    ],
                    'SnapshotRepositoryInterface' => [
                        'times' => 0,
                        'load' => [
                            'times' => 0,
                            'getPlayhead' => 0,
                            'getAggregateRoot' => [
                                'times' => 0,
                                'apply' => 0,
                                'getUncommittedEvents' => [
                                    'times' => 0,
                                    'getIterator' => [
                                        'times' => 0,
                                    ],
                                ],
                                'initializeState' => 0,
                                'getPlayhead' => 0,
                                'getAggregateRootId' => 0,
                            ],
                        ],
                        'save' => 1,
                    ],
                    'TriggerInterface' => [
                        'times' => 0,
                        'shouldSnapshot' => 1,
                    ],
                    'UserEntity' => [
                        'times' => 0,
                        'addId' => 0,
                        'delete' => 0,
                        'getUuid' => [
                            'times' => 0,
                            'toNative' => 0,
                            'getUuid' => [
                                'times' => 0,
                                'toString' => 0,
                            ],
                            'sameValueAs' => 0,
                            'isEmpty' => 0,
                        ],
                        'getId' => [
                            'times' => 0,
                            'sameValueAs' => 0,
                            'toNative' => 0,
                            'inc' => [
                                'times' => 0,
                                'sameValueAs' => 0,
                                'toNative' => 0,
                            ],
                            'decr' => [
                                'times' => 0,
                                'sameValueAs' => 0,
                                'toNative' => 0,
                            ],
                        ],
                        'getPassword' => [
                            'times' => 0,
                            'sameValueAs' => 0,
                            'toNative' => 0,
                            'inc' => [
                                'times' => 0,
                                'sameValueAs' => 0,
                                'toNative' => 0,
                            ],
                            'decr' => [
                                'times' => 0,
                                'sameValueAs' => 0,
                                'toNative' => 0,
                            ],
                        ],
                        'getName' => [
                            'times' => 0,
                            'toNative' => 0,
                            'sameValueAs' => 0,
                            'isEmpty' => 0,
                        ],
                        'getAge' => [
                            'times' => 0,
                            'isActive' => 0,
                            'sameValueAs' => 0,
                            'toNative' => 0,
                            'inc' => [
                                'times' => 0,
                                'sameValueAs' => 0,
                                'toNative' => 0,
                            ],
                            'decr' => [
                                'times' => 0,
                                'sameValueAs' => 0,
                                'toNative' => 0,
                            ],
                        ],
                        'getNickname' => [
                            'times' => 0,
                            'toNative' => 0,
                            'sameValueAs' => 0,
                            'isEmpty' => 0,
                        ],
                        'getCreatedAt' => [
                            'times' => 0,
                            'toNative' => [
                                'times' => 0,
                                'getTimestamp' => 0,
                            ],
                        ],
                        'getUpdatedAt' => [
                            'times' => 0,
                            'toNative' => [
                                'times' => 0,
                                'getTimestamp' => 0,
                            ],
                            'sameValueAs' => 0,
                            'getDate' => [
                                'times' => 0,
                                'toNative' => [
                                    'times' => 0,
                                    'getTimestamp' => 0,
                                ],
                            ],
                            'getTime' => [
                                'times' => 0,
                                'toNative' => [
                                    'times' => 0,
                                    'getTimestamp' => 0,
                                ],
                            ],
                            'toNativeDateTime' => [
                                'times' => 0,
                                'getTimestamp' => 0,
                            ],
                        ],
                        'initializeState' => 0,
                        'getPlayhead' => 1,
                    ],
                ],
            ],
        ];
    }

    /**
     * Return test data for Backend\Api\User\Infrastructure\Repository\UserStoreRepository.
     *
     * @return mixed[]
     */
    public function getDataForLoadMethod(): array
    {
        return [
            0 => [
                0 => [
                    'EventSourcingRepository' => [
                        'load' => [
                            'getUncommittedEvents' => [
                                'getIterator' => [
                                ],
                            ],
                            'getAggregateRootId' => 'qui',
                        ],
                        'save' => null,
                    ],
                    'EventStore' => [
                        'load' => [
                            'getIterator' => [
                            ],
                        ],
                        'loadFromPlayhead' => [
                            'getIterator' => [
                            ],
                        ],
                        'append' => null,
                    ],
                    'SnapshotRepositoryInterface' => [
                        'load' => [
                            'getPlayhead' => 5,
                            'getAggregateRoot' => [
                                'apply' => null,
                                'getUncommittedEvents' => [
                                    'getIterator' => [
                                    ],
                                ],
                                'initializeState' => 'Louisiana',
                                'getPlayhead' => 3,
                                'getAggregateRootId' => 'sint',
                            ],
                        ],
                        'save' => null,
                    ],
                    'TriggerInterface' => [
                        'shouldSnapshot' => 'nisi',
                    ],
                    'load' => [
                        'getUncommittedEvents' => [
                            'getIterator' => [
                            ],
                        ],
                        'getAggregateRootId' => 'aut',
                        'className' => 'Broadway\\Domain\\AggregateRoot',
                    ],
                    'id' => 'illum',
                ],
                1 => [
                    'EventSourcingRepository' => [
                        'times' => 0,
                        'load' => [
                            'times' => 0,
                            'getUncommittedEvents' => [
                                'times' => 0,
                                'getIterator' => [
                                    'times' => 0,
                                ],
                            ],
                            'getAggregateRootId' => 0,
                        ],
                        'save' => 0,
                    ],
                    'EventStore' => [
                        'times' => 0,
                        'load' => [
                            'times' => 0,
                            'getIterator' => [
                                'times' => 0,
                            ],
                        ],
                        'loadFromPlayhead' => [
                            'times' => 1,
                            'getIterator' => [
                                'times' => 0,
                            ],
                        ],
                        'append' => 0,
                    ],
                    'SnapshotRepositoryInterface' => [
                        'times' => 0,
                        'load' => [
                            'times' => 1,
                            'getPlayhead' => 1,
                            'getAggregateRoot' => [
                                'times' => 1,
                                'apply' => 0,
                                'getUncommittedEvents' => [
                                    'times' => 0,
                                    'getIterator' => [
                                        'times' => 0,
                                    ],
                                ],
                                'initializeState' => 1,
                                'getPlayhead' => 0,
                                'getAggregateRootId' => 0,
                            ],
                        ],
                        'save' => 0,
                    ],
                    'TriggerInterface' => [
                        'times' => 0,
                        'shouldSnapshot' => 0,
                    ],
                    'load' => [
                        'times' => 0,
                        'getUncommittedEvents' => [
                            'times' => 0,
                            'getIterator' => [
                                'times' => 0,
                            ],
                        ],
                        'getAggregateRootId' => 0,
                        'className' => 'Broadway\\Domain\\AggregateRoot',
                    ],
                ],
            ],
        ];
    }
}
