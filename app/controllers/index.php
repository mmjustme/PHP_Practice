<?php

$title = 'MY BLOG :: HOME';

# методи fetchAll() і інші це методи класу PDO. оск $db повертає pdo
# ми створимо свої методи для цього db буде повертати клас db
$posts = $db->query("SELECT * FROM posts ORDER BY id DESC")->findAll();
dd($posts);

$recent_posts = $db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 3")->fetchAll();


require_once VIEWS . "/index.tpl.php";
