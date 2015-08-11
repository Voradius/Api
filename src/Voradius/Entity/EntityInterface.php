<?php namespace Voradius\Entity;

use Voradius\ClientInterface;

interface EntityInterface
{

    public function __construct(ClientInterface $client);

}