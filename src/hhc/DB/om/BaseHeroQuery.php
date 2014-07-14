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
use hhc\DB\Hero;
use hhc\DB\HeroPeer;
use hhc\DB\HeroQuery;
use hhc\DB\Vote;

/**
 * Base class that represents a query for the 'hero' table.
 *
 *
 *
 * @method HeroQuery orderById($order = Criteria::ASC) Order by the id column
 * @method HeroQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method HeroQuery orderByRole($order = Criteria::ASC) Order by the role column
 * @method HeroQuery orderByHP($order = Criteria::ASC) Order by the hp column
 * @method HeroQuery orderByDmg($order = Criteria::ASC) Order by the dmg column
 * @method HeroQuery orderByArmor($order = Criteria::ASC) Order by the armor column
 * @method HeroQuery orderByDifficulty($order = Criteria::ASC) Order by the difficulty column
 * @method HeroQuery orderByRange($order = Criteria::ASC) Order by the range column
 * @method HeroQuery orderBySpeed($order = Criteria::ASC) Order by the speed column
 * @method HeroQuery orderByStuns($order = Criteria::ASC) Order by the stuns column
 * @method HeroQuery orderBySide($order = Criteria::ASC) Order by the side column
 * @method HeroQuery orderByStat($order = Criteria::ASC) Order by the stat column
 * @method HeroQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 *
 * @method HeroQuery groupById() Group by the id column
 * @method HeroQuery groupByName() Group by the name column
 * @method HeroQuery groupByRole() Group by the role column
 * @method HeroQuery groupByHP() Group by the hp column
 * @method HeroQuery groupByDmg() Group by the dmg column
 * @method HeroQuery groupByArmor() Group by the armor column
 * @method HeroQuery groupByDifficulty() Group by the difficulty column
 * @method HeroQuery groupByRange() Group by the range column
 * @method HeroQuery groupBySpeed() Group by the speed column
 * @method HeroQuery groupByStuns() Group by the stuns column
 * @method HeroQuery groupBySide() Group by the side column
 * @method HeroQuery groupByStat() Group by the stat column
 * @method HeroQuery groupBySlug() Group by the slug column
 *
 * @method HeroQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method HeroQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method HeroQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method HeroQuery leftJoinHeroVote($relationAlias = null) Adds a LEFT JOIN clause to the query using the HeroVote relation
 * @method HeroQuery rightJoinHeroVote($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HeroVote relation
 * @method HeroQuery innerJoinHeroVote($relationAlias = null) Adds a INNER JOIN clause to the query using the HeroVote relation
 *
 * @method HeroQuery leftJoinCounterVote($relationAlias = null) Adds a LEFT JOIN clause to the query using the CounterVote relation
 * @method HeroQuery rightJoinCounterVote($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CounterVote relation
 * @method HeroQuery innerJoinCounterVote($relationAlias = null) Adds a INNER JOIN clause to the query using the CounterVote relation
 *
 * @method Hero findOne(PropelPDO $con = null) Return the first Hero matching the query
 * @method Hero findOneOrCreate(PropelPDO $con = null) Return the first Hero matching the query, or a new Hero object populated from the query conditions when no match is found
 *
 * @method Hero findOneByName(string $name) Return the first Hero filtered by the name column
 * @method Hero findOneByRole(string $role) Return the first Hero filtered by the role column
 * @method Hero findOneByHP(int $hp) Return the first Hero filtered by the hp column
 * @method Hero findOneByDmg(string $dmg) Return the first Hero filtered by the dmg column
 * @method Hero findOneByArmor(double $armor) Return the first Hero filtered by the armor column
 * @method Hero findOneByDifficulty(double $difficulty) Return the first Hero filtered by the difficulty column
 * @method Hero findOneByRange(int $range) Return the first Hero filtered by the range column
 * @method Hero findOneBySpeed(int $speed) Return the first Hero filtered by the speed column
 * @method Hero findOneByStuns(int $stuns) Return the first Hero filtered by the stuns column
 * @method Hero findOneBySide(string $side) Return the first Hero filtered by the side column
 * @method Hero findOneByStat(string $stat) Return the first Hero filtered by the stat column
 * @method Hero findOneBySlug(string $slug) Return the first Hero filtered by the slug column
 *
 * @method array findById(int $id) Return Hero objects filtered by the id column
 * @method array findByName(string $name) Return Hero objects filtered by the name column
 * @method array findByRole(string $role) Return Hero objects filtered by the role column
 * @method array findByHP(int $hp) Return Hero objects filtered by the hp column
 * @method array findByDmg(string $dmg) Return Hero objects filtered by the dmg column
 * @method array findByArmor(double $armor) Return Hero objects filtered by the armor column
 * @method array findByDifficulty(double $difficulty) Return Hero objects filtered by the difficulty column
 * @method array findByRange(int $range) Return Hero objects filtered by the range column
 * @method array findBySpeed(int $speed) Return Hero objects filtered by the speed column
 * @method array findByStuns(int $stuns) Return Hero objects filtered by the stuns column
 * @method array findBySide(string $side) Return Hero objects filtered by the side column
 * @method array findByStat(string $stat) Return Hero objects filtered by the stat column
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
        $sql = 'SELECT `id`, `name`, `role`, `hp`, `dmg`, `armor`, `difficulty`, `range`, `speed`, `stuns`, `side`, `stat`, `slug` FROM `hero` WHERE `id` = :p0';
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
     * Filter the query on the range column
     *
     * Example usage:
     * <code>
     * $query->filterByRange(1234); // WHERE range = 1234
     * $query->filterByRange(array(12, 34)); // WHERE range IN (12, 34)
     * $query->filterByRange(array('min' => 12)); // WHERE range >= 12
     * $query->filterByRange(array('max' => 12)); // WHERE range <= 12
     * </code>
     *
     * @param     mixed $range The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByRange($range = null, $comparison = null)
    {
        if (is_array($range)) {
            $useMinMax = false;
            if (isset($range['min'])) {
                $this->addUsingAlias(HeroPeer::RANGE, $range['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($range['max'])) {
                $this->addUsingAlias(HeroPeer::RANGE, $range['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::RANGE, $range, $comparison);
    }

    /**
     * Filter the query on the speed column
     *
     * Example usage:
     * <code>
     * $query->filterBySpeed(1234); // WHERE speed = 1234
     * $query->filterBySpeed(array(12, 34)); // WHERE speed IN (12, 34)
     * $query->filterBySpeed(array('min' => 12)); // WHERE speed >= 12
     * $query->filterBySpeed(array('max' => 12)); // WHERE speed <= 12
     * </code>
     *
     * @param     mixed $speed The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterBySpeed($speed = null, $comparison = null)
    {
        if (is_array($speed)) {
            $useMinMax = false;
            if (isset($speed['min'])) {
                $this->addUsingAlias(HeroPeer::SPEED, $speed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($speed['max'])) {
                $this->addUsingAlias(HeroPeer::SPEED, $speed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::SPEED, $speed, $comparison);
    }

    /**
     * Filter the query on the stuns column
     *
     * Example usage:
     * <code>
     * $query->filterByStuns(1234); // WHERE stuns = 1234
     * $query->filterByStuns(array(12, 34)); // WHERE stuns IN (12, 34)
     * $query->filterByStuns(array('min' => 12)); // WHERE stuns >= 12
     * $query->filterByStuns(array('max' => 12)); // WHERE stuns <= 12
     * </code>
     *
     * @param     mixed $stuns The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterByStuns($stuns = null, $comparison = null)
    {
        if (is_array($stuns)) {
            $useMinMax = false;
            if (isset($stuns['min'])) {
                $this->addUsingAlias(HeroPeer::STUNS, $stuns['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stuns['max'])) {
                $this->addUsingAlias(HeroPeer::STUNS, $stuns['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HeroPeer::STUNS, $stuns, $comparison);
    }

    /**
     * Filter the query on the side column
     *
     * Example usage:
     * <code>
     * $query->filterBySide('fooValue');   // WHERE side = 'fooValue'
     * $query->filterBySide('%fooValue%'); // WHERE side LIKE '%fooValue%'
     * </code>
     *
     * @param     string $side The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function filterBySide($side = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($side)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $side)) {
                $side = str_replace('*', '%', $side);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HeroPeer::SIDE, $side, $comparison);
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
     * Filter the query by a related Vote object
     *
     * @param   Vote|PropelObjectCollection $vote  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 HeroQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByHeroVote($vote, $comparison = null)
    {
        if ($vote instanceof Vote) {
            return $this
                ->addUsingAlias(HeroPeer::ID, $vote->getHid(), $comparison);
        } elseif ($vote instanceof PropelObjectCollection) {
            return $this
                ->useHeroVoteQuery()
                ->filterByPrimaryKeys($vote->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByHeroVote() only accepts arguments of type Vote or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the HeroVote relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function joinHeroVote($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('HeroVote');

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
            $this->addJoinObject($join, 'HeroVote');
        }

        return $this;
    }

    /**
     * Use the HeroVote relation Vote object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \hhc\DB\VoteQuery A secondary query class using the current class as primary query
     */
    public function useHeroVoteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHeroVote($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'HeroVote', '\hhc\DB\VoteQuery');
    }

    /**
     * Filter the query by a related Vote object
     *
     * @param   Vote|PropelObjectCollection $vote  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 HeroQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCounterVote($vote, $comparison = null)
    {
        if ($vote instanceof Vote) {
            return $this
                ->addUsingAlias(HeroPeer::ID, $vote->getCid(), $comparison);
        } elseif ($vote instanceof PropelObjectCollection) {
            return $this
                ->useCounterVoteQuery()
                ->filterByPrimaryKeys($vote->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCounterVote() only accepts arguments of type Vote or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CounterVote relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return HeroQuery The current query, for fluid interface
     */
    public function joinCounterVote($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CounterVote');

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
            $this->addJoinObject($join, 'CounterVote');
        }

        return $this;
    }

    /**
     * Use the CounterVote relation Vote object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \hhc\DB\VoteQuery A secondary query class using the current class as primary query
     */
    public function useCounterVoteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCounterVote($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CounterVote', '\hhc\DB\VoteQuery');
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
