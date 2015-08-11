<?php namespace Voradius\Entity;

use Voradius\ClientInterface;
use Voradius\Exceptions\InvalidParameterException;
use Voradius\Helpers\Url;

/**
 * Class Stock
 * @package Voradius\Entity
 */
class Stock extends AbstractEntity implements EntityInterface
{

    /**
     *
     */
    const PATH = '/v2/stock';

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
     * @param null $product_id
     * @param null $shop_id
     * @return mixed
     * @throws InvalidParameterException
     */
    public function get($product_id = null, $shop_id = null) {
        $this->noNullParameters($product_id, $shop_id);

        $response = $this->client->getConnection()->get(Url::build(self::PATH, $product_id . '/' . $shop_id));
        return $response->getBody()->getContents();
    }
}