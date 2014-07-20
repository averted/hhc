<?php

namespace hhc\DB\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use hhc\DB\Counter;
use hhc\DB\Hero;
use hhc\DB\HeroPeer;
use hhc\DB\HeroQuery;

/**
 * Base class that represents a query for the 'hero' table.
 *
 *
 *
 * @method HeroQuery orderById($order = Criteria::ASC) Order by the id column
 * @method HeroQuery orderByHeroID($order = Criteria::ASC) Order by the hero_id column
 * @method HeroQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method HeroQuery orderByTeam($order = Criteria::ASC) Order by the team column
 * @method HeroQuery orderByRole($order = Criteria::ASC) Order by the role column
 * @method HeroQuery orderByAttackType($order = Criteria::ASC) Order by the attacktype column
 * @method HeroQuery orderByAttackRange($order = Criteria::ASC) Order by the attackrange column
 * @method HeroQuery orderByAttackSpeed($order = Criteria::ASC) Order by the attackspeed column
 * @method HeroQuery orderByHP($order = Criteria::ASC) Order by the hp column
 * @method HeroQuery orderByMana($order = Criteria::ASC) Order by the mana column
 * @method HeroQuery orderByDmg($order = Criteria::ASC) Order by the dmg column
 * @method HeroQuery orderByDmgMin($order = Criteria::ASC) Order by the dmgmin column
 * @method HeroQuery orderByDmgMax($order = Criteria::ASC) Order by the dmgmax column
 * @method HeroQuery orderByArmor($order = Criteria::ASC) Order by the armor column
 * @method HeroQuery orderByMagicArmor($order = Criteria::ASC) Order by the magicarmor column
 * @method HeroQuery orderByStat($order = Criteria::ASC) Order by the stat column
 * @method HeroQuery orderByStrength($order = Criteria::ASC) Order by the strength column
 * @method HeroQuery orderByStrperlvl($order = Criteria::ASC) Order by the strperlvl column
 * @method HeroQuery orderByAgility($order = Criteria::ASC) Order by the agility column
 * @method HeroQuery orderByAgiperlvl($order = Criteria::ASC) Order by the agiperlvl column
 * @method HeroQuery orderByIntelligence($order = Criteria::ASC) Order by the intelligence column
 * @method HeroQuery orderByIntperlvl($order = Criteria::ASC) Order by the intperlvl column
 * @method HeroQuery orderByHpRegen($order = Criteria::ASC) Order by the hpregen column
 * @method HeroQuery orderByManaRegen($order = Criteria::ASC) Order by the manaregen column
 * @method HeroQuery orderByMoveSpeed($order = Criteria::ASC) Order by the movespeed column
 * @method HeroQuery orderByDifficulty($order = Criteria::ASC) Order by the difficulty column
 * @method HeroQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 *
 * @method HeroQuery groupById() Group by the id column
 * @method HeroQuery groupByHeroID() Group by the hero_id column
 * @method HeroQuery groupByName() Group by the name column
 * @method HeroQuery groupByTeam() Group by the team column
 * @method HeroQuery groupByRole() Group by the role column
 * @method HeroQuery groupByAttackType() Group by the attacktype column
 * @method HeroQuery groupByAttackRange() Group by the attackrange column
 * @method HeroQuery groupByAttackSpeed() Group by the attackspeed column
 * @method HeroQuery groupByHP() Group by the hp column
 * @method HeroQuery groupByMana() Group by the mana column
 * @method HeroQuery groupByDmg() Group by the dmg column
 * @method HeroQuery groupByDmgMin() Group by the dmgmin column
 * @method HeroQuery groupByDmgMax() Group by the dmgmax column
 * @method HeroQuery groupByArmor() Group by the armor column
 * @method HeroQuery groupByMagicArmor() Group by the magicarmor column
 * @method HeroQuery groupByStat() Group by the stat column
 * @method HeroQuery groupByStrength() Group by the strength column
 * @method HeroQuery groupByStrperlvl() Group by the strperlvl column
 * @method HeroQuery groupByAgility() Group by the agility column
 * @method HeroQuery groupByAgiperlvl() Group by the agiperlvl column
 * @method HeroQuery groupByIntelligence() Group by the intelligence column
 * @method HeroQuery groupByIntperlvl() Group by the intperlvl column
 * @method HeroQuery groupByHpRegen() Group by the hpregen column
 * @method HeroQuery groupByManaRegen() Group by the manaregen column
 * @method HeroQuery groupByMoveSpeed() Group by the movespeed column
 * @method HeroQuery groupByDifficulty() Group by the difficulty column
 * @method HeroQuery groupBySlug() Group by the slug column
 *
 * @method HeroQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method HeroQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method HeroQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method HeroQuery leftJoinCounter($relationAlias = null) Adds a LEFT JOIN clause to the query using the Counter relation
 * @method HeroQuery rightJoinCounter($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Counter relation
 * @method HeroQuery innerJoinCounter($relationAlias = null) Adds a INNER JOIN clause to the query using the Counter relation
 *
 * @method HeroQuery leftJoinCounterRelatedByCid($relationAlias = null) Adds a LEFT JOIN clause to the query using the CounterRelatedByCid relation
 * @method HeroQuery rightJoinCounterRelatedByCid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CounterRelatedByCid relation
 * @method HeroQuery innerJoinCounterRelatedByCid($relationAlias = null) Adds a INNER JOIN clause to the query using the CounterRelatedByCid relation
 *
 * @method Hero findOne(PropelPDO $con = null) Return the first Hero matching the query
 * @method Hero findOneOrCreate(PropelPDO $con = null) Return the first Hero matching the query, or a new Hero object populated from the query conditions when no match is found
 *
 * @method Hero findOneByHeroID(int $hero_id) Return the first Hero filtered by the hero_id column
 * @method Hero findOneByName(string $name) Return the first Hero filtered by the name column
 * @method Hero findOneByTeam(string $team) Return the first Hero filtered by the team column
 * @method Hero findOneByRole(string $role) Return the first Hero filtered by the role column
 * @method Hero findOneByAttackType(string $attacktype) Return the first Hero filtered by the attacktype column
 * @method Hero findOneByAttackRange(int $attackrange) Return the first Hero filtered by the attackrange column
 * @method Hero findOneByAttackSpeed(double $attackspeed) Return the first Hero filtered by the attackspeed column
 * @method Hero findOneByHP(int $hp) Return the first Hero filtered by the hp column
 * @method Hero findOneByMana(int $mana) Return the first Hero filtered by the mana column
 * @method Hero findOneByDmg(string $dmg) Return the first Hero filtered by the dmg column
 * @method Hero findOneByDmgMin(int $dmgmin) Return the first Hero filtered by the dmgmin column
 * @method Hero findOneByDmgMax(int $dmgmax) Return the first Hero filtered by the dmgmax column
 * @method Hero findOneByArmor(double $armor) Return the first Hero filtered by the armor column
 * @method Hero findOneByMagicArmor(double $magicarmor) Return the first Hero filtered by the magicarmor column
 * @method Hero findOneByStat(string $stat) Return the first Hero filtered by the stat column
 * @method Hero findOneByStrength(int $strength) Return the first Hero filtered by the strength column
 * @method Hero findOneByStrperlvl(double $strperlvl) Return the first Hero filtered by the strperlvl column
 * @method Hero findOneByAgility(int $agility) Return the first Hero filtered by the agility column
 * @method Hero findOneByAgiperlvl(double $agiperlvl) Return the first Hero filtered by the agiperlvl column
 * @method Hero findOneByIntelligence(int $intelligence) Return the first Hero filtered by the intelligence column
 * @method Hero findOneByIntperlvl(double $intperlvl) Return the first Hero filtered by the intperlvl column
 * @method Hero findOneByHpRegen(double $hpregen) Return the first Hero filtered by the hpregen column
 * @method Hero findOneByManaRegen(double $manaregen) Return the first Hero filtered by the manaregen column
 * @method Hero findOneByMoveSpeed(int $movespeed) Return the first Hero filtered by the movespeed column
 * @method Hero findOneByDifficulty(double $difficulty) Return the first Hero filtered by the difficulty column
 * @method Hero findOneBySlug(string $slug) Return the first Hero filtered by the slug column
 *
 * @method array findById(int $id) Return Hero objects filtered by the id column
 * @method array findByHeroID(int $hero_id) Return Hero objects filtered by the hero_id column
 * @method array findByName(string $name) Return Hero objects filtered by the name column
 * @method array findByTeam(string $team) Return Hero objects filtered by the team column
 * @method array findByRole(string $role) Return Hero objects filtered by the role column
 * @method array findByAttackType(string $attacktype) Return Hero objects filtered by the attacktype column
 * @method array findByAttackRange(int $attackrange) Return Hero objects filtered by the attackrange column
 * @method array findByAttackSpeed(double $attackspeed) Return Hero objects filtered by the attackspeed column
 * @method array findByHP(int $hp) Return Hero objects filtered by the hp column
 * @method array findByMana(int $mana) Return Hero objects filtered by the mana column
 * @method array findByDmg(string $dmg) Return Hero objects filtered by the dmg column
 * @method array findByDmgMin(int $dmgmin) Return Hero objects filtered by the dmgmin column
 * @method array findByDmgMax(int $dmgmax) Return Hero objects filtered by the dmgmax column
 * @method array findByArmor(double $armor) Return Hero objects filtered by the armor column
 * @method array findByMagicArmor(double $magicarmor) Return Hero objects filtered by the magicarmor column
 * @method array findByStat(string $stat) Return Hero objects filtered by the stat column
 * @method array findByStrength(int $strength) Return Hero objects filtered by the strength column
 * @method array findByStrperlvl(double $strperlvl) Return Hero objects filtered by the strperlvl column
 * @method array findByAgility(int $agility) Return Hero objects filtered by the agility column
 * @method array findByAgiperlvl(double $agiperlvl) Return Hero objects filtered by the agiperlvl column
 * @method array findByIntelligence(int $intelligence) Return Hero objects filtered by the intelligence column
 * @method array findByIntperlvl(double $intperlvl) Return Hero objects filtered by the intperlvl column
 * @method array findByHpRegen(double $hpregen) Return Hero objects filtered by the hpregen column
 * @method array findByManaRegen(double $manaregen) Return Hero objects filtered by the manaregen column
 * @method array findByMoveSpeed(int $movespeed) Return Hero objects filtered by the movespeed column
 * @method array findByDifficulty(double $difficulty) Return Hero objects filtered by the difficulty column
 * @method array findBySlug(string $slug) Return Hero objects filtered by the slug column
 *
 * @package    propel.generator.hhc.om
 */
