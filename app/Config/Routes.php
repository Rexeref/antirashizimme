<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Login;
use App\Controllers\Article;

/**
 * @var RouteCollection $routes
 */

// Account
$routes->post('register/check', [Login::class, 'register']);
$routes->get('register', [Login::class, 'registerForm']);
$routes->post('login/check', [Login::class, 'challengeResponse']);
$routes->get('login', [Login::class, 'index']);
$routes->get('logout', [Login::class, 'logout']);

// Article
$routes->get('/article/(:segment)', 'Article::single/$1');
$routes->get('search', [Article::class, 'search']);
$routes->get('/', [Article::class, 'listLast']);