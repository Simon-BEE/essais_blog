<?php
$basepath = dirname(__dir__). DIRECTORY_SEPARATOR;
require $basepath.'vendor/autoload.php';

$router = new App\Router($basepath.'views');
$router->get('/', 'index', 'home')
        ->get('/categories', 'categories', 'categories')
        ->get('/articles/[*-slug]-[i:id]/', 'post/post', 'post')
        ->run();
