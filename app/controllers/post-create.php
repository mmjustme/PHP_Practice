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
        $db->query(
            "INSERT INTO posts (`title`,`content`,`excerpt`) VALUES (?,?,?)",
            [$_POST["title"], $_POST["content"], $_POST["excerpt"]]
        );
    }
}

$title = "MY BLOG :: New Post";
require_once VIEWS . "/post-create.tpl.php";
