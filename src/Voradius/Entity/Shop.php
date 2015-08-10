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
     * Find a shop based on Category ID and optional Location
     *
     * @param null $category_id
     * @param string $location
     * @return mixed
     * @throws InvalidParameterException
     */
    public function getByCategoryId($category_id = null, $location = 'Amsterdam')
    {
        if($category_id === null) {
            throw new InvalidParameterException('Invalid category ID supplied');
        }

        $response = $this->client->getConnection()->get('/v2/shops/search?category='.$category_id.'&location='.htmlentities($location).'&range=2&size=200&scout=1');
        return $response->getBody()->getContents();
    }

    /**
     * @param null $id
     * @return mixed
     * @throws InvalidParameterException
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
     * @throws InvalidParameterException
     */
    public function getByUniqueId($id = null) {
        if ($id === null) {
            throw new InvalidParameterException('Invalid unique id given');
        }

        $response = $this->client->getConnection()->get(self::PATH . '/unique?id=' . $id);
        return $response->getBody()->getContents();
    }
}