<?php

require_once __DIR__.'/vendor/symfony/src/Symfony/Component/HttpFoundation/UniversalClassLoader.php';

use Symfony\Component\HttpFoundation\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'                    => __DIR__.'/vendor/symfony/src',
    'Application'                => __DIR__,
    'Bundle'                     => __DIR__,
    'Doctrine\\Common'           => __DIR__.'/vendor/doctrine/lib/vendor/doctrine-common/lib',
    'Doctrine\\DBAL\\Migrations' => __DIR__.'/vendor/doctrine-migrations/lib',
    'Doctrine\\DBAL'             => __DIR__.'/vendor/doctrine/lib/vendor/doctrine-dbal/lib',
    'Doctrine\\ODM'              => __DIR__.'/vendor/mongodb-odm/lib',
    'Doctrine'                   => __DIR__.'/vendor/doctrine/lib',
    'Zend'                       => __DIR__ .'/vendor/zend/library',
));
$loader->registerPrefixes(array(
    'Twig_'                       => __DIR__ .'/vendor/twig/lib',
    'Swift_' => __DIR__.'/vendor/swiftmailer/lib/classes',
));
$loader->register();
