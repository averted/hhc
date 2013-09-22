<?php

use hhc\DB\Hero;
use hhc\DB\HeroQuery;
use hhc\DB\User;
use hhc\DB\UserQuery;
use hhc\DB\UserVotes;
use hhc\DB\UserVotesQuery;

/**
 * -----------------
 * filters
 * -----------------
 */
function getURL($f, $v, $filters) {
    if (!in_array($f, $filters)) {
        $url = '+'.slug($v).'+'.$f;
    } else {
        foreach($filters as $filter) {
            if ($filter != $f) $url .= '+'.$filter;
        }
    }
    
    return substr($url,1);
}

/**
 * -----------------
 * search
 * -----------------
 */
function getHeroNameFromAbbr($name) {
    $list = getAbbr();
    for ($i = 0; $i < sizeof($list); $i++)
        if (strtolower($name) == $list[$i]['abbr']) 
            return $list[$i]['name'];
}

function getAbbr() {
    $heroes = HeroQuery::create()->find();
    $abbr = Array();

    foreach ($heroes as $hero) {
        if (strpos($hero->getName(), ' ')) {
            $ab = '';

            foreach (explode(' ', $hero->getName()) as $name)
                $ab .= strtolower($name[0]);

            $abbr[] = array(
                'name' => $hero->getName(),
                'abbr' => $ab
            );
        }
    }
    
    //missing but widely-used abbreviations
    $abbr[] = array('name' => 'Soulstealer', 'abbr' => 'ss');
    $abbr[] = array('name' => 'Madman', 'abbr' => 'mm');
    $abbr[] = array('name' => 'Wretched Hag', 'abbr' => 'hag');

    return $abbr;
}

function guessHeroName($input) {
    foreach(HeroQuery::create()->find() as $hero)
        if (stripos($hero->getName(), $input) !== false)
            $possibleMatch = $hero->getName();

    return $possibleMatch;
}

/**
 * -----------------
 * votes / user
 * -----------------
 */
function voted($user, $name, $counter) {
    // find if user exists
    $q = UserQuery::create()->filterById(getUserId($user))->find()->count();
    if ($q == 0) 
        return false;

    $q = UserVotesQuery::create()->filterByUserId(getUserId($user))->filterByHeroName($name)->filterByCounterName($counter)->find()->count();

    return $q != 0;
}

function registerVote($user, $name, $counter) {
    $vote = new UserVotes();
    $vote->setUserId(getUserId($user));
    $vote->setHeroName($name);
    $vote->setCounterName($counter);
    $vote->save();
}

function getUserId($user) {
    $q = UserQuery::create()->filterByUsername($user)->findOne();
    return $q->getId();
}

function isLoggedIn($user) {
    return $user != null;
}

/**
 * -----------------
 * general
 * -----------------
 */
function valid($name) {
    $heroes = HeroQuery::create()->find();

    foreach($heroes as $hero) {
        if (strtoupper($name) == strtoupper($hero->getName()))
            return true;
    }

    return false;
}

function slug($name) {
    //return (strpos($name,' ') === true) ? str_replace(' ','+',$name) : str_replace('+','',$name);
    return str_replace(' ','+',ucwords($name));
}

function deslug($name) {
    //return ucwords(strtolower(str_replace('+',' ',$name)));
    return str_replace('+',' ',$name);
}

?>
