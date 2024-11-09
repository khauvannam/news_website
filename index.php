<?php
session_start();

require_once "./config/global_config.php";

spl_autoload_register(function ($class) {
    require "controllers/" . $class . ".php";
});

$baseDir = ROOT_URL;

$router = [
    'get' => [
        '' => [new homeController, 'index'],
        'category' => [new categoryController, 'index'],
        'category_create' => [new categoryController, 'add'],
        'category_edit' => [new categoryController, 'edit'],
        'category_delete' => [new categoryController, 'delete'],
        'article_create' => [new articleController, 'create'],
    ],
    'post' => [
        'category_create_' => [new categoryController, 'add_'],
        'category_edit_' => [new categoryController, 'edit_'],
    ],
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
