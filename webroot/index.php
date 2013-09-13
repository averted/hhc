<?php

use hhc\DB\Hero;
use hhc\DB\HeroQuery;
use hhc\DB\User;
use hhc\DB\UserQuery;
use hhc\DB\Votes;
use hhc\DB\VotesQuery;
use hhc\DB\UserVotes;
use hhc\DB\UserVotesQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
 * route /
 * ----------------------
 */
$app->get('/', function() use($app) {
    return $app['twig']->render('index.html.twig', array(
        'link' => '/hero',
        'message' => 'Hero list'
    ));
});

/**
 * ----------------------
 * route /hero
 * ----------------------
 */
$app->get('/hero', function() use ($app) {
    $heroes = HeroQuery::create()->orderByName()->find();
    
    return $app['twig']->render('hero-list.html.twig', array(
        'heroes' => $heroes
    ));
});

$app->run();

?>
