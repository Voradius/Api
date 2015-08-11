<?php namespace Voradius\Helpers;

/**
 * Class Url
 * @package Voradius\Helpers
 */
class Url
{

    /**
     * @param $base
     * @param string $path
     * @param array $params
     * @return string
     */
    public static function build($base, $path = '', array $params = array())
    {
        // Add path to base (with leading slash if missing)
        if (!empty($path)) {
            if (!self::hasTrailingSlash($base)) {
                self::addTrailingSlash($base);
            }

            $base .= self::stripLeadingSlash($path);
        }

        // Add parameters
        $base .= self::createUriParameters($params);

        // Return URL
        return $base;
    }

    /**
     * @param $str
     * @return bool
     */
    private static function addTrailingSlash(&$str)
    {
        $str .= '/';
        return true;
    }

    /**
     * @param array $params
     * @return string
     */
    private static function createUriParameters(array $params)
    {
        if (!empty($params)) {
            return '?' . http_build_query($params);
        }

        return '';
    }

    /**
     * @param $str
     * @return bool
     */
    private static function hasTrailingSlash($str)
    {
        if (substr($str, -1) !== '/') {
            return false;
        }

        return true;
    }

    /**
     * @param $str
     * @return string
     */
    private static function stripLeadingSlash($str)
    {
        if (substr($str, 0, 1) === '/') {
            return substr($str, 1);
        }

        return $str;
    }

}