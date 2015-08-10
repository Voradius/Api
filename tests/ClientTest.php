<?php

class ClientTest extends PHPUnit_Framework_TestCase
{

    public function testWrongKey() {
        $this->setExpectedException('\\Voradius\\Exceptions\\InvalidParameterException');
        new \Voradius\Client;
    }

    public function testWrongEnvironment() {
        $this->setExpectedException('\\Voradius\\Exceptions\\ParameterNotAllowedException');
        new \Voradius\Client('api-key', 'bla');
    }

    public function testWrongPart() {
        $this->setExpectedException('\\Voradius\\Exceptions\\ParameterNotAllowedException');
        new \Voradius\Client('api-key', \Voradius\Client::LIVE, 'test');
    }

    public function testEnvironmentApi() {
        $this->assertInstanceOf('\\Voradius\\Client', new \Voradius\Client('api-key', \Voradius\Client::LIVE));
        $this->assertInstanceOf('\\Voradius\\Client', new \Voradius\Client('api-key', \Voradius\Client::LOCAL));
        $this->assertInstanceOf('\\Voradius\\Client', new \Voradius\Client('api-key', \Voradius\Client::SANDBOX));
        $this->assertInstanceOf('\\Voradius\\Client', new \Voradius\Client('api-key', \Voradius\Client::STAGING));
    }

    public function testEnvironmentFrontend() {
        $this->assertInstanceOf('\\Voradius\\Client', new \Voradius\Client('api-key', \Voradius\Client::LIVE, \Voradius\Client::PART_FRONTEND));
        $this->assertInstanceOf('\\Voradius\\Client', new \Voradius\Client('api-key', \Voradius\Client::LOCAL, \Voradius\Client::PART_FRONTEND));
        $this->assertInstanceOf('\\Voradius\\Client', new \Voradius\Client('api-key', \Voradius\Client::SANDBOX, \Voradius\Client::PART_FRONTEND));
        $this->assertInstanceOf('\\Voradius\\Client', new \Voradius\Client('api-key', \Voradius\Client::STAGING, \Voradius\Client::PART_FRONTEND));
    }

}