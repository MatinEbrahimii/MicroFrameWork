<?php
define('BASE_URL', 'http://php3.exp/22-mf/');

define('BASE_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('SUB_DIRECTORY', '/22-mf');

define('BASE_VIEW_PATH', BASE_PATH . 'views' . DIRECTORY_SEPARATOR);

define('IS_DEV_MODE', 1);
define('SANITIZE_ALL_DATA', 0);
define('GLOBAL_MIDDLEWARES', 'IEBlocker');
