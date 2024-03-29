<?php

namespace Scholar;

trait Router
{
    private static $urls;

    /**
     * Set a new GET Endpoint
     * @param string $url Url of endpoint
     * @param string $class Class for Controller
     * @param string $method Method to call
     * @return void
     */
    public static function get($url, $class, $method)
    {
        self::$urls['get'][$url] = [
            'class' => $class,
            'method' => $method
        ];
    }

    /**
     * Set a new POST Endpoint
     * @param string $url Url of endpoint
     * @param string $class Class for Controller
     * @param string $method Method to call
     * @return void
     */
    public static function post($url, $class, $method)
    {
        self::$urls['post'][$url] = [
            'class' => $class,
            'method' => $method
        ];
    }

    /**
     * Get urls avaliables
     * @return string|array
     */
    public static function getUrls()
    {
        return self::$urls;
    }

    /**
     * Get the method of request
     * @return string
     */
    public function method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Get the path info of request
     * @return string
     */
    public function path(): string
    {
        $path = $_SERVER['PATH_INFO'] ?? '/';
        return $path;
    }
}
