<?php

namespace hhc\DB\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelException;
use \PropelPDO;
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
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the role field.
     * @var        string
     */
    protected $role;

    /**
     * The value for the hp field.
     * @var        int
     */
    protected $hp;

    /**
     * The value for the dmg field.
     * @var        string
     */
    protected $dmg;

    /**
     * The value for the armor field.
     * @var        double
     */
    protected $armor;

    /**
     * The value for the difficulty field.
     * @var        double
     */
    protected $difficulty;

    /**
     * The value for the range field.
     * @var        int
     */
    protected $range;

    /**
     * The value for the speed field.
     * @var        int
     */
    protected $speed;

    /**
     * The value for the stuns field.
     * @var        int
     */
    protected $stuns;

    /**
     * The value for the side field.
     * @var        string
     */
    protected $side;

    /**
     * The value for the stat field.
     * @var        string
     */
    protected $stat;

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
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->id;
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
     * Get the [role] column value.
     *
     * @return string
     */
    public function getRole()
    {

        return $this->role;
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
     * Get the [dmg] column value.
     *
     * @return string
     */
    public function getDmg()
    {

        return $this->dmg;
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
     * Get the [difficulty] column value.
     *
     * @return double
     */
    public function getDifficulty()
    {

        return $this->difficulty;
    }

    /**
     * Get the [range] column value.
     *
     * @return int
     */
    public function getRange()
    {

        return $this->range;
    }

    /**
     * Get the [speed] column value.
     *
     * @return int
     */
    public function getSpeed()
    {

        return $this->speed;
    }

    /**
     * Get the [stuns] column value.
     *
     * @return int
     */
    public function getStuns()
    {

        return $this->stuns;
    }

    /**
     * Get the [side] column value.
     *
     * @return string
     */
    public function getSide()
    {

        return $this->side;
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
     * Set the value of [range] column.
     *
     * @param  int $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setRange($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->range !== $v) {
            $this->range = $v;
            $this->modifiedColumns[] = HeroPeer::RANGE;
        }


        return $this;
    } // setRange()

    /**
     * Set the value of [speed] column.
     *
     * @param  int $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setSpeed($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->speed !== $v) {
            $this->speed = $v;
            $this->modifiedColumns[] = HeroPeer::SPEED;
        }


        return $this;
    } // setSpeed()

    /**
     * Set the value of [stuns] column.
     *
     * @param  int $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setStuns($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->stuns !== $v) {
            $this->stuns = $v;
            $this->modifiedColumns[] = HeroPeer::STUNS;
        }


        return $this;
    } // setStuns()

    /**
     * Set the value of [side] column.
     *
     * @param  string $v new value
     * @return Hero The current object (for fluent API support)
     */
    public function setSide($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->side !== $v) {
            $this->side = $v;
            $this->modifiedColumns[] = HeroPeer::SIDE;
        }


        return $this;
    } // setSide()

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
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->role = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->hp = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->dmg = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->armor = ($row[$startcol + 5] !== null) ? (double) $row[$startcol + 5] : null;
            $this->difficulty = ($row[$startcol + 6] !== null) ? (double) $row[$startcol + 6] : null;
            $this->range = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->speed = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->stuns = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
            $this->side = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->stat = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 12; // 12 = HeroPeer::NUM_HYDRATE_COLUMNS.

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
        if ($this->isColumnModified(HeroPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(HeroPeer::ROLE)) {
            $modifiedColumns[':p' . $index++]  = '`role`';
        }
        if ($this->isColumnModified(HeroPeer::HP)) {
            $modifiedColumns[':p' . $index++]  = '`hp`';
        }
        if ($this->isColumnModified(HeroPeer::DMG)) {
            $modifiedColumns[':p' . $index++]  = '`dmg`';
        }
        if ($this->isColumnModified(HeroPeer::ARMOR)) {
            $modifiedColumns[':p' . $index++]  = '`armor`';
        }
        if ($this->isColumnModified(HeroPeer::DIFFICULTY)) {
            $modifiedColumns[':p' . $index++]  = '`difficulty`';
        }
        if ($this->isColumnModified(HeroPeer::RANGE)) {
            $modifiedColumns[':p' . $index++]  = '`range`';
        }
        if ($this->isColumnModified(HeroPeer::SPEED)) {
            $modifiedColumns[':p' . $index++]  = '`speed`';
        }
        if ($this->isColumnModified(HeroPeer::STUNS)) {
            $modifiedColumns[':p' . $index++]  = '`stuns`';
        }
        if ($this->isColumnModified(HeroPeer::SIDE)) {
            $modifiedColumns[':p' . $index++]  = '`side`';
        }
        if ($this->isColumnModified(HeroPeer::STAT)) {
            $modifiedColumns[':p' . $index++]  = '`stat`';
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
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`role`':
                        $stmt->bindValue($identifier, $this->role, PDO::PARAM_STR);
                        break;
                    case '`hp`':
                        $stmt->bindValue($identifier, $this->hp, PDO::PARAM_INT);
                        break;
                    case '`dmg`':
                        $stmt->bindValue($identifier, $this->dmg, PDO::PARAM_STR);
                        break;
                    case '`armor`':
                        $stmt->bindValue($identifier, $this->armor, PDO::PARAM_STR);
                        break;
                    case '`difficulty`':
                        $stmt->bindValue($identifier, $this->difficulty, PDO::PARAM_STR);
                        break;
                    case '`range`':
                        $stmt->bindValue($identifier, $this->range, PDO::PARAM_INT);
                        break;
                    case '`speed`':
                        $stmt->bindValue($identifier, $this->speed, PDO::PARAM_INT);
                        break;
                    case '`stuns`':
                        $stmt->bindValue($identifier, $this->stuns, PDO::PARAM_INT);
                        break;
                    case '`side`':
                        $stmt->bindValue($identifier, $this->side, PDO::PARAM_STR);
                        break;
                    case '`stat`':
                        $stmt->bindValue($identifier, $this->stat, PDO::PARAM_STR);
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
                return $this->getName();
                break;
            case 2:
                return $this->getRole();
                break;
            case 3:
                return $this->getHP();
                break;
            case 4:
                return $this->getDmg();
                break;
            case 5:
                return $this->getArmor();
                break;
            case 6:
                return $this->getDifficulty();
                break;
            case 7:
                return $this->getRange();
                break;
            case 8:
                return $this->getSpeed();
                break;
            case 9:
                return $this->getStuns();
                break;
            case 10:
                return $this->getSide();
                break;
            case 11:
                return $this->getStat();
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
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {
        if (isset($alreadyDumpedObjects['Hero'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Hero'][$this->getPrimaryKey()] = true;
        $keys = HeroPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getRole(),
            $keys[3] => $this->getHP(),
            $keys[4] => $this->getDmg(),
            $keys[5] => $this->getArmor(),
            $keys[6] => $this->getDifficulty(),
            $keys[7] => $this->getRange(),
            $keys[8] => $this->getSpeed(),
            $keys[9] => $this->getStuns(),
            $keys[10] => $this->getSide(),
            $keys[11] => $this->getStat(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach($virtualColumns as $key => $virtualColumn)
        {
            $result[$key] = $virtualColumn;
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
                $this->setName($value);
                break;
            case 2:
                $this->setRole($value);
                break;
            case 3:
                $this->setHP($value);
                break;
            case 4:
                $this->setDmg($value);
                break;
            case 5:
                $this->setArmor($value);
                break;
            case 6:
                $this->setDifficulty($value);
                break;
            case 7:
                $this->setRange($value);
                break;
            case 8:
                $this->setSpeed($value);
                break;
            case 9:
                $this->setStuns($value);
                break;
            case 10:
                $this->setSide($value);
                break;
            case 11:
                $this->setStat($value);
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
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setRole($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setHP($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setDmg($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setArmor($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setDifficulty($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setRange($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setSpeed($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setStuns($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setSide($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setStat($arr[$keys[11]]);
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
        if ($this->isColumnModified(HeroPeer::NAME)) $criteria->add(HeroPeer::NAME, $this->name);
        if ($this->isColumnModified(HeroPeer::ROLE)) $criteria->add(HeroPeer::ROLE, $this->role);
        if ($this->isColumnModified(HeroPeer::HP)) $criteria->add(HeroPeer::HP, $this->hp);
        if ($this->isColumnModified(HeroPeer::DMG)) $criteria->add(HeroPeer::DMG, $this->dmg);
        if ($this->isColumnModified(HeroPeer::ARMOR)) $criteria->add(HeroPeer::ARMOR, $this->armor);
        if ($this->isColumnModified(HeroPeer::DIFFICULTY)) $criteria->add(HeroPeer::DIFFICULTY, $this->difficulty);
        if ($this->isColumnModified(HeroPeer::RANGE)) $criteria->add(HeroPeer::RANGE, $this->range);
        if ($this->isColumnModified(HeroPeer::SPEED)) $criteria->add(HeroPeer::SPEED, $this->speed);
        if ($this->isColumnModified(HeroPeer::STUNS)) $criteria->add(HeroPeer::STUNS, $this->stuns);
        if ($this->isColumnModified(HeroPeer::SIDE)) $criteria->add(HeroPeer::SIDE, $this->side);
        if ($this->isColumnModified(HeroPeer::STAT)) $criteria->add(HeroPeer::STAT, $this->stat);

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
        $copyObj->setName($this->getName());
        $copyObj->setRole($this->getRole());
        $copyObj->setHP($this->getHP());
        $copyObj->setDmg($this->getDmg());
        $copyObj->setArmor($this->getArmor());
        $copyObj->setDifficulty($this->getDifficulty());
        $copyObj->setRange($this->getRange());
        $copyObj->setSpeed($this->getSpeed());
        $copyObj->setStuns($this->getStuns());
        $copyObj->setSide($this->getSide());
        $copyObj->setStat($this->getStat());
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
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->role = null;
        $this->hp = null;
        $this->dmg = null;
        $this->armor = null;
        $this->difficulty = null;
        $this->range = null;
        $this->speed = null;
        $this->stuns = null;
        $this->side = null;
        $this->stat = null;
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

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

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
