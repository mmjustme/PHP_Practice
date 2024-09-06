<?php
#перевірки чи оголошена константа якщо ні заблокувати доступ бо вхід відбувся напряму
defined("MY_APP") or die("Blocked");

echo "Hello";
function dump($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}
;

# дана функція виводть дані і завершує виконання коду
function dd($data)
{
    dd($data);
    die;
}
;