<?php

namespace hhc\DB\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'vote' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.hhc.map
 */
class VoteTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'hhc.map.VoteTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('vote');
        $this->setPhpName('Vote');
        $this->setClassname('hhc\\DB\\Vote');
        $this->setPackage('hhc');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('uid', 'Uid', 'INTEGER' , 'user', 'id', true, null, null);
        $this->addForeignPrimaryKey('hid', 'Hid', 'INTEGER' , 'hero', 'id', true, null, null);
        $this->addForeignPrimaryKey('cid', 'Cid', 'INTEGER' , 'hero', 'id', true, null, null);
        $this->addColumn('vote_type', 'VoteType', 'ENUM', false, null, null);
        $this->getColumn('vote_type', false)->setValueSet(array (
  0 => 'up',
  1 => 'down',
));
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', 'hhc\\DB\\User', RelationMap::MANY_TO_ONE, array('uid' => 'id', ), null, null);
        $this->addRelation('Hero', 'hhc\\DB\\Hero', RelationMap::MANY_TO_ONE, array('hid' => 'id', ), null, null);
        $this->addRelation('Counter', 'hhc\\DB\\Hero', RelationMap::MANY_TO_ONE, array('cid' => 'id', ), null, null);
    } // buildRelations()

} // VoteTableMap
