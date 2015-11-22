<?php

class Validator
{
	protected $errors = [];

	public function checkData(array $data, array $rules)
	{
		$passed = true;

		foreach ($rules as $key => $value) {
			$rules = explode('|', $value);
			$param = null;
			foreach ($rules as $rule) {
				if (strpos($rule, ':')) {
					list($rule, $param) = explode(':', $rule);
				}

				$method = 'check' . ucfirst($rule);
				$input = isset($data[$key]) ? $data[$key] : null;

				if (method_exists($this, $method)) {
					$this->$method($key, $input, $param) or $passed = false;
				} else {
					$this->addErrors("method $method not exists");
					$passed = false;
				}
			}
		}
		return $passed;
	}

	protected function checkRequired($key, $input)
	{
		if ($input == '' or $input == null) {
			$this->addErrors("$key is required");
			return false;
		}
		return true;
	}

	protected function checkEmail($key, $input)
	{
		if ($input != '' or $input != null) {
			if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
				$this->addErrors("$key is invalid");
				return false;
			}
			return true;
		}
		return false;
	}

	public function checkNum($key, $input)
	{
		if ($input != '' or $input != null) {
			if (!is_numeric($input)) {
				$this->addErrors("$key must be numberic");
				return false;
			}
			return true;
		}
	}

	protected function checkMin($key, $input, $param)
	{
		if ($input != '' or $input != null) {
			if (strlen($input) < $param) {
				$this->addErrors("$key must not be less than $param");
				return false;
			}
			return true;
		}
		return false;
	}

	protected function checkMax($key, $input, $param)
	{
		if ($input != '' or $input != null) {
			if (strlen($input) > $param) {
				$this->addErrors("$key must not be more than $param");
				return false;
			}
			return true;
		}
		return false;
	}

	protected function checkUnique($key, $input, $param)
	{
		if ($input != '' or $input != null) {
			if (table($param)->exists($key, $input)) {
				$this->addErrors("$key $input exists");
				return false;
			}
			return true;
		}
		return false;
	}

	public function addErrors($error)
	{
		$this->errors[] = $error;
	}

	public function getErrors()
	{
		return count($this->errors) ? $this->errors : null;
	}

	public function pass()
	{
		return empty($this->errors);
	}

	public function fail()
	{
		return !$this->pass();
	}

}