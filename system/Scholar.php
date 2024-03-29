<?php

namespace Scholar;


class Scholar
{
    use Router;


    /**
     * Core Class Method for MVC.
     */
    public function run()
    {
        $route_match = $this->match($this->method(), $this->path());
        if (!$route_match) {
            http_response_code(404);
            echo "404";
            exit;
        }
        $class = "App\\Controllers\\" . $route_match['class'];
        if (!class_exists($class)) {
            http_response_code(500);
            echo "500";
            exit;
        }
        $method = $route_match['method'];
        $class = new $class();
        if (method_exists($class, $method)) {
            $class->$method();
        } else {
            http_response_code(500);
            echo "Method not exist - 500";
            exit;
        }
        return;
    }

    /**
     * MVC match method and url.
     * @param string $method A method of request
     * @param string $url Path of url
     */
    private function match($method, $url)
    {
        foreach (self::$urls[$method] as $uri => $call) {
            if (substr($url, -1) === '/' && $uri != '/') {
                $url = substr($url, 0, -1);
            }
            if ($url == $uri) {
                return $call;
            }
        }
        return false;
    }
}
