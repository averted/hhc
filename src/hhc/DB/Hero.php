<?php

namespace hhc\DB;

use hhc\DB\om\BaseHero;


/**
 * Skeleton subclass for representing a row from the 'hero' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.hhc
 */
class Hero extends BaseHero
{
    function voteExists($user, $cntr) {
        $counter = CounterQuery::create()->filterByHid($this->getId())->filterByCid($cntr->getId())->findOne();
        if (!$counter) return false;

        $vote = VoteQuery::create()
            ->filterByUid($user->getId())
            ->filterByCid($counter->getId())
            ->findOne();
        
        return $vote ? true : false;
    }

    function counterExists($cntr) {
        $counter = CounterQuery::create()->filterByHid($this->getId())->filterByCid($cntr->getId())->findOne();
        return $counter ? true : false;
    }

    function getCounterArray($reverse = false) {
        $query = CounterQuery::create();
        $query = $reverse ? $query->filterByCid($this->id) : $query->filterByHid($this->id);
        $mappings = $query->find();
        $counters = array();
        
        foreach ($mappings as $m) {
            $id = $reverse ? $m->getHid() : $m->getCid();
            $hero = HeroQuery::create()->findPK($id);
            $votes = (count($m->findVotes()) - count($m->findVotes('down')) < 0) ? '0' : count($m->findVotes()) - count($m->findVotes('down'));
            $counters[] = array (
                'name' => $hero->getName(),
                'slug' => $hero->getSlug(),
                'up'   => count($m->findVotes()),
                'down' => count($m->findVotes('down')),
                'votes'=> $votes
            );
        }

        return $counters;
    }

    function setAll($name, $role, $hp, $dmg, $armor, $diff, $range, $speed, $stuns = null, $side, $stat = null) {
        $slug = str_replace(' ', '', strtolower($name));
        $this->setName($name);
        $this->setRole($role);
        $this->setHP($hp);
        $this->setDmg($dmg);
        $this->setArmor($armor);
        $this->setDifficulty($diff);
        $this->setRange($range);
        $this->setSpeed($speed);
        $this->setStuns($stuns);
        $this->setSide($side);
        $this->setStat($stat);
        $this->setSlug($slug);
        $this->save();
    }
}
