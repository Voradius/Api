<?php

class HelperTest extends PHPUnit_Framework_TestCase
{

    public function testUrlBuild() {
        $url = \Voradius\Helpers\Url::build('v2/products', 'search', ['location' => 'Amsterdam', 'size' => 50]);
        $this->assertEquals('v2/products/search?location=Amsterdam&size=50', $url);

        $url = \Voradius\Helpers\Url::build('v2/products/', 'search', ['location' => 'Amsterdam', 'size' => 50]);
        $this->assertEquals('v2/products/search?location=Amsterdam&size=50', $url);

        $url = \Voradius\Helpers\Url::build('v2/products', '/search', ['location' => 'Amsterdam', 'size' => 50]);
        $this->assertEquals('v2/products/search?location=Amsterdam&size=50', $url);

        $url = \Voradius\Helpers\Url::build('v2/products', '', ['location' => 'Amsterdam', 'size' => 50]);
        $this->assertEquals('v2/products?location=Amsterdam&size=50', $url);

        $url = \Voradius\Helpers\Url::build('v2/products', 'search');
        $this->assertEquals('v2/products/search', $url);
    }

}