<?php namespace Voradius\Entity;

use Voradius\ClientInterface;
use Voradius\Exceptions\InvalidParameterException;

/**
 * Class ProductCategory
 * @package Voradius\Entity
 */
class ProductCategory {

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

    public function getByProductId($id = null) {
        if($id == null) {
            throw new InvalidParameterException('No product ID supplied');
        }

        $response = $this->client->getConnection()->get(self::PATH . '/categories/' . $id);
        return $response->getBody()->getContents();
    }

}