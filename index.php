<?php
require 'vendor/autoload.php';

/** @var AltoRouter */
$router = new AltoRouter();
// map homepage
$router->map( 'GET', '/', function() {require 'home.php';}, 'home');
// map categoriespage
$router->map( 'GET', '/categories/', function() {require 'posts.php';}, 'categories');
$router->map( 'GET', '/articles/[i:id]/', function() {require 'posts.php';});

$match = $router->match();
if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}