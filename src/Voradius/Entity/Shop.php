<?php namespace Voradius\Entity;
use Voradius\ClientInterface;
use Voradius\Exceptions\InvalidParameterException;

/**
 * Class Shop
 * @package Voradius\Entity
 */
class Shop implements EntityInterface
{
    /**
     *
     */
    const PATH = '/v2/shops';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * Product constructor.
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param null $id
     * @return mixed
     */
    public function getById($id = null) {
        if ($id === null) {
            throw new InvalidParameterException('Invalid shop id given');
        }

        $response = $this->client->getConnection()->get(self::PATH . '/' . $id);
        return $response->getBody()->getContents();
    }

    /**
     * @param null $id
     * @return mixed
     */
    public function getByUniqueId($id = null) {
        if ($id === null) {
            throw new InvalidParameterException('Invalid unique id given');
        }

        $response = $this->client->getConnection()->get(self::PATH . '/unique/' . $id);
        return $response->getBody()->getContents();
    }
}