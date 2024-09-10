<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // dd($_POST);

    # список полів які мають бути в форміа
    $fillable = ['title', 'content', 'excerpt'];

    # фн перевірить дані юзера на наявність полів в масиві fillable і поверне лише дані з цих полів
    # тепер ми контролюємо з яких полів беремо дані з форми
    $data = load($fillable);
    // dd($data);
    // array(3) {
    //     ["title"]=>
    //     string(19) "Eos aut eum quisqua"
    //     ["excerpt"]=>
    //     string(20) "Quaerat ut minus ess"
    //     ["content"]=>
    //     string(19) "Enim aliquid illum "
    //   }

    // validation

    $errors = [];
    if (empty(trim($data["title"]))) {
        $errors["title"] = "Title is requered";
    }
    if (empty(trim($data["content"]))) {
        $errors["content"] = "Content is requered";
    }
    if (empty(trim($data["excerpt"]))) {
        $errors["excerpt"] = "Excerpt is requered";
    }
    // var_dump($errors);

    if (empty($errors)) {
        # `` дані кавички допомагають коли назва поля співпада із зарезервованим словом sql типу desc
        $db->query(
            "INSERT INTO posts (`title`,`content`,`excerpt`) VALUES (?,?,?)",
            [$_POST["title"], $_POST["content"], $_POST["excerpt"]]
        );
    }
}

$title = "MY BLOG :: New Post";
require_once VIEWS . "/post-create.tpl.php";
