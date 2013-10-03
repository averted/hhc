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
require dirname(__DIR__).'/controllers/helpers.php';

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

/**
 * ----------------------
 * route /login
 * ----------------------
 */
$app->match('/login', function (Request $request) use ($app) {
    $user  = $app['session']->get('user');
    $error = null;

    // check if user is logged in
    if (isLoggedIn($user))
        return $app->redirect('/account');
       
    if ($request->getMethod() == 'POST') {
        if (!($username = $request->get('_username')))
            $error = "Username is required";
        else if (!($password = $request->get('_password')))
            $error = "Password is required";
        else if (UserQuery::create()->filterByUsername($username)->find()->count() == 0)
            $error = "Username not found";
        
        if (!$error) {
            $u = UserQuery::create()->filterByUsername($username)->findOne();
            
            if (strtolower($username) === strtolower($u->getUsername()) && $password === $u->getPassword()) {
                $app['session']->start();
                $app['session']->set('user', $u->getUsername());
                return $app->redirect('/account');
            } else {
                $error = 'Bad credentials';
            }
        }
    }

    return $app['twig']->render('login.html.twig', array(
        'user' => $user,
        'error' => $error
    ));
});

$app->get('/account', function () use ($app) {
    $user  = $app['session']->get('user');
    $error = null;
    
    $votes = UserVotesQuery::create()->filterByUserId(getUserId($user))->find();


    return $app['twig']->render('account.html.twig', array(
        'user' => $user,
        'votes' => $votes,
    ));
});

$app->get('/logout', function () use ($app) {
    $app['session']->clear();
    return $app->redirect('/');
});
/**
 * ----------------------
 * route /register
 * ----------------------
 */
$app->match('/register', function (Request $request) use ($app) {
    $user  = $app['session']->get('user');
    $error = null;

    // check if user is logged in
    if (isLoggedIn($user))
        return $app->redirect('/');

    if ($request->getMethod() == 'POST') {
        if (!($email = $request->get('_email')))
            $error = "Email is required";
        else if (!($username = $request->get('_username')))
            $error = "Username is required";
        else if (!($password = $request->get('_password')))
            $error = "Password is required";
        else if (!($password2 = $request->get('_password2')))
            $error = "Repeating your password is required";
        else if ($password != $password2)
            $error = "Passwords don't match";
        else if (strlen($username) > 15) 
            $error = "Username too long (15 char limit)";

        if (!$error) {
            $u = new User();
            $u->setEmail($email);
            $u->setUsername($username);
            $u->setPassword($password);
            
            if ($u->validate()) {
                $u->save();
                $app['session']->start();
                $app['session']->set('user', $u->getUsername());
                return $app->redirect('/hero');
            } else {
                foreach ($u->getValidationFailures() as $failure) {
                    $error = $failure->getMessage();
                }
            }
        }
    }

    return $app['twig']->render('register.html.twig', array(
        'user' => $user,
        'error' => $error
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

$app->run();

?>
