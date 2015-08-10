<?php

class ProductCategoryEntityTest extends PHPUnit_Framework_TestCase
{

    private static function getCorrectClient() {
        $client = new \Voradius\Client('api-key');
        return new \Voradius\Entity\ProductCategory($client);
    }

    public function testUrlBuildId() {
        $product = self::getCorrectClient();

        $this->setExpectedException('\\Voradius\\Exceptions\\InvalidParameterException');
        $product->getByProductId();
    }

}