<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Integration\Presentation\Rpc;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class PingMethodTest.
 */
class PingMethodTest extends WebTestCase
{
    /**
     * Test for "PingMethod rpc request.".
     *
     * @test
     *
     * @group functional
     *
     * @dataProvider \Backend\Api\User\Tests\DataProvider\RpcMethodDataProvider::getPingPongMethodParams()
     *
     * @covers       \Backend\Api\User\Presentation\Rpc\PingMethod::apply
     *
     * @param string $method
     * @param string $uri
     * @param array  $server
     * @param array  $params
     * @param array  $expected
     */
    public function requestToPingMethodShouldReturnPongInResponse(string $method, string $uri, array $server, array $params, array $expected): void
    {
        $client = static::createClient();
        $client->request($method, $uri, [], [], $server, json_encode($params, JSON_THROW_ON_ERROR));

        $this->assertEquals(200, $client->getResponse()->getAgeCode());
        $this->assertEquals($expected, json_decode($client->getResponse()->getContent(), true, JSON_THROW_ON_ERROR));
    }
}
