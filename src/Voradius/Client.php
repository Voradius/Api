<?php namespace Voradius;

use Voradius\Exceptions\InvalidParameterException;
use Voradius\Exceptions\ParameterNotAllowedException;
use Voradius\Product;

class Client implements ClientInterface
{

    /**
     * Environments
     */
    const LIVE = 1;
    const LOCAL = 2;
    const SANDBOX = 3;
    const STAGING = 4;

    /**
     * Parts
     *
     * Defaults to API
     */
    const PART_API = 1;
    const PART_FRONTEND = 2;

    /**
     * @var null
     */
    private $_api_key;

    /**
     * @var int
     */
    private $_env;

    /**
     * @var null
     */
    private $_connection = null;

    /**
     * Client to use in several entities
     *
     * @param null $api_key
     * @param int $env
     */
    public function __construct($api_key = null, $env = self::LIVE, $part = self::PART_API)
    {
        if($api_key === null) {
            throw new InvalidParameterException('API Key cannot be null');
        }

        if(!in_array($env, [self::LOCAL, self::LIVE, self::SANDBOX, self::STAGING])) {
            throw new ParameterNotAllowedException('Unknown environment');
        }

        if(!in_array($part, [self::PART_API, self::PART_FRONTEND])) {
            throw new ParameterNotAllowedException('Unknown part');
        }

        $this->setApiKey($api_key);
        $this->setEnv($env);

        switch($part)
        {
            case 1:
                $this->_connection = ClientApiFactory::newInstance($this->getApiUrl(), $this->getApiKey());
                break;
            case 2:
                $this->_connection = ClientFrontendFactory::newInstance($this->getFrontendUrl(), $this->getApiKey());
                break;
        }
    }

    /**
     * @return string
     */
    private function getApiUrl() {
        switch ($this->_env) {
            case self::LOCAL:
                return 'http://api.voradius.vagrant';break;
            case self::STAGING:
                return 'http://staging.api.voradius.nl';break;
            case self::SANDBOX:
                return 'http://sandbox.api.voradius.nl';break;
            case self::LIVE:
            default:
                return 'http://api.voradius.nl';break;
        }
    }

    /**
     * @return string
     */
    private function getFrontendUrl() {
        switch ($this->_env) {
            case self::LOCAL:
                return 'http://frontend.voradius.vagrant';break;
            case self::STAGING:
                return 'http://staging.voradius.nl';break;
            case self::SANDBOX:
                return 'http://sandbox.voradius.nl';break;
            case self::LIVE:
            default:
                return 'http://www.voradius.nl';break;
        }
    }

    /**
     * @return null
     */
    public function getApiKey()
    {
        return $this->_api_key;
    }

    /**
     * @param null $api_key
     * @return Client
     */
    public function setApiKey($api_key)
    {
        $this->_api_key = $api_key;
        return $this;
    }

    /**
     * @return int
     */
    public function getEnv()
    {
        return $this->_env;
    }

    /**
     * @param int $env
     * @return Client
     */
    public function setEnv($env)
    {
        $this->_env = $env;
        return $this;
    }

    /**
     * @return null
     */
    public function getConnection()
    {
        return $this->_connection;
    }

    /**
     * @param null $connection
     * @return Client
     */
    public function setConnection($connection)
    {
        $this->_connection = $connection;
        return $this;
    }
}