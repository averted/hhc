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
use hhc\DB\User;
use hhc\DB\Vote;
use hhc\DB\VotePeer;
use hhc\DB\VoteQuery;

/**
 * Base class that represents a query for the 'vote' table.
 *
 *
 *
 * @method VoteQuery orderByUid($order = Criteria::ASC) Order by the uid column
 * @method VoteQuery orderByHid($order = Criteria::ASC) Order by the hid column
 * @method VoteQuery orderByCid($order = Criteria::ASC) Order by the cid column
 * @method VoteQuery orderByVoteType($order = Criteria::ASC) Order by the vote_type column
 *
 * @method VoteQuery groupByUid() Group by the uid column
 * @method VoteQuery groupByHid() Group by the hid column
 * @method VoteQuery groupByCid() Group by the cid column
 * @method VoteQuery groupByVoteType() Group by the vote_type column
 *
 * @method VoteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method VoteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method VoteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method VoteQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method VoteQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method VoteQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method VoteQuery leftJoinHero($relationAlias = null) Adds a LEFT JOIN clause to the query using the Hero relation
 * @method VoteQuery rightJoinHero($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Hero relation
 * @method VoteQuery innerJoinHero($relationAlias = null) Adds a INNER JOIN clause to the query using the Hero relation
 *
 * @method VoteQuery leftJoinCounter($relationAlias = null) Adds a LEFT JOIN clause to the query using the Counter relation
 * @method VoteQuery rightJoinCounter($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Counter relation
 * @method VoteQuery innerJoinCounter($relationAlias = null) Adds a INNER JOIN clause to the query using the Counter relation
 *
 * @method Vote findOne(PropelPDO $con = null) Return the first Vote matching the query
 * @method Vote findOneOrCreate(PropelPDO $con = null) Return the first Vote matching the query, or a new Vote object populated from the query conditions when no match is found
 *
 * @method Vote findOneByUid(int $uid) Return the first Vote filtered by the uid column
 * @method Vote findOneByHid(int $hid) Return the first Vote filtered by the hid column
 * @method Vote findOneByCid(int $cid) Return the first Vote filtered by the cid column
 * @method Vote findOneByVoteType(int $vote_type) Return the first Vote filtered by the vote_type column
 *
 * @method array findByUid(int $uid) Return Vote objects filtered by the uid column
 * @method array findByHid(int $hid) Return Vote objects filtered by the hid column
 * @method array findByCid(int $cid) Return Vote objects filtered by the cid column
 * @method array findByVoteType(int $vote_type) Return Vote objects filtered by the vote_type column
 *
 * @package    propel.generator.hhc.om
 */
abstract class BaseVoteQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseVoteQuery object.
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
            $modelName = 'hhc\\DB\\Vote';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new VoteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   VoteQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return VoteQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof VoteQuery) {
            return $criteria;
        }
        $query = new VoteQuery(null, null, $modelAlias);

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
     * $obj = $c->findPk(array(12, 34, 56), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$uid, $hid, $cid]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Vote|Vote[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = VotePeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1], (string) $key[2]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(VotePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Vote A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `uid`, `hid`, `cid`, `vote_type` FROM `vote` WHERE `uid` = :p0 AND `hid` = :p1 AND `cid` = :p2';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Vote();
            $obj->hydrate($row);
            VotePeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1], (string) $key[2])));
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
     * @return Vote|Vote[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Vote[]|mixed the list of results, formatted by the current formatter
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
     * @return VoteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(VotePeer::UID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(VotePeer::HID, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(VotePeer::CID, $key[2], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return VoteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(VotePeer::UID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(VotePeer::HID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(VotePeer::CID, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the uid column
     *
     * Example usage:
     * <code>
     * $query->filterByUid(1234); // WHERE uid = 1234
     * $query->filterByUid(array(12, 34)); // WHERE uid IN (12, 34)
     * $query->filterByUid(array('min' => 12)); // WHERE uid >= 12
     * $query->filterByUid(array('max' => 12)); // WHERE uid <= 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $uid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VoteQuery The current query, for fluid interface
     */
    public function filterByUid($uid = null, $comparison = null)
    {
        if (is_array($uid)) {
            $useMinMax = false;
            if (isset($uid['min'])) {
                $this->addUsingAlias(VotePeer::UID, $uid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uid['max'])) {
                $this->addUsingAlias(VotePeer::UID, $uid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotePeer::UID, $uid, $comparison);
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
     * @return VoteQuery The current query, for fluid interface
     */
    public function filterByHid($hid = null, $comparison = null)
    {
        if (is_array($hid)) {
            $useMinMax = false;
            if (isset($hid['min'])) {
                $this->addUsingAlias(VotePeer::HID, $hid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hid['max'])) {
                $this->addUsingAlias(VotePeer::HID, $hid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotePeer::HID, $hid, $comparison);
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
     * @return VoteQuery The current query, for fluid interface
     */
    public function filterByCid($cid = null, $comparison = null)
    {
        if (is_array($cid)) {
            $useMinMax = false;
            if (isset($cid['min'])) {
                $this->addUsingAlias(VotePeer::CID, $cid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cid['max'])) {
                $this->addUsingAlias(VotePeer::CID, $cid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotePeer::CID, $cid, $comparison);
    }

    /**
     * Filter the query on the vote_type column
     *
     * @param     mixed $voteType The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VoteQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterByVoteType($voteType = null, $comparison = null)
    {
        if (is_scalar($voteType)) {
            $voteType = VotePeer::getSqlValueForEnum(VotePeer::VOTE_TYPE, $voteType);
        } elseif (is_array($voteType)) {
            $convertedValues = array();
            foreach ($voteType as $value) {
                $convertedValues[] = VotePeer::getSqlValueForEnum(VotePeer::VOTE_TYPE, $value);
            }
            $voteType = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotePeer::VOTE_TYPE, $voteType, $comparison);
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 VoteQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(VotePeer::UID, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VotePeer::UID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return VoteQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \hhc\DB\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\hhc\DB\UserQuery');
    }

    /**
     * Filter the query by a related Hero object
     *
     * @param   Hero|PropelObjectCollection $hero The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 VoteQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByHero($hero, $comparison = null)
    {
        if ($hero instanceof Hero) {
            return $this
                ->addUsingAlias(VotePeer::HID, $hero->getId(), $comparison);
        } elseif ($hero instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VotePeer::HID, $hero->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return VoteQuery The current query, for fluid interface
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
     * @return                 VoteQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCounter($hero, $comparison = null)
    {
        if ($hero instanceof Hero) {
            return $this
                ->addUsingAlias(VotePeer::CID, $hero->getId(), $comparison);
        } elseif ($hero instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VotePeer::CID, $hero->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return VoteQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   Vote $vote Object to remove from the list of results
     *
     * @return VoteQuery The current query, for fluid interface
     */
    public function prune($vote = null)
    {
        if ($vote) {
            $this->addCond('pruneCond0', $this->getAliasedColName(VotePeer::UID), $vote->getUid(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(VotePeer::HID), $vote->getHid(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(VotePeer::CID), $vote->getCid(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
