<?php namespace Voradius\Entity;

use Voradius\ClientInterface;

/**
 * Class Reservation
 * @package Voradius\Entity
 */
class Reservation implements EntityInterface
{
    /**
     *
     */
    const PATH = '/v2/scout';

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
     * @param $first_name
     * @param $last_name
     * @param $email
     * @param $shop_id
     * @param $product_id
     * @param $phonenumber
     * @param null $product_request_id
     * @return bool
     */
    public function addReservation($first_name, $last_name, $email, $shop_id, $product_id, $phonenumber, $product_request_id = null)
    {
        $form_params = array(
            'firstname' => $first_name,
            'lastname' => $last_name,
            'email' => $email,
            'shop_id' => $shop_id,
            'product_id' => $product_id,
            'phone' => $phonenumber
        );

        $response = $this->client->getConnection()->post(
            '/product/iframe?shop_id='.$shop_id.'&product_id='.$product_id.'&product_request_id='.$product_request_id,
            ['body' => $form_params]
        );

        if ($response->getStatusCode() == 200) {
            return true;
        } else {
            return false;
        }
    }
}