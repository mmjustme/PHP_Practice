<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // dd($_POST);
    # `` дані кавички допомагають коли назва поля співпада із зарезервованим словом sql типу desc
    $db->query(
        "INSERT INTO posts (`title`,`content`,`excerpt`) VALUES (?,?,?)",
        [$_POST["title"], $_POST["content"], $_POST["excerpt"]]
    );
}

$title = "MY BLOG :: New Post";
require_once VIEWS . "/post-create.tpl.php";
