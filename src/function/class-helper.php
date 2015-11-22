<?php

function app($name = null) {
	return isset($name) ? Container::instance()[$name] : Container::instance();
}

function config($file, $key = null) {
	return (strpos($file, '.php')) ? Config::file($file) : Config::read($file, $key);
}

function route($route = null, $callback = null, $middleware = null) {
	if (is_null($route))
		return app('router');
	return app('router')->map($route, $callback, $middleware);
}

function group() {
	$args = func_get_args();
	$prefix = array_shift($args);
	foreach ($args as $arg) {
		app('router')->group($prefix, $arg);
	}
}

function view($name, array $data = array(), $compile = true) {
	return app('view')->render($name, $data, $compile);
}

function view_static($name, array $data = array()) {
	return view($name, $data, false);
}

function abort($code = '404') {
	if ($code == '403') {
		session_destroy();
		header('HTTP/1.0 403 Forbidden');
	}
	view('error.' . $code);
	exit;
}

function db($setting = null) {
	return isset($setting) ? Database::instance($setting) : Database::instance();
}

function table($name) {
	return db()->table($name);
}

function relate($table, $id) {
	return table($table)->whereId($id)->first();
}

function form_token() {
	return '<input id="token" type="hidden" name="token" value="' . Token::make() . '">';
}

function input($key) {
	return Request::old($key);
}

function flash($key) {
	return Session::flash($key);
}