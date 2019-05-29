<?php
$basepath = dirname(__dir__). DIRECTORY_SEPARATOR;
require $basepath.'vendor/autoload.php';

$router = new App\Router($basepath.'views');
$router->get('/', 'index', 'index')
        ->get('/categories', 'categories', 'categories')
        ->get('/articles/[i:id]/', 'posts', 'posts')
        ->run();
