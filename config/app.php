<?php
define('APP_NAME', "MVC Framework");
define('APP_ROOT', dirname(dirname(__FILE__)));
require_once APP_ROOT . "\\env.php";

foreach ($envs as $env => $val) {
    putenv("$env=$val");
}