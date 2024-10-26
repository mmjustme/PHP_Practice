<?php
# get data from form with load fn. #
# Add fields in load fn and check it, if user fill correct fields we'll return data with values.
$data = load(['name', 'email', 'password']);
$validator = new \myfrm\Validator();

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
} else {
  # даний блок якщо ми маємо помилки валідації
  # тому ми показуємо цю ж сторінку але з помилками
  require VIEWS . "/users/register.tpl.php";
}