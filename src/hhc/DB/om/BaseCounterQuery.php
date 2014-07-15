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
use hhc\DB\CounterPeer;
use hhc\DB\CounterQuery;
use hhc\DB\Hero;
use hhc\DB\Vote;

/**
 * Base class that represents a query for the 'counter' table.
 *
 *
 *
 * @method CounterQuery orderById($order = Criteria::ASC) Order by the id column
 * @method CounterQuery orderByHid($order = Criteria::ASC) Order by the hid column
 * @method CounterQuery orderByCid($order = Criteria::ASC) Order by the cid column
 *
 * @method CounterQuery groupById() Group by the id column
 * @method CounterQuery groupByHid() Group by the hid column
 * @method CounterQuery groupByCid() Group by the cid column
 *
 * @method CounterQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CounterQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CounterQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method CounterQuery leftJoinHero($relationAlias = null) Adds a LEFT JOIN clause to the query using the Hero relation
 * @method CounterQuery rightJoinHero($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Hero relation
 * @method CounterQuery innerJoinHero($relationAlias = null) Adds a INNER JOIN clause to the query using the Hero relation
 *
 * @method CounterQuery leftJoinCounter($relationAlias = null) Adds a LEFT JOIN clause to the query using the Counter relation
 * @method CounterQuery rightJoinCounter($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Counter relation
 * @method CounterQuery innerJoinCounter($relationAlias = null) Adds a INNER JOIN clause to the query using the Counter relation
 *
 * @method CounterQuery leftJoinVote($relationAlias = null) Adds a LEFT JOIN clause to the query using the Vote relation
 * @method CounterQuery rightJoinVote($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Vote relation
 * @method CounterQuery innerJoinVote($relationAlias = null) Adds a INNER JOIN clause to the query using the Vote relation
 *
 * @method Counter findOne(PropelPDO $con = null) Return the first Counter matching the query
 * @method Counter findOneOrCreate(PropelPDO $con = null) Return the first Counter matching the query, or a new Counter object populated from the query conditions when no match is found
 *
 * @method Counter findOneByHid(int $hid) Return the first Counter filtered by the hid column
 * @method Counter findOneByCid(int $cid) Return the first Counter filtered by the cid column
 *
 * @method array findById(int $id) Return Counter objects filtered by the id column
 * @method array findByHid(int $hid) Return Counter objects filtered by the hid column
 * @method array findByCid(int $cid) Return Counter objects filtered by the cid column
 *
 * @package    propel.generator.hhc.om
 */
