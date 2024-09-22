<?php

# оголошення просторового імені класу
# тобто тепер імя класу буде "appA" замість А
namespace app;

class A
{
    public function __construct()
    {
        echo __FILE__ . '<br>';
    }
}