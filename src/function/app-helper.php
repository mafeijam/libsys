<?php

function dd() {
	d(func_get_args());
	exit;
}

function d() {
	call_user_func_array('var_dump', func_get_args());
}

function pr($var) {
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}

function pl($var) {
	echo "<p>$var</p>";
}

function url($url = null) {
	return BASE_URL . $url;
}

function css($file) {
	return url('css') . '/' . $file . '.css';
}

function js($file) {
	return url('js') . '/' . $file . '.js';
}

function redirect($url = null) {
	header('location:' . BASE_URL . $url);
}

function back() {
	$last_location = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : false;

	if (!$last_location) {
		return header('location: javascript:history.back()');
	}

	header('location:' . ltrim($last_location));
}

function debug() {
	ob_start();
	debug_print_backtrace();
	$data = ob_get_clean();

	$debug = '<div class="debug">' . preg_replace(['~^#0.+~', '~(#[^0])~', '~\n$~'], ['', '<div>$1', '</div>'], $data) . '</div>';
	echo $debug;
}

function autoload_class() {
	spl_autoload_register(function($class){
		$folders = ['src/class/', 'src/trait/', 'app/controller/'];
		foreach ($folders as $folder) {
			$file = ROOT . $folder . $class . '.php';
			if (file_exists($file)) require $file;
		}
	});
}

function e($var) {
	return htmlspecialchars($var, ENT_QUOTES, 'utf-8');
}

function img($file) {
	echo '<img src="' . url('upload') . '/' . $file . '">';
}