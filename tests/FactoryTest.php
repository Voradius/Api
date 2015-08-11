<?php

class FactoryTest extends PHPUnit_Framework_TestCase
{

    public function testFactory() {
        $result = \Voradius\ClientFactory::newInstance('http://test', 'api-key');
        $this->assertInstanceOf('\\GuzzleHttp\\Client', $result);
        $this->assertEquals($result->getBaseUrl(), 'http://test');
        $this->assertEquals($result->getDefaultOption('headers')['X-API-KEY'], 'api-key');
    }

}