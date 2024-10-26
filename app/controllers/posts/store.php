<?php

use myfrm\Validator;


$fillable = ['title', 'content', 'excerpt'];

$data = load($fillable);
$form_rules = [
  'title' => ['required' => true, 'min' => 3, 'max' => 250,],
  'excerpt' => ['required' => true, 'min' => 5, 'max' => 250,],
  'content' => ['required' => true, 'min' => 10,]
];
// Validation

$validator = new Validator();
$validation = $validator->validate($data, $form_rules);

// var_dump($validator->hasErrors());
// var_dump($validator->getErrors());
if (!$validation->hasErrors()) {
  if (db()->query("INSERT INTO posts (`title`,`content`,`excerpt`) VALUES (:title,:content,:excerpt)", $data)) {
    $_SESSION['success'] = "OK";
  } else {
    $_SESSION['error'] = "DB ERROR";
  }
  header("Location: " . '/');
} else {
  require VIEWS . "/posts/create.tpl.php";
}


$title = "MY BLOG :: New Post";
require_once VIEWS . "/posts/create.tpl.php";
