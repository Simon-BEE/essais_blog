<?php
$basePath = dirname(__dir__) . DIRECTORY_SEPARATOR;
require_once $basePath . 'vendor/autoload.php';

$app = App\App::getInstance();
$app->setStartTime();
$app::load();

$app->getRouter($basePath)
->get('/', 'post#all', 'home')
        ->get('/categories', 'category#all', 'categories')
        ->get('/category/[*:slug]-[i:id]', 'category#show', 'category')
        ->get('/article/[*:slug]-[i:id]', 'post#show', 'post')
        ->get('/connection', 'connection/index', 'connection')
        ->post('/connection', 'connection/index', 'connection2')
        ->get('/connection/register', 'connection/index', 'register')
        ->post('/connection/register', 'connection/index', 'register2')
        ->get('/connection/password', 'connection/index', 'password')
        ->post('/connection/password', 'connection/index', 'password2')
        ->get('/profile', 'profile/index', 'profile')
        ->run();
