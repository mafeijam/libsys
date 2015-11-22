<?php

class Container implements ArrayAccess
{
	use Singleton;

	protected $container = [];
	protected $share = [];

	public function __construct()
	{
		$this->registerBaseServices();
	}

	public function register($name, $class, $share = false)
	{
		$share ? $this->singleton($name, $class) : $this->container[$name] = $class;
	}

	public function registerBaseServices()
	{
		$baseServices = [
			'router' => Router::class,
			'view' => Template::class,
		];

		foreach ($baseServices as $key => $value) {
			$this->register($key, $value, true);
		}
	}

	public function make($name)
	{
		if ($this->has($name)) {
			$service = $this->container[$name];
			if ($service instanceof Closure) {
				return $service($this);
			} elseif (is_object($service)) {
				return $service;
			}
			return DI::resolve($service);
		}
		return DI::resolve($name);
	}

	public function has($name)
	{
		return array_key_exists($name, $this->container);
	}

	public function remove($name)
	{
		unset($this->container[$name]);
	}

	public function singleton($name, $class)
	{
		$this->register($name, function($c) use ($class){
			static $obj;
			if (is_null($obj)) {
				$obj = is_string($class) ? DI::resolve($class) : $class($c);
			}
			return $obj;
		});
	}

	public function info()
	{
		pr($this->container);
	}

	public function __get($key)
	{
		return $this->make($key);
	}

	public function __set($key, $value)
	{
		return $this->register($key, $value);
	}

	public function __isset($key)
	{
		return $this->has($key);
	}

	public function __unset($key)
	{
		$this->remove($key);
	}

	/* array access */

	public function offsetExists($key)
	{
		return $this->has($key);
	}

	public function offsetSet($key, $value)
	{
		return $this->register($key, $value);
	}

	public function offsetGet($key)
	{
		return $this->make($key);
	}

	public function offsetUnset($key)
	{
		$this->remove($key);
	}
}