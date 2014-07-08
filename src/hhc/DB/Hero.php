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
    function setAll($name, $role, $hp, $dmg, $armor, $diff, $range, $speed, $stuns = null, $side, $stat = null) {
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
        $this->save();
    }
}
