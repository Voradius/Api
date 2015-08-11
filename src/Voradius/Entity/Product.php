<?php namespace Voradius\Entity;

use Voradius\ClientInterface;
use Voradius\Exceptions\InvalidParameterException;
use Voradius\Exceptions\ParameterNotAllowedException;
use Voradius\Helpers\Url;

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
     * @var array
     */
    private $searchWhitelist = ['term', 'sort', 'order', 'category_id', 'lat', 'long', 'shop_id'];

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

        $response = $this->client->getConnection()->get(Url::build(self::PATH, $id));
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

        $response = $this->client->getConnection()->get(Url::build(self::PATH, '/ean/' . $ean));
        return $response->getBody()->getContents();
    }

    /**
     * @param array $params
     * @return mixed
     * @throws InvalidParameterException
     * @throws ParameterNotAllowedException
     */
    public function getSearch(array $params) {
        if(empty($params)) {
            throw new InvalidParameterException('Atleast one parameter is required. Choose from: ' . implode(', ', array_keys($this->searchWhitelist)));
        }

        foreach($params as $key => $value) {
            if(!in_array($key, $this->searchWhitelist)) {
                throw new ParameterNotAllowedException('Parameter "' . $key . '" not allowed');
            }
        }

        if(!array_key_exists('term', $params)) {
            throw new InvalidParameterException('Parameter "term" is required');
        }

        $response = $this->client->getConnection()->get(Url::build(self::PATH, 'search', $params));
        return $response->getBody()->getContents();
    }


}