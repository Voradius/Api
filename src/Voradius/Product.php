<?php

namespace Voradius;

class Product {
    const SUB_PATH = '/v2/products';

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
    public function getProductById($id = null) {
        if ($id == null) {
            die("Please provide a product ID".PHP_EOL);
        }

        $response = $this->client->connection()->get(self::SUB_PATH.'/'.$id);
        return $response->getBody()->getContents();
    }

    /**
     * Find a product based on an EAN code
     *
     * @param string $ean
     */
    public function getProductByEan($ean = null) {
        if ($ean == null) {
            die("Please provide a product EAN".PHP_EOL);
        }

        $response = $this->client->connection()->get(self::SUB_PATH.'/ean/'.$ean);
        return $response->getBody()->getContents();
    }


}