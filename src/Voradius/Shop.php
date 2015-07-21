<?php

namespace Voradius;

class Shop
{
    const SUB_PATH = '/v2/shops';

    var $client = null;

    /**
     * Product constructor.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getShopById($id = null) {
        if ($id == null) {
            die("Please provide a shop ID".PHP_EOL);
        }

        $response = $this->client->connection()->get(self::SUB_PATH.'/'.$id);
        return $response->getBody()->getContents();
    }
}