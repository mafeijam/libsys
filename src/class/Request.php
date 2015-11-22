<?php

class Request
{
	protected $method;
	protected $uri;

	public function __construct()
	{
		foreach ($_POST as $key => $value) {
			Session::set($key, $value);
		}

		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->uri = $_SERVER['REQUEST_URI'];
	}

	public function postOnly()
	{
		if ($this->method != 'POST') {
			back();
			exit;
		}
	}

	public function method()
	{
		return $this->method;
	}

	public function uri()
	{
		return $this->uri;
	}

	public static function old($key)
	{
		return Session::flash($key);
	}

	public function all()
	{
		switch ($this->method) {
			case 'GET':
				return $_GET;
				break;
			case 'POST':
				return $_POST;
				break;
		}
	}

	public function get($key)
	{
		switch ($this->method) {
			case 'GET':
				return isset($_GET[$key]) ? $_GET[$key] : null;
				break;
			case 'POST':
				return isset($_POST[$key]) ? $_POST[$key] : null;
				break;
		}
	}

	public function has($key)
	{
		switch ($this->method) {
			case 'GET':
				return isset($_GET[$key]);
				break;
			case 'POST':
				return isset($_POST[$key]);
				break;
		}
	}

	public function any()
	{
		switch ($this->method) {
			case 'GET':
				return count($_GET);
				break;
			case 'POST':
				return count($_POST);
				break;
		}
	}

	public function forget($key) {
		switch ($this->method) {
			case 'GET':
				unset($_GET[$key]);
				break;
			case 'POST':
				unset($_POST[$key]);
				break;
		}
	}

	public function clean()
	{
		foreach ($_POST as $key => $value) {
			Session::delete($key);
		}
	}

	public function __get($key)
	{
		return $this->get($key);
	}
}