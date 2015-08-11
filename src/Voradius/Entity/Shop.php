<?php namespace Voradius\Entity;
use Voradius\ClientInterface;
use Voradius\Exceptions\InvalidParameterException;
use Voradius\Exceptions\ParameterNotAllowedException;
use Voradius\Helpers\Url;

/**
 * Class Shop
 * @package Voradius\Entity
 */
class Shop extends AbstractEntity implements EntityInterface
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
     * @var array
     */
    private $searchWhitelist = [ 'phone', 'name', 'street', 'zipcode', 'page', 'location', 'category', 'range' ];

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
        $this->noNullParameters($category_id, $location);

        $response = $this->client->getConnection()->get(Url::build(self::PATH, 'search', [
            'category' => $category_id,
            'location' => $location,
            'range' => 2,
            'size' => 200,
            'scout' => 1 ]));
        return $response->getBody()->getContents();
    }

    /**
     * @param array $params
     * @return mixed
     * @throws InvalidParameterException
     * @throws ParameterNotAllowedException
     */
    public function getSearch(array $params) {
        if (empty($params)) {
            throw new InvalidParameterException('Atleast one parameter is required. Choose from: ' . array_keys($this->searchWhitelist));
        }

        foreach ($params as $key => $value) {
            if (!in_array($key, $this->searchWhitelist)) {
                throw new ParameterNotAllowedException('Parameter "' . $key . '" not allowed');
            }
        }

        $response = $this->client->getConnection()->get(Url::build(self::PATH, 'search', $params));
        return $response->getBody()->getContents();
    }

    /**
     * @param null $id
     * @return mixed
     * @throws InvalidParameterException
     */
    public function getById($id = null) {
        $this->noNullParameters($id);

        $response = $this->client->getConnection()->get(Url::build(self::PATH, $id));
        return $response->getBody()->getContents();
    }

    /**
     * @param null $id
     * @return mixed
     * @throws InvalidParameterException
     */
    public function getByUniqueId($id = null) {
        $this->noNullParameters($id);

        $response = $this->client->getConnection()->get(Url::build(self::PATH, 'unique', [ 'id' => $id ]));
        return $response->getBody()->getContents();
    }
}