<?php

require dirname(__DIR__).'/autoload.php';

/**
 * ---------------------
 * init
 * ---------------------
 */
$app = new Silex\Application();
$app['debug'] = true;

/**
 * ---------------------
 * Service Providers
 * ---------------------
 */
$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => dirname(__DIR__).'/templates',
    'twig.options' => array(
        'cache' => false
    ),
));

/**
 * ----------------------
 * Routes
 * ----------------------
 */
$root = dirname(__DIR__);

require "{$root}/modules/base.php";
require "{$root}/modules/hero.php";
require "{$root}/modules/login.php";
require "{$root}/modules/account.php";

$app->run();

?>
