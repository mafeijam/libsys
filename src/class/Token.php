<?php

class Token
{
	public static function make()
	{
		Session::set('token', md5(uniqid()));
		return Session::get('token');
	}

	public static function check($token)
	{
		if (Session::has('token') and $token === Session::get('token')) {
			Session::delete('token');
			return true;
		}
		return false;
	}
}