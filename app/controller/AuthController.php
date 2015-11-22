<?php

class AuthController
{
	public function login(Request $request, Validator $validator)
	{
		$request->postOnly();

		$rules = ['username' => 'required', 'password' => 'required'];
		$validator->checkData($request->all(), $rules);
		if ($validator->fail()) {
			Session::set('error', $validator->getErrors());
			return redirect();
		}

		if (Auth::login($request)) {
			return redirect();
		}

		Session::set('error', ['Wrong username or password']);
		return redirect();
	}

	public function logout()
	{
		session_destroy();
		return redirect();
	}
}