<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fillable = ['title', 'content', 'excerpt'];

    $data = load($fillable);

    $errors = [];
    if (empty($data["title"])) {
        $errors["title"] = "Title is requered";
    }
    if (empty($data["content"])) {
        $errors["content"] = "Content is requered";
    }
    if (empty($data["excerpt"])) {
        $errors["excerpt"] = "Excerpt is requered";
    }

    if (empty($errors)) {
        # іменовані поля ":title" дають можливість як параметр вставити масив $data
        $db->query(
            "INSERT INTO posts (`title`,`content`,`excerpt`) VALUES (:title,:content,:excerpt)",
            $data
        );
    }
}

$title = "MY BLOG :: New Post";
require_once VIEWS . "/post-create.tpl.php";
