<?php
namespace Voradius;

use Voradius\Product;

class Client {
    const API_PATH = 'http://api.voradius.nl';

    var $api_key = null;
    private $_connection = null;

    /**
     * ApiController constructor.
     */
    public function __construct($api_key = null)
    {
        if ($api_key == null) {
            echo ("** Supply your API key for access to the API **").PHP_EOL;
            die();
        }

        $this->api_key = $api_key;

        //Contruct guzzle connection
        $this->_connection = new \GuzzleHttp\Client([
            'base_uri' => 'http://api.voradius.nl',
            'headers' => ['X-API-KEY' => $api_key]
        ]);
    }

    public function connection() {
        return $this->_connection;
    }
}