<?php

class FactoryTest extends PHPUnit_Framework_TestCase
{

    public function testFactoryApi() {
        $result = \Voradius\ClientApiFactory::newInstance('http://test', 'api-key');
        $this->assertInstanceOf('\\GuzzleHttp\\Client', $result);
        $this->assertEquals($result->getBaseUrl(), 'http://test');
        $this->assertEquals($result->getDefaultOption('headers')['X-API-KEY'], 'api-key');
    }

    public function testFactoryFrontend() {
        $result = \Voradius\ClientFrontendFactory::newInstance('http://test', 'api-key');
        $this->assertInstanceOf('\\GuzzleHttp\\Client', $result);
        $this->assertEquals($result->getBaseUrl(), 'http://test');
        $this->assertEquals($result->getDefaultOption('headers')['X-API-KEY'], 'api-key');
    }

}