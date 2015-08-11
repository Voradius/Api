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
    public static function build($base, $path = '', array $params = array()) {
        // Add path to base (with leading slash if missing)
        if(!empty($path)) {
            if (strpos($path, '/') !== 0 && substr($base, -1) !== '/') {
                $base .= '/';
            }

            $base .= $path;
        }

        // Add parameters
        if(!empty($params)) {
            $base .= '?' . http_build_query($params);
        }

        // Return URL
        return $base;
    }

}