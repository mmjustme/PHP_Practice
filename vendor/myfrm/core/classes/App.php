<?php

namespace myfrm;
class App
{   # масив сервісів
  protected static $container;

  # фн для запису сервісу в масив
  public static function setContainer($container)
  {
    static::$container = $container;
  }

  # фн для повернення сервісу
  public static function getContainer()
  {
    return static::$container;
  }

  public static function get($service)
  {
    return static::getContainer()->getService($service);
  }
}