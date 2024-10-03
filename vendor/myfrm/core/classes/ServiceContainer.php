<?php

namespace myfrm;
class ServiceContainer
{
    # контейнер для зберіганні сервісів
    protected $services = [];

    public function setService($service, $func)
    {
        # тобто ми в масив $services по ключам $service кладемо колбек функції
        $this->services[$service] = $func;
    }

    public function getService($service)
    {
        # перевірка чи є в нас сервіс який викликається
        if (!isset($this->services[$service])) {
            throw new \Exception("Not found service {$service}");
        }
        # викликаємо наш сервіс і запускаємо його через call_user_func
        return call_user_func($this->services[$service]);
    }
}