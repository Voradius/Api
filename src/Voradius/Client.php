<?php namespace Voradius;

use Voradius\Exceptions\InvalidParameterException;
use Voradius\Exceptions\ParameterNotAllowedException;

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
     * @var \GuzzleHttp\Client
     */
    private $_connection;

    /**
     * Client to use in several entities
     *
     * @param null $api_key
     * @param int $env
     */
    public function __construct($api_key = null, $env = self::LIVE, $part = self::PART_API)
    {
        if ($api_key === null) {
            throw new InvalidParameterException('API Key cannot be null');
        }

        if (!in_array($env, [ self::LOCAL, self::LIVE, self::SANDBOX, self::STAGING ])) {
            throw new ParameterNotAllowedException('Unknown environment');
        }

        if (!in_array($part, [ self::PART_API, self::PART_FRONTEND ])) {
            throw new ParameterNotAllowedException('Unknown part');
        }

        $this->setApiKey($api_key);
        $this->setEnv($env);

        $this->_connection = ClientFactory::newInstance($this->getUrl($this->getEnv(), $part), $this->getApiKey());
    }

    /**
     * @return string
     */
    private function getUrl($env, $part)
    {
        $urls = [
            self::LOCAL => [
                self::PART_FRONTEND => 'http://frontend.voradius.vagrant',
                self::PART_API => 'http://api.voradius.vagrant'
            ],
            self::STAGING => [
                self::PART_FRONTEND => 'http://staging.voradius.nl',
                self::PART_API => 'http://staging.api.voradius.nl'
            ],
            self::SANDBOX => [
                self::PART_FRONTEND => 'http://sandbox.voradius.nl',
                self::PART_API => 'http://sandbox.api.voradius.nl'
            ],
            self::LIVE => [
                self::PART_FRONTEND => 'http://www.voradius.nl',
                self::PART_API => 'http://api.voradius.nl'
            ]
        ];

        return $urls[ $env ][ $part ];
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