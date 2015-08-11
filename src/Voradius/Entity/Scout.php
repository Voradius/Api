<?php namespace Voradius\Entity;

use Voradius\ClientInterface;
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
    private $replyWhitelist = ['in_assortment', 'in_stock', 'has_alternative', 'can_order', 'price', 'comment'];

    /**
     * @var array
     */
    private $requestWhitelist = ['firstname', 'lastname', 'email', 'location', 'product_id', 'unique_id', 'source', 'phonenumber'];

    /**
     * Product constructor.
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param array $params
     * @param string $source
     * @return bool|int
     * @throws \Voradius\Exceptions\ParameterNotAllowedException
     */
    public function addRequest(array $params, $source = 'website')
    {
        $params['source'] = $source;

        $this->notWhitelistedParameters($params, $this->requestWhitelist);

        $response = $this->client->getConnection()->post(
            Url::build('/product-request/create'),
            ['body' => $params]
        );

        if ($response->getStatusCode() === 200) {
            $body = json_decode($response->getBody()->getContents());
            return (int)$body->id;
        }

        return false;
    }

    /**
     * @param $id
     * @param $unique
     * @param array $params
     * @return bool
     * @throws \Voradius\Exceptions\InvalidParameterException
     * @throws \Voradius\Exceptions\ParameterNotAllowedException
     */
    public function retailerReply($id, $unique, array $params)
    {
        $this->noNullParameters($id, $unique);
        $this->notWhitelistedParameters($params, $this->replyWhitelist);

        if (empty($params)) {
            return false;
        }

        $response = $this->client->getConnection()->post(
            Url::build('/v2/productrequests/retailer-reply', $id . '/' . $unique),
            ['body' => json_encode($params)]
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
    public function getRequest($id = null)
    {
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
    public function getRequestDetail($id = null)
    {
        $this->noNullParameters($id);

        $response = $this->client->getConnection()->get(Url::build(self::PATH, $id . '/detail'));
        return $response->getBody()->getContents();
    }
}