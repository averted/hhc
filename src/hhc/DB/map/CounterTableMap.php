<?php

namespace hhc\DB\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'counter' table.
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
class CounterTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'hhc.map.CounterTableMap';

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
        $this->setName('counter');
        $this->setPhpName('Counter');
        $this->setClassname('hhc\\DB\\Counter');
        $this->setPackage('hhc');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('hid', 'Hid', 'INTEGER', 'hero', 'id', true, null, null);
        $this->addForeignKey('cid', 'Cid', 'INTEGER', 'hero', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Hero', 'hhc\\DB\\Hero', RelationMap::MANY_TO_ONE, array('hid' => 'id', ), null, null);
        $this->addRelation('Counter', 'hhc\\DB\\Hero', RelationMap::MANY_TO_ONE, array('cid' => 'id', ), null, null);
        $this->addRelation('Vote', 'hhc\\DB\\Vote', RelationMap::ONE_TO_MANY, array('id' => 'cid', ), null, null, 'Votes');
    } // buildRelations()

} // CounterTableMap
