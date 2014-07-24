<?php

use hhc\Util\HeroSearch;
use hhc\DB\Hero;
use hhc\DB\HeroQuery;
use hhc\DB\User;
use hhc\DB\UserQuery;
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
        'message' => 'Hero list',
        'topusers' => UserQuery::create()->limit(5)->find(),
        'topheroes' => HeroQuery::create()->limit(5)->find()
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
