<?php namespace Voradius\Exceptions;

class ParameterNotAllowedException extends \Exception
{
    protected $message = 'Supplied parameter is not allowed.';
}