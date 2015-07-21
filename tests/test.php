<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use Voradius\Client;
use Voradius\Product;

if (!isset($argv[1])) {
    die('Supply test api key'.PHP_EOL);
}
/*
$productApi = new Product(new Client($argv[1]));
$product = $productApi->getProductById(2390330);

echo PHP_EOL.PHP_EOL;

$productApi = new Product(new Client($argv[1]));
$product = $productApi->getProductByEan('8806086157100');

echo PHP_EOL.PHP_EOL;

$scoutApi = new \Voradius\Scout(new Client($argv[1]));
print_r($scoutApi->getShops('35.120.750')->getContents());
*/

$scoutApi = new \Voradius\Shop(new Client($argv[1]));
print_r($scoutApi->getShopById(1)->getContents());
