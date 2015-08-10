<?php namespace Voradius\Exceptions;

class InvalidParameterException extends \Exception
{
    protected $message = 'Supplied parameter is invalid.';
}