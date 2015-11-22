<?php

class Middleware
{
	protected $guard = [];
	protected $guest = [];
	protected $custom = [];

	public function add($route, $type)
	{
		switch ($type) {
			case 'guard':
				$this->guard[] = $route;
				break;

			case 'guest':
				$this->guest[] = $route;
				break;

			default:
				if (is_callable($type))
					$this->custom[$route] = $type;
				break;
		}
	}

	public function guard($route)
	{
		if (in_array($route, $this->guard) and Auth::guest()) {
			abort(403);
			exit;
		}
	}

	public function guest($route)
	{
		if (in_array($route, $this->guest) and Auth::check()) {
			back();
			exit;
		}
	}

	public function csrf(Request $request)
	{
		if ($request->method() == 'POST') {
			if (!Token::check($request->token) or $request->token === null) {
				$request->clean();
				back();
				exit;
			}
		}
	}

	public function custom($route)
	{
		if (isset($this->custom[$route])) {
			call_user_func($this->custom[$route]);
		}
	}

	public function run($route)
	{
		$this->guard($route);
		$this->guest($route);
		$this->custom($route);
	}
}