<?php

namespace Database\Model\Base;

use \Exception;
use \PDO;
use Database\Model\MailCriteria as ChildMailCriteria;
use Database\Model\MailCriteriaQuery as ChildMailCriteriaQuery;
use Database\Model\Map\MailCriteriaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'mail_criteria' table.
 *
 *
 *
 * @method     ChildMailCriteriaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMailCriteriaQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildMailCriteriaQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildMailCriteriaQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildMailCriteriaQuery groupById() Group by the id column
 * @method     ChildMailCriteriaQuery groupByName() Group by the name column
 * @method     ChildMailCriteriaQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildMailCriteriaQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildMailCriteriaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMailCriteriaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMailCriteriaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMailCriteriaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMailCriteriaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMailCriteriaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMailCriteriaQuery leftJoinMailCriteriaRelation($relationAlias = null) Adds a LEFT JOIN clause to the query using the MailCriteriaRelation relation
 * @method     ChildMailCriteriaQuery rightJoinMailCriteriaRelation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MailCriteriaRelation relation
 * @method     ChildMailCriteriaQuery innerJoinMailCriteriaRelation($relationAlias = null) Adds a INNER JOIN clause to the query using the MailCriteriaRelation relation
 *
 * @method     ChildMailCriteriaQuery joinWithMailCriteriaRelation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MailCriteriaRelation relation
 *
 * @method     ChildMailCriteriaQuery leftJoinWithMailCriteriaRelation() Adds a LEFT JOIN clause and with to the query using the MailCriteriaRelation relation
 * @method     ChildMailCriteriaQuery rightJoinWithMailCriteriaRelation() Adds a RIGHT JOIN clause and with to the query using the MailCriteriaRelation relation
 * @method     ChildMailCriteriaQuery innerJoinWithMailCriteriaRelation() Adds a INNER JOIN clause and with to the query using the MailCriteriaRelation relation
 *
 * @method     \Database\Model\MailCriteriaRelationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMailCriteria findOne(ConnectionInterface $con = null) Return the first ChildMailCriteria matching the query
 * @method     ChildMailCriteria findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMailCriteria matching the query, or a new ChildMailCriteria object populated from the query conditions when no match is found
 *
 * @method     ChildMailCriteria findOneById(int $id) Return the first ChildMailCriteria filtered by the id column
 * @method     ChildMailCriteria findOneByName(string $name) Return the first ChildMailCriteria filtered by the name column
 * @method     ChildMailCriteria findOneByCreatedAt(string $created_at) Return the first ChildMailCriteria filtered by the created_at column
 * @method     ChildMailCriteria findOneByUpdatedAt(string $updated_at) Return the first ChildMailCriteria filtered by the updated_at column *

 * @method     ChildMailCriteria requirePk($key, ConnectionInterface $con = null) Return the ChildMailCriteria by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMailCriteria requireOne(ConnectionInterface $con = null) Return the first ChildMailCriteria matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMailCriteria requireOneById(int $id) Return the first ChildMailCriteria filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMailCriteria requireOneByName(string $name) Return the first ChildMailCriteria filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMailCriteria requireOneByCreatedAt(string $created_at) Return the first ChildMailCriteria filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMailCriteria requireOneByUpdatedAt(string $updated_at) Return the first ChildMailCriteria filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMailCriteria[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMailCriteria objects based on current ModelCriteria
 * @method     ChildMailCriteria[]|ObjectCollection findById(int $id) Return ChildMailCriteria objects filtered by the id column
 * @method     ChildMailCriteria[]|ObjectCollection findByName(string $name) Return ChildMailCriteria objects filtered by the name column
 * @method     ChildMailCriteria[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildMailCriteria objects filtered by the created_at column
 * @method     ChildMailCriteria[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildMailCriteria objects filtered by the updated_at column
 * @method     ChildMailCriteria[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MailCriteriaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Database\Model\Base\MailCriteriaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Database\\Model\\MailCriteria', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMailCriteriaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMailCriteriaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMailCriteriaQuery) {
            return $criteria;
        }
        $query = new ChildMailCriteriaQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
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
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildMailCriteria|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MailCriteriaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MailCriteriaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMailCriteria A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, created_at, updated_at FROM mail_criteria WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildMailCriteria $obj */
            $obj = new ChildMailCriteria();
            $obj->hydrate($row);
            MailCriteriaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildMailCriteria|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildMailCriteriaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MailCriteriaTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMailCriteriaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MailCriteriaTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMailCriteriaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MailCriteriaTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MailCriteriaTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MailCriteriaTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildMailCriteriaQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MailCriteriaTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMailCriteriaQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(MailCriteriaTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(MailCriteriaTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MailCriteriaTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMailCriteriaQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(MailCriteriaTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(MailCriteriaTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MailCriteriaTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Database\Model\MailCriteriaRelation object
     *
     * @param \Database\Model\MailCriteriaRelation|ObjectCollection $mailCriteriaRelation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMailCriteriaQuery The current query, for fluid interface
     */
    public function filterByMailCriteriaRelation($mailCriteriaRelation, $comparison = null)
    {
        if ($mailCriteriaRelation instanceof \Database\Model\MailCriteriaRelation) {
            return $this
                ->addUsingAlias(MailCriteriaTableMap::COL_ID, $mailCriteriaRelation->getMailCriteriaId(), $comparison);
        } elseif ($mailCriteriaRelation instanceof ObjectCollection) {
            return $this
                ->useMailCriteriaRelationQuery()
                ->filterByPrimaryKeys($mailCriteriaRelation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMailCriteriaRelation() only accepts arguments of type \Database\Model\MailCriteriaRelation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MailCriteriaRelation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMailCriteriaQuery The current query, for fluid interface
     */
    public function joinMailCriteriaRelation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MailCriteriaRelation');

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
            $this->addJoinObject($join, 'MailCriteriaRelation');
        }

        return $this;
    }

    /**
     * Use the MailCriteriaRelation relation MailCriteriaRelation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Database\Model\MailCriteriaRelationQuery A secondary query class using the current class as primary query
     */
    public function useMailCriteriaRelationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMailCriteriaRelation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MailCriteriaRelation', '\Database\Model\MailCriteriaRelationQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMailCriteria $mailCriteria Object to remove from the list of results
     *
     * @return $this|ChildMailCriteriaQuery The current query, for fluid interface
     */
    public function prune($mailCriteria = null)
    {
        if ($mailCriteria) {
            $this->addUsingAlias(MailCriteriaTableMap::COL_ID, $mailCriteria->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the mail_criteria table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MailCriteriaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MailCriteriaTableMap::clearInstancePool();
            MailCriteriaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MailCriteriaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MailCriteriaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MailCriteriaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MailCriteriaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildMailCriteriaQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(MailCriteriaTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildMailCriteriaQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(MailCriteriaTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildMailCriteriaQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(MailCriteriaTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildMailCriteriaQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(MailCriteriaTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildMailCriteriaQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(MailCriteriaTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildMailCriteriaQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(MailCriteriaTableMap::COL_CREATED_AT);
    }

} // MailCriteriaQuery
