<?php

namespace Omnipay;

use Mockery as m;
use Mockery\MockInterface;
use Omnipay\Common\GatewayFactory;
use Omnipay\Tests\TestCase;

class OmnipayTest extends TestCase
{
    public function tearDown()
    {
        Omnipay::setFactory(null);
    }

    public function testGetFactory()
    {
        Omnipay::setFactory(null);

        /** @var MockInterface $factory */
        $factory = Omnipay::getFactory();
        $this->assertInstanceOf(GatewayFactory::class, $factory);
    }

    public function testSetFactory()
    {
        /** @var MockInterface $factory */
        $factory = m::mock(GatewayFactory::class);

        Omnipay::setFactory($factory);

        $this->assertSame($factory, Omnipay::getFactory());
    }

    public function testCallStatic()
    {
        /** @var MockInterface $factory */
        $factory = m::mock(GatewayFactory::class);
        $factory->shouldReceive('testMethod')->with('some-argument')->once()->andReturn('some-result');

        Omnipay::setFactory($factory);

        $result = Omnipay::testMethod('some-argument');
        $this->assertSame('some-result', $result);
    }
}
