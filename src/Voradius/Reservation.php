<?php

namespace Voradius;

class Reservation
{
    const SUB_PATH = '/v2/scout';

    var $client = null;

    /**
     * Product constructor.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function addReservation($first_name, $last_name, $email, $shop_id, $product_id, $phonenumber, $product_request_id = null) {
        $form_params = array(
            'firstname' => $first_name,
            'lastname' => $last_name,
            'email' => $email,
            'shop_id' => $shop_id,
            'product_id' => $product_id,
            'phone' => $phonenumber
        );

        $this->client->connectFrontend();

        $response = $this->client->connection()->post(
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