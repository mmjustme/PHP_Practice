<?php

# проблема: юзер має можливість звернутся до файлів напряму, вписавши в адресну строку назву
# рішення: створити константу, яка оголошується (напр в файлі  index.php) 
# і перевіряти чи вона оголошена в файлах які ми не хочемо, щоб юзер мав доступ (func.php)
# таким чином ми захистимо чутливі файли, спосіб трохи застралий, надалі буде метод єдиного входу

define("MY_APP", true);

require './funcs.php';

$title = 'MY BLOG ::';

$posts = [
    1 => [
        'title' => 'Title 1',
        'desc' => 'Some quick example text to build on the card title and make up the bulk of the card\'s content.',
        'slug' => 'title-1',
    ],
    2 => [
        'title' => 'Title 2',
        'desc' => 'Some quick example text to build on the card title and make up the bulk of the card\'s content.',
        'slug' => 'title-2',
    ],
    3 => [
        'title' => 'Title 3',
        'desc' => 'Some quick example text to build on the card title and make up the bulk of the card\'s content.',
        'slug' => 'title-3',
    ],
    4 => [
        'title' => 'Title 4',
        'desc' => 'Some quick example text to build on the card title and make up the bulk of the card\'s content.',
        'slug' => 'title-4',
    ],
    5 => [
        'title' => 'Title 5',
        'desc' => 'Some quick example text to build on the card title and make up the bulk of the card\'s content.',
        'slug' => 'title-5',
    ],

];

$recent_posts = [
    1 => [
        'title' => 'An item',
        'slug' => lcfirst(str_replace(' ', '-', 'An item')),
    ],
    2 => [
        'title' => 'A second item',
        'slug' => lcfirst(str_replace(' ', '-', 'A second item')),
    ],
    3 => [
        'title' => 'A third item',
        'slug' => lcfirst(str_replace(' ', '-', 'A third item')),
    ],
    4 => [
        'title' => 'A fourth item',
        'slug' => lcfirst(str_replace(' ', '-', 'A fourth item')),
    ],
    5 => [
        'title' => 'A fifth item',
        'slug' => lcfirst(str_replace(' ', '-', 'A fifth item')),
    ],
];
# Вкраплення коду я нижче є нормальним.
# Проте змішування коду представлення і логіки (posts, recent_posts) є проблемою. 
# Тому відділимо логіку від представлення створивши index.tpl.php приставка tpl
# вказуж, що це шаблонний файл. Там ми і будемо зберігати представлення.

require_once "./app/views/index.tpl.php";
# таким чином ми підключили наше представлення, тобто файл index.tpl.php
# таким чином файл index.php - контроллер (controller), index.tpl.php - вид (view)
