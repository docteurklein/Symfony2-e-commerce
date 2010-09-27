<?php

require_once __DIR__.'/../eCommerce/ECommerceCache.php';
require_once __DIR__.'/../eCommerce/ECommerceKernel.php';

$kernel = new ECommerceCache(new ECommerceKernel('prod', true));
$kernel->handle()->send();

