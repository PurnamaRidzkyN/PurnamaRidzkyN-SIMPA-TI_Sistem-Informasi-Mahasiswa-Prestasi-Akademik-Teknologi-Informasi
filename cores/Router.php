<?php

namespace app\cores;

use app\constant\HttpMethod;

class Router
{
    private static RouteNode $root;
    private static Request $request;
    private static Response $response;
    private static View $view;
    public static array $params = [];
    public function __construct()
    {
        new Session();
        self::$root = new RouteNode();
        self::$request = new Request();
        self::$response = new Response();
        self::$view = new View();
    }

    public static function get($path, $callback, $middlewares = []): void
    {
        self::addRoute($path, HttpMethod::GET, $callback, $middlewares);
    }

    public static function post($path, $callback, $middlewares = []): void
    {
        self::addRoute($path, HttpMethod::POST, $callback, $middlewares);
    }

    public static function run(): void
    {
        $path = trim(self::$request->getUrl(), "/");
        $method = self::$request->getMethod();

        $route = self::findRoute($path, $method);

        if (!$route || !is_array($route["handler"])) {
            self::$response->setStatusCode(404);
            self::$view->renderException("_404", "Not Found");
            return;
        }

        [$controllerClass, $handler] = $route["handler"];
        $controller = new $controllerClass();

        // Check if the controller class exists
        if (!class_exists($controllerClass)) {
            self::$response->setStatusCode(404);
            self::$view->renderException("_404", "Not Found");
            return;
        }

        // Check if the method exists in the controller
        if (!method_exists($controllerClass, $handler)) {
            self::$response->setStatusCode(404);
            self::$view->renderException("_404", "Not Found");
            return;
        }

        // call the middlewares
        foreach ($route["middlewares"] as $middleware) {
            $instance = new $middleware();
            $instance->before(self::$request, self::$response);
        }
        self::$params = $route["params"];

        call_user_func([$controller, $handler], self::$request, self::$response);
    }

    private static function addRoute(string $path, string $method, $callback, array $middlewares): void
    {
        $currentNode = self::$root;

        // filter out empty string
        $routeParts = array_filter(explode("/", $path), fn($value) => !empty($value));


        $dynamicParams = [];

        foreach ($routeParts as $segment) {
            // handle dynamic routes
            $isDynamic = $segment[0] === ":";
            $key = $isDynamic ? ":" : strtolower($segment);


            if ($isDynamic) {
                $dynamicParams[] = substr($segment, 1);
            }

            if (!isset($currentNode->children[$key])) {
                $currentNode->children[$key] = new RouteNode();
            }

            $currentNode = $currentNode->children[$key];
        }

        // Set the handler for this route and method
        $currentNode->handler[$method] = $callback;
        // Assign dynamic parameters to the current node
        $currentNode->params = $dynamicParams;
        // Assign middlewares to the current node
        $currentNode->middlewares = $middlewares;
    }

    private static function findRoute(string $path, string $method): ?array
    {
        $currentNode = self::$root;

        $segments = array_filter(explode("/", $path), function ($value) {
            return !empty($value);
        });

        $extractedParams = [];

        foreach ($segments as $segment) {
            $childNode = $currentNode->children[strtolower($segment)] ?? null;

            if ($childNode) {
                $currentNode = $childNode;
            } else if (($childNode = $currentNode->children[":"] ?? null)) {
                $extractedParams[] = $segment;
                $currentNode = $childNode;
            } else {
                return null;
            }
        }

        $params = [];

        for ($i = 0; $i < count($extractedParams); $i++) {
            $key = $currentNode->params[$i];
            $value = $extractedParams[$i];

            $params[$key] = $value;
        }

        return [
            "params" => $params,
            "handler" => $currentNode->handler[$method],
            "middlewares" => $currentNode->middlewares,
        ];
    }
}
