<?php
/**  @var $router */

// future methods from Router class
// Posts
$router->get("", "posts/index.php");
// single post /posts/{post} but we have light version
$router->get("posts", "posts/show.php");
// Create posts
$router->get("posts/create", "posts/create.php");
// save new post
$router->post("posts", "posts/store.php");
$router->delete("posts", "posts/destroy.php");

// $routes = [
//     "" => "index.php",
//     "about" => "about.php",
//     "post" => "post.php",
//     "posts/create" => "post-create.php",
// ];