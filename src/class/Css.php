<?php

Class Css
{
	public static function __callStatic($key, $class)
	{
		if (Session::has($key)) return $class[0];
	}
}