<?php

use myfrm\App;
use myfrm\Db;

$title = 'MY BLOG :: HOME';

$page = $_GET['page'] ?? 1;
$per_page = 2;
# поверне к-ть записів відповідно к-ть сторінок вирахуємо
$total = db()->query("SELECT COUNT(*) FROM posts")->getColumn();
$pagination = new \myfrm\Pagination((int)$page, $per_page, $total);

print_arr($pagination);
$start = $pagination->getStart();

# при виклику класу через echo, під капотом php шукає метод класу toString
# тому ми можемо видалити метод і створити в класі новий метод toString де і викличемо getHtml()
# таким чином залишається чистий запис echo $pagination; замість echo $pagination->getHtml();
echo $pagination;

die();
# тепер db() підтягує з функцій
$posts = db()->query("SELECT * FROM posts ORDER BY id DESC LIMIT $start, $per_page")->findAll();
// dd($posts);

# також можна викоикати базу через App
$db2 = App::get(Db::class);
$recent_posts = $db2->query("SELECT * FROM posts ORDER BY id DESC LIMIT 3")->findAll();
// dd($recent_posts[0]["id"]);

require_once VIEWS . "/posts/index.tpl.php";
