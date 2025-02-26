<?php

namespace Core;

use Core\Middleware\Middleware;
use Exception;

class Router
{
	protected static array $routes = [];

	/**
	 * Add a route to the router.
	 *
	 * @param string $method
	 * @param string $url
	 * @param mixed $controller
	 * @return Router
	 */
	protected static function add(string $method, string $url, mixed $controller): Router
	{
		self::$routes[] = [
			'method' => $method,
			'url' => $url,
			'controller' => $controller,
			'middleware' => null
		];

		return new static;
	}

	/**
	 * Define a GET route.
	 *
	 * @param string $url
	 * @param mixed $controller
	 * @return Router
	 */
	public static function get(string $url, mixed $controller): Router
	{
		return self::add('GET', $url, $controller);
	}

	/**
	 * Define a POST route.
	 *
	 * @param string $url
	 * @param mixed $controller
	 * @return Router
	 */
	public static function post(string $url, mixed $controller): Router
	{
		return self::add('POST', $url, $controller);
	}

	/**
	 * Define a PUT route.
	 *
	 * @param string $url
	 * @param mixed $controller
	 * @return Router
	 */
	public static function put(string $url, mixed $controller): Router
	{
		return self::add('PUT', $url, $controller);
	}

	/**
	 * Define a PATCH route.
	 *
	 * @param string $url
	 * @param mixed $controller
	 * @return Router
	 */
	public static function patch(string $url, mixed $controller): Router
	{
		return self::add('PATCH', $url, $controller);
	}

	/**
	 * Define a DELETE route.
	 *
	 * @param string $url
	 * @param mixed $controller
	 * @return Router
	 */
	public static function delete(string $url, mixed $controller): Router
	{
		return self::add('DELETE', $url, $controller);
	}

	/**
	 * Attach a middleware to the last added route.
	 *
	 * @param mixed $key
	 * @return Router
	 */
	public static function only(mixed $key): Router
	{
		self::$routes[array_key_last(self::$routes)]['middleware'] = $key;
		return new static;
	}

    /**
     * Dispatch the router and call the corresponding controller.
     *
     * @param mixed $uri
     * @param string $method
     * @return mixed
     * @throws Exception
     */
	public static function route(mixed $uri, string $method): mixed
    {
		foreach (self::$routes as $route) {
			if ($route['url'] === $uri && $route['method'] === strtoupper($method)) {
				Middleware::resolve($route['middleware']);

				return require base_path('app/Controllers/' . $route['controller']. '.php');
			}
		}

        self::abort(404, 'tu esi daunis');
        return null;
	}


	/**
	 * Get the previous URL.
	 *
	 * @return string
	 */
	public static function previousUrl(): string
	{
		return $_SERVER['HTTP_REFERER'] ?? '';
	}

	/**
	 * Abort the request with a specific HTTP status code.
	 *
	 * @param int $code
	 * @param string $message
	 * @return void
	 */
	public static function abort(int $code = 404, string $message = ''): void
	{
		http_response_code($code);
        view('404', compact('message'));
	}
}
