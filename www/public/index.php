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
        ->get('/user', 'user#index', 'user')
        ->post('/user', 'user#index', 'user_')
        ->get('/user/register', 'user#index', 'register')
        ->post('/user/register', 'user#index', 'register2')
        ->get('/profile', 'profile/index', 'profile')
        ->run();
