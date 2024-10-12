<?php

namespace myfrm\middlewares;

class Guest
{
    public function handle()
    {
        if (check_auth()) redirect('/');
    }
}
