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
    function setAll($name, $role, $hp, $str, $int, $dex, $range, $speed, $diff) {
        parent::setName($name);
        parent::setRole($role);
        parent::setHP($hp);
        parent::setStr($str);
        parent::setInt($int);
        parent::setDex($dex);
        parent::setRange($range);
        parent::setSpeed($speed);
        parent::setDifficulty($diff);
    }
}
