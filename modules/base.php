<?php

use Symfony\Component\HttpFoundation\Request;

/**
 * ----------------------
 * route /
 * ----------------------
 */
$app->get('/', function() use($app) {
    $session = $app['session']->get('user');

    return $app['twig']->render('index.html.twig', array(
        'user' => $session,
        'link' => '/hero',
        'message' => 'Hero list'
    ));
});

/**
 * ----------------------
 * route /load
 * ----------------------
 */
$app->get('/load', function() use($app) {
    include_once dirname(__DIR__).'/load-heroes.php';
    $session = $app['session']->get('user');

    return $app['twig']->render('index.html.twig', array(
        'user' => $session,
        'link' => '/hero',
        'message' => 'Everything loaded fine.'
    ));
});

/**
 * ----------------------
 * route /search
 * ----------------------
 */
$app->post('/search', function (Request $request) use ($app) {
    $search = $request->get('_search');

    if (strlen($search) <= 3) {       //search by abbreviation
        $url = '/hero/'.getHeroNameFromAbbr($search);
    } else {                          //search by closest match
        $url = guessHeroName($search) ? '/hero/'.guessHeroName($search) : '/hero';
    }

    return $app->redirect($url);
});

?>
