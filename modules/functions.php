<?php

use hhc\DB\Hero;
use hhc\DB\HeroQuery;

/**
 * -----------------
 * search
 * -----------------
 */
function getHeroNameFromAbbr($search) {
    $list = getAbbr();
    foreach ($list as $abbr)
        if (strtolower($search) == $abbr['abbr'])
            return $abbr['name'];
}

function getAbbr() {
    $abbr = Array();

    foreach (HeroQuery::create()->find() as $hero) {
        if (strpos($hero->getName(), ' ')) {
            $ab = '';

            foreach (explode(' ', $hero->getName()) as $name)
                $ab .= strtolower($name[0]);

            $abbr[] = array(
                'name' => $hero->getSlug(),
                'abbr' => $ab
            );
        }
    }
    
    //missing but widely-used abbreviations
    $abbr[] = array('name' => 'soulstealer', 'abbr' => 'ss');
    $abbr[] = array('name' => 'Madman', 'abbr' => 'mm');
    $abbr[] = array('name' => 'Wretched Hag', 'abbr' => 'hag');
    $abbr[] = array('name' => 'Blacksmith', 'abbr' => 'bs');
    $abbr[] = array('name' => 'Drunken Master', 'abbr' => 'bs');

    return $abbr;
}

function guessHeroName($input) {
    foreach(HeroQuery::create()->find() as $hero)
        if (stripos($hero->getName(), $input) !== false)
            $possibleMatch = $hero->getSlug();

    return $possibleMatch;
}

?>
