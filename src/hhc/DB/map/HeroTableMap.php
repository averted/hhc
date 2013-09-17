<?php

namespace hhc\DB\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'hero' table.
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
class HeroTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'hhc.map.HeroTableMap';

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
        $this->setName('hero');
        $this->setPhpName('Hero');
        $this->setClassname('hhc\\DB\\Hero');
        $this->setPackage('hhc');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 50, null);
        $this->addColumn('role', 'Role', 'VARCHAR', true, 200, null);
        $this->addColumn('hp', 'HP', 'INTEGER', true, null, null);
        $this->addColumn('dmg', 'Dmg', 'VARCHAR', true, 20, null);
        $this->addColumn('armor', 'Armor', 'FLOAT', true, 4, null);
        $this->addColumn('difficulty', 'Difficulty', 'FLOAT', true, 3, null);
        $this->addColumn('range', 'Range', 'INTEGER', true, null, null);
        $this->addColumn('speed', 'Speed', 'INTEGER', true, null, null);
        $this->addColumn('stuns', 'Stuns', 'INTEGER', false, null, null);
        $this->addColumn('side', 'Side', 'VARCHAR', true, 20, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // HeroTableMap
