<?php

class ProductEntityTest extends PHPUnit_Framework_TestCase
{

    private static function getCorrectClient() {
        $client = new \Voradius\Client('api-key');
        return new \Voradius\Entity\Product($client);
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