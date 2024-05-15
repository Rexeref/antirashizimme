<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Login;
use App\Controllers\Article;
use App\Controllers\Videos;

/**
 * @var RouteCollection $routes
 */


// Video
$routes->get('videos/stream/(:any)', 'Videos::streamVideo/$1', ['filter' => 'cors']);
$routes->get('videos/meta/(:any)', 'Videos::metadata/$1', ['filter' => 'cors']);
$routes->get('videos/', [Videos::class, 'listAll'], ['filter' => 'cors']);

// Account
$routes->post('register/check', [Login::class, 'register']);
$routes->get('register', [Login::class, 'registerForm']);
$routes->post('login/check', [Login::class, 'challengeResponse']);
$routes->get('login', [Login::class, 'index']);
$routes->get('logout', [Login::class, 'logout']);

$routes->get('manager', [Article::class, 'listLast']);

// Article
$routes->post('/article/comment/(:segment)', 'Article::comment/$1');
$routes->get('/article/(:segment)', 'Article::single/$1');
$routes->get('search', [Article::class, 'search']);
$routes->get('/', [Article::class, 'listLast']);