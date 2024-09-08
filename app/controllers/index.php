<?php

$title = 'MY BLOG :: HOME';

# створили прошарок між данними. Тобто раніше $db->query(..) повертав об'єкт класу PDO 
# в якого є методи типу fetchAll(). Переробивши метод query(), повертаємо  вже наш клас Db.
# В класі новий метод findAll(). А це озн., що ми можемо його викликати після query().
# PDO об'єкт попередньо зберегли в нашу властивість stmt класу Db

# Даний прошарок дає можл додатково змінити дані
$posts = $db->query("SELECT * FROM posts ORDER BY id DESC")->findAll();
// dd($posts);

$recent_posts = $db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 3")->findAll();
// dd($recent_posts[0]["id"]);

require_once VIEWS . "/index.tpl.php";
