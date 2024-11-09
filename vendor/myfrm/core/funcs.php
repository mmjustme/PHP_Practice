<?php

function dump($data)
{
  echo "<pre>";
  var_dump($data);
  echo "</pre>";
}

function print_arr($data)
{
  echo "<pre>";
  print_r($data);
  echo "</pre>";
}


function dd($data)
{
  dump($data);
  die;
}

function abort($code = 404, $title = "404 - Not found")
{
  http_response_code($code);
  require VIEWS . "/errors/{$code}.tpl.php";
  die();
}

function load($fillable, $post=true)
{
  $load_data = $post ? $_POST : $_GET;
  $data = [];
  # пробігаємося по масиву $fillable ['name', 'email', 'password', 'avatar']
  foreach ($fillable as $name){
    #якщо в масиві $load_data є поле з масиву $fillable
    if(isset($load_data[$name])){
      # додатково чекнемо якщо не масив то застос. trim
      # оск для масиву трім не працює
      if(!is_array($load_data[$name])){
        $data[$name] = trim($load_data[$name]);
      } else{
        # записуємо в $data по ключу
        $data[$name] = $load_data[$name];
      }
    } else {
      # або кладемо туди ""
      # таким чином додамо avatar і воно буде пусте
      $data[$name] = '';
    }
  }

//  #задача перевірити чи в масиві fillable є поля з данних юзера
//  foreach ($load_data as $key => $value) {
//    # беремо $key і перевіряємо наявність в fillable
//    if (in_array($key, $fillable)) {
//      # запис данних юзера в масив data
//      $data[$key] = trim($value);
//    }
//  }
  return $data;
}

function old($fieldname)
{
  return isset($_POST[$fieldname]) ? h($_POST[$fieldname]) : '';
}

function h($str)
{
  #дана фн перетворює теги на звичайні символи
  return htmlspecialchars($str, ENT_QUOTES);
}

function redirect($url = '')
{
  if ($url) {
    $redirect = $url;
  } else {
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
  }
  header("Location: {$redirect}");
  die;
}

function get_alerts()
{
  if (!empty($_SESSION['success'])) {
    require_once VIEWS . "/incs/alert_success.php";
    unset($_SESSION['success']);
  }

  if (!empty($_SESSION['error'])) {
    require_once VIEWS . "/incs/alert_error.php";
    unset($_SESSION['error']);
  }
}

function db(): \myfrm\Db
{
  return \myfrm\App::get(\myfrm\Db::class);
}

function check_auth()
{
  # return true if user exist
  # false if not
  return isset($_SESSION['user']);
}
