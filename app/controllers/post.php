<?php


$id = (int) $_GET["id"] ?? 0;

# захист query від SQL інєкції
$post = $db->query("SELECT * FROM posts WHERE id = :id LIMIT 1", [":id" => $id])->findOrFail();

# захист query від SQL інєкції метод 2, 
# тут важливий порядок змінних в масиві, перший ? = першому знач. в масиві
// $post = $db->query("SELECT * FROM posts WHERE id = ? LIMIT 1", [$id])->findOrFail();
// dd($post);


$title = "MY BLOG :: {$post['title']}";
require_once VIEWS . "/post.tpl.php";
