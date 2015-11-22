<?php

class DI
{
	public static function resolve($class, $method = null)
	{
		if (is_callable($class)) {
			return static::resolveClosure($class);
		}

		if (class_exists($class)) {
			return isset($method) ?
				static::resolveMethod($class, $method) :
				static::resolveConstructor($class);
	    }

	    return false;
	}

	protected static function resolveConstructor($class)
	{
		$reflactor = new ReflectionClass($class);
		$constructor = $reflactor->getConstructor();
		if (is_null($constructor)) return new $class;

		$params = $constructor->getParameters();
		if (empty($params)) return new $class;

        return $reflactor->newInstanceArgs(static::dependencies($params));
	}

	protected static function resolveMethod($class, $method)
	{
		$reflactor = new ReflectionMethod($class, $method);
		return static::dependencies($reflactor->getParameters());
	}

	protected static function resolveClosure($callback)
	{
		$reflactor = new ReflectionFunction($callback);
		return static::dependencies($reflactor->getParameters());
	}

	protected static function dependencies($params)
	{
		$dependencies = [];
		foreach ($params as $param) {
			if ($class = $param->getClass()) {
				$dependencies[] = static::resolve($class->name);
			}
		}
		return $dependencies;
	}
}