<?php

$title = 'My Blog :: Register';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $data = load(['name', 'email', 'password']);
  $validator = new \myfrm\Validator();

  if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
    $data['avatar'] = $_FILES['avatar'];
  } else {
    $data['avatar'] = [];
  }

  $form_rules = [
    'name' => ['required' => true, 'min' => 3, 'max' => 100,],
    'email' => ['email' => true, 'max' => 100, 'unique' => 'users:email'],
    'password' => ['required' => true, 'min' => 6,],
    'avatar' => [
//      'required'=>true, optional
      'ext' => 'png|jpg|gif',
    'size' => 1_048_576, // 1mb in bytes 1024 * 1024
    ],
  ];

  $validation = $validator->validate($data, $form_rules);

  dd($validation->getErrors());

  if (!$validation->hasErrors()) {
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    if (db()->query("INSERT INTO users (`name`,`email`,`password`) VALUES (:name,:email,:password)", $data)) {
      $_SESSION['success'] = "User has been registered";
    } else {
      $_SESSION['error'] = "DB ERROR";
    }
    redirect('/');
  }
}

require_once VIEWS . '/users/register.tpl.php';
