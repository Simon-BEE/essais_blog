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
        ->get('/admin', 'admin\Admin#index', 'admin')
        ->get('/admin/posts', 'admin\Admin#posts', 'admin_posts')
        ->get('/admin/categories', 'admin\Admin#categories', 'admin_categories')
        ->get('/admin/users', 'admin\Admin#users', 'admin_users')
        ->get('/admin/posts/[*:slug]-[i:id]', 'admin\PostsEdit#postsEdit', 'admin_posts_edit')
        ->post('/admin/postUpdate', 'admin\PostsEdit#postUpdate', 'admin_post_update')
        ->post('/admin/postInsert', 'admin\PostsEdit#postInsert', 'admin_post_insert')
        ->get('/admin/category/[*:slug]-[i:id]', 'admin\CategoryEdit#categoryEdit', 'admin_category_edit')
        ->post('/admin/categoryUpdate', 'admin\CategoryEdit#categoryUpdate', 'admin_category_update')
        ->run();
