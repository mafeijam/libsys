<?php

class Session
{
	protected static $hidden = ['login'];

	public static function has($name)
	{
		return isset($_SESSION[$name]);
	}

	public static function hasAny()
	{
		return count(static::all());
	}

	public static function set($name, $value)
	{
		$_SESSION[$name] = $value;
	}

	public static function get($name)
	{
		if (static::has($name)) {
			return $_SESSION[$name];
		}
	}

	public static function delete($name)
	{
		if(static::has($name)) {
			unset($_SESSION[$name]);
		}
	}

	public static function flash($name)
	{
		$msg = static::get($name);
		static::delete($name);
		return $msg;
	}

	public static function flashAny()
	{
		$names = static::all();

		if (count($names)) {
			foreach ($names as $name) {
				pl(static::flash($name));
			}
		}
	}

	public static function all()
	{
		return array_diff(array_keys($_SESSION), static::$hidden);
	}

	public static function clean()
	{
		return session_destroy();
	}
}
