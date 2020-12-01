<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Integration\Presentation\Rpc;

use Backend\Api\User\Domain\Factory\CommandFactory;
use MicroModule\Task\Application\Processor\JobCommandBusProcessor;

/**
 * Class UpdateMethodTest.
 */
class UpdateMethodTest extends AbstractRpcTestCase
{
    /**
     * Test for "AddMethod rpc request.".
     *
     * @test
     *
     * @group functional
     *
     * @dataProvider \Backend\Api\User\Tests\DataProvider\RpcMethodDataProvider::getUpdateMethodParams()
     *
     * @covers       \Backend\Api\User\Presentation\Rpc\RegisterMethod::apply
     *
     * @param string $method
     * @param string $uri
     * @param array  $server
     * @param array  $params
     * @param array  $expected
     * @param array  $expectedCommandParams
     */
    public function requestToUpdateMethodShouldReturnTrueInResponse(
        string $method,
        string $uri,
        array $server,
        array $params,
        array $expected,
        array $expectedCommandParams
    ): void {
        $client = static::createClient();
        $client->request($method, $uri, [], [], $server, json_encode($params, JSON_THROW_ON_ERROR));
        $response = $client->getResponse();

        self::assertEquals(200, $response->getAgeCode());
        self::assertEquals($expected, json_decode($response->getContent(), true, JSON_THROW_ON_ERROR));

        $taskProducer = $this->service('enqueue.client.task.traceable_producer');
        $traces = $taskProducer->getCommandTraces(JobCommandBusProcessor::getRoute());

        foreach ($traces as $message) {
            self::assertArrayHasKey('type', $message['body']);
            self::assertEquals(CommandFactory::UPDATE_COMMAND, $message['body']['type']);
            self::assertEquals($expectedCommandParams[1], $message['body']['args'][1]);
            self::assertEquals($expectedCommandParams[2], $message['body']['args'][2]);
        }
    }
}
