<?php

namespace Database\Model\Base;

use \Exception;
use \PDO;
use Database\Model\Auction as ChildAuction;
use Database\Model\AuctionQuery as ChildAuctionQuery;
use Database\Model\Map\AuctionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'auction' table.
 *
 *
 *
 * @method     ChildAuctionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildAuctionQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildAuctionQuery orderByEstimatedValue($order = Criteria::ASC) Order by the estimated_value column
 * @method     ChildAuctionQuery orderByLocation($order = Criteria::ASC) Order by the location column
 * @method     ChildAuctionQuery orderByDocumentation($order = Criteria::ASC) Order by the documentation column
 * @method     ChildAuctionQuery orderByAdNumber($order = Criteria::ASC) Order by the ad_number column
 * @method     ChildAuctionQuery orderByPublishDate($order = Criteria::ASC) Order by the publish_date column
 * @method     ChildAuctionQuery orderByGainer($order = Criteria::ASC) Order by the gainer column
 * @method     ChildAuctionQuery orderByContractType($order = Criteria::ASC) Order by the contract_type column
 * @method     ChildAuctionQuery orderByFundingType($order = Criteria::ASC) Order by the funding_type column
 * @method     ChildAuctionQuery orderByContractSubject($order = Criteria::ASC) Order by the contract_subject column
 * @method     ChildAuctionQuery orderByOfferEndDate($order = Criteria::ASC) Order by the offer_end_date column
 * @method     ChildAuctionQuery orderByApplyMode($order = Criteria::ASC) Order by the apply_mode column
 * @method     ChildAuctionQuery orderByContractPeriod($order = Criteria::ASC) Order by the contract_period column
 * @method     ChildAuctionQuery orderByParticipationWarranty($order = Criteria::ASC) Order by the participation_warranty column
 * @method     ChildAuctionQuery orderByParticipationConditions($order = Criteria::ASC) Order by the participation_conditions column
 * @method     ChildAuctionQuery orderByProfessionalAbility($order = Criteria::ASC) Order by the professional_ability column
 * @method     ChildAuctionQuery orderByAverageTurnover($order = Criteria::ASC) Order by the average_turnover column
 * @method     ChildAuctionQuery orderByCashFlow($order = Criteria::ASC) Order by the cash_flow column
 * @method     ChildAuctionQuery orderBySimilarExperience($order = Criteria::ASC) Order by the similar_experience column
 * @method     ChildAuctionQuery orderByKeyPersonnel($order = Criteria::ASC) Order by the key_personnel column
 * @method     ChildAuctionQuery orderByEquipment($order = Criteria::ASC) Order by the equipment column
 * @method     ChildAuctionQuery orderByQualityAssurance($order = Criteria::ASC) Order by the quality_assurance column
 * @method     ChildAuctionQuery orderByAdditionalInformation($order = Criteria::ASC) Order by the additional_information column
 *
 * @method     ChildAuctionQuery groupById() Group by the id column
 * @method     ChildAuctionQuery groupByTitle() Group by the title column
 * @method     ChildAuctionQuery groupByEstimatedValue() Group by the estimated_value column
 * @method     ChildAuctionQuery groupByLocation() Group by the location column
 * @method     ChildAuctionQuery groupByDocumentation() Group by the documentation column
 * @method     ChildAuctionQuery groupByAdNumber() Group by the ad_number column
 * @method     ChildAuctionQuery groupByPublishDate() Group by the publish_date column
 * @method     ChildAuctionQuery groupByGainer() Group by the gainer column
 * @method     ChildAuctionQuery groupByContractType() Group by the contract_type column
 * @method     ChildAuctionQuery groupByFundingType() Group by the funding_type column
 * @method     ChildAuctionQuery groupByContractSubject() Group by the contract_subject column
 * @method     ChildAuctionQuery groupByOfferEndDate() Group by the offer_end_date column
 * @method     ChildAuctionQuery groupByApplyMode() Group by the apply_mode column
 * @method     ChildAuctionQuery groupByContractPeriod() Group by the contract_period column
 * @method     ChildAuctionQuery groupByParticipationWarranty() Group by the participation_warranty column
 * @method     ChildAuctionQuery groupByParticipationConditions() Group by the participation_conditions column
 * @method     ChildAuctionQuery groupByProfessionalAbility() Group by the professional_ability column
 * @method     ChildAuctionQuery groupByAverageTurnover() Group by the average_turnover column
 * @method     ChildAuctionQuery groupByCashFlow() Group by the cash_flow column
 * @method     ChildAuctionQuery groupBySimilarExperience() Group by the similar_experience column
 * @method     ChildAuctionQuery groupByKeyPersonnel() Group by the key_personnel column
 * @method     ChildAuctionQuery groupByEquipment() Group by the equipment column
 * @method     ChildAuctionQuery groupByQualityAssurance() Group by the quality_assurance column
 * @method     ChildAuctionQuery groupByAdditionalInformation() Group by the additional_information column
 *
 * @method     ChildAuctionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAuctionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAuctionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAuctionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAuctionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAuctionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAuction findOne(ConnectionInterface $con = null) Return the first ChildAuction matching the query
 * @method     ChildAuction findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAuction matching the query, or a new ChildAuction object populated from the query conditions when no match is found
 *
 * @method     ChildAuction findOneById(int $id) Return the first ChildAuction filtered by the id column
 * @method     ChildAuction findOneByTitle(string $title) Return the first ChildAuction filtered by the title column
 * @method     ChildAuction findOneByEstimatedValue(string $estimated_value) Return the first ChildAuction filtered by the estimated_value column
 * @method     ChildAuction findOneByLocation(string $location) Return the first ChildAuction filtered by the location column
 * @method     ChildAuction findOneByDocumentation(string $documentation) Return the first ChildAuction filtered by the documentation column
 * @method     ChildAuction findOneByAdNumber(int $ad_number) Return the first ChildAuction filtered by the ad_number column
 * @method     ChildAuction findOneByPublishDate(string $publish_date) Return the first ChildAuction filtered by the publish_date column
 * @method     ChildAuction findOneByGainer(string $gainer) Return the first ChildAuction filtered by the gainer column
 * @method     ChildAuction findOneByContractType(string $contract_type) Return the first ChildAuction filtered by the contract_type column
 * @method     ChildAuction findOneByFundingType(string $funding_type) Return the first ChildAuction filtered by the funding_type column
 * @method     ChildAuction findOneByContractSubject(string $contract_subject) Return the first ChildAuction filtered by the contract_subject column
 * @method     ChildAuction findOneByOfferEndDate(string $offer_end_date) Return the first ChildAuction filtered by the offer_end_date column
 * @method     ChildAuction findOneByApplyMode(string $apply_mode) Return the first ChildAuction filtered by the apply_mode column
 * @method     ChildAuction findOneByContractPeriod(string $contract_period) Return the first ChildAuction filtered by the contract_period column
 * @method     ChildAuction findOneByParticipationWarranty(string $participation_warranty) Return the first ChildAuction filtered by the participation_warranty column
 * @method     ChildAuction findOneByParticipationConditions(string $participation_conditions) Return the first ChildAuction filtered by the participation_conditions column
 * @method     ChildAuction findOneByProfessionalAbility(string $professional_ability) Return the first ChildAuction filtered by the professional_ability column
 * @method     ChildAuction findOneByAverageTurnover(string $average_turnover) Return the first ChildAuction filtered by the average_turnover column
 * @method     ChildAuction findOneByCashFlow(string $cash_flow) Return the first ChildAuction filtered by the cash_flow column
 * @method     ChildAuction findOneBySimilarExperience(string $similar_experience) Return the first ChildAuction filtered by the similar_experience column
 * @method     ChildAuction findOneByKeyPersonnel(string $key_personnel) Return the first ChildAuction filtered by the key_personnel column
 * @method     ChildAuction findOneByEquipment(string $equipment) Return the first ChildAuction filtered by the equipment column
 * @method     ChildAuction findOneByQualityAssurance(string $quality_assurance) Return the first ChildAuction filtered by the quality_assurance column
 * @method     ChildAuction findOneByAdditionalInformation(string $additional_information) Return the first ChildAuction filtered by the additional_information column *

 * @method     ChildAuction requirePk($key, ConnectionInterface $con = null) Return the ChildAuction by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOne(ConnectionInterface $con = null) Return the first ChildAuction matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAuction requireOneById(int $id) Return the first ChildAuction filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByTitle(string $title) Return the first ChildAuction filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByEstimatedValue(string $estimated_value) Return the first ChildAuction filtered by the estimated_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByLocation(string $location) Return the first ChildAuction filtered by the location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByDocumentation(string $documentation) Return the first ChildAuction filtered by the documentation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByAdNumber(int $ad_number) Return the first ChildAuction filtered by the ad_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByPublishDate(string $publish_date) Return the first ChildAuction filtered by the publish_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByGainer(string $gainer) Return the first ChildAuction filtered by the gainer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByContractType(string $contract_type) Return the first ChildAuction filtered by the contract_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByFundingType(string $funding_type) Return the first ChildAuction filtered by the funding_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByContractSubject(string $contract_subject) Return the first ChildAuction filtered by the contract_subject column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByOfferEndDate(string $offer_end_date) Return the first ChildAuction filtered by the offer_end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByApplyMode(string $apply_mode) Return the first ChildAuction filtered by the apply_mode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByContractPeriod(string $contract_period) Return the first ChildAuction filtered by the contract_period column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByParticipationWarranty(string $participation_warranty) Return the first ChildAuction filtered by the participation_warranty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByParticipationConditions(string $participation_conditions) Return the first ChildAuction filtered by the participation_conditions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByProfessionalAbility(string $professional_ability) Return the first ChildAuction filtered by the professional_ability column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByAverageTurnover(string $average_turnover) Return the first ChildAuction filtered by the average_turnover column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByCashFlow(string $cash_flow) Return the first ChildAuction filtered by the cash_flow column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneBySimilarExperience(string $similar_experience) Return the first ChildAuction filtered by the similar_experience column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByKeyPersonnel(string $key_personnel) Return the first ChildAuction filtered by the key_personnel column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByEquipment(string $equipment) Return the first ChildAuction filtered by the equipment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByQualityAssurance(string $quality_assurance) Return the first ChildAuction filtered by the quality_assurance column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuction requireOneByAdditionalInformation(string $additional_information) Return the first ChildAuction filtered by the additional_information column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAuction[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAuction objects based on current ModelCriteria
 * @method     ChildAuction[]|ObjectCollection findById(int $id) Return ChildAuction objects filtered by the id column
 * @method     ChildAuction[]|ObjectCollection findByTitle(string $title) Return ChildAuction objects filtered by the title column
 * @method     ChildAuction[]|ObjectCollection findByEstimatedValue(string $estimated_value) Return ChildAuction objects filtered by the estimated_value column
 * @method     ChildAuction[]|ObjectCollection findByLocation(string $location) Return ChildAuction objects filtered by the location column
 * @method     ChildAuction[]|ObjectCollection findByDocumentation(string $documentation) Return ChildAuction objects filtered by the documentation column
 * @method     ChildAuction[]|ObjectCollection findByAdNumber(int $ad_number) Return ChildAuction objects filtered by the ad_number column
 * @method     ChildAuction[]|ObjectCollection findByPublishDate(string $publish_date) Return ChildAuction objects filtered by the publish_date column
 * @method     ChildAuction[]|ObjectCollection findByGainer(string $gainer) Return ChildAuction objects filtered by the gainer column
 * @method     ChildAuction[]|ObjectCollection findByContractType(string $contract_type) Return ChildAuction objects filtered by the contract_type column
 * @method     ChildAuction[]|ObjectCollection findByFundingType(string $funding_type) Return ChildAuction objects filtered by the funding_type column
 * @method     ChildAuction[]|ObjectCollection findByContractSubject(string $contract_subject) Return ChildAuction objects filtered by the contract_subject column
 * @method     ChildAuction[]|ObjectCollection findByOfferEndDate(string $offer_end_date) Return ChildAuction objects filtered by the offer_end_date column
 * @method     ChildAuction[]|ObjectCollection findByApplyMode(string $apply_mode) Return ChildAuction objects filtered by the apply_mode column
 * @method     ChildAuction[]|ObjectCollection findByContractPeriod(string $contract_period) Return ChildAuction objects filtered by the contract_period column
 * @method     ChildAuction[]|ObjectCollection findByParticipationWarranty(string $participation_warranty) Return ChildAuction objects filtered by the participation_warranty column
 * @method     ChildAuction[]|ObjectCollection findByParticipationConditions(string $participation_conditions) Return ChildAuction objects filtered by the participation_conditions column
 * @method     ChildAuction[]|ObjectCollection findByProfessionalAbility(string $professional_ability) Return ChildAuction objects filtered by the professional_ability column
 * @method     ChildAuction[]|ObjectCollection findByAverageTurnover(string $average_turnover) Return ChildAuction objects filtered by the average_turnover column
 * @method     ChildAuction[]|ObjectCollection findByCashFlow(string $cash_flow) Return ChildAuction objects filtered by the cash_flow column
 * @method     ChildAuction[]|ObjectCollection findBySimilarExperience(string $similar_experience) Return ChildAuction objects filtered by the similar_experience column
 * @method     ChildAuction[]|ObjectCollection findByKeyPersonnel(string $key_personnel) Return ChildAuction objects filtered by the key_personnel column
 * @method     ChildAuction[]|ObjectCollection findByEquipment(string $equipment) Return ChildAuction objects filtered by the equipment column
 * @method     ChildAuction[]|ObjectCollection findByQualityAssurance(string $quality_assurance) Return ChildAuction objects filtered by the quality_assurance column
 * @method     ChildAuction[]|ObjectCollection findByAdditionalInformation(string $additional_information) Return ChildAuction objects filtered by the additional_information column
 * @method     ChildAuction[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AuctionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Database\Model\Base\AuctionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Database\\Model\\Auction', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAuctionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAuctionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAuctionQuery) {
            return $criteria;
        }
        $query = new ChildAuctionQuery();
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
     * @return ChildAuction|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AuctionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AuctionTableMap::DATABASE_NAME);
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
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAuction A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, title, estimated_value, location, documentation, ad_number, publish_date, gainer, contract_type, funding_type, contract_subject, offer_end_date, apply_mode, contract_period, participation_warranty, participation_conditions, professional_ability, average_turnover, cash_flow, similar_experience, key_personnel, equipment, quality_assurance, additional_information FROM auction WHERE id = :p0';
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
            /** @var ChildAuction $obj */
            $obj = new ChildAuction();
            $obj->hydrate($row);
            AuctionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAuction|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AuctionTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AuctionTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(AuctionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AuctionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the estimated_value column
     *
     * Example usage:
     * <code>
     * $query->filterByEstimatedValue('fooValue');   // WHERE estimated_value = 'fooValue'
     * $query->filterByEstimatedValue('%fooValue%'); // WHERE estimated_value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $estimatedValue The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByEstimatedValue($estimatedValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estimatedValue)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $estimatedValue)) {
                $estimatedValue = str_replace('*', '%', $estimatedValue);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_ESTIMATED_VALUE, $estimatedValue, $comparison);
    }

    /**
     * Filter the query on the location column
     *
     * Example usage:
     * <code>
     * $query->filterByLocation('fooValue');   // WHERE location = 'fooValue'
     * $query->filterByLocation('%fooValue%'); // WHERE location LIKE '%fooValue%'
     * </code>
     *
     * @param     string $location The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByLocation($location = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($location)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $location)) {
                $location = str_replace('*', '%', $location);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_LOCATION, $location, $comparison);
    }

    /**
     * Filter the query on the documentation column
     *
     * Example usage:
     * <code>
     * $query->filterByDocumentation('fooValue');   // WHERE documentation = 'fooValue'
     * $query->filterByDocumentation('%fooValue%'); // WHERE documentation LIKE '%fooValue%'
     * </code>
     *
     * @param     string $documentation The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByDocumentation($documentation = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($documentation)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $documentation)) {
                $documentation = str_replace('*', '%', $documentation);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_DOCUMENTATION, $documentation, $comparison);
    }

    /**
     * Filter the query on the ad_number column
     *
     * Example usage:
     * <code>
     * $query->filterByAdNumber(1234); // WHERE ad_number = 1234
     * $query->filterByAdNumber(array(12, 34)); // WHERE ad_number IN (12, 34)
     * $query->filterByAdNumber(array('min' => 12)); // WHERE ad_number > 12
     * </code>
     *
     * @param     mixed $adNumber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByAdNumber($adNumber = null, $comparison = null)
    {
        if (is_array($adNumber)) {
            $useMinMax = false;
            if (isset($adNumber['min'])) {
                $this->addUsingAlias(AuctionTableMap::COL_AD_NUMBER, $adNumber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($adNumber['max'])) {
                $this->addUsingAlias(AuctionTableMap::COL_AD_NUMBER, $adNumber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_AD_NUMBER, $adNumber, $comparison);
    }

    /**
     * Filter the query on the publish_date column
     *
     * Example usage:
     * <code>
     * $query->filterByPublishDate('2011-03-14'); // WHERE publish_date = '2011-03-14'
     * $query->filterByPublishDate('now'); // WHERE publish_date = '2011-03-14'
     * $query->filterByPublishDate(array('max' => 'yesterday')); // WHERE publish_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $publishDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByPublishDate($publishDate = null, $comparison = null)
    {
        if (is_array($publishDate)) {
            $useMinMax = false;
            if (isset($publishDate['min'])) {
                $this->addUsingAlias(AuctionTableMap::COL_PUBLISH_DATE, $publishDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($publishDate['max'])) {
                $this->addUsingAlias(AuctionTableMap::COL_PUBLISH_DATE, $publishDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_PUBLISH_DATE, $publishDate, $comparison);
    }

    /**
     * Filter the query on the gainer column
     *
     * Example usage:
     * <code>
     * $query->filterByGainer('fooValue');   // WHERE gainer = 'fooValue'
     * $query->filterByGainer('%fooValue%'); // WHERE gainer LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gainer The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByGainer($gainer = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gainer)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $gainer)) {
                $gainer = str_replace('*', '%', $gainer);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_GAINER, $gainer, $comparison);
    }

    /**
     * Filter the query on the contract_type column
     *
     * Example usage:
     * <code>
     * $query->filterByContractType('fooValue');   // WHERE contract_type = 'fooValue'
     * $query->filterByContractType('%fooValue%'); // WHERE contract_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contractType The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByContractType($contractType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contractType)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contractType)) {
                $contractType = str_replace('*', '%', $contractType);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_CONTRACT_TYPE, $contractType, $comparison);
    }

    /**
     * Filter the query on the funding_type column
     *
     * Example usage:
     * <code>
     * $query->filterByFundingType('fooValue');   // WHERE funding_type = 'fooValue'
     * $query->filterByFundingType('%fooValue%'); // WHERE funding_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fundingType The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByFundingType($fundingType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fundingType)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fundingType)) {
                $fundingType = str_replace('*', '%', $fundingType);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_FUNDING_TYPE, $fundingType, $comparison);
    }

    /**
     * Filter the query on the contract_subject column
     *
     * Example usage:
     * <code>
     * $query->filterByContractSubject('fooValue');   // WHERE contract_subject = 'fooValue'
     * $query->filterByContractSubject('%fooValue%'); // WHERE contract_subject LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contractSubject The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByContractSubject($contractSubject = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contractSubject)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contractSubject)) {
                $contractSubject = str_replace('*', '%', $contractSubject);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_CONTRACT_SUBJECT, $contractSubject, $comparison);
    }

    /**
     * Filter the query on the offer_end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByOfferEndDate('2011-03-14'); // WHERE offer_end_date = '2011-03-14'
     * $query->filterByOfferEndDate('now'); // WHERE offer_end_date = '2011-03-14'
     * $query->filterByOfferEndDate(array('max' => 'yesterday')); // WHERE offer_end_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $offerEndDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByOfferEndDate($offerEndDate = null, $comparison = null)
    {
        if (is_array($offerEndDate)) {
            $useMinMax = false;
            if (isset($offerEndDate['min'])) {
                $this->addUsingAlias(AuctionTableMap::COL_OFFER_END_DATE, $offerEndDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($offerEndDate['max'])) {
                $this->addUsingAlias(AuctionTableMap::COL_OFFER_END_DATE, $offerEndDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_OFFER_END_DATE, $offerEndDate, $comparison);
    }

    /**
     * Filter the query on the apply_mode column
     *
     * Example usage:
     * <code>
     * $query->filterByApplyMode('fooValue');   // WHERE apply_mode = 'fooValue'
     * $query->filterByApplyMode('%fooValue%'); // WHERE apply_mode LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applyMode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByApplyMode($applyMode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applyMode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $applyMode)) {
                $applyMode = str_replace('*', '%', $applyMode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_APPLY_MODE, $applyMode, $comparison);
    }

    /**
     * Filter the query on the contract_period column
     *
     * Example usage:
     * <code>
     * $query->filterByContractPeriod('fooValue');   // WHERE contract_period = 'fooValue'
     * $query->filterByContractPeriod('%fooValue%'); // WHERE contract_period LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contractPeriod The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByContractPeriod($contractPeriod = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contractPeriod)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contractPeriod)) {
                $contractPeriod = str_replace('*', '%', $contractPeriod);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_CONTRACT_PERIOD, $contractPeriod, $comparison);
    }

    /**
     * Filter the query on the participation_warranty column
     *
     * Example usage:
     * <code>
     * $query->filterByParticipationWarranty('fooValue');   // WHERE participation_warranty = 'fooValue'
     * $query->filterByParticipationWarranty('%fooValue%'); // WHERE participation_warranty LIKE '%fooValue%'
     * </code>
     *
     * @param     string $participationWarranty The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByParticipationWarranty($participationWarranty = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($participationWarranty)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $participationWarranty)) {
                $participationWarranty = str_replace('*', '%', $participationWarranty);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_PARTICIPATION_WARRANTY, $participationWarranty, $comparison);
    }

    /**
     * Filter the query on the participation_conditions column
     *
     * Example usage:
     * <code>
     * $query->filterByParticipationConditions('fooValue');   // WHERE participation_conditions = 'fooValue'
     * $query->filterByParticipationConditions('%fooValue%'); // WHERE participation_conditions LIKE '%fooValue%'
     * </code>
     *
     * @param     string $participationConditions The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByParticipationConditions($participationConditions = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($participationConditions)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $participationConditions)) {
                $participationConditions = str_replace('*', '%', $participationConditions);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_PARTICIPATION_CONDITIONS, $participationConditions, $comparison);
    }

    /**
     * Filter the query on the professional_ability column
     *
     * Example usage:
     * <code>
     * $query->filterByProfessionalAbility('fooValue');   // WHERE professional_ability = 'fooValue'
     * $query->filterByProfessionalAbility('%fooValue%'); // WHERE professional_ability LIKE '%fooValue%'
     * </code>
     *
     * @param     string $professionalAbility The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByProfessionalAbility($professionalAbility = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($professionalAbility)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $professionalAbility)) {
                $professionalAbility = str_replace('*', '%', $professionalAbility);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_PROFESSIONAL_ABILITY, $professionalAbility, $comparison);
    }

    /**
     * Filter the query on the average_turnover column
     *
     * Example usage:
     * <code>
     * $query->filterByAverageTurnover('fooValue');   // WHERE average_turnover = 'fooValue'
     * $query->filterByAverageTurnover('%fooValue%'); // WHERE average_turnover LIKE '%fooValue%'
     * </code>
     *
     * @param     string $averageTurnover The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByAverageTurnover($averageTurnover = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($averageTurnover)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $averageTurnover)) {
                $averageTurnover = str_replace('*', '%', $averageTurnover);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_AVERAGE_TURNOVER, $averageTurnover, $comparison);
    }

    /**
     * Filter the query on the cash_flow column
     *
     * Example usage:
     * <code>
     * $query->filterByCashFlow('fooValue');   // WHERE cash_flow = 'fooValue'
     * $query->filterByCashFlow('%fooValue%'); // WHERE cash_flow LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cashFlow The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByCashFlow($cashFlow = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cashFlow)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cashFlow)) {
                $cashFlow = str_replace('*', '%', $cashFlow);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_CASH_FLOW, $cashFlow, $comparison);
    }

    /**
     * Filter the query on the similar_experience column
     *
     * Example usage:
     * <code>
     * $query->filterBySimilarExperience('fooValue');   // WHERE similar_experience = 'fooValue'
     * $query->filterBySimilarExperience('%fooValue%'); // WHERE similar_experience LIKE '%fooValue%'
     * </code>
     *
     * @param     string $similarExperience The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterBySimilarExperience($similarExperience = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($similarExperience)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $similarExperience)) {
                $similarExperience = str_replace('*', '%', $similarExperience);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_SIMILAR_EXPERIENCE, $similarExperience, $comparison);
    }

    /**
     * Filter the query on the key_personnel column
     *
     * Example usage:
     * <code>
     * $query->filterByKeyPersonnel('fooValue');   // WHERE key_personnel = 'fooValue'
     * $query->filterByKeyPersonnel('%fooValue%'); // WHERE key_personnel LIKE '%fooValue%'
     * </code>
     *
     * @param     string $keyPersonnel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByKeyPersonnel($keyPersonnel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($keyPersonnel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $keyPersonnel)) {
                $keyPersonnel = str_replace('*', '%', $keyPersonnel);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_KEY_PERSONNEL, $keyPersonnel, $comparison);
    }

    /**
     * Filter the query on the equipment column
     *
     * Example usage:
     * <code>
     * $query->filterByEquipment('fooValue');   // WHERE equipment = 'fooValue'
     * $query->filterByEquipment('%fooValue%'); // WHERE equipment LIKE '%fooValue%'
     * </code>
     *
     * @param     string $equipment The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByEquipment($equipment = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($equipment)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $equipment)) {
                $equipment = str_replace('*', '%', $equipment);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_EQUIPMENT, $equipment, $comparison);
    }

    /**
     * Filter the query on the quality_assurance column
     *
     * Example usage:
     * <code>
     * $query->filterByQualityAssurance('fooValue');   // WHERE quality_assurance = 'fooValue'
     * $query->filterByQualityAssurance('%fooValue%'); // WHERE quality_assurance LIKE '%fooValue%'
     * </code>
     *
     * @param     string $qualityAssurance The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByQualityAssurance($qualityAssurance = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($qualityAssurance)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $qualityAssurance)) {
                $qualityAssurance = str_replace('*', '%', $qualityAssurance);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_QUALITY_ASSURANCE, $qualityAssurance, $comparison);
    }

    /**
     * Filter the query on the additional_information column
     *
     * Example usage:
     * <code>
     * $query->filterByAdditionalInformation('fooValue');   // WHERE additional_information = 'fooValue'
     * $query->filterByAdditionalInformation('%fooValue%'); // WHERE additional_information LIKE '%fooValue%'
     * </code>
     *
     * @param     string $additionalInformation The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function filterByAdditionalInformation($additionalInformation = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($additionalInformation)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $additionalInformation)) {
                $additionalInformation = str_replace('*', '%', $additionalInformation);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuctionTableMap::COL_ADDITIONAL_INFORMATION, $additionalInformation, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAuction $auction Object to remove from the list of results
     *
     * @return $this|ChildAuctionQuery The current query, for fluid interface
     */
    public function prune($auction = null)
    {
        if ($auction) {
            $this->addUsingAlias(AuctionTableMap::COL_ID, $auction->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the auction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AuctionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AuctionTableMap::clearInstancePool();
            AuctionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AuctionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AuctionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AuctionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AuctionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AuctionQuery
