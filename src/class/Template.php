<?php

class Template
{
	protected $path = VIEW_PATH;
	protected $layoutName;
	protected $layoutData;
	protected $shareData;
	protected $block;
	protected $append;
	protected $replace;
	protected $key;

	public function extend($layout, array $data = array())
	{
		$this->layoutName = $layout;
		$this->layoutData = $data;
	}

	protected function block($name)
	{
		echo isset($this->block[$name]) ? $this->block[$name] : null;
	}

	protected function start($name, $data = null)
	{
		if (isset($data)) {
			return $this->block[$name] = $data;
		}

		$this->key[] = $name;
		ob_start();
	}

	protected function end()
	{
		$key = array_shift($this->key);
		$this->block[$key] = ob_get_clean();
	}

	protected function append()
	{
		$key = array_shift($this->key);
		$this->append[$key] = ob_get_clean();
	}

	protected function replace()
	{
		$key = array_shift($this->key);
		$this->replace[$key] = ob_get_clean();
	}

	protected function show()
	{
		$key = array_shift($this->key);
		$this->block[$key] = ob_get_clean();

		if (isset($this->append[$key])) {
			echo $this->block[$key] . $this->append[$key];
		} elseif (isset($this->replace[$key])) {
			echo $this->replace[$key];
		} else {
			echo $this->block[$key];
		}
	}

	protected function get($file, $compile = true)
	{
		$file = str_replace('.', '/', $file);
		require $compile ? $this->compile($file) : $file . '.php';
	}

	protected function theme($file)
	{
		$theme = table('theme')->select('name')->first()->name;
		$this->get($theme . $file);
	}

	public function shareData(array $data)
	{
		$this->shareData = $data;
	}

	public function render($template, array $data = array(), $compile = true)
	{
		if (isset($this->shareData)) {
			extract($this->shareData);
		}

		extract($data);
		$template = str_replace('.', '/', $template);
		require $compile ? $this->compile($template) : $this->file($template);

		if ($this->layoutName) {
			extract($this->layoutData);
			$layout = str_replace('.', '/', $this->layoutName);
			require $compile ? $this->compile($layout) : $this->file($layout);
		}
		$this->reset();
	}

	protected function compile($template)
	{
		$patterns = config('pattern');

		$file = $this->path . $template . '.php';
		$compiledFile = COMPILED . $template . '_cp.php';

		$this->makeFolder($template);

		if (filemtime($file) > @filemtime($compiledFile)) {
			$contents = file_get_contents($file);
			$compiled = preg_replace(array_keys($patterns), array_values($patterns), $contents);
			file_put_contents($compiledFile, $compiled);
		}

		return $compiledFile;
	}

	protected function makeFolder($template)
	{
		if (strpos($template, '/')) {
			$folders = explode('/', $template);
			array_pop($folders);

			$base = COMPILED;

			foreach ($folders as $folder) {
				$base .= $folder . '/';
				is_dir($base) ? : mkdir($base);
			}
		}
	}

	protected function reset()
	{
		$this->layoutName = null;
		$this->layoutData = null;
	}

	protected function file($file)
	{
		return $this->path . $file . '.php';
	}
}