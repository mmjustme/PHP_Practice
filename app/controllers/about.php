<?php

$title = 'MY BLOG :: ABOUT';

$post = '<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex placeat minus, impedit
corporis veritatis similique sint quos nulla enim ducimus quasi modi eius, reprehenderit
voluptatibus nisi labore id velit. Sapiente!</p>
<p>Rem inventore, aspernatur illum accusamus asperiores beatae excepturi exercitationem hic
omnis perspiciatis dolorem, perferendis nam ea quibusdam, dignissimos neque dicta? Fuga
iste perferendis nostrum doloremque perspiciatis autem quae ipsa tempore.</p>
<p>Maxime odio quos repudiandae ab aliquam nemo itaque, tenetur maiores ullam doloremque
    numquam quo dignissimos corporis accusantium earum quisquam perspiciatis modi? Corporis
   totam excepturi repellendus placeat illo saepe nulla ipsum.</p>';

$recent_posts = $db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 3")->findAll();

require_once VIEWS . "/about.tpl.php";
