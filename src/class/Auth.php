<?php

class Auth
{
	public static function check()
	{
		return Session::has('login');
	}

	public static function guest()
	{
		return !static::check();
	}

	public static function user()
	{
		return table('users')->whereId(Session::get('user_id'))->first();
	}

	public static function login(Request $request)
	{
		$user = table('users')->whereUsername($request->username)->first();
		if (count($user) and $user->password == $request->password) {
			Session::set('user_id', $user->id);
			Session::set('login', true);
			return true;
		}
		return false;
	}
}