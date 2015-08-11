<?php namespace Voradius;

interface ClientInterface
{

    function __construct($api_key, $env, $part);
    function getConnection();

}