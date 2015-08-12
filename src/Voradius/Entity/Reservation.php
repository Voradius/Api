<?php namespace Voradius\Entity;

use Voradius\ClientInterface;
use Voradius\Helpers\Url;

/**
 * Class Reservation
 * @package Voradius\Entity
 */
class Reservation extends AbstractEntity implements EntityInterface
{
    /**
     *
     */
    const PATH = '/v2/scout';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var array
     */
    private $searchWhitelist = [
        'firstname',
        'lastname',
        'email',
        'shop_id',
        'product_id',
        'phone',
        'street_name',
        'street_number',
        'zipcode',
        'city',
        'delivery_type'
    ];

    /**
     * Product constructor.
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param array $params
     * @param null $product_request_id
     * @return bool
     * @throws \Voradius\Exceptions\InvalidParameterException
     * @throws \Voradius\Exceptions\ParameterNotAllowedException
     */
    public function addReservation(array $params, $product_request_id = null)
    {
        $this->noNullParameters((isset($params['shop_id']) ?: null), (isset($params['product_id']) ?: null));
        $this->notWhitelistedParameters($params, $this->searchWhitelist);

        $response = $this->client->getConnection()->post(
            Url::build('/product/iframe', '', [
                'shop_id' => $params['shop_id'],
                'product_id' => $params['product_id'],
                'product_request_id' => $product_request_id ]),
            [ 'body' => $params ]
        );

        if ($response->getStatusCode() === 200) {
            return true;
        }

        return false;
    }
}