abstract class BaseHeroQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseHeroQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'hhc';
        }
        if (null === $modelName) {
            $modelName = 'hhc\\DB\\Hero';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new HeroQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   HeroQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return HeroQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof HeroQuery) {
            return $criteria;
        }
        $query = new HeroQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Hero|Hero[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = HeroPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(HeroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Hero A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Hero A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `hero_id`, `name`, `team`, `role`, `attacktype`, `attackrange`, `attackspeed`, `hp`, `mana`, `dmg`, `dmgmin`, `dmgmax`, `armor`, `magicarmor`, `stat`, `strength`, `strperlvl`, `agility`, `agiperlvl`, `intelligence`, `intperlvl`, `hpregen`, `manaregen`, `movespeed`, `difficulty`, `slug` FROM `hero` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Hero();
            $obj->hydrate($row);
            HeroPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Hero|Hero[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Hero[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HeroPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HeroPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(HeroPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(HeroPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the hero_id column
     *
     * Example usage:
     * <code>
     * $query->filterByHeroID(1234); // WHERE hero_id = 1234
     * $query->filterByHeroID(array(12, 34)); // WHERE hero_id IN (12, 34)
     * $query->filterByHeroID(array('min' => 12)); // WHERE hero_id >= 12
     * $query->filterByHeroID(array('max' => 12)); // WHERE hero_id <= 12
     * </code>
     *
     * @param     mixed $heroID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByHeroID($heroID = null, $comparison = null)
    {
        if (is_array($heroID)) {
            $useMinMax = false;
            if (isset($heroID['min'])) {
                $this->addUsingAlias(HeroPeer::HERO_ID, $heroID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($heroID['max'])) {
                $this->addUsingAlias(HeroPeer::HERO_ID, $heroID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::HERO_ID, $heroID, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HeroPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the team column
     *
     * Example usage:
     * <code>
     * $query->filterByTeam('fooValue');   // WHERE team = 'fooValue'
     * $query->filterByTeam('%fooValue%'); // WHERE team LIKE '%fooValue%'
     * </code>
     *
     * @param     string $team The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByTeam($team = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($team)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $team)) {
                $team = str_replace('*', '%', $team);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HeroPeer::TEAM, $team, $comparison);
    }

    /**
     * Filter the query on the role column
     *
     * Example usage:
     * <code>
     * $query->filterByRole('fooValue');   // WHERE role = 'fooValue'
     * $query->filterByRole('%fooValue%'); // WHERE role LIKE '%fooValue%'
     * </code>
     *
     * @param     string $role The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByRole($role = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($role)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $role)) {
                $role = str_replace('*', '%', $role);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HeroPeer::ROLE, $role, $comparison);
    }

    /**
     * Filter the query on the attacktype column
     *
     * Example usage:
     * <code>
     * $query->filterByAttackType('fooValue');   // WHERE attacktype = 'fooValue'
     * $query->filterByAttackType('%fooValue%'); // WHERE attacktype LIKE '%fooValue%'
     * </code>
     *
     * @param     string $attackType The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByAttackType($attackType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($attackType)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $attackType)) {
                $attackType = str_replace('*', '%', $attackType);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HeroPeer::ATTACKTYPE, $attackType, $comparison);
    }

    /**
     * Filter the query on the attackrange column
     *
     * Example usage:
     * <code>
     * $query->filterByAttackRange(1234); // WHERE attackrange = 1234
     * $query->filterByAttackRange(array(12, 34)); // WHERE attackrange IN (12, 34)
     * $query->filterByAttackRange(array('min' => 12)); // WHERE attackrange >= 12
     * $query->filterByAttackRange(array('max' => 12)); // WHERE attackrange <= 12
     * </code>
     *
     * @param     mixed $attackRange The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByAttackRange($attackRange = null, $comparison = null)
    {
        if (is_array($attackRange)) {
            $useMinMax = false;
            if (isset($attackRange['min'])) {
                $this->addUsingAlias(HeroPeer::ATTACKRANGE, $attackRange['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($attackRange['max'])) {
                $this->addUsingAlias(HeroPeer::ATTACKRANGE, $attackRange['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::ATTACKRANGE, $attackRange, $comparison);
    }

    /**
     * Filter the query on the attackspeed column
     *
     * Example usage:
     * <code>
     * $query->filterByAttackSpeed(1234); // WHERE attackspeed = 1234
     * $query->filterByAttackSpeed(array(12, 34)); // WHERE attackspeed IN (12, 34)
     * $query->filterByAttackSpeed(array('min' => 12)); // WHERE attackspeed >= 12
     * $query->filterByAttackSpeed(array('max' => 12)); // WHERE attackspeed <= 12
     * </code>
     *
     * @param     mixed $attackSpeed The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByAttackSpeed($attackSpeed = null, $comparison = null)
    {
        if (is_array($attackSpeed)) {
            $useMinMax = false;
            if (isset($attackSpeed['min'])) {
                $this->addUsingAlias(HeroPeer::ATTACKSPEED, $attackSpeed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($attackSpeed['max'])) {
                $this->addUsingAlias(HeroPeer::ATTACKSPEED, $attackSpeed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::ATTACKSPEED, $attackSpeed, $comparison);
    }

    /**
     * Filter the query on the hp column
     *
     * Example usage:
     * <code>
     * $query->filterByHP(1234); // WHERE hp = 1234
     * $query->filterByHP(array(12, 34)); // WHERE hp IN (12, 34)
     * $query->filterByHP(array('min' => 12)); // WHERE hp >= 12
     * $query->filterByHP(array('max' => 12)); // WHERE hp <= 12
     * </code>
     *
     * @param     mixed $hP The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByHP($hP = null, $comparison = null)
    {
        if (is_array($hP)) {
            $useMinMax = false;
            if (isset($hP['min'])) {
                $this->addUsingAlias(HeroPeer::HP, $hP['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hP['max'])) {
                $this->addUsingAlias(HeroPeer::HP, $hP['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::HP, $hP, $comparison);
    }

    /**
     * Filter the query on the mana column
     *
     * Example usage:
     * <code>
     * $query->filterByMana(1234); // WHERE mana = 1234
     * $query->filterByMana(array(12, 34)); // WHERE mana IN (12, 34)
     * $query->filterByMana(array('min' => 12)); // WHERE mana >= 12
     * $query->filterByMana(array('max' => 12)); // WHERE mana <= 12
     * </code>
     *
     * @param     mixed $mana The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByMana($mana = null, $comparison = null)
    {
        if (is_array($mana)) {
            $useMinMax = false;
            if (isset($mana['min'])) {
                $this->addUsingAlias(HeroPeer::MANA, $mana['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mana['max'])) {
                $this->addUsingAlias(HeroPeer::MANA, $mana['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::MANA, $mana, $comparison);
    }

    /**
     * Filter the query on the dmg column
     *
     * Example usage:
     * <code>
     * $query->filterByDmg('fooValue');   // WHERE dmg = 'fooValue'
     * $query->filterByDmg('%fooValue%'); // WHERE dmg LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dmg The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByDmg($dmg = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dmg)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $dmg)) {
                $dmg = str_replace('*', '%', $dmg);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HeroPeer::DMG, $dmg, $comparison);
    }

    /**
     * Filter the query on the dmgmin column
     *
     * Example usage:
     * <code>
     * $query->filterByDmgMin(1234); // WHERE dmgmin = 1234
     * $query->filterByDmgMin(array(12, 34)); // WHERE dmgmin IN (12, 34)
     * $query->filterByDmgMin(array('min' => 12)); // WHERE dmgmin >= 12
     * $query->filterByDmgMin(array('max' => 12)); // WHERE dmgmin <= 12
     * </code>
     *
     * @param     mixed $dmgMin The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByDmgMin($dmgMin = null, $comparison = null)
    {
        if (is_array($dmgMin)) {
            $useMinMax = false;
            if (isset($dmgMin['min'])) {
                $this->addUsingAlias(HeroPeer::DMGMIN, $dmgMin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dmgMin['max'])) {
                $this->addUsingAlias(HeroPeer::DMGMIN, $dmgMin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::DMGMIN, $dmgMin, $comparison);
    }

    /**
     * Filter the query on the dmgmax column
     *
     * Example usage:
     * <code>
     * $query->filterByDmgMax(1234); // WHERE dmgmax = 1234
     * $query->filterByDmgMax(array(12, 34)); // WHERE dmgmax IN (12, 34)
     * $query->filterByDmgMax(array('min' => 12)); // WHERE dmgmax >= 12
     * $query->filterByDmgMax(array('max' => 12)); // WHERE dmgmax <= 12
     * </code>
     *
     * @param     mixed $dmgMax The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByDmgMax($dmgMax = null, $comparison = null)
    {
        if (is_array($dmgMax)) {
            $useMinMax = false;
            if (isset($dmgMax['min'])) {
                $this->addUsingAlias(HeroPeer::DMGMAX, $dmgMax['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dmgMax['max'])) {
                $this->addUsingAlias(HeroPeer::DMGMAX, $dmgMax['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::DMGMAX, $dmgMax, $comparison);
    }

    /**
     * Filter the query on the armor column
     *
     * Example usage:
     * <code>
     * $query->filterByArmor(1234); // WHERE armor = 1234
     * $query->filterByArmor(array(12, 34)); // WHERE armor IN (12, 34)
     * $query->filterByArmor(array('min' => 12)); // WHERE armor >= 12
     * $query->filterByArmor(array('max' => 12)); // WHERE armor <= 12
     * </code>
     *
     * @param     mixed $armor The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByArmor($armor = null, $comparison = null)
    {
        if (is_array($armor)) {
            $useMinMax = false;
            if (isset($armor['min'])) {
                $this->addUsingAlias(HeroPeer::ARMOR, $armor['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($armor['max'])) {
                $this->addUsingAlias(HeroPeer::ARMOR, $armor['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::ARMOR, $armor, $comparison);
    }

    /**
     * Filter the query on the magicarmor column
     *
     * Example usage:
     * <code>
     * $query->filterByMagicArmor(1234); // WHERE magicarmor = 1234
     * $query->filterByMagicArmor(array(12, 34)); // WHERE magicarmor IN (12, 34)
     * $query->filterByMagicArmor(array('min' => 12)); // WHERE magicarmor >= 12
     * $query->filterByMagicArmor(array('max' => 12)); // WHERE magicarmor <= 12
     * </code>
     *
     * @param     mixed $magicArmor The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByMagicArmor($magicArmor = null, $comparison = null)
    {
        if (is_array($magicArmor)) {
            $useMinMax = false;
            if (isset($magicArmor['min'])) {
                $this->addUsingAlias(HeroPeer::MAGICARMOR, $magicArmor['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($magicArmor['max'])) {
                $this->addUsingAlias(HeroPeer::MAGICARMOR, $magicArmor['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::MAGICARMOR, $magicArmor, $comparison);
    }

    /**
     * Filter the query on the stat column
     *
     * Example usage:
     * <code>
     * $query->filterByStat('fooValue');   // WHERE stat = 'fooValue'
     * $query->filterByStat('%fooValue%'); // WHERE stat LIKE '%fooValue%'
     * </code>
     *
     * @param     string $stat The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByStat($stat = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($stat)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $stat)) {
                $stat = str_replace('*', '%', $stat);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HeroPeer::STAT, $stat, $comparison);
    }

    /**
     * Filter the query on the strength column
     *
     * Example usage:
     * <code>
     * $query->filterByStrength(1234); // WHERE strength = 1234
     * $query->filterByStrength(array(12, 34)); // WHERE strength IN (12, 34)
     * $query->filterByStrength(array('min' => 12)); // WHERE strength >= 12
     * $query->filterByStrength(array('max' => 12)); // WHERE strength <= 12
     * </code>
     *
     * @param     mixed $strength The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByStrength($strength = null, $comparison = null)
    {
        if (is_array($strength)) {
            $useMinMax = false;
            if (isset($strength['min'])) {
                $this->addUsingAlias(HeroPeer::STRENGTH, $strength['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($strength['max'])) {
                $this->addUsingAlias(HeroPeer::STRENGTH, $strength['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::STRENGTH, $strength, $comparison);
    }

    /**
     * Filter the query on the strperlvl column
     *
     * Example usage:
     * <code>
     * $query->filterByStrperlvl(1234); // WHERE strperlvl = 1234
     * $query->filterByStrperlvl(array(12, 34)); // WHERE strperlvl IN (12, 34)
     * $query->filterByStrperlvl(array('min' => 12)); // WHERE strperlvl >= 12
     * $query->filterByStrperlvl(array('max' => 12)); // WHERE strperlvl <= 12
     * </code>
     *
     * @param     mixed $strperlvl The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByStrperlvl($strperlvl = null, $comparison = null)
    {
        if (is_array($strperlvl)) {
            $useMinMax = false;
            if (isset($strperlvl['min'])) {
                $this->addUsingAlias(HeroPeer::STRPERLVL, $strperlvl['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($strperlvl['max'])) {
                $this->addUsingAlias(HeroPeer::STRPERLVL, $strperlvl['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::STRPERLVL, $strperlvl, $comparison);
    }

    /**
     * Filter the query on the agility column
     *
     * Example usage:
     * <code>
     * $query->filterByAgility(1234); // WHERE agility = 1234
     * $query->filterByAgility(array(12, 34)); // WHERE agility IN (12, 34)
     * $query->filterByAgility(array('min' => 12)); // WHERE agility >= 12
     * $query->filterByAgility(array('max' => 12)); // WHERE agility <= 12
     * </code>
     *
     * @param     mixed $agility The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByAgility($agility = null, $comparison = null)
    {
        if (is_array($agility)) {
            $useMinMax = false;
            if (isset($agility['min'])) {
                $this->addUsingAlias(HeroPeer::AGILITY, $agility['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($agility['max'])) {
                $this->addUsingAlias(HeroPeer::AGILITY, $agility['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::AGILITY, $agility, $comparison);
    }

    /**
     * Filter the query on the agiperlvl column
     *
     * Example usage:
     * <code>
     * $query->filterByAgiperlvl(1234); // WHERE agiperlvl = 1234
     * $query->filterByAgiperlvl(array(12, 34)); // WHERE agiperlvl IN (12, 34)
     * $query->filterByAgiperlvl(array('min' => 12)); // WHERE agiperlvl >= 12
     * $query->filterByAgiperlvl(array('max' => 12)); // WHERE agiperlvl <= 12
     * </code>
     *
     * @param     mixed $agiperlvl The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByAgiperlvl($agiperlvl = null, $comparison = null)
    {
        if (is_array($agiperlvl)) {
            $useMinMax = false;
            if (isset($agiperlvl['min'])) {
                $this->addUsingAlias(HeroPeer::AGIPERLVL, $agiperlvl['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($agiperlvl['max'])) {
                $this->addUsingAlias(HeroPeer::AGIPERLVL, $agiperlvl['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::AGIPERLVL, $agiperlvl, $comparison);
    }

    /**
     * Filter the query on the intelligence column
     *
     * Example usage:
     * <code>
     * $query->filterByIntelligence(1234); // WHERE intelligence = 1234
     * $query->filterByIntelligence(array(12, 34)); // WHERE intelligence IN (12, 34)
     * $query->filterByIntelligence(array('min' => 12)); // WHERE intelligence >= 12
     * $query->filterByIntelligence(array('max' => 12)); // WHERE intelligence <= 12
     * </code>
     *
     * @param     mixed $intelligence The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByIntelligence($intelligence = null, $comparison = null)
    {
        if (is_array($intelligence)) {
            $useMinMax = false;
            if (isset($intelligence['min'])) {
                $this->addUsingAlias(HeroPeer::INTELLIGENCE, $intelligence['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($intelligence['max'])) {
                $this->addUsingAlias(HeroPeer::INTELLIGENCE, $intelligence['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::INTELLIGENCE, $intelligence, $comparison);
    }

    /**
     * Filter the query on the intperlvl column
     *
     * Example usage:
     * <code>
     * $query->filterByIntperlvl(1234); // WHERE intperlvl = 1234
     * $query->filterByIntperlvl(array(12, 34)); // WHERE intperlvl IN (12, 34)
     * $query->filterByIntperlvl(array('min' => 12)); // WHERE intperlvl >= 12
     * $query->filterByIntperlvl(array('max' => 12)); // WHERE intperlvl <= 12
     * </code>
     *
     * @param     mixed $intperlvl The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByIntperlvl($intperlvl = null, $comparison = null)
    {
        if (is_array($intperlvl)) {
            $useMinMax = false;
            if (isset($intperlvl['min'])) {
                $this->addUsingAlias(HeroPeer::INTPERLVL, $intperlvl['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($intperlvl['max'])) {
                $this->addUsingAlias(HeroPeer::INTPERLVL, $intperlvl['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::INTPERLVL, $intperlvl, $comparison);
    }

    /**
     * Filter the query on the hpregen column
     *
     * Example usage:
     * <code>
     * $query->filterByHpRegen(1234); // WHERE hpregen = 1234
     * $query->filterByHpRegen(array(12, 34)); // WHERE hpregen IN (12, 34)
     * $query->filterByHpRegen(array('min' => 12)); // WHERE hpregen >= 12
     * $query->filterByHpRegen(array('max' => 12)); // WHERE hpregen <= 12
     * </code>
     *
     * @param     mixed $hpRegen The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByHpRegen($hpRegen = null, $comparison = null)
    {
        if (is_array($hpRegen)) {
            $useMinMax = false;
            if (isset($hpRegen['min'])) {
                $this->addUsingAlias(HeroPeer::HPREGEN, $hpRegen['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hpRegen['max'])) {
                $this->addUsingAlias(HeroPeer::HPREGEN, $hpRegen['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::HPREGEN, $hpRegen, $comparison);
    }

    /**
     * Filter the query on the manaregen column
     *
     * Example usage:
     * <code>
     * $query->filterByManaRegen(1234); // WHERE manaregen = 1234
     * $query->filterByManaRegen(array(12, 34)); // WHERE manaregen IN (12, 34)
     * $query->filterByManaRegen(array('min' => 12)); // WHERE manaregen >= 12
     * $query->filterByManaRegen(array('max' => 12)); // WHERE manaregen <= 12
     * </code>
     *
     * @param     mixed $manaRegen The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByManaRegen($manaRegen = null, $comparison = null)
    {
        if (is_array($manaRegen)) {
            $useMinMax = false;
            if (isset($manaRegen['min'])) {
                $this->addUsingAlias(HeroPeer::MANAREGEN, $manaRegen['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($manaRegen['max'])) {
                $this->addUsingAlias(HeroPeer::MANAREGEN, $manaRegen['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::MANAREGEN, $manaRegen, $comparison);
    }

    /**
     * Filter the query on the movespeed column
     *
     * Example usage:
     * <code>
     * $query->filterByMoveSpeed(1234); // WHERE movespeed = 1234
     * $query->filterByMoveSpeed(array(12, 34)); // WHERE movespeed IN (12, 34)
     * $query->filterByMoveSpeed(array('min' => 12)); // WHERE movespeed >= 12
     * $query->filterByMoveSpeed(array('max' => 12)); // WHERE movespeed <= 12
     * </code>
     *
     * @param     mixed $moveSpeed The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByMoveSpeed($moveSpeed = null, $comparison = null)
    {
        if (is_array($moveSpeed)) {
            $useMinMax = false;
            if (isset($moveSpeed['min'])) {
                $this->addUsingAlias(HeroPeer::MOVESPEED, $moveSpeed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($moveSpeed['max'])) {
                $this->addUsingAlias(HeroPeer::MOVESPEED, $moveSpeed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::MOVESPEED, $moveSpeed, $comparison);
    }

    /**
     * Filter the query on the difficulty column
     *
     * Example usage:
     * <code>
     * $query->filterByDifficulty(1234); // WHERE difficulty = 1234
     * $query->filterByDifficulty(array(12, 34)); // WHERE difficulty IN (12, 34)
     * $query->filterByDifficulty(array('min' => 12)); // WHERE difficulty >= 12
     * $query->filterByDifficulty(array('max' => 12)); // WHERE difficulty <= 12
     * </code>
     *
     * @param     mixed $difficulty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByDifficulty($difficulty = null, $comparison = null)
    {
        if (is_array($difficulty)) {
            $useMinMax = false;
            if (isset($difficulty['min'])) {
                $this->addUsingAlias(HeroPeer::DIFFICULTY, $difficulty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($difficulty['max'])) {
                $this->addUsingAlias(HeroPeer::DIFFICULTY, $difficulty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::DIFFICULTY, $difficulty, $comparison);
    }

    /**
     * Filter the query on the slug column
     *
     * Example usage:
     * <code>
     * $query->filterBySlug('fooValue');   // WHERE slug = 'fooValue'
     * $query->filterBySlug('%fooValue%'); // WHERE slug LIKE '%fooValue%'
     * </code>
     *
     * @param     string $slug The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterBySlug($slug = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($slug)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $slug)) {
                $slug = str_replace('*', '%', $slug);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HeroPeer::SLUG, $slug, $comparison);
    }

    /**
     * Filter the query by a related Counter object
     *
     * @param   Counter|PropelObjectCollection $counter  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 HeroQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCounter($counter, $comparison = null)
    {
        if ($counter instanceof Counter) {
            return $this
                ->addUsingAlias(HeroPeer::ID, $counter->getHid(), $comparison);
        } elseif ($counter instanceof PropelObjectCollection) {
            return $this
                ->useCounterQuery()
                ->filterByPrimaryKeys($counter->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCounter() only accepts arguments of type Counter or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Counter relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function joinCounter($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Counter');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Counter');
        }

        return $this;
    }

    /**
     * Use the Counter relation Counter object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \hhc\DB\CounterQuery A secondary query class using the current class as primary query
     */
    public function useCounterQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCounter($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Counter', '\hhc\DB\CounterQuery');
    }

    /**
     * Filter the query by a related Counter object
     *
     * @param   Counter|PropelObjectCollection $counter  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 HeroQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCounterRelatedByCid($counter, $comparison = null)
    {
        if ($counter instanceof Counter) {
            return $this
                ->addUsingAlias(HeroPeer::ID, $counter->getCid(), $comparison);
        } elseif ($counter instanceof PropelObjectCollection) {
            return $this
                ->useCounterRelatedByCidQuery()
                ->filterByPrimaryKeys($counter->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCounterRelatedByCid() only accepts arguments of type Counter or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CounterRelatedByCid relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function joinCounterRelatedByCid($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CounterRelatedByCid');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'CounterRelatedByCid');
        }

        return $this;
    }

    /**
     * Use the CounterRelatedByCid relation Counter object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \hhc\DB\CounterQuery A secondary query class using the current class as primary query
     */
    public function useCounterRelatedByCidQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCounterRelatedByCid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CounterRelatedByCid', '\hhc\DB\CounterQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Hero $hero Object to remove from the list of results
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function prune($hero = null)
    {
        if ($hero) {
            $this->addUsingAlias(HeroPeer::ID, $hero->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
