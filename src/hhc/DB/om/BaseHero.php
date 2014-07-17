<?php

namespace hhc\DB\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use hhc\DB\Counter;
use hhc\DB\CounterQuery;
use hhc\DB\Hero;
use hhc\DB\HeroPeer;
use hhc\DB\HeroQuery;

/**
 * Base class that represents a row from the 'hero' table.
 *
 *
 *
 * @package    propel.generator.hhc.om
 */
abstract class BaseHero extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'hhc\\DB\\HeroPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        HeroPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the hero_id field.
     * @var        int
     */
    protected $hero_id;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the team field.
     * @var        string
     */
    protected $team;

    /**
     * The value for the role field.
     * @var        string
     */
    protected $role;

    /**
     * The value for the attacktype field.
     * @var        string
     */
    protected $attacktype;

    /**
     * The value for the attackrange field.
     * @var        int
     */
    protected $attackrange;

    /**
     * The value for the attackspeed field.
     * @var        double
     */
    protected $attackspeed;

    /**
     * The value for the hp field.
     * @var        int
     */
    protected $hp;

    /**
     * The value for the mana field.
     * @var        int
     */
    protected $mana;

    /**
     * The value for the dmg field.
     * @var        string
     */
    protected $dmg;

    /**
     * The value for the dmgmin field.
     * @var        int
     */
    protected $dmgmin;

    /**
     * The value for the dmgmax field.
     * @var        int
     */
    protected $dmgmax;

    /**
     * The value for the armor field.
     * @var        double
     */
    protected $armor;

    /**
     * The value for the magicarmor field.
     * @var        double
     */
    protected $magicarmor;

    /**
     * The value for the stat field.
     * @var        string
     */
    protected $stat;

    /**
     * The value for the strength field.
     * @var        int
     */
    protected $strength;

    /**
     * The value for the strperlvl field.
     * @var        double
     */
    protected $strperlvl;

    /**
     * The value for the agility field.
     * @var        int
     */
    protected $agility;

    /**
     * The value for the agiperlvl field.
     * @var        double
     */
    protected $agiperlvl;

    /**
     * The value for the intelligence field.
     * @var        int
     */
    protected $intelligence;

    /**
     * The value for the intperlvl field.
     * @var        double
     */
    protected $intperlvl;

    /**
     * The value for the hpregen field.
     * @var        double
     */
    protected $hpregen;

    /**
     * The value for the manaregen field.
     * @var        double
     */
    protected $manaregen;

    /**
     * The value for the movespeed field.
     * @var        int
     */
    protected $movespeed;

    /**
     * The value for the difficulty field.
     * @var        double
     */
    protected $difficulty;

    /**
     * The value for the slug field.
     * @var        string
     */
    protected $slug;

    /**
     * @var        PropelObjectCollection|Counter[] Collection to store aggregation of Counter objects.
     */
    protected $collCounters;
    protected $collCountersPartial;

    /**
     * @var        PropelObjectCollection|Counter[] Collection to store aggregation of Counter objects.
     */
    protected $collCountersRelatedByCid;
    protected $collCountersRelatedByCidPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $countersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $countersRelatedByCidScheduledForDeletion = null;

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [hero_id] column value.
     *
     * @return int
     */
    public function getHeroId()
    {

        return $this->hero_id;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {

        return $this->name;
    }

    /**
     * Get the [team] column value.
     *
     * @return string
     */
    public function getTeam()
    {

        return $this->team;
    }

    /**
     * Get the [role] column value.
     *
     * @return string
     */
    public function getRole()
    {

        return $this->role;
    }

    /**
     * Get the [attacktype] column value.
     *
     * @return string
     */
    public function getAttacktype()
    {

        return $this->attacktype;
    }

    /**
     * Get the [attackrange] column value.
     *
     * @return int
     */
    public function getAttackrange()
    {

        return $this->attackrange;
    }

    /**
     * Get the [attackspeed] column value.
     *
     * @return double
     */
    public function getAttackspeed()
    {

        return $this->attackspeed;
    }

    /**
     * Get the [hp] column value.
     *
     * @return int
     */
    public function getHP()
    {

        return $this->hp;
    }

    /**
     * Get the [mana] column value.
     *
     * @return int
     */
    public function getMana()
    {

        return $this->mana;
    }

    /**
     * Get the [dmg] column value.
     *
     * @return string
     */
    public function getDmg()
    {

        return $this->dmg;
    }

    /**
     * Get the [dmgmin] column value.
     *
     * @return int
     */
    public function getDmgMin()
    {

        return $this->dmgmin;
    }

    /**
     * Get the [dmgmax] column value.
     *
     * @return int
     */
    public function getDmgMax()
    {

        return $this->dmgmax;
    }

    /**
     * Get the [armor] column value.
     *
     * @return double
     */
    public function getArmor()
    {

        return $this->armor;
    }

    /**
     * Get the [magicarmor] column value.
     *
     * @return double
     */
    public function getMagicArmor()
    {

        return $this->magicarmor;
    }

    /**
     * Get the [stat] column value.
     *
     * @return string
     */
    public function getStat()
    {

        return $this->stat;
    }

    /**
     * Get the [strength] column value.
     *
     * @return int
     */
    public function getStrength()
    {

        return $this->strength;
    }

    /**
     * Get the [strperlvl] column value.
     *
     * @return double
     */
    public function getStrperlvl()
    {

        return $this->strperlvl;
    }

    /**
     * Get the [agility] column value.
     *
     * @return int
     */
    public function getAgility()
    {

        return $this->agility;
    }

    /**
     * Get the [agiperlvl] column value.
     *
     * @return double
     */
    public function getAgiperlvl()
    {

        return $this->agiperlvl;
    }

    /**
     * Get the [intelligence] column value.
     *
     * @return int
     */
    public function getIntelligence()
    {

        return $this->intelligence;
    }

    /**
     * Get the [intperlvl] column value.
     *
     * @return double
     */
    public function getIntperlvl()
    {

        return $this->intperlvl;
    }

    /**
     * Get the [hpregen] column value.
     *
     * @return double
     */
    public function getHpRegen()
    {

        return $this->hpregen;
    }

    /**
     * Get the [manaregen] column value.
     *
     * @return double
     */
    public function getManaRegen()
    {

        return $this->manaregen;
    }

    /**
     * Get the [movespeed] column value.
     *
     * @return int
     */
    public function getMoveSpeed()
    {

        return $this->movespeed;
    }

    /**
     * Get the [difficulty] column value.
     *
     * @return double
     */
    public function getDifficulty()
    {

        return $this->difficulty;
    }

    /**
     * Get the [slug] column value.
     *
     * @return string
     */
    public function getSlug()
    {

        return $this->slug;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = HeroPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [hero_id] column.
     *
     * @param  int $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setHeroId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->hero_id !== $v) {
            $this->hero_id = $v;
            $this->modifiedColumns[] = HeroPeer::HERO_ID;
        }


        return $this;
    } // setHeroId()

    /**
     * Set the value of [name] column.
     *
     * @param  string $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = HeroPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [team] column.
     *
     * @param  string $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setTeam($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->team !== $v) {
            $this->team = $v;
            $this->modifiedColumns[] = HeroPeer::TEAM;
        }


        return $this;
    } // setTeam()

    /**
     * Set the value of [role] column.
     *
     * @param  string $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setRole($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->role !== $v) {
            $this->role = $v;
            $this->modifiedColumns[] = HeroPeer::ROLE;
        }


        return $this;
    } // setRole()

    /**
     * Set the value of [attacktype] column.
     *
     * @param  string $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setAttacktype($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->attacktype !== $v) {
            $this->attacktype = $v;
            $this->modifiedColumns[] = HeroPeer::ATTACKTYPE;
        }


        return $this;
    } // setAttacktype()

    /**
     * Set the value of [attackrange] column.
     *
     * @param  int $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setAttackrange($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->attackrange !== $v) {
            $this->attackrange = $v;
            $this->modifiedColumns[] = HeroPeer::ATTACKRANGE;
        }


        return $this;
    } // setAttackrange()

    /**
     * Set the value of [attackspeed] column.
     *
     * @param  double $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setAttackspeed($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->attackspeed !== $v) {
            $this->attackspeed = $v;
            $this->modifiedColumns[] = HeroPeer::ATTACKSPEED;
        }


        return $this;
    } // setAttackspeed()

    /**
     * Set the value of [hp] column.
     *
     * @param  int $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setHP($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->hp !== $v) {
            $this->hp = $v;
            $this->modifiedColumns[] = HeroPeer::HP;
        }


        return $this;
    } // setHP()

    /**
     * Set the value of [mana] column.
     *
     * @param  int $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setMana($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->mana !== $v) {
            $this->mana = $v;
            $this->modifiedColumns[] = HeroPeer::MANA;
        }


        return $this;
    } // setMana()

    /**
     * Set the value of [dmg] column.
     *
     * @param  string $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setDmg($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->dmg !== $v) {
            $this->dmg = $v;
            $this->modifiedColumns[] = HeroPeer::DMG;
        }


        return $this;
    } // setDmg()

    /**
     * Set the value of [dmgmin] column.
     *
     * @param  int $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setDmgMin($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->dmgmin !== $v) {
            $this->dmgmin = $v;
            $this->modifiedColumns[] = HeroPeer::DMGMIN;
        }


        return $this;
    } // setDmgMin()

    /**
     * Set the value of [dmgmax] column.
     *
     * @param  int $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setDmgMax($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->dmgmax !== $v) {
            $this->dmgmax = $v;
            $this->modifiedColumns[] = HeroPeer::DMGMAX;
        }


        return $this;
    } // setDmgMax()

    /**
     * Set the value of [armor] column.
     *
     * @param  double $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setArmor($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->armor !== $v) {
            $this->armor = $v;
            $this->modifiedColumns[] = HeroPeer::ARMOR;
        }


        return $this;
    } // setArmor()

    /**
     * Set the value of [magicarmor] column.
     *
     * @param  double $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setMagicArmor($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->magicarmor !== $v) {
            $this->magicarmor = $v;
            $this->modifiedColumns[] = HeroPeer::MAGICARMOR;
        }


        return $this;
    } // setMagicArmor()

    /**
     * Set the value of [stat] column.
     *
     * @param  string $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setStat($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->stat !== $v) {
            $this->stat = $v;
            $this->modifiedColumns[] = HeroPeer::STAT;
        }


        return $this;
    } // setStat()

    /**
     * Set the value of [strength] column.
     *
     * @param  int $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setStrength($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->strength !== $v) {
            $this->strength = $v;
            $this->modifiedColumns[] = HeroPeer::STRENGTH;
        }


        return $this;
    } // setStrength()

    /**
     * Set the value of [strperlvl] column.
     *
     * @param  double $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setStrperlvl($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->strperlvl !== $v) {
            $this->strperlvl = $v;
            $this->modifiedColumns[] = HeroPeer::STRPERLVL;
        }


        return $this;
    } // setStrperlvl()

    /**
     * Set the value of [agility] column.
     *
     * @param  int $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setAgility($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->agility !== $v) {
            $this->agility = $v;
            $this->modifiedColumns[] = HeroPeer::AGILITY;
        }


        return $this;
    } // setAgility()

    /**
     * Set the value of [agiperlvl] column.
     *
     * @param  double $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setAgiperlvl($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->agiperlvl !== $v) {
            $this->agiperlvl = $v;
            $this->modifiedColumns[] = HeroPeer::AGIPERLVL;
        }


        return $this;
    } // setAgiperlvl()

    /**
     * Set the value of [intelligence] column.
     *
     * @param  int $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setIntelligence($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->intelligence !== $v) {
            $this->intelligence = $v;
            $this->modifiedColumns[] = HeroPeer::INTELLIGENCE;
        }


        return $this;
    } // setIntelligence()

    /**
     * Set the value of [intperlvl] column.
     *
     * @param  double $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setIntperlvl($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->intperlvl !== $v) {
            $this->intperlvl = $v;
            $this->modifiedColumns[] = HeroPeer::INTPERLVL;
        }


        return $this;
    } // setIntperlvl()

    /**
     * Set the value of [hpregen] column.
     *
     * @param  double $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setHpRegen($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->hpregen !== $v) {
            $this->hpregen = $v;
            $this->modifiedColumns[] = HeroPeer::HPREGEN;
        }


        return $this;
    } // setHpRegen()

    /**
     * Set the value of [manaregen] column.
     *
     * @param  double $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setManaRegen($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->manaregen !== $v) {
            $this->manaregen = $v;
            $this->modifiedColumns[] = HeroPeer::MANAREGEN;
        }


        return $this;
    } // setManaRegen()

    /**
     * Set the value of [movespeed] column.
     *
     * @param  int $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setMoveSpeed($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->movespeed !== $v) {
            $this->movespeed = $v;
            $this->modifiedColumns[] = HeroPeer::MOVESPEED;
        }


        return $this;
    } // setMoveSpeed()

    /**
     * Set the value of [difficulty] column.
     *
     * @param  double $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setDifficulty($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->difficulty !== $v) {
            $this->difficulty = $v;
            $this->modifiedColumns[] = HeroPeer::DIFFICULTY;
        }


        return $this;
    } // setDifficulty()

    /**
     * Set the value of [slug] column.
     *
     * @param  string $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setSlug($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->slug !== $v) {
            $this->slug = $v;
            $this->modifiedColumns[] = HeroPeer::SLUG;
        }


        return $this;
    } // setSlug()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->hero_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->team = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->role = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->attacktype = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->attackrange = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->attackspeed = ($row[$startcol + 7] !== null) ? (double) $row[$startcol + 7] : null;
            $this->hp = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->mana = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
            $this->dmg = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->dmgmin = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
            $this->dmgmax = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
            $this->armor = ($row[$startcol + 13] !== null) ? (double) $row[$startcol + 13] : null;
            $this->magicarmor = ($row[$startcol + 14] !== null) ? (double) $row[$startcol + 14] : null;
            $this->stat = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->strength = ($row[$startcol + 16] !== null) ? (int) $row[$startcol + 16] : null;
            $this->strperlvl = ($row[$startcol + 17] !== null) ? (double) $row[$startcol + 17] : null;
            $this->agility = ($row[$startcol + 18] !== null) ? (int) $row[$startcol + 18] : null;
            $this->agiperlvl = ($row[$startcol + 19] !== null) ? (double) $row[$startcol + 19] : null;
            $this->intelligence = ($row[$startcol + 20] !== null) ? (int) $row[$startcol + 20] : null;
            $this->intperlvl = ($row[$startcol + 21] !== null) ? (double) $row[$startcol + 21] : null;
            $this->hpregen = ($row[$startcol + 22] !== null) ? (double) $row[$startcol + 22] : null;
            $this->manaregen = ($row[$startcol + 23] !== null) ? (double) $row[$startcol + 23] : null;
            $this->movespeed = ($row[$startcol + 24] !== null) ? (int) $row[$startcol + 24] : null;
            $this->difficulty = ($row[$startcol + 25] !== null) ? (double) $row[$startcol + 25] : null;
            $this->slug = ($row[$startcol + 26] !== null) ? (string) $row[$startcol + 26] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 27; // 27 = HeroPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Hero object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(HeroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = HeroPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collCounters = null;

            $this->collCountersRelatedByCid = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(HeroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = HeroQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(HeroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                HeroPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->countersScheduledForDeletion !== null) {
                if (!$this->countersScheduledForDeletion->isEmpty()) {
                    CounterQuery::create()
                        ->filterByPrimaryKeys($this->countersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->countersScheduledForDeletion = null;
                }
            }

            if ($this->collCounters !== null) {
                foreach ($this->collCounters as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->countersRelatedByCidScheduledForDeletion !== null) {
                if (!$this->countersRelatedByCidScheduledForDeletion->isEmpty()) {
                    CounterQuery::create()
                        ->filterByPrimaryKeys($this->countersRelatedByCidScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->countersRelatedByCidScheduledForDeletion = null;
                }
            }

            if ($this->collCountersRelatedByCid !== null) {
                foreach ($this->collCountersRelatedByCid as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = HeroPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . HeroPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(HeroPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(HeroPeer::HERO_ID)) {
            $modifiedColumns[':p' . $index++]  = '`hero_id`';
        }
        if ($this->isColumnModified(HeroPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(HeroPeer::TEAM)) {
            $modifiedColumns[':p' . $index++]  = '`team`';
        }
        if ($this->isColumnModified(HeroPeer::ROLE)) {
            $modifiedColumns[':p' . $index++]  = '`role`';
        }
        if ($this->isColumnModified(HeroPeer::ATTACKTYPE)) {
            $modifiedColumns[':p' . $index++]  = '`attacktype`';
        }
        if ($this->isColumnModified(HeroPeer::ATTACKRANGE)) {
            $modifiedColumns[':p' . $index++]  = '`attackrange`';
        }
        if ($this->isColumnModified(HeroPeer::ATTACKSPEED)) {
            $modifiedColumns[':p' . $index++]  = '`attackspeed`';
        }
        if ($this->isColumnModified(HeroPeer::HP)) {
            $modifiedColumns[':p' . $index++]  = '`hp`';
        }
        if ($this->isColumnModified(HeroPeer::MANA)) {
            $modifiedColumns[':p' . $index++]  = '`mana`';
        }
        if ($this->isColumnModified(HeroPeer::DMG)) {
            $modifiedColumns[':p' . $index++]  = '`dmg`';
        }
        if ($this->isColumnModified(HeroPeer::DMGMIN)) {
            $modifiedColumns[':p' . $index++]  = '`dmgmin`';
        }
        if ($this->isColumnModified(HeroPeer::DMGMAX)) {
            $modifiedColumns[':p' . $index++]  = '`dmgmax`';
        }
        if ($this->isColumnModified(HeroPeer::ARMOR)) {
            $modifiedColumns[':p' . $index++]  = '`armor`';
        }
        if ($this->isColumnModified(HeroPeer::MAGICARMOR)) {
            $modifiedColumns[':p' . $index++]  = '`magicarmor`';
        }
        if ($this->isColumnModified(HeroPeer::STAT)) {
            $modifiedColumns[':p' . $index++]  = '`stat`';
        }
        if ($this->isColumnModified(HeroPeer::STRENGTH)) {
            $modifiedColumns[':p' . $index++]  = '`strength`';
        }
        if ($this->isColumnModified(HeroPeer::STRPERLVL)) {
            $modifiedColumns[':p' . $index++]  = '`strperlvl`';
        }
        if ($this->isColumnModified(HeroPeer::AGILITY)) {
            $modifiedColumns[':p' . $index++]  = '`agility`';
        }
        if ($this->isColumnModified(HeroPeer::AGIPERLVL)) {
            $modifiedColumns[':p' . $index++]  = '`agiperlvl`';
        }
        if ($this->isColumnModified(HeroPeer::INTELLIGENCE)) {
            $modifiedColumns[':p' . $index++]  = '`intelligence`';
        }
        if ($this->isColumnModified(HeroPeer::INTPERLVL)) {
            $modifiedColumns[':p' . $index++]  = '`intperlvl`';
        }
        if ($this->isColumnModified(HeroPeer::HPREGEN)) {
            $modifiedColumns[':p' . $index++]  = '`hpregen`';
        }
        if ($this->isColumnModified(HeroPeer::MANAREGEN)) {
            $modifiedColumns[':p' . $index++]  = '`manaregen`';
        }
        if ($this->isColumnModified(HeroPeer::MOVESPEED)) {
            $modifiedColumns[':p' . $index++]  = '`movespeed`';
        }
        if ($this->isColumnModified(HeroPeer::DIFFICULTY)) {
            $modifiedColumns[':p' . $index++]  = '`difficulty`';
        }
        if ($this->isColumnModified(HeroPeer::SLUG)) {
            $modifiedColumns[':p' . $index++]  = '`slug`';
        }

        $sql = sprintf(
            'INSERT INTO `hero` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`hero_id`':
                        $stmt->bindValue($identifier, $this->hero_id, PDO::PARAM_INT);
                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`team`':
                        $stmt->bindValue($identifier, $this->team, PDO::PARAM_STR);
                        break;
                    case '`role`':
                        $stmt->bindValue($identifier, $this->role, PDO::PARAM_STR);
                        break;
                    case '`attacktype`':
                        $stmt->bindValue($identifier, $this->attacktype, PDO::PARAM_STR);
                        break;
                    case '`attackrange`':
                        $stmt->bindValue($identifier, $this->attackrange, PDO::PARAM_INT);
                        break;
                    case '`attackspeed`':
                        $stmt->bindValue($identifier, $this->attackspeed, PDO::PARAM_STR);
                        break;
                    case '`hp`':
                        $stmt->bindValue($identifier, $this->hp, PDO::PARAM_INT);
                        break;
                    case '`mana`':
                        $stmt->bindValue($identifier, $this->mana, PDO::PARAM_INT);
                        break;
                    case '`dmg`':
                        $stmt->bindValue($identifier, $this->dmg, PDO::PARAM_STR);
                        break;
                    case '`dmgmin`':
                        $stmt->bindValue($identifier, $this->dmgmin, PDO::PARAM_INT);
                        break;
                    case '`dmgmax`':
                        $stmt->bindValue($identifier, $this->dmgmax, PDO::PARAM_INT);
                        break;
                    case '`armor`':
                        $stmt->bindValue($identifier, $this->armor, PDO::PARAM_STR);
                        break;
                    case '`magicarmor`':
                        $stmt->bindValue($identifier, $this->magicarmor, PDO::PARAM_STR);
                        break;
                    case '`stat`':
                        $stmt->bindValue($identifier, $this->stat, PDO::PARAM_STR);
                        break;
                    case '`strength`':
                        $stmt->bindValue($identifier, $this->strength, PDO::PARAM_INT);
                        break;
                    case '`strperlvl`':
                        $stmt->bindValue($identifier, $this->strperlvl, PDO::PARAM_STR);
                        break;
                    case '`agility`':
                        $stmt->bindValue($identifier, $this->agility, PDO::PARAM_INT);
                        break;
                    case '`agiperlvl`':
                        $stmt->bindValue($identifier, $this->agiperlvl, PDO::PARAM_STR);
                        break;
                    case '`intelligence`':
                        $stmt->bindValue($identifier, $this->intelligence, PDO::PARAM_INT);
                        break;
                    case '`intperlvl`':
                        $stmt->bindValue($identifier, $this->intperlvl, PDO::PARAM_STR);
                        break;
                    case '`hpregen`':
                        $stmt->bindValue($identifier, $this->hpregen, PDO::PARAM_STR);
                        break;
                    case '`manaregen`':
                        $stmt->bindValue($identifier, $this->manaregen, PDO::PARAM_STR);
                        break;
                    case '`movespeed`':
                        $stmt->bindValue($identifier, $this->movespeed, PDO::PARAM_INT);
                        break;
                    case '`difficulty`':
                        $stmt->bindValue($identifier, $this->difficulty, PDO::PARAM_STR);
                        break;
                    case '`slug`':
                        $stmt->bindValue($identifier, $this->slug, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = HeroPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collCounters !== null) {
                    foreach ($this->collCounters as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collCountersRelatedByCid !== null) {
                    foreach ($this->collCountersRelatedByCid as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = HeroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getHeroId();
                break;
            case 2:
                return $this->getName();
                break;
            case 3:
                return $this->getTeam();
                break;
            case 4:
                return $this->getRole();
                break;
            case 5:
                return $this->getAttacktype();
                break;
            case 6:
                return $this->getAttackrange();
                break;
            case 7:
                return $this->getAttackspeed();
                break;
            case 8:
                return $this->getHP();
                break;
            case 9:
                return $this->getMana();
                break;
            case 10:
                return $this->getDmg();
                break;
            case 11:
                return $this->getDmgMin();
                break;
            case 12:
                return $this->getDmgMax();
                break;
            case 13:
                return $this->getArmor();
                break;
            case 14:
                return $this->getMagicArmor();
                break;
            case 15:
                return $this->getStat();
                break;
            case 16:
                return $this->getStrength();
                break;
            case 17:
                return $this->getStrperlvl();
                break;
            case 18:
                return $this->getAgility();
                break;
            case 19:
                return $this->getAgiperlvl();
                break;
            case 20:
                return $this->getIntelligence();
                break;
            case 21:
                return $this->getIntperlvl();
                break;
            case 22:
                return $this->getHpRegen();
                break;
            case 23:
                return $this->getManaRegen();
                break;
            case 24:
                return $this->getMoveSpeed();
                break;
            case 25:
                return $this->getDifficulty();
                break;
            case 26:
                return $this->getSlug();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Hero'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Hero'][$this->getPrimaryKey()] = true;
        $keys = HeroPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getHeroId(),
            $keys[2] => $this->getName(),
            $keys[3] => $this->getTeam(),
            $keys[4] => $this->getRole(),
            $keys[5] => $this->getAttacktype(),
            $keys[6] => $this->getAttackrange(),
            $keys[7] => $this->getAttackspeed(),
            $keys[8] => $this->getHP(),
            $keys[9] => $this->getMana(),
            $keys[10] => $this->getDmg(),
            $keys[11] => $this->getDmgMin(),
            $keys[12] => $this->getDmgMax(),
            $keys[13] => $this->getArmor(),
            $keys[14] => $this->getMagicArmor(),
            $keys[15] => $this->getStat(),
            $keys[16] => $this->getStrength(),
            $keys[17] => $this->getStrperlvl(),
            $keys[18] => $this->getAgility(),
            $keys[19] => $this->getAgiperlvl(),
            $keys[20] => $this->getIntelligence(),
            $keys[21] => $this->getIntperlvl(),
            $keys[22] => $this->getHpRegen(),
            $keys[23] => $this->getManaRegen(),
            $keys[24] => $this->getMoveSpeed(),
            $keys[25] => $this->getDifficulty(),
            $keys[26] => $this->getSlug(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach($virtualColumns as $key => $virtualColumn)
        {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collCounters) {
                $result['Counters'] = $this->collCounters->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCountersRelatedByCid) {
                $result['CountersRelatedByCid'] = $this->collCountersRelatedByCid->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = HeroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setHeroId($value);
                break;
            case 2:
                $this->setName($value);
                break;
            case 3:
                $this->setTeam($value);
                break;
            case 4:
                $this->setRole($value);
                break;
            case 5:
                $this->setAttacktype($value);
                break;
            case 6:
                $this->setAttackrange($value);
                break;
            case 7:
                $this->setAttackspeed($value);
                break;
            case 8:
                $this->setHP($value);
                break;
            case 9:
                $this->setMana($value);
                break;
            case 10:
                $this->setDmg($value);
                break;
            case 11:
                $this->setDmgMin($value);
                break;
            case 12:
                $this->setDmgMax($value);
                break;
            case 13:
                $this->setArmor($value);
                break;
            case 14:
                $this->setMagicArmor($value);
                break;
            case 15:
                $this->setStat($value);
                break;
            case 16:
                $this->setStrength($value);
                break;
            case 17:
                $this->setStrperlvl($value);
                break;
            case 18:
                $this->setAgility($value);
                break;
            case 19:
                $this->setAgiperlvl($value);
                break;
            case 20:
                $this->setIntelligence($value);
                break;
            case 21:
                $this->setIntperlvl($value);
                break;
            case 22:
                $this->setHpRegen($value);
                break;
            case 23:
                $this->setManaRegen($value);
                break;
            case 24:
                $this->setMoveSpeed($value);
                break;
            case 25:
                $this->setDifficulty($value);
                break;
            case 26:
                $this->setSlug($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = HeroPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setHeroId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setTeam($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setRole($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setAttacktype($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setAttackrange($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setAttackspeed($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setHP($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setMana($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setDmg($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setDmgMin($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setDmgMax($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setArmor($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setMagicArmor($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setStat($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setStrength($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setStrperlvl($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setAgility($arr[$keys[18]]);
        if (array_key_exists($keys[19], $arr)) $this->setAgiperlvl($arr[$keys[19]]);
        if (array_key_exists($keys[20], $arr)) $this->setIntelligence($arr[$keys[20]]);
        if (array_key_exists($keys[21], $arr)) $this->setIntperlvl($arr[$keys[21]]);
        if (array_key_exists($keys[22], $arr)) $this->setHpRegen($arr[$keys[22]]);
        if (array_key_exists($keys[23], $arr)) $this->setManaRegen($arr[$keys[23]]);
        if (array_key_exists($keys[24], $arr)) $this->setMoveSpeed($arr[$keys[24]]);
        if (array_key_exists($keys[25], $arr)) $this->setDifficulty($arr[$keys[25]]);
        if (array_key_exists($keys[26], $arr)) $this->setSlug($arr[$keys[26]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(HeroPeer::DATABASE_NAME);

        if ($this->isColumnModified(HeroPeer::ID)) $criteria->add(HeroPeer::ID, $this->id);
        if ($this->isColumnModified(HeroPeer::HERO_ID)) $criteria->add(HeroPeer::HERO_ID, $this->hero_id);
        if ($this->isColumnModified(HeroPeer::NAME)) $criteria->add(HeroPeer::NAME, $this->name);
        if ($this->isColumnModified(HeroPeer::TEAM)) $criteria->add(HeroPeer::TEAM, $this->team);
        if ($this->isColumnModified(HeroPeer::ROLE)) $criteria->add(HeroPeer::ROLE, $this->role);
        if ($this->isColumnModified(HeroPeer::ATTACKTYPE)) $criteria->add(HeroPeer::ATTACKTYPE, $this->attacktype);
        if ($this->isColumnModified(HeroPeer::ATTACKRANGE)) $criteria->add(HeroPeer::ATTACKRANGE, $this->attackrange);
        if ($this->isColumnModified(HeroPeer::ATTACKSPEED)) $criteria->add(HeroPeer::ATTACKSPEED, $this->attackspeed);
        if ($this->isColumnModified(HeroPeer::HP)) $criteria->add(HeroPeer::HP, $this->hp);
        if ($this->isColumnModified(HeroPeer::MANA)) $criteria->add(HeroPeer::MANA, $this->mana);
        if ($this->isColumnModified(HeroPeer::DMG)) $criteria->add(HeroPeer::DMG, $this->dmg);
        if ($this->isColumnModified(HeroPeer::DMGMIN)) $criteria->add(HeroPeer::DMGMIN, $this->dmgmin);
        if ($this->isColumnModified(HeroPeer::DMGMAX)) $criteria->add(HeroPeer::DMGMAX, $this->dmgmax);
        if ($this->isColumnModified(HeroPeer::ARMOR)) $criteria->add(HeroPeer::ARMOR, $this->armor);
        if ($this->isColumnModified(HeroPeer::MAGICARMOR)) $criteria->add(HeroPeer::MAGICARMOR, $this->magicarmor);
        if ($this->isColumnModified(HeroPeer::STAT)) $criteria->add(HeroPeer::STAT, $this->stat);
        if ($this->isColumnModified(HeroPeer::STRENGTH)) $criteria->add(HeroPeer::STRENGTH, $this->strength);
        if ($this->isColumnModified(HeroPeer::STRPERLVL)) $criteria->add(HeroPeer::STRPERLVL, $this->strperlvl);
        if ($this->isColumnModified(HeroPeer::AGILITY)) $criteria->add(HeroPeer::AGILITY, $this->agility);
        if ($this->isColumnModified(HeroPeer::AGIPERLVL)) $criteria->add(HeroPeer::AGIPERLVL, $this->agiperlvl);
        if ($this->isColumnModified(HeroPeer::INTELLIGENCE)) $criteria->add(HeroPeer::INTELLIGENCE, $this->intelligence);
        if ($this->isColumnModified(HeroPeer::INTPERLVL)) $criteria->add(HeroPeer::INTPERLVL, $this->intperlvl);
        if ($this->isColumnModified(HeroPeer::HPREGEN)) $criteria->add(HeroPeer::HPREGEN, $this->hpregen);
        if ($this->isColumnModified(HeroPeer::MANAREGEN)) $criteria->add(HeroPeer::MANAREGEN, $this->manaregen);
        if ($this->isColumnModified(HeroPeer::MOVESPEED)) $criteria->add(HeroPeer::MOVESPEED, $this->movespeed);
        if ($this->isColumnModified(HeroPeer::DIFFICULTY)) $criteria->add(HeroPeer::DIFFICULTY, $this->difficulty);
        if ($this->isColumnModified(HeroPeer::SLUG)) $criteria->add(HeroPeer::SLUG, $this->slug);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(HeroPeer::DATABASE_NAME);
        $criteria->add(HeroPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Hero (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setHeroId($this->getHeroId());
        $copyObj->setName($this->getName());
        $copyObj->setTeam($this->getTeam());
        $copyObj->setRole($this->getRole());
        $copyObj->setAttacktype($this->getAttacktype());
        $copyObj->setAttackrange($this->getAttackrange());
        $copyObj->setAttackspeed($this->getAttackspeed());
        $copyObj->setHP($this->getHP());
        $copyObj->setMana($this->getMana());
        $copyObj->setDmg($this->getDmg());
        $copyObj->setDmgMin($this->getDmgMin());
        $copyObj->setDmgMax($this->getDmgMax());
        $copyObj->setArmor($this->getArmor());
        $copyObj->setMagicArmor($this->getMagicArmor());
        $copyObj->setStat($this->getStat());
        $copyObj->setStrength($this->getStrength());
        $copyObj->setStrperlvl($this->getStrperlvl());
        $copyObj->setAgility($this->getAgility());
        $copyObj->setAgiperlvl($this->getAgiperlvl());
        $copyObj->setIntelligence($this->getIntelligence());
        $copyObj->setIntperlvl($this->getIntperlvl());
        $copyObj->setHpRegen($this->getHpRegen());
        $copyObj->setManaRegen($this->getManaRegen());
        $copyObj->setMoveSpeed($this->getMoveSpeed());
        $copyObj->setDifficulty($this->getDifficulty());
        $copyObj->setSlug($this->getSlug());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getCounters() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCounter($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCountersRelatedByCid() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCounterRelatedByCid($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Hero Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return HeroPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new HeroPeer();
        }

        return self::$peer;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Counter' == $relationName) {
            $this->initCounters();
        }
        if ('CounterRelatedByCid' == $relationName) {
            $this->initCountersRelatedByCid();
        }
    }

    /**
     * Clears out the collCounters collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Hero The current object (for fluent API support)
     * @see        addCounters()
     */
    public function clearCounters()
    {
        $this->collCounters = null; // important to set this to null since that means it is uninitialized
        $this->collCountersPartial = null;

        return $this;
    }

    /**
     * reset is the collCounters collection loaded partially
     *
     * @return void
     */
    public function resetPartialCounters($v = true)
    {
        $this->collCountersPartial = $v;
    }

    /**
     * Initializes the collCounters collection.
     *
     * By default this just sets the collCounters collection to an empty array (like clearcollCounters());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCounters($overrideExisting = true)
    {
        if (null !== $this->collCounters && !$overrideExisting) {
            return;
        }
        $this->collCounters = new PropelObjectCollection();
        $this->collCounters->setModel('Counter');
    }

    /**
     * Gets an array of Counter objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Hero is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Counter[] List of Counter objects
     * @throws PropelException
     */
    public function getCounters($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCountersPartial && !$this->isNew();
        if (null === $this->collCounters || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCounters) {
                // return empty collection
                $this->initCounters();
            } else {
                $collCounters = CounterQuery::create(null, $criteria)
                    ->filterByHero($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCountersPartial && count($collCounters)) {
                      $this->initCounters(false);

                      foreach ($collCounters as $obj) {
                        if (false == $this->collCounters->contains($obj)) {
                          $this->collCounters->append($obj);
                        }
                      }

                      $this->collCountersPartial = true;
                    }

                    $collCounters->getInternalIterator()->rewind();

                    return $collCounters;
                }

                if ($partial && $this->collCounters) {
                    foreach ($this->collCounters as $obj) {
                        if ($obj->isNew()) {
                            $collCounters[] = $obj;
                        }
                    }
                }

                $this->collCounters = $collCounters;
                $this->collCountersPartial = false;
            }
        }

        return $this->collCounters;
    }

    /**
     * Sets a collection of Counter objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $counters A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Hero The current object (for fluent API support)
     */
    public function setCounters(PropelCollection $counters, PropelPDO $con = null)
    {
        $countersToDelete = $this->getCounters(new Criteria(), $con)->diff($counters);


        $this->countersScheduledForDeletion = $countersToDelete;

        foreach ($countersToDelete as $counterRemoved) {
            $counterRemoved->setHero(null);
        }

        $this->collCounters = null;
        foreach ($counters as $counter) {
            $this->addCounter($counter);
        }

        $this->collCounters = $counters;
        $this->collCountersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Counter objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Counter objects.
     * @throws PropelException
     */
    public function countCounters(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCountersPartial && !$this->isNew();
        if (null === $this->collCounters || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCounters) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCounters());
            }
            $query = CounterQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByHero($this)
                ->count($con);
        }

        return count($this->collCounters);
    }

    /**
     * Method called to associate a Counter object to this object
     * through the Counter foreign key attribute.
     *
     * @param    Counter $l Counter
     * @return Hero The current object (for fluent API support)
     */
    public function addCounter(Counter $l)
    {
        if ($this->collCounters === null) {
            $this->initCounters();
            $this->collCountersPartial = true;
        }

        if (!in_array($l, $this->collCounters->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCounter($l);

            if ($this->countersScheduledForDeletion and $this->countersScheduledForDeletion->contains($l)) {
                $this->countersScheduledForDeletion->remove($this->countersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Counter $counter The counter object to add.
     */
    protected function doAddCounter($counter)
    {
        $this->collCounters[]= $counter;
        $counter->setHero($this);
    }

    /**
     * @param	Counter $counter The counter object to remove.
     * @return Hero The current object (for fluent API support)
     */
    public function removeCounter($counter)
    {
        if ($this->getCounters()->contains($counter)) {
            $this->collCounters->remove($this->collCounters->search($counter));
            if (null === $this->countersScheduledForDeletion) {
                $this->countersScheduledForDeletion = clone $this->collCounters;
                $this->countersScheduledForDeletion->clear();
            }
            $this->countersScheduledForDeletion[]= clone $counter;
            $counter->setHero(null);
        }

        return $this;
    }

    /**
     * Clears out the collCountersRelatedByCid collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Hero The current object (for fluent API support)
     * @see        addCountersRelatedByCid()
     */
    public function clearCountersRelatedByCid()
    {
        $this->collCountersRelatedByCid = null; // important to set this to null since that means it is uninitialized
        $this->collCountersRelatedByCidPartial = null;

        return $this;
    }

    /**
     * reset is the collCountersRelatedByCid collection loaded partially
     *
     * @return void
     */
    public function resetPartialCountersRelatedByCid($v = true)
    {
        $this->collCountersRelatedByCidPartial = $v;
    }

    /**
     * Initializes the collCountersRelatedByCid collection.
     *
     * By default this just sets the collCountersRelatedByCid collection to an empty array (like clearcollCountersRelatedByCid());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCountersRelatedByCid($overrideExisting = true)
    {
        if (null !== $this->collCountersRelatedByCid && !$overrideExisting) {
            return;
        }
        $this->collCountersRelatedByCid = new PropelObjectCollection();
        $this->collCountersRelatedByCid->setModel('Counter');
    }

    /**
     * Gets an array of Counter objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Hero is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Counter[] List of Counter objects
     * @throws PropelException
     */
    public function getCountersRelatedByCid($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCountersRelatedByCidPartial && !$this->isNew();
        if (null === $this->collCountersRelatedByCid || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCountersRelatedByCid) {
                // return empty collection
                $this->initCountersRelatedByCid();
            } else {
                $collCountersRelatedByCid = CounterQuery::create(null, $criteria)
                    ->filterByCounter($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCountersRelatedByCidPartial && count($collCountersRelatedByCid)) {
                      $this->initCountersRelatedByCid(false);

                      foreach ($collCountersRelatedByCid as $obj) {
                        if (false == $this->collCountersRelatedByCid->contains($obj)) {
                          $this->collCountersRelatedByCid->append($obj);
                        }
                      }

                      $this->collCountersRelatedByCidPartial = true;
                    }

                    $collCountersRelatedByCid->getInternalIterator()->rewind();

                    return $collCountersRelatedByCid;
                }

                if ($partial && $this->collCountersRelatedByCid) {
                    foreach ($this->collCountersRelatedByCid as $obj) {
                        if ($obj->isNew()) {
                            $collCountersRelatedByCid[] = $obj;
                        }
                    }
                }

                $this->collCountersRelatedByCid = $collCountersRelatedByCid;
                $this->collCountersRelatedByCidPartial = false;
            }
        }

        return $this->collCountersRelatedByCid;
    }

    /**
     * Sets a collection of CounterRelatedByCid objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $countersRelatedByCid A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Hero The current object (for fluent API support)
     */
    public function setCountersRelatedByCid(PropelCollection $countersRelatedByCid, PropelPDO $con = null)
    {
        $countersRelatedByCidToDelete = $this->getCountersRelatedByCid(new Criteria(), $con)->diff($countersRelatedByCid);


        $this->countersRelatedByCidScheduledForDeletion = $countersRelatedByCidToDelete;

        foreach ($countersRelatedByCidToDelete as $counterRelatedByCidRemoved) {
            $counterRelatedByCidRemoved->setCounter(null);
        }

        $this->collCountersRelatedByCid = null;
        foreach ($countersRelatedByCid as $counterRelatedByCid) {
            $this->addCounterRelatedByCid($counterRelatedByCid);
        }

        $this->collCountersRelatedByCid = $countersRelatedByCid;
        $this->collCountersRelatedByCidPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Counter objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Counter objects.
     * @throws PropelException
     */
    public function countCountersRelatedByCid(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCountersRelatedByCidPartial && !$this->isNew();
        if (null === $this->collCountersRelatedByCid || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCountersRelatedByCid) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCountersRelatedByCid());
            }
            $query = CounterQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCounter($this)
                ->count($con);
        }

        return count($this->collCountersRelatedByCid);
    }

    /**
     * Method called to associate a Counter object to this object
     * through the Counter foreign key attribute.
     *
     * @param    Counter $l Counter
     * @return Hero The current object (for fluent API support)
     */
    public function addCounterRelatedByCid(Counter $l)
    {
        if ($this->collCountersRelatedByCid === null) {
            $this->initCountersRelatedByCid();
            $this->collCountersRelatedByCidPartial = true;
        }

        if (!in_array($l, $this->collCountersRelatedByCid->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCounterRelatedByCid($l);

            if ($this->countersRelatedByCidScheduledForDeletion and $this->countersRelatedByCidScheduledForDeletion->contains($l)) {
                $this->countersRelatedByCidScheduledForDeletion->remove($this->countersRelatedByCidScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	CounterRelatedByCid $counterRelatedByCid The counterRelatedByCid object to add.
     */
    protected function doAddCounterRelatedByCid($counterRelatedByCid)
    {
        $this->collCountersRelatedByCid[]= $counterRelatedByCid;
        $counterRelatedByCid->setCounter($this);
    }

    /**
     * @param	CounterRelatedByCid $counterRelatedByCid The counterRelatedByCid object to remove.
     * @return Hero The current object (for fluent API support)
     */
    public function removeCounterRelatedByCid($counterRelatedByCid)
    {
        if ($this->getCountersRelatedByCid()->contains($counterRelatedByCid)) {
            $this->collCountersRelatedByCid->remove($this->collCountersRelatedByCid->search($counterRelatedByCid));
            if (null === $this->countersRelatedByCidScheduledForDeletion) {
                $this->countersRelatedByCidScheduledForDeletion = clone $this->collCountersRelatedByCid;
                $this->countersRelatedByCidScheduledForDeletion->clear();
            }
            $this->countersRelatedByCidScheduledForDeletion[]= clone $counterRelatedByCid;
            $counterRelatedByCid->setCounter(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->hero_id = null;
        $this->name = null;
        $this->team = null;
        $this->role = null;
        $this->attacktype = null;
        $this->attackrange = null;
        $this->attackspeed = null;
        $this->hp = null;
        $this->mana = null;
        $this->dmg = null;
        $this->dmgmin = null;
        $this->dmgmax = null;
        $this->armor = null;
        $this->magicarmor = null;
        $this->stat = null;
        $this->strength = null;
        $this->strperlvl = null;
        $this->agility = null;
        $this->agiperlvl = null;
        $this->intelligence = null;
        $this->intperlvl = null;
        $this->hpregen = null;
        $this->manaregen = null;
        $this->movespeed = null;
        $this->difficulty = null;
        $this->slug = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collCounters) {
                foreach ($this->collCounters as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCountersRelatedByCid) {
                foreach ($this->collCountersRelatedByCid as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collCounters instanceof PropelCollection) {
            $this->collCounters->clearIterator();
        }
        $this->collCounters = null;
        if ($this->collCountersRelatedByCid instanceof PropelCollection) {
            $this->collCountersRelatedByCid->clearIterator();
        }
        $this->collCountersRelatedByCid = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(HeroPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
