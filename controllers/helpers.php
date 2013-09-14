<?php

use hhc\DB\Hero;
use hhc\DB\HeroQuery;
use hhc\DB\User;
use hhc\DB\UserQuery;
use hhc\DB\UserVotes;
use hhc\DB\UserVotesQuery;

function valid($name) {
    $heroes = HeroQuery::create()->find();

    foreach($heroes as $hero) {
        if (deslug($name) == $hero->getName())
            return true;
    }

    return false;
}

function voted($user, $name, $counter) {
    // find if user exists
    $q = UserQuery::create()->filterById(getUserId($user))->find()->count();
    if ($q == 0) 
        return false;

    $q = UserVotesQuery::create()->filterByUserId(getUserId($user))->filterByHeroName(deslug($name))->filterByCounterName(deslug($counter))->find()->count();

    return $q == 0 ? false : true;
}

function registerVote($user, $name, $counter) {
    $vote = new UserVotes();
    $vote->setUserId(getUserId($user));
    $vote->setHeroName(deslug($name));
    $vote->setCounterName(deslug($counter));
    $vote->save();
}

function getUserId($user) {
    $q = UserQuery::create()->filterByUsername($user)->findOne();
    return $q->getId();
}

function isLoggedIn($user) {
    return $user == null ? false : true;
}

function slug($name) {
    return str_replace(' ','+',$name);
}

function deslug($name) {
    return str_replace('+',' ',$name);
}


?>
