<?php

namespace App\Core;

class Router
{

    private $uri;
    private const CONTROLLERS_PATH = 'App\\Controllers\\';

    private $controller = self::CONTROLLERS_PATH . 'HomeController';
    private $method = 'index';
    private $params = [];

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];

        $this->makeRoute();
    }

    public function makeRoute()
    {
        $uri = $this->uri;

        $uri = strtolower($uri);
        $uri = trim($uri, ' /');
        $uri = preg_split('/[\/\?&]/', $uri);
        // URI: [0] - controller, [1] - method, [2] - get params (foo=bar&baz=tmp...)

        // controller
        if (!empty($uri[0])) {
            $controller = self::CONTROLLERS_PATH . ucfirst($uri[0]) . 'Controller';

            if (class_exists($controller)) {
                $this->controller = new $controller;
            } else {
                abort("class <code>$controller</code> not found");
            }
        }

        $class = new $this->controller;

        // method
        if (isset($uri[1])) {

            $method = $uri[1];

            if (method_exists($class, $method)) {
                $this->method = $method;
            } else {
                abort("method <code>$method</code> not exists");
            }

        } else {
            abort("method is required");
        }

        // parameters for the method
        if (isset($uri[2])) {
            $this->params = array_slice($uri, 2);
        }

        call_user_func_array([$class, $this->method], $this->params);
    }

}