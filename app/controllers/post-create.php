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
    if (!$validtion->hasErrors()) {
        if (
            $db->query(
                "INSERT INTO posts (`title`,`content`,`excerpt`) VALUES (:title,:content,:excerpt)",
                $data
            )
        ) {
            $_SESSION['success'] = "OK";
        } else {
            $_SESSION['error'] = "DB ERROR";
        }
    }

}

$title = "MY BLOG :: New Post";
require_once VIEWS . "/post-create.tpl.php";
