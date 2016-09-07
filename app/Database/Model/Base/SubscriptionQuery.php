<?php

namespace Database\Model\Base;

use \Exception;
use \PDO;
use Database\Model\Subscription as ChildSubscription;
use Database\Model\SubscriptionQuery as ChildSubscriptionQuery;
use Database\Model\Map\SubscriptionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'subscriptions' table.
 *
 *
 *
 * @method     ChildSubscriptionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSubscriptionQuery orderByCompanyName($order = Criteria::ASC) Order by the company_name column
 * @method     ChildSubscriptionQuery orderByCompanyAddress($order = Criteria::ASC) Order by the company_address column
 * @method     ChildSubscriptionQuery orderByCompanyCui($order = Criteria::ASC) Order by the company_cui column
 * @method     ChildSubscriptionQuery orderByCompanyRepresentative($order = Criteria::ASC) Order by the company_representative column
 * @method     ChildSubscriptionQuery orderByIbanAccount($order = Criteria::ASC) Order by the iban_account column
 * @method     ChildSubscriptionQuery orderByEmailAddress($order = Criteria::ASC) Order by the email_address column
 * @method     ChildSubscriptionQuery orderByPhoneNumber($order = Criteria::ASC) Order by the phone_number column
 * @method     ChildSubscriptionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSubscriptionQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSubscriptionQuery groupById() Group by the id column
 * @method     ChildSubscriptionQuery groupByCompanyName() Group by the company_name column
 * @method     ChildSubscriptionQuery groupByCompanyAddress() Group by the company_address column
 * @method     ChildSubscriptionQuery groupByCompanyCui() Group by the company_cui column
 * @method     ChildSubscriptionQuery groupByCompanyRepresentative() Group by the company_representative column
 * @method     ChildSubscriptionQuery groupByIbanAccount() Group by the iban_account column
 * @method     ChildSubscriptionQuery groupByEmailAddress() Group by the email_address column
 * @method     ChildSubscriptionQuery groupByPhoneNumber() Group by the phone_number column
 * @method     ChildSubscriptionQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSubscriptionQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSubscriptionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSubscriptionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSubscriptionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSubscriptionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSubscriptionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSubscriptionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSubscription findOne(ConnectionInterface $con = null) Return the first ChildSubscription matching the query
 * @method     ChildSubscription findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSubscription matching the query, or a new ChildSubscription object populated from the query conditions when no match is found
 *
 * @method     ChildSubscription findOneById(int $id) Return the first ChildSubscription filtered by the id column
 * @method     ChildSubscription findOneByCompanyName(string $company_name) Return the first ChildSubscription filtered by the company_name column
 * @method     ChildSubscription findOneByCompanyAddress(string $company_address) Return the first ChildSubscription filtered by the company_address column
 * @method     ChildSubscription findOneByCompanyCui(string $company_cui) Return the first ChildSubscription filtered by the company_cui column
 * @method     ChildSubscription findOneByCompanyRepresentative(string $company_representative) Return the first ChildSubscription filtered by the company_representative column
 * @method     ChildSubscription findOneByIbanAccount(string $iban_account) Return the first ChildSubscription filtered by the iban_account column
 * @method     ChildSubscription findOneByEmailAddress(string $email_address) Return the first ChildSubscription filtered by the email_address column
 * @method     ChildSubscription findOneByPhoneNumber(string $phone_number) Return the first ChildSubscription filtered by the phone_number column
 * @method     ChildSubscription findOneByCreatedAt(string $created_at) Return the first ChildSubscription filtered by the created_at column
 * @method     ChildSubscription findOneByUpdatedAt(string $updated_at) Return the first ChildSubscription filtered by the updated_at column *

 * @method     ChildSubscription requirePk($key, ConnectionInterface $con = null) Return the ChildSubscription by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubscription requireOne(ConnectionInterface $con = null) Return the first ChildSubscription matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSubscription requireOneById(int $id) Return the first ChildSubscription filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubscription requireOneByCompanyName(string $company_name) Return the first ChildSubscription filtered by the company_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubscription requireOneByCompanyAddress(string $company_address) Return the first ChildSubscription filtered by the company_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubscription requireOneByCompanyCui(string $company_cui) Return the first ChildSubscription filtered by the company_cui column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubscription requireOneByCompanyRepresentative(string $company_representative) Return the first ChildSubscription filtered by the company_representative column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubscription requireOneByIbanAccount(string $iban_account) Return the first ChildSubscription filtered by the iban_account column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubscription requireOneByEmailAddress(string $email_address) Return the first ChildSubscription filtered by the email_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubscription requireOneByPhoneNumber(string $phone_number) Return the first ChildSubscription filtered by the phone_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubscription requireOneByCreatedAt(string $created_at) Return the first ChildSubscription filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubscription requireOneByUpdatedAt(string $updated_at) Return the first ChildSubscription filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSubscription[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSubscription objects based on current ModelCriteria
 * @method     ChildSubscription[]|ObjectCollection findById(int $id) Return ChildSubscription objects filtered by the id column
 * @method     ChildSubscription[]|ObjectCollection findByCompanyName(string $company_name) Return ChildSubscription objects filtered by the company_name column
 * @method     ChildSubscription[]|ObjectCollection findByCompanyAddress(string $company_address) Return ChildSubscription objects filtered by the company_address column
 * @method     ChildSubscription[]|ObjectCollection findByCompanyCui(string $company_cui) Return ChildSubscription objects filtered by the company_cui column
 * @method     ChildSubscription[]|ObjectCollection findByCompanyRepresentative(string $company_representative) Return ChildSubscription objects filtered by the company_representative column
 * @method     ChildSubscription[]|ObjectCollection findByIbanAccount(string $iban_account) Return ChildSubscription objects filtered by the iban_account column
 * @method     ChildSubscription[]|ObjectCollection findByEmailAddress(string $email_address) Return ChildSubscription objects filtered by the email_address column
 * @method     ChildSubscription[]|ObjectCollection findByPhoneNumber(string $phone_number) Return ChildSubscription objects filtered by the phone_number column
 * @method     ChildSubscription[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildSubscription objects filtered by the created_at column
 * @method     ChildSubscription[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildSubscription objects filtered by the updated_at column
 * @method     ChildSubscription[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SubscriptionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Database\Model\Base\SubscriptionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Database\\Model\\Subscription', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSubscriptionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSubscriptionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSubscriptionQuery) {
            return $criteria;
        }
        $query = new ChildSubscriptionQuery();
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
     * @return ChildSubscription|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SubscriptionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SubscriptionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSubscription A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, company_name, company_address, company_cui, company_representative, iban_account, email_address, phone_number, created_at, updated_at FROM subscriptions WHERE id = :p0';
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
            /** @var ChildSubscription $obj */
            $obj = new ChildSubscription();
            $obj->hydrate($row);
            SubscriptionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSubscription|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SubscriptionTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SubscriptionTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SubscriptionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SubscriptionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubscriptionTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the company_name column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyName('fooValue');   // WHERE company_name = 'fooValue'
     * $query->filterByCompanyName('%fooValue%'); // WHERE company_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $companyName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function filterByCompanyName($companyName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($companyName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubscriptionTableMap::COL_COMPANY_NAME, $companyName, $comparison);
    }

    /**
     * Filter the query on the company_address column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyAddress('fooValue');   // WHERE company_address = 'fooValue'
     * $query->filterByCompanyAddress('%fooValue%'); // WHERE company_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $companyAddress The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function filterByCompanyAddress($companyAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($companyAddress)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubscriptionTableMap::COL_COMPANY_ADDRESS, $companyAddress, $comparison);
    }

    /**
     * Filter the query on the company_cui column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyCui('fooValue');   // WHERE company_cui = 'fooValue'
     * $query->filterByCompanyCui('%fooValue%'); // WHERE company_cui LIKE '%fooValue%'
     * </code>
     *
     * @param     string $companyCui The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function filterByCompanyCui($companyCui = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($companyCui)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubscriptionTableMap::COL_COMPANY_CUI, $companyCui, $comparison);
    }

    /**
     * Filter the query on the company_representative column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyRepresentative('fooValue');   // WHERE company_representative = 'fooValue'
     * $query->filterByCompanyRepresentative('%fooValue%'); // WHERE company_representative LIKE '%fooValue%'
     * </code>
     *
     * @param     string $companyRepresentative The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function filterByCompanyRepresentative($companyRepresentative = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($companyRepresentative)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubscriptionTableMap::COL_COMPANY_REPRESENTATIVE, $companyRepresentative, $comparison);
    }

    /**
     * Filter the query on the iban_account column
     *
     * Example usage:
     * <code>
     * $query->filterByIbanAccount('fooValue');   // WHERE iban_account = 'fooValue'
     * $query->filterByIbanAccount('%fooValue%'); // WHERE iban_account LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ibanAccount The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function filterByIbanAccount($ibanAccount = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ibanAccount)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubscriptionTableMap::COL_IBAN_ACCOUNT, $ibanAccount, $comparison);
    }

    /**
     * Filter the query on the email_address column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailAddress('fooValue');   // WHERE email_address = 'fooValue'
     * $query->filterByEmailAddress('%fooValue%'); // WHERE email_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $emailAddress The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function filterByEmailAddress($emailAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($emailAddress)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubscriptionTableMap::COL_EMAIL_ADDRESS, $emailAddress, $comparison);
    }

    /**
     * Filter the query on the phone_number column
     *
     * Example usage:
     * <code>
     * $query->filterByPhoneNumber('fooValue');   // WHERE phone_number = 'fooValue'
     * $query->filterByPhoneNumber('%fooValue%'); // WHERE phone_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phoneNumber The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function filterByPhoneNumber($phoneNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phoneNumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubscriptionTableMap::COL_PHONE_NUMBER, $phoneNumber, $comparison);
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
     * @return $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(SubscriptionTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(SubscriptionTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubscriptionTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(SubscriptionTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(SubscriptionTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubscriptionTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSubscription $subscription Object to remove from the list of results
     *
     * @return $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function prune($subscription = null)
    {
        if ($subscription) {
            $this->addUsingAlias(SubscriptionTableMap::COL_ID, $subscription->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the subscriptions table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SubscriptionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SubscriptionTableMap::clearInstancePool();
            SubscriptionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SubscriptionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SubscriptionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SubscriptionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SubscriptionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(SubscriptionTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(SubscriptionTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(SubscriptionTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(SubscriptionTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(SubscriptionTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildSubscriptionQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(SubscriptionTableMap::COL_CREATED_AT);
    }

} // SubscriptionQuery
