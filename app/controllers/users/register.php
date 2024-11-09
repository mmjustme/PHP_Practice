<?php

$title = 'My Blog :: Register';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $data = load(['name', 'email', 'password']);
  $validator = new \myfrm\Validator();
# data from form
//  dump($_POST);
# data with files
//  dump($_FILES);


  # перевірка на файл, в масиві про файл наявне поле error
  # значення 4 - помилку, файл не завантажувався, 0 - завантажувався
  # тому первірка чи взагалі є файл і чи зі ствтусом 0
  if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
    # додаємо файл в дані з форми
    $data['avatar'] = $_FILES['avatar'];
  } else {
    $data['avatar'] = [];
  }
//  array(4) {
//    ["name"]=>
//  string(14) "Russell Campos"
//    ["email"]=>
//  string(20) "vepiw@mailinator.com"
//    ["password"]=>
//  string(9) "Pa$$w0rd!"
//    ["avatar"]=>
//  array(6) {
//      ["name"]=>
//    string(42) "scenic_view_sunset-wallpaper-1920x1280.jpg"
//      ["full_path"]=>
//    string(42) "scenic_view_sunset-wallpaper-1920x1280.jpg"
//      ["type"]=>
//    string(10) "image/jpeg"
//      ["tmp_name"]=>
//    string(24) "C:\xampp\tmp\php6097.tmp"
//      ["error"]=>
//    int(0)
//    ["size"]=>
//    int(395977)
//  }
//}


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
