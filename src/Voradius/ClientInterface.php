<?php namespace Voradius;

interface ClientInterface
{

    function __construct($api_key = null, $env, $part);
    function getConnection();

}