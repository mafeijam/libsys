<?php

class File
{
	public static function name($name)
	{
		return UPLOAD . $_FILES[$name]['name'];
	}

	public static function shortName($name)
	{
		return $_FILES[$name]['name'];
	}

	public static function __callStatic($method, $args)
	{
		return static::name($method);
	}

	public static function tmp($name)
	{
		return $_FILES[$name]['tmp_name'];
	}

	public static function delete($name)
	{
		unlink(UPLOAD . $name);
	}
}