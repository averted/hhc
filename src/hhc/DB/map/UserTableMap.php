<?php

namespace hhc\DB\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'user' table.
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
class UserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'hhc.map.UserTableMap';

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
        $this->setName('user');
        $this->setPhpName('User');
        $this->setClassname('hhc\\DB\\User');
        $this->setPackage('hhc');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('username', 'Username', 'VARCHAR', true, 255, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 255, null);
        $this->addColumn('password', 'Password', 'VARCHAR', false, 255, null);
        $this->addColumn('roles', 'Roles', 'ENUM', false, null, null);
        $this->getColumn('roles', false)->setValueSet(array (
  0 => 'USER_ROLE',
  1 => 'ADMIN_ROLE',
));
        // validators
        $this->addValidator('username', 'unique', 'propel.validator.UniqueValidator', '', 'Username already exists!');
        $this->addValidator('email', 'unique', 'propel.validator.UniqueValidator', '', 'E-mail already exists!');
        $this->addValidator('email', 'match', 'propel.validator.MatchValidator', '/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9])+(\.[a-zA-Z0-9_-]+)+$/', 'Please enter a valid email address.');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Vote', 'hhc\\DB\\Vote', RelationMap::ONE_TO_MANY, array('id' => 'uid', ), null, null, 'Votes');
    } // buildRelations()

} // UserTableMap
