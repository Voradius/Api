<?php namespace Voradius\Entity;

use Voradius\ClientInterface;
use Voradius\Exceptions\InvalidParameterException;
use Voradius\Helpers\Url;

/**
 * Class Scout
 * @package Voradius\Entity
 */
class Scout extends AbstractEntity implements EntityInterface
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
    private $replyWhitelist = [ 'in_assortment', 'in_stock', 'has_alternative', 'can_order', 'price', 'comment' ];

    /**
     * Product constructor.
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Create a new scout request
     *
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $location
     * @param int $product_id
     * @param string $source
     * @return int
     */
    public function addRequest($first_name, $last_name, $email, $location, $product_id, $unique_id, $phonenumber, $source = 'website') {
        $form_params = array(
            'firstname' => $first_name,
            'lastname' => $last_name,
            'email' => $email,
            'location' => $location,
            'product_id' => $product_id,
            'unique_id' => $unique_id,
            'source' => $source,
            'phonenumber' => $phonenumber
        );

        $response = $this->client->getConnection()->post(
            Url::build('/product-request/create'),
            [ 'body' => $form_params ]
        );
        
        if ($response->getStatusCode() === 200) {
            $body = json_decode($response->getBody()->getContents());
            return (int) $body->id;
        }

        return false;
    }

    /**
     * @param $id
     * @param $unique
     * @param array $data
     * @return bool
     */
    public function retailerReply($id, $unique, array $params) {
        $this->noNullParameters($id, $unique);
        $this->notWhitelistedParameters($params, $this->replyWhitelist);

        if (empty($data)) {
            return false;
        }

        $response = $this->client->getConnection()->post(
            Url::build('/v2/productrequests/retailer-reply', $id . '/' . $unique),
            [ 'body' => json_encode($data) ]
        );

        if ($response->getStatusCode() === 200) {
            return true;
        }

        return false;
    }

    /**
     * Get request info
     *
     * @param int $id Request ID
     * @return string JSON response
     */
    public function getRequest($id = null) {
        $this->noNullParameters($id);

        $response = $this->client->getConnection()->get(Url::build(self::PATH, $id));
        return $response->getBody()->getContents();
    }

    /**
     * Get the shops IDS and there responses to the requests
     *
     * @param int $id Request ID
     * @return string JSON response of request details
     */
    public function getRequestDetail($id = null) {
        $this->noNullParameters($id);

        $response = $this->client->getConnection()->get(Url::build(self::PATH, $id . '/detail'));
        return $response->getBody()->getContents();
    }
}