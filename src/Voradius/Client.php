<?php
namespace Voradius;

use Voradius\Product;

class Client {
    const LIVE = 1;
    const LOCAL = 2;
    const SANDBOX = 3;
    const STAGING = 4;

    var $_api_key;
    var $_env;

    private $_connection = null;

    /**
     * ApiController constructor.
     */
    public function __construct($api_key = null, $env = self::LIVE)
    {
        if ($api_key == null) {
            echo ("** Supply your API key for access to the API **").PHP_EOL;
            die();
        }

        $this->_api_key = $api_key;
        $this->_env = $env;

        $this->connectAPI($api_key);
    }

    public function connection() {
        return $this->_connection;
    }

    public function connectAPI($api_key) {
        $this->_connection = new \GuzzleHttp\Client([
            'base_uri' => $this->getApiUrl(),
            'headers' => ['X-API-KEY' => $api_key]
        ]);
    }

    public function connectFrontend() {
        $this->_connection = new \GuzzleHttp\Client([
            'base_uri' => $this->getFrontendUrl(),
            'headers' => ['X-API-KEY' => $this->_api_key]
        ]);
    }

    private function getApiUrl() {
        switch ($this->_env) {
            case self::LOCAL:
                return 'http://api.voradius.vagrant';break;
            case self::STAGING:
                return 'http://staging.api.voradius.nl';break;
            case self::SANDBOX:
                return 'http://sandbox.api.voradius.nl';break;
            case self::LIVE:
                return 'http://api.voradius.nl';break;
        }
    }

    private function getFrontendUrl() {
        switch ($this->_env) {
            case self::LOCAL:
                return 'http://frontend.voradius.vagrant';break;
            case self::STAGING:
                return 'http://staging.voradius.nl';break;
            case self::SANDBOX:
                return 'http://sandbox.voradius.nl';break;
            case self::LIVE:
                return 'http://www.voradius.nl';break;
        }
    }
}