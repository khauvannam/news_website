<?php
session_start();

require_once "config.php";

spl_autoload_register(function ($class) {
    require "controllers/" . $class . ".php";
});

$baseDir = ROOT_URL;

$router = [
    'get' => [],
    'post' => [],
];

$path = substr($_SERVER['REQUEST_URI'], strlen($baseDir));
$arr = explode("?", $path);
$route = strtolower($arr[0]);
if (count($arr) >= 2) parse_str($arr[1], $params);
else $params = [];
$method = strtolower($_SERVER['REQUEST_METHOD']);
if (!array_key_exists($method, $router)) die("Phương thức không hợp lệ");
if (!array_key_exists($route, $router[$method])) die($_SERVER['REQUEST_URI']);
$action = $router[$method][$route];
call_user_func($action);
