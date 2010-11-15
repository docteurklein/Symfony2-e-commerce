<?php

require_once __DIR__.'/ECommerceKernel.php';

use Symfony\Bundle\FrameworkBundle\Cache\Cache;
use Symfony\Component\HttpFoundation\Request;

class ECommerceCache extends Cache
{
    public function handleAndSend()
    {
        return $this->handle(new Request)->send();
    }
}
