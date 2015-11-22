<?php

class Config
{
	public $obj;

	protected static $config;

	public function __construct($file)
	{
		$file = static::parseFile($file);
		$this->obj = require $file;
	}

	public function __get($key)
	{
		return $this->obj[$key];
	}

	public static function file($customPath)
	{
		return require $customPath;
	}

	public static function read($file, $key = null)
	{
		$file = static::parseFile($file);

		static::$config = require $file;

		if (isset($key)) return static::get($key);

		return static::$config;
	}

	public static function get($key, $file = null)
	{
		if (isset($file)) static::read($file);

		if (!strpos($key, '.')) return static::$config[$key];

		$keys = explode('.', $key);
		$config = static::$config;
		foreach ($keys as $key) {
			if (isset($config[$key])) {
				$config = $config[$key];
			}
		}
		return $config;
	}

	public static function write($file, array $config)
	{
		$file = static::parseFile($file);
		$config = var_export($config, true);
		$config = preg_replace(['#array \(#', '#\)#'], ['[', ']'], $config);
		file_put_contents($file, "<?php\n\nreturn $config;");
	}

	protected static function parseFile($file)
	{
		return CONFIG_PATH . str_replace('.','/',$file) . '.php';
	}
}