<?php

declare(strict_types=1);

namespace Backend\Api\User\Tests\Unit\Application\Service;

use Backend\Api\User\Application\Service\MappingCollector;
use Backend\Api\User\Tests\Unit\Mock\Vendor\Yoanm\JsonRpcServerVendorMockHelper;
use Backend\Api\User\Tests\Unit\UnitTestCase;

/**
 * Test for class MappingCollector.
 *
 * @class MappingCollectorTest
 */
class MappingCollectorTest extends UnitTestCase
{
    use JsonRpcServerVendorMockHelper;

    /**
     * Test for "Add new JsonRpcMethod.".
     *
     * @test
     *
     * @group unit
     *
     * @covers       \Backend\Api\User\Application\Service\MappingCollector::addJsonRpcMethod
     * @covers       \Backend\Api\User\Application\Service\MappingCollector::getMappingList
     *
     * @dataProvider \Backend\Api\User\Tests\Unit\DataProvider\Application\Service\MappingCollectorDataProvider::getDataForAddJsonRpcMethodMethod()
     *
     * @param mixed[] $mockArgs
     * @param mixed[] $mockTimes
     */
    public function addJsonRpcMethodShouldReturnVoidTest(array $mockArgs, array $mockTimes): void
    {
        $test = new MappingCollector();
        $methodName = $mockArgs['methodName'];
        $yoanmJsonRpcServerDomainJsonRpcMethodInterfaceMock = $this->createYoanmJsonRpcServerDomainJsonRpcMethodInterfaceMock($mockArgs['JsonRpcMethodInterface'], $mockTimes['JsonRpcMethodInterface']);
        $test->addJsonRpcMethod($methodName, $yoanmJsonRpcServerDomainJsonRpcMethodInterfaceMock);
        $mappingList = $test->getMappingList();

        self::arrayHasKey($methodName)->evaluate($mappingList);
        self::assertEquals($yoanmJsonRpcServerDomainJsonRpcMethodInterfaceMock, $mappingList[$methodName]);
    }
}
