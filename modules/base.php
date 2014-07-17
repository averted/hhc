<?php

use Symfony\Component\HttpFoundation\Request;

/**
 * ----------------------
 * route /
 * ----------------------
 */
$app->get('/', function() use($app) {
    return $app['twig']->render('index.html.twig', array(
        'user' => $app['session']->get('user'), 
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

    return $app['twig']->render('index.html.twig', array(
        'user' => $app['session']->get('user'), 
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
    $input = $request->get('_search');

    // search by abbreviation
    if (strlen($input) <= 3) {
        $match = HeroSearch::getNameFromAbbr($input);
        if ($match)
            return $app->redirect("/hero/{$match}");
    }

    // search by closest match
    $guess = HeroSearch::guessName($input);
    $url   = $guess ? "/hero/{$guess}" : '/hero';

    return $app->redirect($url);
});

?>
