<?php

use Symfony\Component\HttpFoundation\Request;

/**
 * ----------------------
 * route /
 * ----------------------
 */
$app->get('/', function() use($app) {
    $user = $app['session']->get('user');

    return $app['twig']->render('index.html.twig', array(
        'user' => $user,
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
    $user = $app['session']->get('user');

    return $app['twig']->render('index.html.twig', array(
        'user' => $user,
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
    $name = $request->get('_search');

    if (strlen($name) <= 3) {       //search by abbreviation
        $url = '/hero/'.slug(getHeroNameFromAbbr($name));
    } else if (valid($name)) {      //seach by hero name
        $url = '/hero/'.slug($name);
    } else {                        //search by closest match
        $url = guessHeroName($name) ? '/hero/'.slug(guessHeroName($name)) : '/hero';
    }

    return $app->redirect($url);
});

?>
