<?php

trait Singleton
{
	protected static $singleton;

	public static function instance()
	{
		$args = func_get_args();
		$reflector = new ReflectionClass(static::class);

		if ($reflector->getConstructor()) {
			return static::instanceWithDependencies($args, $reflector);
		}

		isset(static::$singleton) ?: static::$singleton = $reflector->newInstanceArgs($args);

		return static::$singleton;
	}

	protected static function instanceWithDependencies($args, $reflector)
	{
		if (is_null(static::$singleton)) {
			$dependencies = [];
			foreach ($reflector->getConstructor()->getParameters() as $param) {
				if ($param->getClass()) {
					$dependencies[] = DI::resolve($param->getClass()->name);
				}
			}
			static::$singleton = $reflector->newInstanceArgs(array_merge($dependencies, $args));
		}
		return static::$singleton;
	}
}