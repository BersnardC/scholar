<?php

namespace Scholar;

trait Router
{
    private static $urls;

    public static function get($url, $class, $method)
    {
        self::$urls['get'][$url] = [
            'class' => $class,
            'method' => $method
        ];
    }

    public static function post($url, $class, $method)
    {
        self::$urls['post'][$url] = [
            'class' => $class,
            'method' => $method
        ];
    }

    public static function getUrls()
    {
        return self::$urls;
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function path()
    {
        $path = $_SERVER['PATH_INFO'] ?? '/';
        return $path;
    }
}
