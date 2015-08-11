<?php namespace Voradius\Entity;

use Voradius\ClientInterface;
use Voradius\Exceptions\InvalidParameterException;
use Voradius\Helpers\Url;

/**
 * Class ProductCategory
 * @package Voradius\Entity
 */
class ProductCategory extends AbstractEntity implements EntityInterface
{

    /**
     *
     */
    const PATH = '/v2/products';

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

    public function getByProductId($id = null) {
        if($id == null) {
            throw new InvalidParameterException('No product ID supplied');
        }

        $response = $this->client->getConnection()->get(Url::build(self::PATH, '/categories/' . $id));
        return $response->getBody()->getContents();
    }

}