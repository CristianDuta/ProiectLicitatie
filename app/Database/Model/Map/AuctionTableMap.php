<?php

namespace Database\Model\Map;

use Database\Model\Auction;
use Database\Model\AuctionQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'auction' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class AuctionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Database.Model.Map.AuctionTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'auction';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Database\\Model\\Auction';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Database.Model.Auction';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 25;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 25;

    /**
     * the column name for the id field
     */
    const COL_ID = 'auction.id';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'auction.title';

    /**
     * the column name for the estimated_value field
     */
    const COL_ESTIMATED_VALUE = 'auction.estimated_value';

    /**
     * the column name for the location field
     */
    const COL_LOCATION = 'auction.location';

    /**
     * the column name for the documentation field
     */
    const COL_DOCUMENTATION = 'auction.documentation';

    /**
     * the column name for the ad_number field
     */
    const COL_AD_NUMBER = 'auction.ad_number';

    /**
     * the column name for the publish_date field
     */
    const COL_PUBLISH_DATE = 'auction.publish_date';

    /**
     * the column name for the gainer field
     */
    const COL_GAINER = 'auction.gainer';

    /**
     * the column name for the contract_type field
     */
    const COL_CONTRACT_TYPE = 'auction.contract_type';

    /**
     * the column name for the funding_type field
     */
    const COL_FUNDING_TYPE = 'auction.funding_type';

    /**
     * the column name for the contract_subject field
     */
    const COL_CONTRACT_SUBJECT = 'auction.contract_subject';

    /**
     * the column name for the offer_end_date field
     */
    const COL_OFFER_END_DATE = 'auction.offer_end_date';

    /**
     * the column name for the apply_mode field
     */
    const COL_APPLY_MODE = 'auction.apply_mode';

    /**
     * the column name for the contract_period field
     */
    const COL_CONTRACT_PERIOD = 'auction.contract_period';

    /**
     * the column name for the participation_warranty field
     */
    const COL_PARTICIPATION_WARRANTY = 'auction.participation_warranty';

    /**
     * the column name for the participation_conditions field
     */
    const COL_PARTICIPATION_CONDITIONS = 'auction.participation_conditions';

    /**
     * the column name for the professional_ability field
     */
    const COL_PROFESSIONAL_ABILITY = 'auction.professional_ability';

    /**
     * the column name for the average_turnover field
     */
    const COL_AVERAGE_TURNOVER = 'auction.average_turnover';

    /**
     * the column name for the cash_flow field
     */
    const COL_CASH_FLOW = 'auction.cash_flow';

    /**
     * the column name for the similar_experience field
     */
    const COL_SIMILAR_EXPERIENCE = 'auction.similar_experience';

    /**
     * the column name for the key_personnel field
     */
    const COL_KEY_PERSONNEL = 'auction.key_personnel';

    /**
     * the column name for the equipment field
     */
    const COL_EQUIPMENT = 'auction.equipment';

    /**
     * the column name for the quality_assurance field
     */
    const COL_QUALITY_ASSURANCE = 'auction.quality_assurance';

    /**
     * the column name for the additional_information field
     */
    const COL_ADDITIONAL_INFORMATION = 'auction.additional_information';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'auction.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Title', 'EstimatedValue', 'Location', 'Documentation', 'AdNumber', 'PublishDate', 'Gainer', 'ContractType', 'FundingType', 'ContractSubject', 'OfferEndDate', 'ApplyMode', 'ContractPeriod', 'ParticipationWarranty', 'ParticipationConditions', 'ProfessionalAbility', 'AverageTurnover', 'CashFlow', 'SimilarExperience', 'KeyPersonnel', 'Equipment', 'QualityAssurance', 'AdditionalInformation', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'title', 'estimatedValue', 'location', 'documentation', 'adNumber', 'publishDate', 'gainer', 'contractType', 'fundingType', 'contractSubject', 'offerEndDate', 'applyMode', 'contractPeriod', 'participationWarranty', 'participationConditions', 'professionalAbility', 'averageTurnover', 'cashFlow', 'similarExperience', 'keyPersonnel', 'equipment', 'qualityAssurance', 'additionalInformation', 'updatedAt', ),
        self::TYPE_COLNAME       => array(AuctionTableMap::COL_ID, AuctionTableMap::COL_TITLE, AuctionTableMap::COL_ESTIMATED_VALUE, AuctionTableMap::COL_LOCATION, AuctionTableMap::COL_DOCUMENTATION, AuctionTableMap::COL_AD_NUMBER, AuctionTableMap::COL_PUBLISH_DATE, AuctionTableMap::COL_GAINER, AuctionTableMap::COL_CONTRACT_TYPE, AuctionTableMap::COL_FUNDING_TYPE, AuctionTableMap::COL_CONTRACT_SUBJECT, AuctionTableMap::COL_OFFER_END_DATE, AuctionTableMap::COL_APPLY_MODE, AuctionTableMap::COL_CONTRACT_PERIOD, AuctionTableMap::COL_PARTICIPATION_WARRANTY, AuctionTableMap::COL_PARTICIPATION_CONDITIONS, AuctionTableMap::COL_PROFESSIONAL_ABILITY, AuctionTableMap::COL_AVERAGE_TURNOVER, AuctionTableMap::COL_CASH_FLOW, AuctionTableMap::COL_SIMILAR_EXPERIENCE, AuctionTableMap::COL_KEY_PERSONNEL, AuctionTableMap::COL_EQUIPMENT, AuctionTableMap::COL_QUALITY_ASSURANCE, AuctionTableMap::COL_ADDITIONAL_INFORMATION, AuctionTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'title', 'estimated_value', 'location', 'documentation', 'ad_number', 'publish_date', 'gainer', 'contract_type', 'funding_type', 'contract_subject', 'offer_end_date', 'apply_mode', 'contract_period', 'participation_warranty', 'participation_conditions', 'professional_ability', 'average_turnover', 'cash_flow', 'similar_experience', 'key_personnel', 'equipment', 'quality_assurance', 'additional_information', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Title' => 1, 'EstimatedValue' => 2, 'Location' => 3, 'Documentation' => 4, 'AdNumber' => 5, 'PublishDate' => 6, 'Gainer' => 7, 'ContractType' => 8, 'FundingType' => 9, 'ContractSubject' => 10, 'OfferEndDate' => 11, 'ApplyMode' => 12, 'ContractPeriod' => 13, 'ParticipationWarranty' => 14, 'ParticipationConditions' => 15, 'ProfessionalAbility' => 16, 'AverageTurnover' => 17, 'CashFlow' => 18, 'SimilarExperience' => 19, 'KeyPersonnel' => 20, 'Equipment' => 21, 'QualityAssurance' => 22, 'AdditionalInformation' => 23, 'UpdatedAt' => 24, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'title' => 1, 'estimatedValue' => 2, 'location' => 3, 'documentation' => 4, 'adNumber' => 5, 'publishDate' => 6, 'gainer' => 7, 'contractType' => 8, 'fundingType' => 9, 'contractSubject' => 10, 'offerEndDate' => 11, 'applyMode' => 12, 'contractPeriod' => 13, 'participationWarranty' => 14, 'participationConditions' => 15, 'professionalAbility' => 16, 'averageTurnover' => 17, 'cashFlow' => 18, 'similarExperience' => 19, 'keyPersonnel' => 20, 'equipment' => 21, 'qualityAssurance' => 22, 'additionalInformation' => 23, 'updatedAt' => 24, ),
        self::TYPE_COLNAME       => array(AuctionTableMap::COL_ID => 0, AuctionTableMap::COL_TITLE => 1, AuctionTableMap::COL_ESTIMATED_VALUE => 2, AuctionTableMap::COL_LOCATION => 3, AuctionTableMap::COL_DOCUMENTATION => 4, AuctionTableMap::COL_AD_NUMBER => 5, AuctionTableMap::COL_PUBLISH_DATE => 6, AuctionTableMap::COL_GAINER => 7, AuctionTableMap::COL_CONTRACT_TYPE => 8, AuctionTableMap::COL_FUNDING_TYPE => 9, AuctionTableMap::COL_CONTRACT_SUBJECT => 10, AuctionTableMap::COL_OFFER_END_DATE => 11, AuctionTableMap::COL_APPLY_MODE => 12, AuctionTableMap::COL_CONTRACT_PERIOD => 13, AuctionTableMap::COL_PARTICIPATION_WARRANTY => 14, AuctionTableMap::COL_PARTICIPATION_CONDITIONS => 15, AuctionTableMap::COL_PROFESSIONAL_ABILITY => 16, AuctionTableMap::COL_AVERAGE_TURNOVER => 17, AuctionTableMap::COL_CASH_FLOW => 18, AuctionTableMap::COL_SIMILAR_EXPERIENCE => 19, AuctionTableMap::COL_KEY_PERSONNEL => 20, AuctionTableMap::COL_EQUIPMENT => 21, AuctionTableMap::COL_QUALITY_ASSURANCE => 22, AuctionTableMap::COL_ADDITIONAL_INFORMATION => 23, AuctionTableMap::COL_UPDATED_AT => 24, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'title' => 1, 'estimated_value' => 2, 'location' => 3, 'documentation' => 4, 'ad_number' => 5, 'publish_date' => 6, 'gainer' => 7, 'contract_type' => 8, 'funding_type' => 9, 'contract_subject' => 10, 'offer_end_date' => 11, 'apply_mode' => 12, 'contract_period' => 13, 'participation_warranty' => 14, 'participation_conditions' => 15, 'professional_ability' => 16, 'average_turnover' => 17, 'cash_flow' => 18, 'similar_experience' => 19, 'key_personnel' => 20, 'equipment' => 21, 'quality_assurance' => 22, 'additional_information' => 23, 'updated_at' => 24, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('auction');
        $this->setPhpName('Auction');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Database\\Model\\Auction');
        $this->setPackage('Database.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 11, null);
        $this->addColumn('title', 'Title', 'LONGVARCHAR', true, null, null);
        $this->addColumn('estimated_value', 'EstimatedValue', 'VARCHAR', true, 255, null);
        $this->addColumn('location', 'Location', 'VARCHAR', true, 255, null);
        $this->addColumn('documentation', 'Documentation', 'LONGVARCHAR', false, null, null);
        $this->addColumn('ad_number', 'AdNumber', 'INTEGER', false, 11, null);
        $this->addColumn('publish_date', 'PublishDate', 'DATE', true, null, null);
        $this->addColumn('gainer', 'Gainer', 'VARCHAR', false, 255, null);
        $this->addColumn('contract_type', 'ContractType', 'VARCHAR', true, 255, null);
        $this->addColumn('funding_type', 'FundingType', 'VARCHAR', true, 255, null);
        $this->addColumn('contract_subject', 'ContractSubject', 'LONGVARCHAR', false, null, null);
        $this->addColumn('offer_end_date', 'OfferEndDate', 'DATE', true, null, null);
        $this->addColumn('apply_mode', 'ApplyMode', 'VARCHAR', false, 255, null);
        $this->addColumn('contract_period', 'ContractPeriod', 'VARCHAR', false, 255, null);
        $this->addColumn('participation_warranty', 'ParticipationWarranty', 'VARCHAR', false, 255, null);
        $this->addColumn('participation_conditions', 'ParticipationConditions', 'VARCHAR', false, 255, null);
        $this->addColumn('professional_ability', 'ProfessionalAbility', 'LONGVARCHAR', false, null, null);
        $this->addColumn('average_turnover', 'AverageTurnover', 'VARCHAR', false, 255, null);
        $this->addColumn('cash_flow', 'CashFlow', 'VARCHAR', false, 255, null);
        $this->addColumn('similar_experience', 'SimilarExperience', 'LONGVARCHAR', false, null, null);
        $this->addColumn('key_personnel', 'KeyPersonnel', 'VARCHAR', false, 255, null);
        $this->addColumn('equipment', 'Equipment', 'LONGVARCHAR', false, null, null);
        $this->addColumn('quality_assurance', 'QualityAssurance', 'LONGVARCHAR', false, null, null);
        $this->addColumn('additional_information', 'AdditionalInformation', 'LONGVARCHAR', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'DATE', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? AuctionTableMap::CLASS_DEFAULT : AuctionTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Auction object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = AuctionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AuctionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AuctionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AuctionTableMap::OM_CLASS;
            /** @var Auction $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AuctionTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = AuctionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AuctionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Auction $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AuctionTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(AuctionTableMap::COL_ID);
            $criteria->addSelectColumn(AuctionTableMap::COL_TITLE);
            $criteria->addSelectColumn(AuctionTableMap::COL_ESTIMATED_VALUE);
            $criteria->addSelectColumn(AuctionTableMap::COL_LOCATION);
            $criteria->addSelectColumn(AuctionTableMap::COL_DOCUMENTATION);
            $criteria->addSelectColumn(AuctionTableMap::COL_AD_NUMBER);
            $criteria->addSelectColumn(AuctionTableMap::COL_PUBLISH_DATE);
            $criteria->addSelectColumn(AuctionTableMap::COL_GAINER);
            $criteria->addSelectColumn(AuctionTableMap::COL_CONTRACT_TYPE);
            $criteria->addSelectColumn(AuctionTableMap::COL_FUNDING_TYPE);
            $criteria->addSelectColumn(AuctionTableMap::COL_CONTRACT_SUBJECT);
            $criteria->addSelectColumn(AuctionTableMap::COL_OFFER_END_DATE);
            $criteria->addSelectColumn(AuctionTableMap::COL_APPLY_MODE);
            $criteria->addSelectColumn(AuctionTableMap::COL_CONTRACT_PERIOD);
            $criteria->addSelectColumn(AuctionTableMap::COL_PARTICIPATION_WARRANTY);
            $criteria->addSelectColumn(AuctionTableMap::COL_PARTICIPATION_CONDITIONS);
            $criteria->addSelectColumn(AuctionTableMap::COL_PROFESSIONAL_ABILITY);
            $criteria->addSelectColumn(AuctionTableMap::COL_AVERAGE_TURNOVER);
            $criteria->addSelectColumn(AuctionTableMap::COL_CASH_FLOW);
            $criteria->addSelectColumn(AuctionTableMap::COL_SIMILAR_EXPERIENCE);
            $criteria->addSelectColumn(AuctionTableMap::COL_KEY_PERSONNEL);
            $criteria->addSelectColumn(AuctionTableMap::COL_EQUIPMENT);
            $criteria->addSelectColumn(AuctionTableMap::COL_QUALITY_ASSURANCE);
            $criteria->addSelectColumn(AuctionTableMap::COL_ADDITIONAL_INFORMATION);
            $criteria->addSelectColumn(AuctionTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.estimated_value');
            $criteria->addSelectColumn($alias . '.location');
            $criteria->addSelectColumn($alias . '.documentation');
            $criteria->addSelectColumn($alias . '.ad_number');
            $criteria->addSelectColumn($alias . '.publish_date');
            $criteria->addSelectColumn($alias . '.gainer');
            $criteria->addSelectColumn($alias . '.contract_type');
            $criteria->addSelectColumn($alias . '.funding_type');
            $criteria->addSelectColumn($alias . '.contract_subject');
            $criteria->addSelectColumn($alias . '.offer_end_date');
            $criteria->addSelectColumn($alias . '.apply_mode');
            $criteria->addSelectColumn($alias . '.contract_period');
            $criteria->addSelectColumn($alias . '.participation_warranty');
            $criteria->addSelectColumn($alias . '.participation_conditions');
            $criteria->addSelectColumn($alias . '.professional_ability');
            $criteria->addSelectColumn($alias . '.average_turnover');
            $criteria->addSelectColumn($alias . '.cash_flow');
            $criteria->addSelectColumn($alias . '.similar_experience');
            $criteria->addSelectColumn($alias . '.key_personnel');
            $criteria->addSelectColumn($alias . '.equipment');
            $criteria->addSelectColumn($alias . '.quality_assurance');
            $criteria->addSelectColumn($alias . '.additional_information');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(AuctionTableMap::DATABASE_NAME)->getTable(AuctionTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(AuctionTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(AuctionTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new AuctionTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Auction or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Auction object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AuctionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Database\Model\Auction) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AuctionTableMap::DATABASE_NAME);
            $criteria->add(AuctionTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = AuctionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AuctionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AuctionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the auction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return AuctionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Auction or Criteria object.
     *
     * @param mixed               $criteria Criteria or Auction object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AuctionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Auction object
        }

        if ($criteria->containsKey(AuctionTableMap::COL_ID) && $criteria->keyContainsValue(AuctionTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AuctionTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = AuctionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // AuctionTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
AuctionTableMap::buildTableMap();
