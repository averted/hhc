<?php

use hhc\DB\Hero;
use hhc\DB\HeroQuery;

class HeroSearch {
    /**
     * Returns hero slug if match was found.
     *
     * @param  string       $input Hero search input
     * @return string|null  String if match was found, null otherwise
     */
    public static function getNameFromAbbr($input) {
        $list = self::getHeroList();
        foreach ($list as $hero)
            if (strtolower($input) == $hero['abbr'])
                return $hero['slug'];
    }

    /**
     * Returns array of heroes along with their abbreviations.
     *
     * @return array
     */
    private static function getHeroList() {
        $heroList = Array();

        foreach (HeroQuery::create()->find() as $hero) {
            if (strpos($hero->getName(), ' ')) {
                $ab = '';

                foreach (explode(' ', $hero->getName()) as $name)
                    $ab .= strtolower($name[0]);

                $heroList[] = array(
                    'slug' => $hero->getSlug(),
                    'abbr' => $ab
                );
            }
        }
        
        // missing but widely-used abbreviations
        $heroList[] = array('slug' => 'soulstealer', 'abbr' => 'ss');
        $heroList[] = array('slug' => 'madman', 'abbr' => 'mm');
        $heroList[] = array('slug' => 'wretchedhag', 'abbr' => 'hag');
        $heroList[] = array('slug' => 'blacksmith', 'abbr' => 'bs');

        return $heroList;
    }

    /**
     * Attempts to guess a hero name based on search input.
     *
     * @param  string       $search Hero search input
     * @return string|null  String if found a name, null otherwise 
     */
    public static function guessName($input) {
        foreach(HeroQuery::create()->find() as $hero)
            if (stripos($hero->getName(), $input) !== false)
                $possibleMatch = $hero->getSlug();

        return $possibleMatch ? $possibleMatch : null;
    }
}
