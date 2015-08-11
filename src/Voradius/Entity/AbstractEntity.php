<?php namespace Voradius\Entity;

use Voradius\Exceptions\InvalidParameterException;
use Voradius\Exceptions\ParameterNotAllowedException;

/**
 * Class AbstractEntity
 * @package Voradius\Entity
 */
class AbstractEntity
{

    /**
     * @return bool
     * @throws InvalidParameterException
     */
    protected function noNullParameters()
    {
        foreach (func_get_args() as $param => $arg)
        {
            if (is_null($arg))
            {
                throw new InvalidParameterException('Parameter ' . $param . " should be supplied");
            }
        }

        return true;
    }

    /**
     * @param array $parameters
     * @param array $whitelist
     * @return bool
     * @throws ParameterNotAllowedException
     */
    protected function notWhitelistedParameters(array $parameters, array $whitelist)
    {
        foreach ($parameters as $key => $value)
        {
            if (!in_array($key, $whitelist))
            {
                throw new ParameterNotAllowedException('Parameter "' . $key . '" not allowed');
            }
        }

        return true;
    }
}