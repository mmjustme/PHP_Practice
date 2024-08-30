<?php

$post = '<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex placeat minus, impedit
corporis veritatis similique sint quos nulla enim ducimus quasi modi eius, reprehenderit
voluptatibus nisi labore id velit. Sapiente!</p>
<p>Rem inventore, aspernatur illum accusamus asperiores beatae excepturi exercitationem hic
omnis perspiciatis dolorem, perferendis nam ea quibusdam, dignissimos neque dicta? Fuga
iste perferendis nostrum doloremque perspiciatis autem quae ipsa tempore.</p>
<p>Maxime odio quos repudiandae ab aliquam nemo itaque, tenetur maiores ullam doloremque
    numquam quo dignissimos corporis accusantium earum quisquam perspiciatis modi? Corporis
   totam excepturi repellendus placeat illo saepe nulla ipsum.</p>';

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

require_once "./about.tpl.php";

# даний метод вже має недоліки, такі як дубляж коду, напр. посилання на файли в меню ми вказували на кожній сторінці
