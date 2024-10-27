<?php

namespace myfrm\middlewares;

class Auth
{
  public function handle()
  {
    if (!check_auth()) redirect('/login');
  }
}
