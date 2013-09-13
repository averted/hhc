<?php

namespace hhc\DB\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \PDO;
use \Propel;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use hhc\DB\Votes;
use hhc\DB\VotesPeer;
use hhc\DB\VotesQuery;

/**
 * Base class that represents a query for the 'votes' table.
 *
 *
 *
 * @method VotesQuery orderByHeroName($order = Criteria::ASC) Order by the hero_name column
 * @method VotesQuery orderByCounterName($order = Criteria::ASC) Order by the counter_name column
 * @method VotesQuery orderByVotes($order = Criteria::ASC) Order by the votes column
 *
 * @method VotesQuery groupByHeroName() Group by the hero_name column
 * @method VotesQuery groupByCounterName() Group by the counter_name column
 * @method VotesQuery groupByVotes() Group by the votes column
 *
 * @method VotesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method VotesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method VotesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Votes findOne(PropelPDO $con = null) Return the first Votes matching the query
 * @method Votes findOneOrCreate(PropelPDO $con = null) Return the first Votes matching the query, or a new Votes object populated from the query conditions when no match is found
 *
 * @method Votes findOneByHeroName(string $hero_name) Return the first Votes filtered by the hero_name column
 * @method Votes findOneByCounterName(string $counter_name) Return the first Votes filtered by the counter_name column
 * @method Votes findOneByVotes(int $votes) Return the first Votes filtered by the votes column
 *
 * @method array findByHeroName(string $hero_name) Return Votes objects filtered by the hero_name column
 * @method array findByCounterName(string $counter_name) Return Votes objects filtered by the counter_name column
 * @method array findByVotes(int $votes) Return Votes objects filtered by the votes column
 *
 * @package    propel.generator.hhc.om
 */
abstract class BaseVotesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseVotesQuery object.
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
            $modelName = 'hhc\\DB\\Votes';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new VotesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   VotesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return VotesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof VotesQuery) {
            return $criteria;
        }
        $query = new VotesQuery(null, null, $modelAlias);

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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$hero_name, $counter_name]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Votes|Votes[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = VotesPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(VotesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Votes A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `hero_name`, `counter_name`, `votes` FROM `votes` WHERE `hero_name` = :p0 AND `counter_name` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Votes();
            $obj->hydrate($row);
            VotesPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return Votes|Votes[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Votes[]|mixed the list of results, formatted by the current formatter
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
     * @return VotesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(VotesPeer::HERO_NAME, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(VotesPeer::COUNTER_NAME, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return VotesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(VotesPeer::HERO_NAME, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(VotesPeer::COUNTER_NAME, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the hero_name column
     *
     * Example usage:
     * <code>
     * $query->filterByHeroName('fooValue');   // WHERE hero_name = 'fooValue'
     * $query->filterByHeroName('%fooValue%'); // WHERE hero_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $heroName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VotesQuery The current query, for fluid interface
     */
    public function filterByHeroName($heroName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($heroName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $heroName)) {
                $heroName = str_replace('*', '%', $heroName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(VotesPeer::HERO_NAME, $heroName, $comparison);
    }

    /**
     * Filter the query on the counter_name column
     *
     * Example usage:
     * <code>
     * $query->filterByCounterName('fooValue');   // WHERE counter_name = 'fooValue'
     * $query->filterByCounterName('%fooValue%'); // WHERE counter_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $counterName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VotesQuery The current query, for fluid interface
     */
    public function filterByCounterName($counterName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($counterName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $counterName)) {
                $counterName = str_replace('*', '%', $counterName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(VotesPeer::COUNTER_NAME, $counterName, $comparison);
    }

    /**
     * Filter the query on the votes column
     *
     * Example usage:
     * <code>
     * $query->filterByVotes(1234); // WHERE votes = 1234
     * $query->filterByVotes(array(12, 34)); // WHERE votes IN (12, 34)
     * $query->filterByVotes(array('min' => 12)); // WHERE votes >= 12
     * $query->filterByVotes(array('max' => 12)); // WHERE votes <= 12
     * </code>
     *
     * @param     mixed $votes The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VotesQuery The current query, for fluid interface
     */
    public function filterByVotes($votes = null, $comparison = null)
    {
        if (is_array($votes)) {
            $useMinMax = false;
            if (isset($votes['min'])) {
                $this->addUsingAlias(VotesPeer::VOTES, $votes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($votes['max'])) {
                $this->addUsingAlias(VotesPeer::VOTES, $votes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotesPeer::VOTES, $votes, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Votes $votes Object to remove from the list of results
     *
     * @return VotesQuery The current query, for fluid interface
     */
    public function prune($votes = null)
    {
        if ($votes) {
            $this->addCond('pruneCond0', $this->getAliasedColName(VotesPeer::HERO_NAME), $votes->getHeroName(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(VotesPeer::COUNTER_NAME), $votes->getCounterName(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
