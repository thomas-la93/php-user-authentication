<?php

session_start();
require __DIR__ . '/../init.php';

if(empty($_SERVER['PATH_INFO'])){
    header('Location: index.php/index');
}

$pathInfo = $_SERVER['PATH_INFO'];

$routes = [
    '/index' => [
        'controller' => 'postsController',
        'method' => 'index'
    ],
    '/post' => [
        'controller' => 'postsController',
        'method' => 'show'
    ],
    '/login' => [
        'controller' => 'loginController',
        'method' => 'login'
    ],
    '/logout' => [
        'controller' => 'loginController',
        'method' => 'logout'
    ],
    '/dashboard' => [
        'controller' => 'loginController',
        'method' => 'dashboard'
    ],
    '/posts-admin' => [
        'controller' => 'postAdminController',
        'method' => 'index'
    ],
    '/posts-edit' => [
        'controller' => 'postAdminController',
        'method' => 'show'
    ],
    '/posts-delete' => [
        'controller' => 'postAdminController',
        'method' => 'deletePost'
    ],
    '/posts-new' => [
        'controller' => 'postAdminController',
        'method' => 'create'
    ]
];

if(isset($routes[$pathInfo])){
    $route = $routes[$pathInfo];
    $postsController = $container->make($route['controller']);
    $method = $route['method'];
    $postsController->{$method}();
}