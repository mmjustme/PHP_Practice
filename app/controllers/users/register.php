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
//      'required'=>true, // optional
      'ext' => 'png|jpg|gif',
      'size' => 1_048_576, // 1mb in bytes 1024 * 1024
    ],
  ];

  $validation = $validator->validate($data, $form_rules);


  if (!$validation->hasErrors()) {
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    if (db()->query(
      "INSERT INTO users (`name`,`email`,`password`) VALUES (?,?,?)",
      [$data['name'], $data['email'], $data['password']])) {

      if (!empty($data['avatar']['name'])) {
        $id = db()->getInsertId();
        $fileExtension = getFileExt($data['avatar']['name']);
        # save file
        $dir = '/avatars/' . date('Y') . '/' . date('m') . '/' . date('d');
        # перевірими чи такий шлях вже є і якщо ні створимо
        if (!is_dir(UPLOADS . $dir)) {
          mkdir(UPLOADS . $dir, 0755, true);
        }
        # шлях збереження файлу
        $file_path = UPLOADS . "{$dir}/avatar-{$id}.{$fileExtension}";
        # шлях де знаходиться файл для бд
        $file_url = "/uploads{$dir}/avatar-{$id}.{$fileExtension}";
        # першочергово файл зн в тимчасовій папці його переміщають через спец фн
        if (move_uploaded_file($data['avatar']['tmp_name'], $file_path)) {
          # оновлюємо поле з файлом в бд
          db()->query('UPDATE users SET avatar=? WHERE id=?', [$file_url, $id]);
        } else {
          echo "error upload file";
        }
      }

      $_SESSION['success'] = "User has been registered";
    } else {
      $_SESSION['error'] = "DB ERROR";
    }
    redirect('/');
  }
}

require_once VIEWS . '/users/register.tpl.php';
