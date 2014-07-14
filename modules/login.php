<?php

use hhc\DB\User;
use hhc\DB\UserQuery;
use hhc\DB\UserVotes;
use hhc\DB\UserVotesQuery;
use Symfony\Component\HttpFoundation\Request;

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


?>
