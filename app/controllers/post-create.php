<?php
use myfrm\Validator;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fillable = ['title', 'content', 'excerpt'];

    $data = load($fillable);
    $form_rules = [
        'title' => ['required' => true, 'min' => 3, 'max' => 250,],
        'excerpt' => ['required' => true, 'min' => 5, 'max' => 250,],
        'content' => ['required' => true, 'min' => 10,]
    ];
    // Validation

    $validator = new Validator();
    $validtion = $validator->validate($data, $form_rules);

    // var_dump($validator->hasErrors());
    // var_dump($validator->getErrors());
    if ($validtion->hasErrors()) {
        print_arr($validtion->getErrors());
    } else {
        echo "SUCCESS";
    }
    die();


    // if (empty($data["title"])) {
    //     $errors["title"] = "Title is requered";
    // }
    // if (empty($data["content"])) {
    //     $errors["content"] = "Content is requered";
    // }
    // if (empty($data["excerpt"])) {
    //     $errors["excerpt"] = "Excerpt is requered";
    // }

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
