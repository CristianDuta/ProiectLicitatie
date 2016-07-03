<?php

namespace Database\Model\Base;

use \Exception;
use \PDO;
use Database\Model\Mail as ChildMail;
use Database\Model\MailQuery as ChildMailQuery;
use Database\Model\Map\MailTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'mail' table.
 *
 *
 *
 * @method     ChildMailQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMailQuery orderByFromEmailAddress($order = Criteria::ASC) Order by the from_email_address column
 * @method     ChildMailQuery orderBySubject($order = Criteria::ASC) Order by the subject column
 * @method     ChildMailQuery orderByAuctionList($order = Criteria::ASC) Order by the auction_list column
 * @method     ChildMailQuery orderByMailTemplate($order = Criteria::ASC) Order by the mail_template column
 * @method     ChildMailQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildMailQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildMailQuery groupById() Group by the id column
 * @method     ChildMailQuery groupByFromEmailAddress() Group by the from_email_address column
 * @method     ChildMailQuery groupBySubject() Group by the subject column
 * @method     ChildMailQuery groupByAuctionList() Group by the auction_list column
 * @method     ChildMailQuery groupByMailTemplate() Group by the mail_template column
 * @method     ChildMailQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildMailQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildMailQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMailQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMailQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMailQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMailQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMailQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMailQuery leftJoinMailQueue($relationAlias = null) Adds a LEFT JOIN clause to the query using the MailQueue relation
 * @method     ChildMailQuery rightJoinMailQueue($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MailQueue relation
 * @method     ChildMailQuery innerJoinMailQueue($relationAlias = null) Adds a INNER JOIN clause to the query using the MailQueue relation
 *
 * @method     ChildMailQuery joinWithMailQueue($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MailQueue relation
 *
 * @method     ChildMailQuery leftJoinWithMailQueue() Adds a LEFT JOIN clause and with to the query using the MailQueue relation
 * @method     ChildMailQuery rightJoinWithMailQueue() Adds a RIGHT JOIN clause and with to the query using the MailQueue relation
 * @method     ChildMailQuery innerJoinWithMailQueue() Adds a INNER JOIN clause and with to the query using the MailQueue relation
 *
 * @method     \Database\Model\MailQueueQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMail findOne(ConnectionInterface $con = null) Return the first ChildMail matching the query
 * @method     ChildMail findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMail matching the query, or a new ChildMail object populated from the query conditions when no match is found
 *
 * @method     ChildMail findOneById(int $id) Return the first ChildMail filtered by the id column
 * @method     ChildMail findOneByFromEmailAddress(string $from_email_address) Return the first ChildMail filtered by the from_email_address column
 * @method     ChildMail findOneBySubject(string $subject) Return the first ChildMail filtered by the subject column
 * @method     ChildMail findOneByAuctionList(string $auction_list) Return the first ChildMail filtered by the auction_list column
 * @method     ChildMail findOneByMailTemplate(string $mail_template) Return the first ChildMail filtered by the mail_template column
 * @method     ChildMail findOneByCreatedAt(string $created_at) Return the first ChildMail filtered by the created_at column
 * @method     ChildMail findOneByUpdatedAt(string $updated_at) Return the first ChildMail filtered by the updated_at column *

 * @method     ChildMail requirePk($key, ConnectionInterface $con = null) Return the ChildMail by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMail requireOne(ConnectionInterface $con = null) Return the first ChildMail matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMail requireOneById(int $id) Return the first ChildMail filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMail requireOneByFromEmailAddress(string $from_email_address) Return the first ChildMail filtered by the from_email_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMail requireOneBySubject(string $subject) Return the first ChildMail filtered by the subject column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMail requireOneByAuctionList(string $auction_list) Return the first ChildMail filtered by the auction_list column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMail requireOneByMailTemplate(string $mail_template) Return the first ChildMail filtered by the mail_template column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMail requireOneByCreatedAt(string $created_at) Return the first ChildMail filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMail requireOneByUpdatedAt(string $updated_at) Return the first ChildMail filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMail[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMail objects based on current ModelCriteria
 * @method     ChildMail[]|ObjectCollection findById(int $id) Return ChildMail objects filtered by the id column
 * @method     ChildMail[]|ObjectCollection findByFromEmailAddress(string $from_email_address) Return ChildMail objects filtered by the from_email_address column
 * @method     ChildMail[]|ObjectCollection findBySubject(string $subject) Return ChildMail objects filtered by the subject column
 * @method     ChildMail[]|ObjectCollection findByAuctionList(string $auction_list) Return ChildMail objects filtered by the auction_list column
 * @method     ChildMail[]|ObjectCollection findByMailTemplate(string $mail_template) Return ChildMail objects filtered by the mail_template column
 * @method     ChildMail[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildMail objects filtered by the created_at column
 * @method     ChildMail[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildMail objects filtered by the updated_at column
 * @method     ChildMail[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MailQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Database\Model\Base\MailQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Database\\Model\\Mail', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMailQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMailQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMailQuery) {
            return $criteria;
        }
        $query = new ChildMailQuery();
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
     * @return ChildMail|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MailTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MailTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMail A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, from_email_address, subject, auction_list, mail_template, created_at, updated_at FROM mail WHERE id = :p0';
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
            /** @var ChildMail $obj */
            $obj = new ChildMail();
            $obj->hydrate($row);
            MailTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMail|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MailTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MailTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MailTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MailTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MailTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the from_email_address column
     *
     * Example usage:
     * <code>
     * $query->filterByFromEmailAddress('fooValue');   // WHERE from_email_address = 'fooValue'
     * $query->filterByFromEmailAddress('%fooValue%'); // WHERE from_email_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fromEmailAddress The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByFromEmailAddress($fromEmailAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fromEmailAddress)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fromEmailAddress)) {
                $fromEmailAddress = str_replace('*', '%', $fromEmailAddress);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MailTableMap::COL_FROM_EMAIL_ADDRESS, $fromEmailAddress, $comparison);
    }

    /**
     * Filter the query on the subject column
     *
     * Example usage:
     * <code>
     * $query->filterBySubject('fooValue');   // WHERE subject = 'fooValue'
     * $query->filterBySubject('%fooValue%'); // WHERE subject LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subject The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterBySubject($subject = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subject)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $subject)) {
                $subject = str_replace('*', '%', $subject);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MailTableMap::COL_SUBJECT, $subject, $comparison);
    }

    /**
     * Filter the query on the auction_list column
     *
     * Example usage:
     * <code>
     * $query->filterByAuctionList('fooValue');   // WHERE auction_list = 'fooValue'
     * $query->filterByAuctionList('%fooValue%'); // WHERE auction_list LIKE '%fooValue%'
     * </code>
     *
     * @param     string $auctionList The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByAuctionList($auctionList = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($auctionList)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $auctionList)) {
                $auctionList = str_replace('*', '%', $auctionList);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MailTableMap::COL_AUCTION_LIST, $auctionList, $comparison);
    }

    /**
     * Filter the query on the mail_template column
     *
     * Example usage:
     * <code>
     * $query->filterByMailTemplate('fooValue');   // WHERE mail_template = 'fooValue'
     * $query->filterByMailTemplate('%fooValue%'); // WHERE mail_template LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mailTemplate The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByMailTemplate($mailTemplate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mailTemplate)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mailTemplate)) {
                $mailTemplate = str_replace('*', '%', $mailTemplate);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MailTableMap::COL_MAIL_TEMPLATE, $mailTemplate, $comparison);
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
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(MailTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(MailTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MailTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(MailTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(MailTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MailTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Database\Model\MailQueue object
     *
     * @param \Database\Model\MailQueue|ObjectCollection $mailQueue the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMailQuery The current query, for fluid interface
     */
    public function filterByMailQueue($mailQueue, $comparison = null)
    {
        if ($mailQueue instanceof \Database\Model\MailQueue) {
            return $this
                ->addUsingAlias(MailTableMap::COL_ID, $mailQueue->getMailId(), $comparison);
        } elseif ($mailQueue instanceof ObjectCollection) {
            return $this
                ->useMailQueueQuery()
                ->filterByPrimaryKeys($mailQueue->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMailQueue() only accepts arguments of type \Database\Model\MailQueue or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MailQueue relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function joinMailQueue($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MailQueue');

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
            $this->addJoinObject($join, 'MailQueue');
        }

        return $this;
    }

    /**
     * Use the MailQueue relation MailQueue object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Database\Model\MailQueueQuery A secondary query class using the current class as primary query
     */
    public function useMailQueueQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMailQueue($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MailQueue', '\Database\Model\MailQueueQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMail $mail Object to remove from the list of results
     *
     * @return $this|ChildMailQuery The current query, for fluid interface
     */
    public function prune($mail = null)
    {
        if ($mail) {
            $this->addUsingAlias(MailTableMap::COL_ID, $mail->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the mail table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MailTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MailTableMap::clearInstancePool();
            MailTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MailTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MailTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MailTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MailTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildMailQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(MailTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildMailQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(MailTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildMailQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(MailTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildMailQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(MailTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildMailQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(MailTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildMailQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(MailTableMap::COL_CREATED_AT);
    }

} // MailQuery
