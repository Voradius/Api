<?php namespace Voradius\Entity;

use Voradius\ClientInterface;
use Voradius\Exceptions\InvalidParameterException;

/**
 * Class Product
 * @package Voradius\Entity
 */
class Product implements EntityInterface
{

    /**
     *
     */
    const PATH = '/v2/products';

    /**
     * @var ClientInterface
     */
    var $client;

    /**
     * Product constructor.
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Find a product based on its ID
     *
     * @param int $id
     */
    public function getById($id = null) {
        if($id === null) {
            throw new InvalidParameterException('No ID supplied');
        }

        $response = $this->client->getConnection()->get(self::PATH . '/' . $id);
        return $response->getBody()->getContents();
    }

    /**
     * Find a product based on an EAN code
     *
     * @param string $ean
     */
    public function getByEan($ean = null) {
        if($ean === null) {
            throw new InvalidParameterException('No EAN supplied');
        }

        $response = $this->client->getConnection()->get(self::PATH . '/ean/' . $ean);
        return $response->getBody()->getContents();
    }


}