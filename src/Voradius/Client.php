<?php
namespace Voradius;

use Voradius\Product;

class Client {
    const API_PATH = 'http://api.voradius.vagrant';

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
            'base_uri' => self::API_PATH,
            'headers' => ['X-API-KEY' => $api_key]
        ]);
    }

    public function connection() {
        return $this->_connection;
    }
}