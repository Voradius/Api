<?php

namespace Voradius;

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

        $response = $this->client->connection()->get('/v2/shops/search?category='.$category_id.'&location='.htmlentities($location).'&range=5&size=100&scout=1');
        return $response->getBody();
    }

}