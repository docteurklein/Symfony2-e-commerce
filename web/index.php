<?php

require_once __DIR__.'/../eCommerce/ECommerceKernel.php';

$kernel = new ECommerceKernel('prod', false);
$kernel->handle()->send();
