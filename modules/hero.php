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
    $heroes = HeroQuery::create()->orderByName('asc')->find();

    return $app['twig']->render('hero-list.html.twig', array(
        'user' => $app['session']->get('user'),
        'heroes' => $heroes
    ));
});

$app->get('/hero/{slug}', function($slug) use ($app) {
    $hero = HeroQuery::create()->filterBySlug($slug)->findOne();
    if (!$hero)
        throw new Exception('Unknown Hero');

    return $app['twig']->render('hero.html.twig', array(
        'user' => $app['session']->get('user'),
        'hero' => $hero,
        'counters' => $hero->getCounterArray(),
        'pros' => $hero->getCounterArray(true)
    ));
});

$app->get('/hero/{slug}/counter/{counter}/{vote_type}', function($slug, $counter, $vote_type) use ($app) {
    if (!in_array($vote_type, array('up', 'down')))
        throw new Exception('Invalid Vote Type');

    if (!$session = $app['session']->get('user'))
        return $app->redirect('/login');

    $hero = HeroQuery::create()->filterBySlug($slug)->findOne();
    $cntr = HeroQuery::create()->filterBySlug($counter)->findOne();
    $user = UserQuery::create()->filterByUsername($session)->findOne();

    if (!$hero || !$cntr || !$user)
        throw new Exception('Invalid Hero/User/Counter Specified');

    if ($hero->voteExists($user, $cntr))
        throw new Exception('You may only vote once for each Hero->Counter combination');

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
$app->get('/counter/{slug}', function($slug) use ($app) {
    $heroes = HeroQuery::create()->orderByName()->find();
    $hero   = HeroQuery::create()->filterBySlug($slug)->findOne();

    if (!$hero)
        throw new Exception('Unknown Hero');

    return $app['twig']->render('counter-list.html.twig', array(
        'user' => $app['session']->get('user'),
        'hero' => $hero,
        'heroes' => $heroes,
        'counters' => $hero->getCounterArray()
    ));
});

?>
