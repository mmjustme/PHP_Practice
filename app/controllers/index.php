<?php

$title = 'MY BLOG :: HOME';

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
// dd($posts); // working

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

require_once VIEWS . "/index.tpl.php";
