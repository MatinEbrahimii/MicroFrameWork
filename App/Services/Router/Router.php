<?php

namespace App\Services\Router;

use App\Core\Request;
use App\Services\View\View;

class Router
{
    private static $routes;
    const baseController = "\\App\\Controllers\\";
    const baseMiddlewares = "\\App\\Middlewares\\";

    public static function start()
    {
        // echo "Router Starts!";
        // get all routes (load address book)
        $routes = self::get_all_routes();
        $current_uri = self::get_current_route();
        // var_dump($current_uri);
        // check if route exists
        if (self::route_exists($current_uri)) {
            $request = new Request();
            $allowed_methods = self::get_route_methods($current_uri);

            if (!$request->is_in($allowed_methods)) {
                header('HTTP/1.0 403 Forbidden');
                View::load('errors.403');
                // View::load('errors.403');
                die();
            }


            // check middleware
            if (self::has_middleware($current_uri)) {
                $middelewares = self::get_route_middlewares($current_uri);
                // var_dump($middelewares);
                foreach ($middelewares as $middeleware) {
                    $middlewareClass = self::baseMiddlewares . $middeleware;
                    if (!class_exists($middlewareClass)) {
                        echo "Error: Class '$middlewareClass' was not found!";
                        die();
                    }
                    $middlewareObj = new $middlewareClass;
                    $middlewareObj->handle($request);
                }
            }


            // call controller method
            $targetStr = self::get_route_target($current_uri);
            list($controller, $method) =  explode('@', $targetStr);
            $controller = self::baseController . $controller;
            if (!class_exists($controller)) {
                echo "Error: Class '$controller' was not found!";
                die();
            }
            $controllerObject = new $controller;
            if (!method_exists($controllerObject, $method)) {
                echo "Error: Method '$method' was not found in '$controller' !";
                die();
            }

            $controllerObject->$method($request);
        } else {
            header("HTTP/1.0 404 Not Found");
            View::load('errors.404');
            die();
        }

        // if route not exists : 404.php
        // get route target (Controller & Method)
        // create an object fromtarget Controller and call the method

    }

    public static function get_all_routes()
    {
        return include BASE_PATH . "routes/web.php";
    }

    public static function route_exists($route)
    {
        $routes = self::get_all_routes();
        return in_array($route, array_keys($routes));
    }

    public static function get_route_target($route)
    {
        $routes = self::get_all_routes();
        return $routes[$route]['target'];
    }

    public static function get_current_route()
    {
        $current_uri = str_replace(SUB_DIRECTORY, '', $_SERVER['REQUEST_URI']);
        return strtok($current_uri, '?');
    }

    public static function get_route_methods($route)
    {
        $routes = self::get_all_routes();
        $methods_str = $routes[$route]['method'];
        return explode('|', $methods_str);
    }

    public static function get_route_middlewares($route)
    {
        $routes = self::get_all_routes();
        $middelewareStr = GLOBAL_MIDDLEWARES . "|" . ($routes[$route]['middleware'] ?? '');
        return removeEmptyMembers(explode('|', $middelewareStr));
    }

    public static function has_middleware($route)
    {
        $routes = self::get_all_routes();
        return isset($routes[$route]['middleware']) or !empty(GLOBAL_MIDDLEWARES);
    }
}
