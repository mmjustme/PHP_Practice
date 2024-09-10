<?php
function dump($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}
;

function dd($data)
{
    dump($data);
    die;
}
;
function abort($code = 404)
{
    http_response_code($code);
    require VIEWS . "/errors/{$code}.tpl.php";
    die();
}

function load($fillable)
{
    $data = [];
    #задача перевірити чи в масиві fillable є поля з данних юзера
    foreach ($_POST as $key => $value) {
        # беремо $key і перевіряємо наявність в fillable
        if (in_array($key, $fillable)) {
            # запис данних юзера в масив data
            $data[$key] = trim($value);
        }
    }
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