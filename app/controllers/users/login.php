<?php

$title = 'My Blog :: Login';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $data = load(['email', 'password']);

  $form_rules = [
    'password' => ['required' => true, 'min' => 6],
    'email' => ['email' => true],
  ];
  $validator = new \myfrm\Validator();
  $validation = $validator->validate($data, $form_rules);

  if (!$validator->hasErrors()) {
    # якщо не буде юзера прийде "" що = false конвертуємо в true
    # повідомляємо про помилку і кидаємо на цю ж сторінку
    $user = db()->query("SELECT * from users WHERE email = ?", [$data['email']])->find();
    if (!$user) {
      $_SESSION['error'] = "Wrong email or password";
      redirect();
    }
    # Якщо ми знайшли юзера то дані будуть в $user
    # Порівнюємо паролі
    if (!password_verify($data['password'], $user['password'])) {
      $_SESSION['error'] = "Wrong email or password";
      redirect();
    }
    # якщо перевірки успішні авторизуємо юзера, виводимо повідомлення і редірект на головну
//    $_SESSION['user'] = [
//      'name' => $user['name'],
//      'id' => $user['id'],
//    ];
    foreach ($user as $key => $value) {
      if ($key != 'password') {
        $_SESSION['user'][$key] = $value;
      }
    }

    $_SESSION['success'] = 'Successful authorized';
    redirect('/');
  }
}

require_once VIEWS . '/users/login.tpl.php';
