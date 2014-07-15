<?php 

use hhc\DB\Hero;
use hhc\DB\HeroQuery;
use hhc\DB\User;
use hhc\DB\UserQuery;
use hhc\DB\Vote;
use hhc\DB\VoteQuery;
use hhc\DB\Counter;
use hhc\DB\CounterQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * ----------------------
 * route /hero
 * ----------------------
 */
$app->get('/hero', function(Request $request) use ($app) {
    $session = $app['session']->get('user');

    $heroes = HeroQuery::create()->orderByName('asc')->find();

    return $app['twig']->render('hero-list.html.twig', array(
        'user' => $session,
        'heroes' => $heroes
    ));
});

$app->get('/hero/{slug}', function($slug) use ($app) {
    $session = $app['session']->get('user');

    $hero = HeroQuery::create()->filterBySlug($slug)->findOne();
    if (!$hero) return $app->redirect('/hero');

    return $app['twig']->render('hero.html.twig', array(
        'user' => $session,
        'hero' => $hero,
        'counters' => $hero->getCounterArray()
    ));
});

$app->get('/hero/{slug}/counter/{counter}/{vote_type}', function($slug, $counter, $vote_type) use ($app) {
    if (!in_array($vote_type, array('up', 'down'))) return $app->redirect('/hero');

    $session = $app['session']->get('user');
    if (!$session) return $app->redirect('/login');

    $hero = HeroQuery::create()->filterBySlug($slug)->findOne();
    $cntr = HeroQuery::create()->filterBySlug($counter)->findOne();
    $user = UserQuery::create()->filterByUsername($session)->findOne();

    if (!$hero || !$cntr || !$user) return $app->redirect('/hero');

    if ($hero->voteExists($user, $cntr)) {
        return $app['twig']->render('error.html.twig', array(
            'user' => $session,
            'url' => "/hero/{$slug}",
            'error' => 'You may only vote once for each Hero->Counter combination'
        ));
    }

    if ($hero->counterExists($cntr)) {
        $c = CounterQuery::create()
            ->filterByHid($hero->getId())
            ->filterByCid($cntr->getId())
            ->findOne();
    } else {
        $c = new Counter();
    }

    $c->setHero($hero);
    $c->setCounter($cntr);
    $c->save();

    // register new vote
    $vote = new Vote();
    $vote->setUser($user);
    $vote->setCounter($c);
    $vote->setVoteType($vote_type);
    $vote->save();
    
    return $app->redirect("/hero/{$slug}");
});

/**
 * ----------------------
 * route /counter
 * ----------------------
 */
$app->get('/counter/{name}', function($name) use ($app) {
    $session = $app['session']->get('user');

    $heroes = HeroQuery::create()->orderByName()->find();
    $hero   = HeroQuery::create()->filterByName($name)->findOne();

    if (!$hero) return $app->redirect('/hero');

    return $app['twig']->render('counter-list.html.twig', array(
        'user' => $session,
        'hero' => $hero,
        'heroes' => $heroes,
        'counters' => $hero->getCounterArray()
    ));
});

?>
