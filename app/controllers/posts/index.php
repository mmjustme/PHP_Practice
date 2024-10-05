<?php

use myfrm\App;
use myfrm\Db;

$title = 'MY BLOG :: HOME';

# тепер db() підтягує з функцій
$posts = db()->query("SELECT * FROM posts ORDER BY id DESC")->findAll();
// dd($posts);

# також можна викоикати базу через App
$db2 = App::get(Db::class); 
$recent_posts = $db2->query("SELECT * FROM posts ORDER BY id DESC LIMIT 3")->findAll();
// dd($recent_posts[0]["id"]);

require_once VIEWS . "/posts/index.tpl.php";
