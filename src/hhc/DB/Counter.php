<?php

namespace hhc\DB;

use hhc\DB\om\BaseCounter;


/**
 * Skeleton subclass for representing a row from the 'counter' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.hhc
 */
class Counter extends BaseCounter
{
    function findVotes($type = 'up') {
        $votes = array();
        
        foreach ($this->getVotes() as $v) {
            if ($v->getVoteType() === $type) {
                $votes[] = $v;
            }
        }

        return $votes;
    }

}
