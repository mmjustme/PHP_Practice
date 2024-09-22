<?php
use app\A;
use base\B;

# підключаємо автозагрузку класів
require 'vendor/autoload.php';

# composer сам розбереться з класами і назвами

// new app\A;
// new base\A();
// new base\B();

new A();
new \base\A();
new B();

# автозагрузка файлів
# після додавання в файл composer шлях до файлу використали composer 
# dumpautoload щоб оновити залежності і файл підключився
test();

# Налаштування компсера прописуємо вручну в файлі composer.json
# Далі composer install в папці де проект
# base - може бути любе ключовк слово, головне вказати правильний шлях до реального класу
# і в цьому ж класі прописати namespace "base"
// {
//     "autoload": {
//         "psr-4": {
//             "app\\":"app",
//             "base\\":"classes/test"
//         }
//     }
// }