<?php

use hhc\DB\User;
use hhc\DB\UserQuery;
use Symfony\Component\HttpFoundation\Request;

/**
 * ----------------------
 * route /account
 * ----------------------
 */
$app->get('/account', function () use ($app) {
    if (!$session = $app['session']->get('user')) return $app->redirect('/login');

    $user = UserQuery::create()->filterByUsername($session)->findOne();
    if (!$user) return $app->redirect('/');
    
    return $app['twig']->render('account.html.twig', array(
        'user' => $session,
        'votes' => $user->findAllVotes()
    ));
});

?>
