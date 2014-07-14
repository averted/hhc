<?php 

use hhc\DB\Hero;
use hhc\DB\HeroQuery;
use hhc\DB\Votes;
use hhc\DB\VotesQuery;
use Symfony\Component\HttpFoundation\Request;

/**
 * ----------------------
 * route /hero
 * ----------------------
 */
$app->get('/hero', function(Request $request) use ($app) {
    $user = $app['session']->get('user');

    $heroes = HeroQuery::create()->orderByName('asc')->find();;

    return $app['twig']->render('hero-list.html.twig', array(
        'user' => $user,
        'heroes' => $heroes
    ));
});

$app->get('/hero/{name}', function($name) use ($app) {
    $user = $app['session']->get('user');

    if (!valid($name))
        return $app->redirect('/hero');

    $hero = HeroQuery::create()->filterByName($name)->findOne();
    $votes = VotesQuery::create()->filterByHeroName($name)->orderByVotes('desc')->limit(3)->find();

    foreach ($votes as $counter) {
        $counters[] = array(
            'name'     => slug($counter->getCounterName()),
            'votes'    => $counter->getVotes(),
            'voteup'   => isLoggedIn($user) ? '/hero/'.slug($name).'/counter/'.slug($counter->getCounterName()).'/voteup' : '/login',
            'votedown' => isLoggedIn($user) ? '/hero/'.slug($name).'/counter/'.slug($counter->getCounterName()).'/votedown' : '/login',
        );
    }
    
    return $app['twig']->render('hero.html.twig', array(
        'user' => $user,
        'hero' => $hero,
        'counters' => $counters
    ));
})
->convert('name', function ($name) { return str_replace('+',' ',$name); });

$app->get('/hero/{name}/counter/{counter}/voteup', function($name, $counter) use ($app) {
    $user = $app['session']->get('user');
    $error = null;

    if (!valid($name) || !valid($counter))
        return $app->redirect('/hero');

    if (isLoggedIn($user)) { 
        if (!voted($user, $name, $counter)) {
            //increase total votes
            $votes = VotesQuery::create()->filterByHeroName($name)->filterByCounterName($counter)->findOne();
            $votes->setVotes($votes->getVotes() + 1);
            $votes->save();
            
            //register vote for current user
            registerVote($user, $name, $counter);
        } else {
            $url   = '/hero/'.slug($name);
            $error = 'You may only vote once for each Hero->Counter combination.';
            
            return $app['twig']->render('error.html.twig', array(
                'user' => $user,
                'url' => $url,
                'error' => $error
            ));
        }
    }
    
    return $app->redirect('/hero/'.slug($name));
})
->convert('name', function ($name) { return str_replace('+',' ',$name); })
->convert('counter', function ($counter) { return str_replace('+',' ',$counter); });

$app->get('/hero/{name}/counter/{counter}/votedown', function($name, $counter) use ($app) {
    $user = $app['session']->get('user');

    if (!valid($name) || !valid($counter))
        return $app->redirect('/hero');

    if (isLoggedIn($user)) {
        if (!voted($user, $name, $counter)) {
            // decreate total votes
            $votes = VotesQuery::create()->filterByHeroName($name)->filterByCounterName($counter)->findOne();
            $votes->setVotes($votes->getVotes() - 1);
            $votes->save();

            registerVote($user, $name, $counter);
        } else {
            $url   = '/hero/'.$name;
            $error = 'You may only vote once for each Hero->Counter combination.';
            
            return $app['twig']->render('error.html.twig', array(
                'user' => $user,
                'url' => $url,
                'error' => $error
            ));
        }
    }
    
    return $app->redirect('/hero/'.$name);
})
->convert('name', function ($name) { return str_replace('+',' ',$name); })
->convert('counter', function ($counter) { return str_replace('+',' ',$counter); });

/**
 * ----------------------
 * route /counter
 * ----------------------
 */
$app->get('/counter/{name}', function($name) use ($app) {
    $user = $app['session']->get('user');

    if (!valid($name))
        return $app->redirect('/hero');

    $heroes = HeroQuery::create()->orderByName()->find();
    $hero   = HeroQuery::create()->filterByName($name)->findOne();
    $votes  = VotesQuery::create()->filterByHeroName($name)->find();
    
    foreach ($votes as $index => $counter) {
        $counters[$index] = $counter->getCounterName();
    }

    return $app['twig']->render('counter-list.html.twig', array(
        'user' => $user,
        'hero' => $hero,
        'heroes' => $heroes,
        'counters' => $counters
    ));
})
->convert('name', function ($name) { return str_replace('+',' ',$name); });

$app->get('/counter/{name}/add/{counter}', function($name, $counter) use ($app) {
    if (!valid($name) || !valid($counter))
        return $app->redirect('/hero');

    if (VotesQuery::create()->filterByHeroName($name)->filterByCounterName($counter)->find()->count() != 0) // counter already exists
        return $app->redirect('/hero/'.slug($name).'/counter/'.slug($counter).'/voteup');
        

    $hero = HeroQuery::create()->filterByName($name)->findOne();

    $votes = new Votes();
    $votes->setHeroName($name);
    $votes->setCounterName($counter);
    $votes->setVotes(1);
    $votes->save();

    return $app->redirect('/hero/'.slug($name));
})
->convert('name', function ($name) { return str_replace('+',' ',$name); })
->convert('counter', function ($counter) { return str_replace('+',' ',$counter); });




?>
