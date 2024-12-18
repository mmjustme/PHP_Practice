<?php

/**  @var \myfrm\Router $router */

const MIDDLEWARE = [
  'auth' => \myfrm\middlewares\Auth::class,
  'guest' => \myfrm\middlewares\Guest::class,
];

// Posts
$router->get('', 'posts/index.php');
$router->get('posts', 'posts/show.php');
$router->get('posts/create', 'posts/create.php')->only('auth');
$router->post('posts', 'posts/store.php');
$router->delete('posts', 'posts/destroy.php');

// Pages
$router->get('about', 'about.php');

// Users
# show form for register
//$router->get('register', 'users/register.php')->only('guest');
$router->add('register', 'users/register.php', ['get', 'post'])->only('guest');
# create user in db
//$router->post('register', 'users/store.php')->only('guest');
$router->add('login', 'users/login.php', ['get', 'post'])->only('guest');
$router->get('logout', 'users/logout.php')->only('auth');
