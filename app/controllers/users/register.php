<?php

$title = 'My Blog :: Register';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $data = load(['name', 'email', 'password', 'avatar']);
  $validator = new \myfrm\Validator();
# data from form
  dump($_POST);
# data with files
  dump($_FILES);
# data after fn load with field avatar
  dd($data);

  $form_rules = [
    'name' => ['required' => true, 'min' => 3, 'max' => 100,],
    'email' => ['email' => true, 'max' => 100, 'unique' => 'users:email'],
    'password' => ['required' => true, 'min' => 6,]
  ];

  $validation = $validator->validate($data, $form_rules);

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
