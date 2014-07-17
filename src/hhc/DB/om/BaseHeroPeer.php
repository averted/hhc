<?php

namespace hhc\DB\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use hhc\DB\Hero;
use hhc\DB\HeroPeer;
use hhc\DB\map\HeroTableMap;

/**
 * Base static class for performing query and update operations on the 'hero' table.
 *
 *
 *
 * @package propel.generator.hhc.om
 */
abstract class BaseHeroPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'hhc';

    /** the table name for this class */
    const TABLE_NAME = 'hero';

    /** the related Propel class for this table */
    const OM_CLASS = 'hhc\\DB\\Hero';

    /** the related TableMap class for this table */
    const TM_CLASS = 'hhc\\DB\\map\\HeroTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 27;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 27;

    /** the column name for the id field */
    const ID = 'hero.id';

    /** the column name for the hero_id field */
    const HERO_ID = 'hero.hero_id';

    /** the column name for the name field */
    const NAME = 'hero.name';

    /** the column name for the team field */
    const TEAM = 'hero.team';

    /** the column name for the role field */
    const ROLE = 'hero.role';

    /** the column name for the attacktype field */
    const ATTACKTYPE = 'hero.attacktype';

    /** the column name for the attackrange field */
    const ATTACKRANGE = 'hero.attackrange';

    /** the column name for the attackspeed field */
    const ATTACKSPEED = 'hero.attackspeed';

    /** the column name for the hp field */
    const HP = 'hero.hp';

    /** the column name for the mana field */
    const MANA = 'hero.mana';

    /** the column name for the dmg field */
    const DMG = 'hero.dmg';

    /** the column name for the dmgmin field */
    const DMGMIN = 'hero.dmgmin';

    /** the column name for the dmgmax field */
    const DMGMAX = 'hero.dmgmax';

    /** the column name for the armor field */
    const ARMOR = 'hero.armor';

    /** the column name for the magicarmor field */
    const MAGICARMOR = 'hero.magicarmor';

    /** the column name for the stat field */
    const STAT = 'hero.stat';

    /** the column name for the strength field */
    const STRENGTH = 'hero.strength';

    /** the column name for the strperlvl field */
    const STRPERLVL = 'hero.strperlvl';

    /** the column name for the agility field */
    const AGILITY = 'hero.agility';

    /** the column name for the agiperlvl field */
    const AGIPERLVL = 'hero.agiperlvl';

    /** the column name for the intelligence field */
    const INTELLIGENCE = 'hero.intelligence';

    /** the column name for the intperlvl field */
    const INTPERLVL = 'hero.intperlvl';

    /** the column name for the hpregen field */
    const HPREGEN = 'hero.hpregen';

    /** the column name for the manaregen field */
    const MANAREGEN = 'hero.manaregen';

    /** the column name for the movespeed field */
    const MOVESPEED = 'hero.movespeed';

    /** the column name for the difficulty field */
    const DIFFICULTY = 'hero.difficulty';

    /** the column name for the slug field */
    const SLUG = 'hero.slug';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of Hero objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Hero[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. HeroPeer::$fieldNames[HeroPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'HeroId', 'Name', 'Team', 'Role', 'Attacktype', 'Attackrange', 'Attackspeed', 'HP', 'Mana', 'Dmg', 'DmgMin', 'DmgMax', 'Armor', 'MagicArmor', 'Stat', 'Strength', 'Strperlvl', 'Agility', 'Agiperlvl', 'Intelligence', 'Intperlvl', 'HpRegen', 'ManaRegen', 'MoveSpeed', 'Difficulty', 'Slug', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'heroId', 'name', 'team', 'role', 'attacktype', 'attackrange', 'attackspeed', 'hP', 'mana', 'dmg', 'dmgMin', 'dmgMax', 'armor', 'magicArmor', 'stat', 'strength', 'strperlvl', 'agility', 'agiperlvl', 'intelligence', 'intperlvl', 'hpRegen', 'manaRegen', 'moveSpeed', 'difficulty', 'slug', ),
        BasePeer::TYPE_COLNAME => array (HeroPeer::ID, HeroPeer::HERO_ID, HeroPeer::NAME, HeroPeer::TEAM, HeroPeer::ROLE, HeroPeer::ATTACKTYPE, HeroPeer::ATTACKRANGE, HeroPeer::ATTACKSPEED, HeroPeer::HP, HeroPeer::MANA, HeroPeer::DMG, HeroPeer::DMGMIN, HeroPeer::DMGMAX, HeroPeer::ARMOR, HeroPeer::MAGICARMOR, HeroPeer::STAT, HeroPeer::STRENGTH, HeroPeer::STRPERLVL, HeroPeer::AGILITY, HeroPeer::AGIPERLVL, HeroPeer::INTELLIGENCE, HeroPeer::INTPERLVL, HeroPeer::HPREGEN, HeroPeer::MANAREGEN, HeroPeer::MOVESPEED, HeroPeer::DIFFICULTY, HeroPeer::SLUG, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'HERO_ID', 'NAME', 'TEAM', 'ROLE', 'ATTACKTYPE', 'ATTACKRANGE', 'ATTACKSPEED', 'HP', 'MANA', 'DMG', 'DMGMIN', 'DMGMAX', 'ARMOR', 'MAGICARMOR', 'STAT', 'STRENGTH', 'STRPERLVL', 'AGILITY', 'AGIPERLVL', 'INTELLIGENCE', 'INTPERLVL', 'HPREGEN', 'MANAREGEN', 'MOVESPEED', 'DIFFICULTY', 'SLUG', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'hero_id', 'name', 'team', 'role', 'attacktype', 'attackrange', 'attackspeed', 'hp', 'mana', 'dmg', 'dmgmin', 'dmgmax', 'armor', 'magicarmor', 'stat', 'strength', 'strperlvl', 'agility', 'agiperlvl', 'intelligence', 'intperlvl', 'hpregen', 'manaregen', 'movespeed', 'difficulty', 'slug', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. HeroPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'HeroId' => 1, 'Name' => 2, 'Team' => 3, 'Role' => 4, 'Attacktype' => 5, 'Attackrange' => 6, 'Attackspeed' => 7, 'HP' => 8, 'Mana' => 9, 'Dmg' => 10, 'DmgMin' => 11, 'DmgMax' => 12, 'Armor' => 13, 'MagicArmor' => 14, 'Stat' => 15, 'Strength' => 16, 'Strperlvl' => 17, 'Agility' => 18, 'Agiperlvl' => 19, 'Intelligence' => 20, 'Intperlvl' => 21, 'HpRegen' => 22, 'ManaRegen' => 23, 'MoveSpeed' => 24, 'Difficulty' => 25, 'Slug' => 26, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'heroId' => 1, 'name' => 2, 'team' => 3, 'role' => 4, 'attacktype' => 5, 'attackrange' => 6, 'attackspeed' => 7, 'hP' => 8, 'mana' => 9, 'dmg' => 10, 'dmgMin' => 11, 'dmgMax' => 12, 'armor' => 13, 'magicArmor' => 14, 'stat' => 15, 'strength' => 16, 'strperlvl' => 17, 'agility' => 18, 'agiperlvl' => 19, 'intelligence' => 20, 'intperlvl' => 21, 'hpRegen' => 22, 'manaRegen' => 23, 'moveSpeed' => 24, 'difficulty' => 25, 'slug' => 26, ),
        BasePeer::TYPE_COLNAME => array (HeroPeer::ID => 0, HeroPeer::HERO_ID => 1, HeroPeer::NAME => 2, HeroPeer::TEAM => 3, HeroPeer::ROLE => 4, HeroPeer::ATTACKTYPE => 5, HeroPeer::ATTACKRANGE => 6, HeroPeer::ATTACKSPEED => 7, HeroPeer::HP => 8, HeroPeer::MANA => 9, HeroPeer::DMG => 10, HeroPeer::DMGMIN => 11, HeroPeer::DMGMAX => 12, HeroPeer::ARMOR => 13, HeroPeer::MAGICARMOR => 14, HeroPeer::STAT => 15, HeroPeer::STRENGTH => 16, HeroPeer::STRPERLVL => 17, HeroPeer::AGILITY => 18, HeroPeer::AGIPERLVL => 19, HeroPeer::INTELLIGENCE => 20, HeroPeer::INTPERLVL => 21, HeroPeer::HPREGEN => 22, HeroPeer::MANAREGEN => 23, HeroPeer::MOVESPEED => 24, HeroPeer::DIFFICULTY => 25, HeroPeer::SLUG => 26, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'HERO_ID' => 1, 'NAME' => 2, 'TEAM' => 3, 'ROLE' => 4, 'ATTACKTYPE' => 5, 'ATTACKRANGE' => 6, 'ATTACKSPEED' => 7, 'HP' => 8, 'MANA' => 9, 'DMG' => 10, 'DMGMIN' => 11, 'DMGMAX' => 12, 'ARMOR' => 13, 'MAGICARMOR' => 14, 'STAT' => 15, 'STRENGTH' => 16, 'STRPERLVL' => 17, 'AGILITY' => 18, 'AGIPERLVL' => 19, 'INTELLIGENCE' => 20, 'INTPERLVL' => 21, 'HPREGEN' => 22, 'MANAREGEN' => 23, 'MOVESPEED' => 24, 'DIFFICULTY' => 25, 'SLUG' => 26, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'hero_id' => 1, 'name' => 2, 'team' => 3, 'role' => 4, 'attacktype' => 5, 'attackrange' => 6, 'attackspeed' => 7, 'hp' => 8, 'mana' => 9, 'dmg' => 10, 'dmgmin' => 11, 'dmgmax' => 12, 'armor' => 13, 'magicarmor' => 14, 'stat' => 15, 'strength' => 16, 'strperlvl' => 17, 'agility' => 18, 'agiperlvl' => 19, 'intelligence' => 20, 'intperlvl' => 21, 'hpregen' => 22, 'manaregen' => 23, 'movespeed' => 24, 'difficulty' => 25, 'slug' => 26, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = HeroPeer::getFieldNames($toType);
        $key = isset(HeroPeer::$fieldKeys[$fromType][$name]) ? HeroPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(HeroPeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, HeroPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return HeroPeer::$fieldNames[$type];
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. HeroPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(HeroPeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(HeroPeer::ID);
            $criteria->addSelectColumn(HeroPeer::HERO_ID);
            $criteria->addSelectColumn(HeroPeer::NAME);
            $criteria->addSelectColumn(HeroPeer::TEAM);
            $criteria->addSelectColumn(HeroPeer::ROLE);
            $criteria->addSelectColumn(HeroPeer::ATTACKTYPE);
            $criteria->addSelectColumn(HeroPeer::ATTACKRANGE);
            $criteria->addSelectColumn(HeroPeer::ATTACKSPEED);
            $criteria->addSelectColumn(HeroPeer::HP);
            $criteria->addSelectColumn(HeroPeer::MANA);
            $criteria->addSelectColumn(HeroPeer::DMG);
            $criteria->addSelectColumn(HeroPeer::DMGMIN);
            $criteria->addSelectColumn(HeroPeer::DMGMAX);
            $criteria->addSelectColumn(HeroPeer::ARMOR);
            $criteria->addSelectColumn(HeroPeer::MAGICARMOR);
            $criteria->addSelectColumn(HeroPeer::STAT);
            $criteria->addSelectColumn(HeroPeer::STRENGTH);
            $criteria->addSelectColumn(HeroPeer::STRPERLVL);
            $criteria->addSelectColumn(HeroPeer::AGILITY);
            $criteria->addSelectColumn(HeroPeer::AGIPERLVL);
            $criteria->addSelectColumn(HeroPeer::INTELLIGENCE);
            $criteria->addSelectColumn(HeroPeer::INTPERLVL);
            $criteria->addSelectColumn(HeroPeer::HPREGEN);
            $criteria->addSelectColumn(HeroPeer::MANAREGEN);
            $criteria->addSelectColumn(HeroPeer::MOVESPEED);
            $criteria->addSelectColumn(HeroPeer::DIFFICULTY);
            $criteria->addSelectColumn(HeroPeer::SLUG);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.hero_id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.team');
            $criteria->addSelectColumn($alias . '.role');
            $criteria->addSelectColumn($alias . '.attacktype');
            $criteria->addSelectColumn($alias . '.attackrange');
            $criteria->addSelectColumn($alias . '.attackspeed');
            $criteria->addSelectColumn($alias . '.hp');
            $criteria->addSelectColumn($alias . '.mana');
            $criteria->addSelectColumn($alias . '.dmg');
            $criteria->addSelectColumn($alias . '.dmgmin');
            $criteria->addSelectColumn($alias . '.dmgmax');
            $criteria->addSelectColumn($alias . '.armor');
            $criteria->addSelectColumn($alias . '.magicarmor');
            $criteria->addSelectColumn($alias . '.stat');
            $criteria->addSelectColumn($alias . '.strength');
            $criteria->addSelectColumn($alias . '.strperlvl');
            $criteria->addSelectColumn($alias . '.agility');
            $criteria->addSelectColumn($alias . '.agiperlvl');
            $criteria->addSelectColumn($alias . '.intelligence');
            $criteria->addSelectColumn($alias . '.intperlvl');
            $criteria->addSelectColumn($alias . '.hpregen');
            $criteria->addSelectColumn($alias . '.manaregen');
            $criteria->addSelectColumn($alias . '.movespeed');
            $criteria->addSelectColumn($alias . '.difficulty');
            $criteria->addSelectColumn($alias . '.slug');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(HeroPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            HeroPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(HeroPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(HeroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return Hero
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = HeroPeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return HeroPeer::populateObjects(HeroPeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement directly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(HeroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            HeroPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(HeroPeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param Hero $obj A Hero object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            HeroPeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A Hero object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Hero) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Hero object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(HeroPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return Hero Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(HeroPeer::$instances[$key])) {
                return HeroPeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool($and_clear_all_references = false)
    {
      if ($and_clear_all_references) {
        foreach (HeroPeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        HeroPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to hero
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = HeroPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = HeroPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = HeroPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                HeroPeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (Hero object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = HeroPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = HeroPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + HeroPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = HeroPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            HeroPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(HeroPeer::DATABASE_NAME)->getTable(HeroPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseHeroPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseHeroPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new \hhc\DB\map\HeroTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass($row = 0, $colnum = 0)
    {
        return HeroPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Hero or Criteria object.
     *
     * @param      mixed $values Criteria or Hero object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(HeroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Hero object
        }

        if ($criteria->containsKey(HeroPeer::ID) && $criteria->keyContainsValue(HeroPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.HeroPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(HeroPeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a Hero or Criteria object.
     *
     * @param      mixed $values Criteria or Hero object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(HeroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(HeroPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(HeroPeer::ID);
            $value = $criteria->remove(HeroPeer::ID);
            if ($value) {
                $selectCriteria->add(HeroPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(HeroPeer::TABLE_NAME);
            }

        } else { // $values is Hero object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(HeroPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the hero table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(HeroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(HeroPeer::TABLE_NAME, $con, HeroPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HeroPeer::clearInstancePool();
            HeroPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Hero or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Hero object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(HeroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            HeroPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Hero) { // it's a model object
            // invalidate the cache for this single object
            HeroPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(HeroPeer::DATABASE_NAME);
            $criteria->add(HeroPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                HeroPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(HeroPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            HeroPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given Hero object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param Hero $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(HeroPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(HeroPeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(HeroPeer::DATABASE_NAME, HeroPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Hero
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = HeroPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(HeroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(HeroPeer::DATABASE_NAME);
        $criteria->add(HeroPeer::ID, $pk);

        $v = HeroPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Hero[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(HeroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(HeroPeer::DATABASE_NAME);
            $criteria->add(HeroPeer::ID, $pks, Criteria::IN);
            $objs = HeroPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseHeroPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseHeroPeer::buildTableMap();

