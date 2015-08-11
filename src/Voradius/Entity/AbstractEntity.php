<?php namespace Voradius\Entity;

use Voradius\Exceptions\InvalidParameterException;

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

}