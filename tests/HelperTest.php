<?php

class ProductEntityTest extends PHPUnit_Framework_TestCase
{

    private static function getCorrectClient() {
        $client = new \Voradius\Client('api-key');
        return new \Voradius\Entity\Product($client);
    }

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

    public function testUrlBuildId() {
        $product = self::getCorrectClient();

        $this->setExpectedException('\\Voradius\\Exceptions\\InvalidParameterException');
        $product->getById();
    }

    public function testUrlBuildEan() {
        $product = self::getCorrectClient();

        $this->setExpectedException('\\Voradius\\Exceptions\\InvalidParameterException');
        $product->getByEan();
    }

    public function testUrlBuildSearch() {
        $product = self::getCorrectClient();

        $this->setExpectedException('\\Voradius\\Exceptions\\ParameterNotAllowedException');
        $product->getSearch(['test' => 1]);
    }

}