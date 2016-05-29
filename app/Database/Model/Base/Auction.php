<?php

namespace Database\Model\Base;

use \DateTime;
use \Exception;
use \PDO;
use Database\Model\Auction as ChildAuction;
use Database\Model\AuctionQuery as ChildAuctionQuery;
use Database\Model\Map\AuctionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'auction' table.
 *
 *
 *
* @package    propel.generator.Database.Model.Base
*/
abstract class Auction implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Database\\Model\\Map\\AuctionTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the title field.
     *
     * @var        string
     */
    protected $title;

    /**
     * The value for the estimated_value field.
     *
     * @var        string
     */
    protected $estimated_value;

    /**
     * The value for the location field.
     *
     * @var        string
     */
    protected $location;

    /**
     * The value for the documentation field.
     *
     * @var        string
     */
    protected $documentation;

    /**
     * The value for the ad_number field.
     *
     * @var        int
     */
    protected $ad_number;

    /**
     * The value for the publish_date field.
     *
     * @var        DateTime
     */
    protected $publish_date;

    /**
     * The value for the gainer field.
     *
     * @var        string
     */
    protected $gainer;

    /**
     * The value for the contract_type field.
     *
     * @var        string
     */
    protected $contract_type;

    /**
     * The value for the funding_type field.
     *
     * @var        string
     */
    protected $funding_type;

    /**
     * The value for the contract_subject field.
     *
     * @var        string
     */
    protected $contract_subject;

    /**
     * The value for the offer_end_date field.
     *
     * @var        DateTime
     */
    protected $offer_end_date;

    /**
     * The value for the apply_mode field.
     *
     * @var        string
     */
    protected $apply_mode;

    /**
     * The value for the contract_period field.
     *
     * @var        string
     */
    protected $contract_period;

    /**
     * The value for the participation_warranty field.
     *
     * @var        string
     */
    protected $participation_warranty;

    /**
     * The value for the participation_conditions field.
     *
     * @var        string
     */
    protected $participation_conditions;

    /**
     * The value for the professional_ability field.
     *
     * @var        string
     */
    protected $professional_ability;

    /**
     * The value for the average_turnover field.
     *
     * @var        string
     */
    protected $average_turnover;

    /**
     * The value for the cash_flow field.
     *
     * @var        string
     */
    protected $cash_flow;

    /**
     * The value for the similar_experience field.
     *
     * @var        string
     */
    protected $similar_experience;

    /**
     * The value for the key_personnel field.
     *
     * @var        string
     */
    protected $key_personnel;

    /**
     * The value for the equipment field.
     *
     * @var        string
     */
    protected $equipment;

    /**
     * The value for the quality_assurance field.
     *
     * @var        string
     */
    protected $quality_assurance;

    /**
     * The value for the additional_information field.
     *
     * @var        string
     */
    protected $additional_information;

    /**
     * The value for the created_at field.
     *
     * @var        DateTime
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * @var        DateTime
     */
    protected $updated_at;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Database\Model\Base\Auction object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Auction</code> instance.  If
     * <code>obj</code> is an instance of <code>Auction</code>, delegates to
     * <code>equals(Auction)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Auction The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [title] column value.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the [estimated_value] column value.
     *
     * @return string
     */
    public function getEstimatedValue()
    {
        return $this->estimated_value;
    }

    /**
     * Get the [location] column value.
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Get the [documentation] column value.
     *
     * @return string
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Get the [ad_number] column value.
     *
     * @return int
     */
    public function getAdNumber()
    {
        return $this->ad_number;
    }

    /**
     * Get the [optionally formatted] temporal [publish_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getPublishDate($format = NULL)
    {
        if ($format === null) {
            return $this->publish_date;
        } else {
            return $this->publish_date instanceof \DateTimeInterface ? $this->publish_date->format($format) : null;
        }
    }

    /**
     * Get the [gainer] column value.
     *
     * @return string
     */
    public function getGainer()
    {
        return $this->gainer;
    }

    /**
     * Get the [contract_type] column value.
     *
     * @return string
     */
    public function getContractType()
    {
        return $this->contract_type;
    }

    /**
     * Get the [funding_type] column value.
     *
     * @return string
     */
    public function getFundingType()
    {
        return $this->funding_type;
    }

    /**
     * Get the [contract_subject] column value.
     *
     * @return string
     */
    public function getContractSubject()
    {
        return $this->contract_subject;
    }

    /**
     * Get the [optionally formatted] temporal [offer_end_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getOfferEndDate($format = NULL)
    {
        if ($format === null) {
            return $this->offer_end_date;
        } else {
            return $this->offer_end_date instanceof \DateTimeInterface ? $this->offer_end_date->format($format) : null;
        }
    }

    /**
     * Get the [apply_mode] column value.
     *
     * @return string
     */
    public function getApplyMode()
    {
        return $this->apply_mode;
    }

    /**
     * Get the [contract_period] column value.
     *
     * @return string
     */
    public function getContractPeriod()
    {
        return $this->contract_period;
    }

    /**
     * Get the [participation_warranty] column value.
     *
     * @return string
     */
    public function getParticipationWarranty()
    {
        return $this->participation_warranty;
    }

    /**
     * Get the [participation_conditions] column value.
     *
     * @return string
     */
    public function getParticipationConditions()
    {
        return $this->participation_conditions;
    }

    /**
     * Get the [professional_ability] column value.
     *
     * @return string
     */
    public function getProfessionalAbility()
    {
        return $this->professional_ability;
    }

    /**
     * Get the [average_turnover] column value.
     *
     * @return string
     */
    public function getAverageTurnover()
    {
        return $this->average_turnover;
    }

    /**
     * Get the [cash_flow] column value.
     *
     * @return string
     */
    public function getCashFlow()
    {
        return $this->cash_flow;
    }

    /**
     * Get the [similar_experience] column value.
     *
     * @return string
     */
    public function getSimilarExperience()
    {
        return $this->similar_experience;
    }

    /**
     * Get the [key_personnel] column value.
     *
     * @return string
     */
    public function getKeyPersonnel()
    {
        return $this->key_personnel;
    }

    /**
     * Get the [equipment] column value.
     *
     * @return string
     */
    public function getEquipment()
    {
        return $this->equipment;
    }

    /**
     * Get the [quality_assurance] column value.
     *
     * @return string
     */
    public function getQualityAssurance()
    {
        return $this->quality_assurance;
    }

    /**
     * Get the [additional_information] column value.
     *
     * @return string
     */
    public function getAdditionalInformation()
    {
        return $this->additional_information;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTimeInterface ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[AuctionTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[AuctionTableMap::COL_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Set the value of [estimated_value] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setEstimatedValue($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->estimated_value !== $v) {
            $this->estimated_value = $v;
            $this->modifiedColumns[AuctionTableMap::COL_ESTIMATED_VALUE] = true;
        }

        return $this;
    } // setEstimatedValue()

    /**
     * Set the value of [location] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setLocation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->location !== $v) {
            $this->location = $v;
            $this->modifiedColumns[AuctionTableMap::COL_LOCATION] = true;
        }

        return $this;
    } // setLocation()

    /**
     * Set the value of [documentation] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setDocumentation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->documentation !== $v) {
            $this->documentation = $v;
            $this->modifiedColumns[AuctionTableMap::COL_DOCUMENTATION] = true;
        }

        return $this;
    } // setDocumentation()

    /**
     * Set the value of [ad_number] column.
     *
     * @param int $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setAdNumber($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ad_number !== $v) {
            $this->ad_number = $v;
            $this->modifiedColumns[AuctionTableMap::COL_AD_NUMBER] = true;
        }

        return $this;
    } // setAdNumber()

    /**
     * Sets the value of [publish_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setPublishDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->publish_date !== null || $dt !== null) {
            if ($this->publish_date === null || $dt === null || $dt->format("Y-m-d") !== $this->publish_date->format("Y-m-d")) {
                $this->publish_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[AuctionTableMap::COL_PUBLISH_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setPublishDate()

    /**
     * Set the value of [gainer] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setGainer($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gainer !== $v) {
            $this->gainer = $v;
            $this->modifiedColumns[AuctionTableMap::COL_GAINER] = true;
        }

        return $this;
    } // setGainer()

    /**
     * Set the value of [contract_type] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setContractType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contract_type !== $v) {
            $this->contract_type = $v;
            $this->modifiedColumns[AuctionTableMap::COL_CONTRACT_TYPE] = true;
        }

        return $this;
    } // setContractType()

    /**
     * Set the value of [funding_type] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setFundingType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->funding_type !== $v) {
            $this->funding_type = $v;
            $this->modifiedColumns[AuctionTableMap::COL_FUNDING_TYPE] = true;
        }

        return $this;
    } // setFundingType()

    /**
     * Set the value of [contract_subject] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setContractSubject($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contract_subject !== $v) {
            $this->contract_subject = $v;
            $this->modifiedColumns[AuctionTableMap::COL_CONTRACT_SUBJECT] = true;
        }

        return $this;
    } // setContractSubject()

    /**
     * Sets the value of [offer_end_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setOfferEndDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->offer_end_date !== null || $dt !== null) {
            if ($this->offer_end_date === null || $dt === null || $dt->format("Y-m-d") !== $this->offer_end_date->format("Y-m-d")) {
                $this->offer_end_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[AuctionTableMap::COL_OFFER_END_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setOfferEndDate()

    /**
     * Set the value of [apply_mode] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setApplyMode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->apply_mode !== $v) {
            $this->apply_mode = $v;
            $this->modifiedColumns[AuctionTableMap::COL_APPLY_MODE] = true;
        }

        return $this;
    } // setApplyMode()

    /**
     * Set the value of [contract_period] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setContractPeriod($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contract_period !== $v) {
            $this->contract_period = $v;
            $this->modifiedColumns[AuctionTableMap::COL_CONTRACT_PERIOD] = true;
        }

        return $this;
    } // setContractPeriod()

    /**
     * Set the value of [participation_warranty] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setParticipationWarranty($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->participation_warranty !== $v) {
            $this->participation_warranty = $v;
            $this->modifiedColumns[AuctionTableMap::COL_PARTICIPATION_WARRANTY] = true;
        }

        return $this;
    } // setParticipationWarranty()

    /**
     * Set the value of [participation_conditions] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setParticipationConditions($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->participation_conditions !== $v) {
            $this->participation_conditions = $v;
            $this->modifiedColumns[AuctionTableMap::COL_PARTICIPATION_CONDITIONS] = true;
        }

        return $this;
    } // setParticipationConditions()

    /**
     * Set the value of [professional_ability] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setProfessionalAbility($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->professional_ability !== $v) {
            $this->professional_ability = $v;
            $this->modifiedColumns[AuctionTableMap::COL_PROFESSIONAL_ABILITY] = true;
        }

        return $this;
    } // setProfessionalAbility()

    /**
     * Set the value of [average_turnover] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setAverageTurnover($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->average_turnover !== $v) {
            $this->average_turnover = $v;
            $this->modifiedColumns[AuctionTableMap::COL_AVERAGE_TURNOVER] = true;
        }

        return $this;
    } // setAverageTurnover()

    /**
     * Set the value of [cash_flow] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setCashFlow($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cash_flow !== $v) {
            $this->cash_flow = $v;
            $this->modifiedColumns[AuctionTableMap::COL_CASH_FLOW] = true;
        }

        return $this;
    } // setCashFlow()

    /**
     * Set the value of [similar_experience] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setSimilarExperience($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->similar_experience !== $v) {
            $this->similar_experience = $v;
            $this->modifiedColumns[AuctionTableMap::COL_SIMILAR_EXPERIENCE] = true;
        }

        return $this;
    } // setSimilarExperience()

    /**
     * Set the value of [key_personnel] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setKeyPersonnel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->key_personnel !== $v) {
            $this->key_personnel = $v;
            $this->modifiedColumns[AuctionTableMap::COL_KEY_PERSONNEL] = true;
        }

        return $this;
    } // setKeyPersonnel()

    /**
     * Set the value of [equipment] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setEquipment($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->equipment !== $v) {
            $this->equipment = $v;
            $this->modifiedColumns[AuctionTableMap::COL_EQUIPMENT] = true;
        }

        return $this;
    } // setEquipment()

    /**
     * Set the value of [quality_assurance] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setQualityAssurance($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->quality_assurance !== $v) {
            $this->quality_assurance = $v;
            $this->modifiedColumns[AuctionTableMap::COL_QUALITY_ASSURANCE] = true;
        }

        return $this;
    } // setQualityAssurance()

    /**
     * Set the value of [additional_information] column.
     *
     * @param string $v new value
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setAdditionalInformation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->additional_information !== $v) {
            $this->additional_information = $v;
            $this->modifiedColumns[AuctionTableMap::COL_ADDITIONAL_INFORMATION] = true;
        }

        return $this;
    } // setAdditionalInformation()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[AuctionTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Database\Model\Auction The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[AuctionTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : AuctionTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : AuctionTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : AuctionTableMap::translateFieldName('EstimatedValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->estimated_value = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : AuctionTableMap::translateFieldName('Location', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : AuctionTableMap::translateFieldName('Documentation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->documentation = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : AuctionTableMap::translateFieldName('AdNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ad_number = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : AuctionTableMap::translateFieldName('PublishDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->publish_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : AuctionTableMap::translateFieldName('Gainer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gainer = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : AuctionTableMap::translateFieldName('ContractType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contract_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : AuctionTableMap::translateFieldName('FundingType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->funding_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : AuctionTableMap::translateFieldName('ContractSubject', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contract_subject = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : AuctionTableMap::translateFieldName('OfferEndDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->offer_end_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : AuctionTableMap::translateFieldName('ApplyMode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->apply_mode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : AuctionTableMap::translateFieldName('ContractPeriod', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contract_period = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : AuctionTableMap::translateFieldName('ParticipationWarranty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->participation_warranty = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : AuctionTableMap::translateFieldName('ParticipationConditions', TableMap::TYPE_PHPNAME, $indexType)];
            $this->participation_conditions = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : AuctionTableMap::translateFieldName('ProfessionalAbility', TableMap::TYPE_PHPNAME, $indexType)];
            $this->professional_ability = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : AuctionTableMap::translateFieldName('AverageTurnover', TableMap::TYPE_PHPNAME, $indexType)];
            $this->average_turnover = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : AuctionTableMap::translateFieldName('CashFlow', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cash_flow = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : AuctionTableMap::translateFieldName('SimilarExperience', TableMap::TYPE_PHPNAME, $indexType)];
            $this->similar_experience = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : AuctionTableMap::translateFieldName('KeyPersonnel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key_personnel = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : AuctionTableMap::translateFieldName('Equipment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->equipment = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : AuctionTableMap::translateFieldName('QualityAssurance', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quality_assurance = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : AuctionTableMap::translateFieldName('AdditionalInformation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->additional_information = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : AuctionTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : AuctionTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 26; // 26 = AuctionTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Database\\Model\\Auction'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AuctionTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildAuctionQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Auction::setDeleted()
     * @see Auction::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AuctionTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildAuctionQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AuctionTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior

                if (!$this->isColumnModified(AuctionTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(AuctionTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(AuctionTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                AuctionTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[AuctionTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . AuctionTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AuctionTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'title';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_ESTIMATED_VALUE)) {
            $modifiedColumns[':p' . $index++]  = 'estimated_value';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_LOCATION)) {
            $modifiedColumns[':p' . $index++]  = 'location';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_DOCUMENTATION)) {
            $modifiedColumns[':p' . $index++]  = 'documentation';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_AD_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'ad_number';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_PUBLISH_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'publish_date';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_GAINER)) {
            $modifiedColumns[':p' . $index++]  = 'gainer';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_CONTRACT_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'contract_type';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_FUNDING_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'funding_type';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_CONTRACT_SUBJECT)) {
            $modifiedColumns[':p' . $index++]  = 'contract_subject';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_OFFER_END_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'offer_end_date';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_APPLY_MODE)) {
            $modifiedColumns[':p' . $index++]  = 'apply_mode';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_CONTRACT_PERIOD)) {
            $modifiedColumns[':p' . $index++]  = 'contract_period';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_PARTICIPATION_WARRANTY)) {
            $modifiedColumns[':p' . $index++]  = 'participation_warranty';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_PARTICIPATION_CONDITIONS)) {
            $modifiedColumns[':p' . $index++]  = 'participation_conditions';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_PROFESSIONAL_ABILITY)) {
            $modifiedColumns[':p' . $index++]  = 'professional_ability';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_AVERAGE_TURNOVER)) {
            $modifiedColumns[':p' . $index++]  = 'average_turnover';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_CASH_FLOW)) {
            $modifiedColumns[':p' . $index++]  = 'cash_flow';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_SIMILAR_EXPERIENCE)) {
            $modifiedColumns[':p' . $index++]  = 'similar_experience';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_KEY_PERSONNEL)) {
            $modifiedColumns[':p' . $index++]  = 'key_personnel';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_EQUIPMENT)) {
            $modifiedColumns[':p' . $index++]  = 'equipment';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_QUALITY_ASSURANCE)) {
            $modifiedColumns[':p' . $index++]  = 'quality_assurance';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_ADDITIONAL_INFORMATION)) {
            $modifiedColumns[':p' . $index++]  = 'additional_information';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(AuctionTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO auction (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'title':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case 'estimated_value':
                        $stmt->bindValue($identifier, $this->estimated_value, PDO::PARAM_STR);
                        break;
                    case 'location':
                        $stmt->bindValue($identifier, $this->location, PDO::PARAM_STR);
                        break;
                    case 'documentation':
                        $stmt->bindValue($identifier, $this->documentation, PDO::PARAM_STR);
                        break;
                    case 'ad_number':
                        $stmt->bindValue($identifier, $this->ad_number, PDO::PARAM_INT);
                        break;
                    case 'publish_date':
                        $stmt->bindValue($identifier, $this->publish_date ? $this->publish_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'gainer':
                        $stmt->bindValue($identifier, $this->gainer, PDO::PARAM_STR);
                        break;
                    case 'contract_type':
                        $stmt->bindValue($identifier, $this->contract_type, PDO::PARAM_STR);
                        break;
                    case 'funding_type':
                        $stmt->bindValue($identifier, $this->funding_type, PDO::PARAM_STR);
                        break;
                    case 'contract_subject':
                        $stmt->bindValue($identifier, $this->contract_subject, PDO::PARAM_STR);
                        break;
                    case 'offer_end_date':
                        $stmt->bindValue($identifier, $this->offer_end_date ? $this->offer_end_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'apply_mode':
                        $stmt->bindValue($identifier, $this->apply_mode, PDO::PARAM_STR);
                        break;
                    case 'contract_period':
                        $stmt->bindValue($identifier, $this->contract_period, PDO::PARAM_STR);
                        break;
                    case 'participation_warranty':
                        $stmt->bindValue($identifier, $this->participation_warranty, PDO::PARAM_STR);
                        break;
                    case 'participation_conditions':
                        $stmt->bindValue($identifier, $this->participation_conditions, PDO::PARAM_STR);
                        break;
                    case 'professional_ability':
                        $stmt->bindValue($identifier, $this->professional_ability, PDO::PARAM_STR);
                        break;
                    case 'average_turnover':
                        $stmt->bindValue($identifier, $this->average_turnover, PDO::PARAM_STR);
                        break;
                    case 'cash_flow':
                        $stmt->bindValue($identifier, $this->cash_flow, PDO::PARAM_STR);
                        break;
                    case 'similar_experience':
                        $stmt->bindValue($identifier, $this->similar_experience, PDO::PARAM_STR);
                        break;
                    case 'key_personnel':
                        $stmt->bindValue($identifier, $this->key_personnel, PDO::PARAM_STR);
                        break;
                    case 'equipment':
                        $stmt->bindValue($identifier, $this->equipment, PDO::PARAM_STR);
                        break;
                    case 'quality_assurance':
                        $stmt->bindValue($identifier, $this->quality_assurance, PDO::PARAM_STR);
                        break;
                    case 'additional_information':
                        $stmt->bindValue($identifier, $this->additional_information, PDO::PARAM_STR);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = AuctionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getTitle();
                break;
            case 2:
                return $this->getEstimatedValue();
                break;
            case 3:
                return $this->getLocation();
                break;
            case 4:
                return $this->getDocumentation();
                break;
            case 5:
                return $this->getAdNumber();
                break;
            case 6:
                return $this->getPublishDate();
                break;
            case 7:
                return $this->getGainer();
                break;
            case 8:
                return $this->getContractType();
                break;
            case 9:
                return $this->getFundingType();
                break;
            case 10:
                return $this->getContractSubject();
                break;
            case 11:
                return $this->getOfferEndDate();
                break;
            case 12:
                return $this->getApplyMode();
                break;
            case 13:
                return $this->getContractPeriod();
                break;
            case 14:
                return $this->getParticipationWarranty();
                break;
            case 15:
                return $this->getParticipationConditions();
                break;
            case 16:
                return $this->getProfessionalAbility();
                break;
            case 17:
                return $this->getAverageTurnover();
                break;
            case 18:
                return $this->getCashFlow();
                break;
            case 19:
                return $this->getSimilarExperience();
                break;
            case 20:
                return $this->getKeyPersonnel();
                break;
            case 21:
                return $this->getEquipment();
                break;
            case 22:
                return $this->getQualityAssurance();
                break;
            case 23:
                return $this->getAdditionalInformation();
                break;
            case 24:
                return $this->getCreatedAt();
                break;
            case 25:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {

        if (isset($alreadyDumpedObjects['Auction'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Auction'][$this->hashCode()] = true;
        $keys = AuctionTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getTitle(),
            $keys[2] => $this->getEstimatedValue(),
            $keys[3] => $this->getLocation(),
            $keys[4] => $this->getDocumentation(),
            $keys[5] => $this->getAdNumber(),
            $keys[6] => $this->getPublishDate(),
            $keys[7] => $this->getGainer(),
            $keys[8] => $this->getContractType(),
            $keys[9] => $this->getFundingType(),
            $keys[10] => $this->getContractSubject(),
            $keys[11] => $this->getOfferEndDate(),
            $keys[12] => $this->getApplyMode(),
            $keys[13] => $this->getContractPeriod(),
            $keys[14] => $this->getParticipationWarranty(),
            $keys[15] => $this->getParticipationConditions(),
            $keys[16] => $this->getProfessionalAbility(),
            $keys[17] => $this->getAverageTurnover(),
            $keys[18] => $this->getCashFlow(),
            $keys[19] => $this->getSimilarExperience(),
            $keys[20] => $this->getKeyPersonnel(),
            $keys[21] => $this->getEquipment(),
            $keys[22] => $this->getQualityAssurance(),
            $keys[23] => $this->getAdditionalInformation(),
            $keys[24] => $this->getCreatedAt(),
            $keys[25] => $this->getUpdatedAt(),
        );
        if ($result[$keys[6]] instanceof \DateTime) {
            $result[$keys[6]] = $result[$keys[6]]->format('c');
        }

        if ($result[$keys[11]] instanceof \DateTime) {
            $result[$keys[11]] = $result[$keys[11]]->format('c');
        }

        if ($result[$keys[24]] instanceof \DateTime) {
            $result[$keys[24]] = $result[$keys[24]]->format('c');
        }

        if ($result[$keys[25]] instanceof \DateTime) {
            $result[$keys[25]] = $result[$keys[25]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }


        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Database\Model\Auction
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = AuctionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Database\Model\Auction
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setTitle($value);
                break;
            case 2:
                $this->setEstimatedValue($value);
                break;
            case 3:
                $this->setLocation($value);
                break;
            case 4:
                $this->setDocumentation($value);
                break;
            case 5:
                $this->setAdNumber($value);
                break;
            case 6:
                $this->setPublishDate($value);
                break;
            case 7:
                $this->setGainer($value);
                break;
            case 8:
                $this->setContractType($value);
                break;
            case 9:
                $this->setFundingType($value);
                break;
            case 10:
                $this->setContractSubject($value);
                break;
            case 11:
                $this->setOfferEndDate($value);
                break;
            case 12:
                $this->setApplyMode($value);
                break;
            case 13:
                $this->setContractPeriod($value);
                break;
            case 14:
                $this->setParticipationWarranty($value);
                break;
            case 15:
                $this->setParticipationConditions($value);
                break;
            case 16:
                $this->setProfessionalAbility($value);
                break;
            case 17:
                $this->setAverageTurnover($value);
                break;
            case 18:
                $this->setCashFlow($value);
                break;
            case 19:
                $this->setSimilarExperience($value);
                break;
            case 20:
                $this->setKeyPersonnel($value);
                break;
            case 21:
                $this->setEquipment($value);
                break;
            case 22:
                $this->setQualityAssurance($value);
                break;
            case 23:
                $this->setAdditionalInformation($value);
                break;
            case 24:
                $this->setCreatedAt($value);
                break;
            case 25:
                $this->setUpdatedAt($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = AuctionTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTitle($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setEstimatedValue($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setLocation($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDocumentation($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setAdNumber($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPublishDate($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setGainer($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setContractType($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setFundingType($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setContractSubject($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setOfferEndDate($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setApplyMode($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setContractPeriod($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setParticipationWarranty($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setParticipationConditions($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setProfessionalAbility($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setAverageTurnover($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setCashFlow($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setSimilarExperience($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setKeyPersonnel($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setEquipment($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setQualityAssurance($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setAdditionalInformation($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setCreatedAt($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setUpdatedAt($arr[$keys[25]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Database\Model\Auction The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(AuctionTableMap::DATABASE_NAME);

        if ($this->isColumnModified(AuctionTableMap::COL_ID)) {
            $criteria->add(AuctionTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_TITLE)) {
            $criteria->add(AuctionTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_ESTIMATED_VALUE)) {
            $criteria->add(AuctionTableMap::COL_ESTIMATED_VALUE, $this->estimated_value);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_LOCATION)) {
            $criteria->add(AuctionTableMap::COL_LOCATION, $this->location);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_DOCUMENTATION)) {
            $criteria->add(AuctionTableMap::COL_DOCUMENTATION, $this->documentation);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_AD_NUMBER)) {
            $criteria->add(AuctionTableMap::COL_AD_NUMBER, $this->ad_number);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_PUBLISH_DATE)) {
            $criteria->add(AuctionTableMap::COL_PUBLISH_DATE, $this->publish_date);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_GAINER)) {
            $criteria->add(AuctionTableMap::COL_GAINER, $this->gainer);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_CONTRACT_TYPE)) {
            $criteria->add(AuctionTableMap::COL_CONTRACT_TYPE, $this->contract_type);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_FUNDING_TYPE)) {
            $criteria->add(AuctionTableMap::COL_FUNDING_TYPE, $this->funding_type);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_CONTRACT_SUBJECT)) {
            $criteria->add(AuctionTableMap::COL_CONTRACT_SUBJECT, $this->contract_subject);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_OFFER_END_DATE)) {
            $criteria->add(AuctionTableMap::COL_OFFER_END_DATE, $this->offer_end_date);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_APPLY_MODE)) {
            $criteria->add(AuctionTableMap::COL_APPLY_MODE, $this->apply_mode);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_CONTRACT_PERIOD)) {
            $criteria->add(AuctionTableMap::COL_CONTRACT_PERIOD, $this->contract_period);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_PARTICIPATION_WARRANTY)) {
            $criteria->add(AuctionTableMap::COL_PARTICIPATION_WARRANTY, $this->participation_warranty);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_PARTICIPATION_CONDITIONS)) {
            $criteria->add(AuctionTableMap::COL_PARTICIPATION_CONDITIONS, $this->participation_conditions);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_PROFESSIONAL_ABILITY)) {
            $criteria->add(AuctionTableMap::COL_PROFESSIONAL_ABILITY, $this->professional_ability);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_AVERAGE_TURNOVER)) {
            $criteria->add(AuctionTableMap::COL_AVERAGE_TURNOVER, $this->average_turnover);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_CASH_FLOW)) {
            $criteria->add(AuctionTableMap::COL_CASH_FLOW, $this->cash_flow);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_SIMILAR_EXPERIENCE)) {
            $criteria->add(AuctionTableMap::COL_SIMILAR_EXPERIENCE, $this->similar_experience);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_KEY_PERSONNEL)) {
            $criteria->add(AuctionTableMap::COL_KEY_PERSONNEL, $this->key_personnel);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_EQUIPMENT)) {
            $criteria->add(AuctionTableMap::COL_EQUIPMENT, $this->equipment);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_QUALITY_ASSURANCE)) {
            $criteria->add(AuctionTableMap::COL_QUALITY_ASSURANCE, $this->quality_assurance);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_ADDITIONAL_INFORMATION)) {
            $criteria->add(AuctionTableMap::COL_ADDITIONAL_INFORMATION, $this->additional_information);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_CREATED_AT)) {
            $criteria->add(AuctionTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(AuctionTableMap::COL_UPDATED_AT)) {
            $criteria->add(AuctionTableMap::COL_UPDATED_AT, $this->updated_at);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildAuctionQuery::create();
        $criteria->add(AuctionTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Database\Model\Auction (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTitle($this->getTitle());
        $copyObj->setEstimatedValue($this->getEstimatedValue());
        $copyObj->setLocation($this->getLocation());
        $copyObj->setDocumentation($this->getDocumentation());
        $copyObj->setAdNumber($this->getAdNumber());
        $copyObj->setPublishDate($this->getPublishDate());
        $copyObj->setGainer($this->getGainer());
        $copyObj->setContractType($this->getContractType());
        $copyObj->setFundingType($this->getFundingType());
        $copyObj->setContractSubject($this->getContractSubject());
        $copyObj->setOfferEndDate($this->getOfferEndDate());
        $copyObj->setApplyMode($this->getApplyMode());
        $copyObj->setContractPeriod($this->getContractPeriod());
        $copyObj->setParticipationWarranty($this->getParticipationWarranty());
        $copyObj->setParticipationConditions($this->getParticipationConditions());
        $copyObj->setProfessionalAbility($this->getProfessionalAbility());
        $copyObj->setAverageTurnover($this->getAverageTurnover());
        $copyObj->setCashFlow($this->getCashFlow());
        $copyObj->setSimilarExperience($this->getSimilarExperience());
        $copyObj->setKeyPersonnel($this->getKeyPersonnel());
        $copyObj->setEquipment($this->getEquipment());
        $copyObj->setQualityAssurance($this->getQualityAssurance());
        $copyObj->setAdditionalInformation($this->getAdditionalInformation());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Database\Model\Auction Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->title = null;
        $this->estimated_value = null;
        $this->location = null;
        $this->documentation = null;
        $this->ad_number = null;
        $this->publish_date = null;
        $this->gainer = null;
        $this->contract_type = null;
        $this->funding_type = null;
        $this->contract_subject = null;
        $this->offer_end_date = null;
        $this->apply_mode = null;
        $this->contract_period = null;
        $this->participation_warranty = null;
        $this->participation_conditions = null;
        $this->professional_ability = null;
        $this->average_turnover = null;
        $this->cash_flow = null;
        $this->similar_experience = null;
        $this->key_personnel = null;
        $this->equipment = null;
        $this->quality_assurance = null;
        $this->additional_information = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(AuctionTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     $this|ChildAuction The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[AuctionTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
