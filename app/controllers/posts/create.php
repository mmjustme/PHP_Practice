<?php

# базова перевірка перед створенням посту чи авторизовано юзера
# і якщо ні перекидаємо його на голоовну
// if (!check_auth()) redirect('/');


$title = "MY BLOG :: New Post";
require_once VIEWS . "/posts/create.tpl.php";
