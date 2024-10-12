<?php

/**  @var \myfrm\Router $router  */

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
$router->get('register', 'users/register.php')->only('guest');
$router->get('login', 'users/login.php')->only('guest');
$router->get('logout', 'users/logout.php');
