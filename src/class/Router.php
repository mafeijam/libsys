<?php

class Router
{
	protected $routes = [];
	protected $middleware;
	protected $request;

	public function __construct(Middleware $middleware, Request $request)
	{
		$this->middleware = $middleware;
		$this->request = $request;
	}

	public function map($route, $callback, $middleware = null)
	{
		$this->routes[$route] = $callback;
		$this->middleware->add($route, $middleware);
		return $route;
	}

	public function group()
	{
		$routes = func_get_args();
		$prefix = array_shift($routes);
		$middleware = null;

		if (is_array($prefix)) {
			list($prefix, $middleware) = $prefix;
		}

		foreach ($routes as $route) {
			$group = $prefix.$route;
			$this->routes[$group] = $this->routes[$route];
			unset($this->routes[$route]);
			$this->middleware->add($group, $middleware);
		}
	}

	public function __destruct()
	{
		$uri = $this->request->uri();

		if (strpos($uri, APP))
			$uri = substr($uri, strlen(APP) + 8);

		foreach ($this->routes as $route => $callback) {
			$regex = '#^' . preg_replace('#:\w+#i', '([\w-]+)', $route) . '$#i';
			if (preg_match($regex, $uri, $args)) {
				$this->middleware->run($route);
				$this->middleware->csrf($this->request);
				array_shift($args);
				is_callable($callback) ? $this->callback($callback, $args) : $this->controller($callback, $args);
				return;
			}
		}
		return abort();
	}

	protected function callback($callback, $args)
	{
		$dependencies = DI::resolve($callback);
		return call_user_func_array($callback, array_merge($dependencies, $args));
	}

	protected function controller($callback, $args)
	{
		list($controller, $method) = explode('@', $callback);
		$obj = DI::resolve($controller);
		$dependencies = DI::resolve($controller, $method);
		return call_user_func_array([$obj, $method], array_merge($dependencies, $args));
	}

	public function info()
	{
		$info = [
			'route'      => array_keys($this->routes),
			'middleware' => $this->middleware
		];

		pr($info);
	}
}
