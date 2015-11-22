<?php

require ROOT . 'app/config/setting.php';

require ROOT . 'src/function/app-helper.php';

autoload_class();

require ROOT . 'src/function/class-helper.php';

require ROOT . 'app/routes.php';

if (DEBUG) {
	error_reporting(E_ALL);
} else {
	error_reporting(0);
	ini_set('display_errors', 0);
}
