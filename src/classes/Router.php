<?php

declare(strict_types=1);

namespace App;

class Router
{
    private array $routes = [];
    private string $notFoundHandler = '';

    public function get(string $path, string $controller, string $method): void
    {
        $this->addRoute('GET', $path, $controller, $method);
    }

    public function post(string $path, string $controller, string $method): void
    {
        $this->addRoute('POST', $path, $controller, $method);
    }

    public function setNotFoundHandler(string $controller, string $method): void
    {
        $this->notFoundHandler = $controller . '@' . $method;
    }

    public function dispatch(string $requestUri, string $requestMethod): void
    {
        // Remove query string from URI
        $uri = strtok($requestUri, '?');

        // Remove trailing slash
        $uri = rtrim($uri, '/');
        if (empty($uri)) {
            $uri = '/';
        }

        foreach ($this->routes as $route) {
            if ($route['http_method'] !== $requestMethod) {
                continue;
            }

            $pattern = $this->convertToRegex($route['path']);

            if (preg_match($pattern, $uri, $matches)) {
                // Remove full match
                array_shift($matches);

                $this->callController($route['controller'], $route['method'], $matches);

                return;
            }
        }

        // No route found
        if (!empty($this->notFoundHandler)) {
            [$controller, $method] = explode('@', $this->notFoundHandler);
            $this->callController($controller, $method, []);
        } else {
            http_response_code(404);
            echo '404 - Seite nicht gefunden';
        }
    }

    private function addRoute(string $httpMethod, string $path, string $controller, string $method): void
    {
        $this->routes[] = [
            'http_method' => $httpMethod,
            'path' => $path,
            'controller' => $controller,
            'method' => $method,
        ];
    }

    private function convertToRegex(string $path): string
    {
        // Convert /article/{id} to regex pattern
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_-]+)', $path);

        return '#^' . $pattern . '$#';
    }

    private function callController(string $controllerClass, string $method, array $params): void
    {
        if (!class_exists($controllerClass)) {
            throw new \Exception("Controller {$controllerClass} nicht gefunden");
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $method)) {
            throw new \Exception("Methode {$method} in Controller {$controllerClass} nicht gefunden");
        }

        call_user_func_array([$controller, $method], $params);
    }
}