abstract class BaseCounterQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCounterQuery object.
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
            $modelName = 'hhc\\DB\\Counter';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CounterQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   CounterQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CounterQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CounterQuery) {
            return $criteria;
        }
        $query = new CounterQuery(null, null, $modelAlias);

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
     * @return   Counter|Counter[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CounterPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CounterPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Counter A model object, or null if the key is not found
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
     * @return                 Counter A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `hid`, `cid` FROM `counter` WHERE `id` = :p0';
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
            $obj = new Counter();
            $obj->hydrate($row);
            CounterPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Counter|Counter[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Counter[]|mixed the list of results, formatted by the current formatter
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
     * @return CounterQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CounterPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CounterQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CounterPeer::ID, $keys, Criteria::IN);
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
     * @return CounterQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CounterPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CounterPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CounterPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the hid column
     *
     * Example usage:
     * <code>
     * $query->filterByHid(1234); // WHERE hid = 1234
     * $query->filterByHid(array(12, 34)); // WHERE hid IN (12, 34)
     * $query->filterByHid(array('min' => 12)); // WHERE hid >= 12
     * $query->filterByHid(array('max' => 12)); // WHERE hid <= 12
     * </code>
     *
     * @see       filterByHero()
     *
     * @param     mixed $hid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CounterQuery The current query, for fluid interface
     */
    public function filterByHid($hid = null, $comparison = null)
    {
        if (is_array($hid)) {
            $useMinMax = false;
            if (isset($hid['min'])) {
                $this->addUsingAlias(CounterPeer::HID, $hid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hid['max'])) {
                $this->addUsingAlias(CounterPeer::HID, $hid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CounterPeer::HID, $hid, $comparison);
    }

    /**
     * Filter the query on the cid column
     *
     * Example usage:
     * <code>
     * $query->filterByCid(1234); // WHERE cid = 1234
     * $query->filterByCid(array(12, 34)); // WHERE cid IN (12, 34)
     * $query->filterByCid(array('min' => 12)); // WHERE cid >= 12
     * $query->filterByCid(array('max' => 12)); // WHERE cid <= 12
     * </code>
     *
     * @see       filterByCounter()
     *
     * @param     mixed $cid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CounterQuery The current query, for fluid interface
     */
    public function filterByCid($cid = null, $comparison = null)
    {
        if (is_array($cid)) {
            $useMinMax = false;
            if (isset($cid['min'])) {
                $this->addUsingAlias(CounterPeer::CID, $cid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cid['max'])) {
                $this->addUsingAlias(CounterPeer::CID, $cid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CounterPeer::CID, $cid, $comparison);
    }

    /**
     * Filter the query by a related Hero object
     *
     * @param   Hero|PropelObjectCollection $hero The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 CounterQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByHero($hero, $comparison = null)
    {
        if ($hero instanceof Hero) {
            return $this
                ->addUsingAlias(CounterPeer::HID, $hero->getId(), $comparison);
        } elseif ($hero instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CounterPeer::HID, $hero->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByHero() only accepts arguments of type Hero or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Hero relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CounterQuery The current query, for fluid interface
     */
    public function joinHero($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Hero');

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
            $this->addJoinObject($join, 'Hero');
        }

        return $this;
    }

    /**
     * Use the Hero relation Hero object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \hhc\DB\HeroQuery A secondary query class using the current class as primary query
     */
    public function useHeroQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHero($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Hero', '\hhc\DB\HeroQuery');
    }

    /**
     * Filter the query by a related Hero object
     *
     * @param   Hero|PropelObjectCollection $hero The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 CounterQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCounter($hero, $comparison = null)
    {
        if ($hero instanceof Hero) {
            return $this
                ->addUsingAlias(CounterPeer::CID, $hero->getId(), $comparison);
        } elseif ($hero instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CounterPeer::CID, $hero->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCounter() only accepts arguments of type Hero or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Counter relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CounterQuery The current query, for fluid interface
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
     * Use the Counter relation Hero object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \hhc\DB\HeroQuery A secondary query class using the current class as primary query
     */
    public function useCounterQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCounter($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Counter', '\hhc\DB\HeroQuery');
    }

    /**
     * Filter the query by a related Vote object
     *
     * @param   Vote|PropelObjectCollection $vote  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 CounterQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByVote($vote, $comparison = null)
    {
        if ($vote instanceof Vote) {
            return $this
                ->addUsingAlias(CounterPeer::ID, $vote->getCid(), $comparison);
        } elseif ($vote instanceof PropelObjectCollection) {
            return $this
                ->useVoteQuery()
                ->filterByPrimaryKeys($vote->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVote() only accepts arguments of type Vote or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Vote relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CounterQuery The current query, for fluid interface
     */
    public function joinVote($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Vote');

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
            $this->addJoinObject($join, 'Vote');
        }

        return $this;
    }

    /**
     * Use the Vote relation Vote object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \hhc\DB\VoteQuery A secondary query class using the current class as primary query
     */
    public function useVoteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVote($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Vote', '\hhc\DB\VoteQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Counter $counter Object to remove from the list of results
     *
     * @return CounterQuery The current query, for fluid interface
     */
    public function prune($counter = null)
    {
        if ($counter) {
            $this->addUsingAlias(CounterPeer::ID, $counter->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
