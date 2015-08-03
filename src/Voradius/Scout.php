<?php

namespace Voradius;

use GuzzleHttp\Exception\RequestException;

class Scout {
    const SUB_PATH = '/v2/scout';

    var $client = null;

    /**
     * Product constructor.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
     * Find a product based on its ID
     *
     * @param int $id
     */
    public function getShops($category_id = null, $location = 'Amsterdam') {
        if ($category_id == null) {
            die("Please provide a category ID".PHP_EOL);
        }

        $response = $this->client->connection()->get('/v2/shops/search?category='.$category_id.'&location='.htmlentities($location).'&range=5&size=200&scout=1');
        return $response->getBody()->getContents();
    }

    /**
     * Create a new scout request
     *
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $location
     * @param int $product_id
     * @return int
     */
    public function addRequest($first_name, $last_name, $email, $location, $product_id) {
        $form_params = array(
            'firstname' => $first_name,
            'lastname' => $last_name,
            'email' => $email,
            'location' => $location,
            'product_id' => $product_id
        );

        $this->client->connectFrontend();

        $response = $this->client->connection()->post(
            '/product-request/create',
            ['body' => $form_params]
        );
        
        if ($response->getStatusCode() == 200) {
            $body = json_decode($response->getBody()->getContents());
            return (int) $body->id;
        } else {
            return false;
        }
    }

    /**
     * Get request info
     *
     * @param int $id Request ID
     * @return string JSON response
     */
    public function getRequest($id = null) {
        if ($id == null) {
            die("Please provide a request ID".PHP_EOL);
        }

        $response = $this->client->connection()->get(self::SUB_PATH.'/'.$id);
        return $response->getBody()->getContents();
    }

    /**
     * Get the shops IDS and there responses to the requests
     *
     * @param int $id Request ID
     * @return string JSON response of request details
     */
    public function getRequestDetail($id = null) {
        if ($id == null) {
            die("Please provide a request ID".PHP_EOL);
        }

        $response = $this->client->connection()->get(self::SUB_PATH.'/'.$id.'/detail');
        return $response->getBody()->getContents();
    }
}