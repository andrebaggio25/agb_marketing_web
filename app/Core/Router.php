<?php

declare(strict_types=1);

namespace App\Core;

final class Router
{
    /** @var array<string, array{0:string,1:string}> */
    private array $routes = [];

    public function get(string $pattern, string $handler): void
    {
        $this->routes['GET:' . $pattern] = $handler;
    }

    public function post(string $pattern, string $handler): void
    {
        $this->routes['POST:' . $pattern] = $handler;
    }

    public function dispatch(Request $req): void
    {
        $path = $req->path;
        if ($path !== '/' && str_ends_with($path, '/')) {
            $path = rtrim($path, '/') ?: '/';
        }

        foreach ($this->routes as $key => $handler) {
            [$method, $pattern] = explode(':', $key, 2);
            if ($method !== $req->method) {
                continue;
            }
            $params = $this->match($pattern, $path);
            if ($params !== null) {
                [$class, $action] = explode('@', $handler);
                $controller = new $class();
                $controller->$action($req, $params);
                return;
            }
        }
        http_response_code(404);
        echo View::render('site/errors/404', ['title' => 'Página não encontrada']);
        exit;
    }

    /**
     * @return array<string,string>|null
     */
    private function match(string $pattern, string $path): ?array
    {
        if ($pattern === $path) {
            return [];
        }
        $regex = preg_replace('#\{([a-zA-Z_]+)\}#', '(?P<$1>[^/]+)', $pattern);
        $regex = '#^' . $regex . '$#';
        if (!preg_match($regex, $path, $m)) {
            return null;
        }
        $params = [];
        foreach ($m as $k => $v) {
            if (is_string($k)) {
                $params[$k] = $v;
            }
        }
        return $params;
    }
}
