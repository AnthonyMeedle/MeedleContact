<?php

namespace MeedleContact\Model\Base;

use \DateTime;
use \Exception;
use \PDO;
use MeedleContact\Model\Meedlecontact as ChildMeedlecontact;
use MeedleContact\Model\MeedlecontactQuery as ChildMeedlecontactQuery;
use MeedleContact\Model\Map\MeedlecontactTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

abstract class Meedlecontact implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\MeedleContact\\Model\\Map\\MeedlecontactTableMap';


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
     * @var        int
     */
    protected $id;

    /**
     * The value for the civilite field.
     * @var        string
     */
    protected $civilite;

    /**
     * The value for the nom field.
     * @var        string
     */
    protected $nom;

    /**
     * The value for the prenom field.
     * @var        string
     */
    protected $prenom;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the phone field.
     * @var        string
     */
    protected $phone;

    /**
     * The value for the sujet field.
     * @var        string
     */
    protected $sujet;

    /**
     * The value for the description field.
     * @var        string
     */
    protected $description;

    /**
     * The value for the autre field.
     * @var        string
     */
    protected $autre;

    /**
     * The value for the infoscaptcha field.
     * @var        string
     */
    protected $infoscaptcha;

    /**
     * The value for the infosnavig field.
     * @var        string
     */
    protected $infosnavig;

    /**
     * The value for the score field.
     * @var        string
     */
    protected $score;

    /**
     * The value for the accepte_newsletter field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $accepte_newsletter;

    /**
     * The value for the created_at field.
     * @var        string
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * @var        string
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
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->accepte_newsletter = 0;
    }

    /**
     * Initializes internal state of MeedleContact\Model\Base\Meedlecontact object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
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
        $this->new = (Boolean) $b;
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
        $this->deleted = (Boolean) $b;
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
     * Compares this with another <code>Meedlecontact</code> instance.  If
     * <code>obj</code> is an instance of <code>Meedlecontact</code>, delegates to
     * <code>equals(Meedlecontact)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        $thisclazz = get_class($this);
        if (!is_object($obj) || !($obj instanceof $thisclazz)) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey()
            || null === $obj->getPrimaryKey())  {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        if (null !== $this->getPrimaryKey()) {
            return crc32(serialize($this->getPrimaryKey()));
        }

        return crc32(serialize(clone $this));
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
     * @return Meedlecontact The current object, for fluid interface
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
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     *
     * @return Meedlecontact The current object, for fluid interface
     */
    public function importFrom($parser, $data)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), TableMap::TYPE_PHPNAME);

        return $this;
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

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [id] column value.
     *
     * @return   int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [civilite] column value.
     *
     * @return   string
     */
    public function getCivilite()
    {

        return $this->civilite;
    }

    /**
     * Get the [nom] column value.
     *
     * @return   string
     */
    public function getNom()
    {

        return $this->nom;
    }

    /**
     * Get the [prenom] column value.
     *
     * @return   string
     */
    public function getPrenom()
    {

        return $this->prenom;
    }

    /**
     * Get the [email] column value.
     *
     * @return   string
     */
    public function getEmail()
    {

        return $this->email;
    }

    /**
     * Get the [phone] column value.
     *
     * @return   string
     */
    public function getPhone()
    {

        return $this->phone;
    }

    /**
     * Get the [sujet] column value.
     *
     * @return   string
     */
    public function getSujet()
    {

        return $this->sujet;
    }

    /**
     * Get the [description] column value.
     *
     * @return   string
     */
    public function getDescription()
    {

        return $this->description;
    }

    /**
     * Get the [autre] column value.
     *
     * @return   string
     */
    public function getAutre()
    {

        return $this->autre;
    }

    /**
     * Get the [infoscaptcha] column value.
     *
     * @return   string
     */
    public function getInfoscaptcha()
    {

        return $this->infoscaptcha;
    }

    /**
     * Get the [infosnavig] column value.
     *
     * @return   string
     */
    public function getInfosnavig()
    {

        return $this->infosnavig;
    }

    /**
     * Get the [score] column value.
     *
     * @return   string
     */
    public function getScore()
    {

        return $this->score;
    }

    /**
     * Get the [accepte_newsletter] column value.
     *
     * @return   int
     */
    public function getAccepteNewsletter()
    {

        return $this->accepte_newsletter;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw \DateTime object will be returned.
     *
     * @return mixed Formatted date/time value as string or \DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTime ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw \DateTime object will be returned.
     *
     * @return mixed Formatted date/time value as string or \DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTime ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param      int $v new value
     * @return   \MeedleContact\Model\Meedlecontact The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[MeedlecontactTableMap::ID] = true;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [civilite] column.
     *
     * @param      string $v new value
     * @return   \MeedleContact\Model\Meedlecontact The current object (for fluent API support)
     */
    public function setCivilite($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->civilite !== $v) {
            $this->civilite = $v;
            $this->modifiedColumns[MeedlecontactTableMap::CIVILITE] = true;
        }


        return $this;
    } // setCivilite()

    /**
     * Set the value of [nom] column.
     *
     * @param      string $v new value
     * @return   \MeedleContact\Model\Meedlecontact The current object (for fluent API support)
     */
    public function setNom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nom !== $v) {
            $this->nom = $v;
            $this->modifiedColumns[MeedlecontactTableMap::NOM] = true;
        }


        return $this;
    } // setNom()

    /**
     * Set the value of [prenom] column.
     *
     * @param      string $v new value
     * @return   \MeedleContact\Model\Meedlecontact The current object (for fluent API support)
     */
    public function setPrenom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->prenom !== $v) {
            $this->prenom = $v;
            $this->modifiedColumns[MeedlecontactTableMap::PRENOM] = true;
        }


        return $this;
    } // setPrenom()

    /**
     * Set the value of [email] column.
     *
     * @param      string $v new value
     * @return   \MeedleContact\Model\Meedlecontact The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[MeedlecontactTableMap::EMAIL] = true;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [phone] column.
     *
     * @param      string $v new value
     * @return   \MeedleContact\Model\Meedlecontact The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[MeedlecontactTableMap::PHONE] = true;
        }


        return $this;
    } // setPhone()

    /**
     * Set the value of [sujet] column.
     *
     * @param      string $v new value
     * @return   \MeedleContact\Model\Meedlecontact The current object (for fluent API support)
     */
    public function setSujet($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sujet !== $v) {
            $this->sujet = $v;
            $this->modifiedColumns[MeedlecontactTableMap::SUJET] = true;
        }


        return $this;
    } // setSujet()

    /**
     * Set the value of [description] column.
     *
     * @param      string $v new value
     * @return   \MeedleContact\Model\Meedlecontact The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[MeedlecontactTableMap::DESCRIPTION] = true;
        }


        return $this;
    } // setDescription()

    /**
     * Set the value of [autre] column.
     *
     * @param      string $v new value
     * @return   \MeedleContact\Model\Meedlecontact The current object (for fluent API support)
     */
    public function setAutre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->autre !== $v) {
            $this->autre = $v;
            $this->modifiedColumns[MeedlecontactTableMap::AUTRE] = true;
        }


        return $this;
    } // setAutre()

    /**
     * Set the value of [infoscaptcha] column.
     *
     * @param      string $v new value
     * @return   \MeedleContact\Model\Meedlecontact The current object (for fluent API support)
     */
    public function setInfoscaptcha($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->infoscaptcha !== $v) {
            $this->infoscaptcha = $v;
            $this->modifiedColumns[MeedlecontactTableMap::INFOSCAPTCHA] = true;
        }


        return $this;
    } // setInfoscaptcha()

    /**
     * Set the value of [infosnavig] column.
     *
     * @param      string $v new value
     * @return   \MeedleContact\Model\Meedlecontact The current object (for fluent API support)
     */
    public function setInfosnavig($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->infosnavig !== $v) {
            $this->infosnavig = $v;
            $this->modifiedColumns[MeedlecontactTableMap::INFOSNAVIG] = true;
        }


        return $this;
    } // setInfosnavig()

    /**
     * Set the value of [score] column.
     *
     * @param      string $v new value
     * @return   \MeedleContact\Model\Meedlecontact The current object (for fluent API support)
     */
    public function setScore($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->score !== $v) {
            $this->score = $v;
            $this->modifiedColumns[MeedlecontactTableMap::SCORE] = true;
        }


        return $this;
    } // setScore()

    /**
     * Set the value of [accepte_newsletter] column.
     *
     * @param      int $v new value
     * @return   \MeedleContact\Model\Meedlecontact The current object (for fluent API support)
     */
    public function setAccepteNewsletter($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->accepte_newsletter !== $v) {
            $this->accepte_newsletter = $v;
            $this->modifiedColumns[MeedlecontactTableMap::ACCEPTE_NEWSLETTER] = true;
        }


        return $this;
    } // setAccepteNewsletter()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param      mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return   \MeedleContact\Model\Meedlecontact The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, '\DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($dt !== $this->created_at) {
                $this->created_at = $dt;
                $this->modifiedColumns[MeedlecontactTableMap::CREATED_AT] = true;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param      mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return   \MeedleContact\Model\Meedlecontact The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, '\DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($dt !== $this->updated_at) {
                $this->updated_at = $dt;
                $this->modifiedColumns[MeedlecontactTableMap::UPDATED_AT] = true;
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
            if ($this->accepte_newsletter !== 0) {
                return false;
            }

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
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {


            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : MeedlecontactTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : MeedlecontactTableMap::translateFieldName('Civilite', TableMap::TYPE_PHPNAME, $indexType)];
            $this->civilite = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : MeedlecontactTableMap::translateFieldName('Nom', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nom = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : MeedlecontactTableMap::translateFieldName('Prenom', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prenom = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : MeedlecontactTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : MeedlecontactTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : MeedlecontactTableMap::translateFieldName('Sujet', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sujet = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : MeedlecontactTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : MeedlecontactTableMap::translateFieldName('Autre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->autre = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : MeedlecontactTableMap::translateFieldName('Infoscaptcha', TableMap::TYPE_PHPNAME, $indexType)];
            $this->infoscaptcha = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : MeedlecontactTableMap::translateFieldName('Infosnavig', TableMap::TYPE_PHPNAME, $indexType)];
            $this->infosnavig = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : MeedlecontactTableMap::translateFieldName('Score', TableMap::TYPE_PHPNAME, $indexType)];
            $this->score = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : MeedlecontactTableMap::translateFieldName('AccepteNewsletter', TableMap::TYPE_PHPNAME, $indexType)];
            $this->accepte_newsletter = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : MeedlecontactTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, '\DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : MeedlecontactTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, '\DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 15; // 15 = MeedlecontactTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating \MeedleContact\Model\Meedlecontact object", 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(MeedlecontactTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildMeedlecontactQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
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
     * @see Meedlecontact::setDeleted()
     * @see Meedlecontact::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(MeedlecontactTableMap::DATABASE_NAME);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ChildMeedlecontactQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
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
            $con = Propel::getServiceContainer()->getWriteConnection(MeedlecontactTableMap::DATABASE_NAME);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(MeedlecontactTableMap::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(MeedlecontactTableMap::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(MeedlecontactTableMap::UPDATED_AT)) {
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
                MeedlecontactTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
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
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
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

        $this->modifiedColumns[MeedlecontactTableMap::ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . MeedlecontactTableMap::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(MeedlecontactTableMap::ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(MeedlecontactTableMap::CIVILITE)) {
            $modifiedColumns[':p' . $index++]  = 'CIVILITE';
        }
        if ($this->isColumnModified(MeedlecontactTableMap::NOM)) {
            $modifiedColumns[':p' . $index++]  = 'NOM';
        }
        if ($this->isColumnModified(MeedlecontactTableMap::PRENOM)) {
            $modifiedColumns[':p' . $index++]  = 'PRENOM';
        }
        if ($this->isColumnModified(MeedlecontactTableMap::EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'EMAIL';
        }
        if ($this->isColumnModified(MeedlecontactTableMap::PHONE)) {
            $modifiedColumns[':p' . $index++]  = 'PHONE';
        }
        if ($this->isColumnModified(MeedlecontactTableMap::SUJET)) {
            $modifiedColumns[':p' . $index++]  = 'SUJET';
        }
        if ($this->isColumnModified(MeedlecontactTableMap::DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'DESCRIPTION';
        }
        if ($this->isColumnModified(MeedlecontactTableMap::AUTRE)) {
            $modifiedColumns[':p' . $index++]  = 'AUTRE';
        }
        if ($this->isColumnModified(MeedlecontactTableMap::INFOSCAPTCHA)) {
            $modifiedColumns[':p' . $index++]  = 'INFOSCAPTCHA';
        }
        if ($this->isColumnModified(MeedlecontactTableMap::INFOSNAVIG)) {
            $modifiedColumns[':p' . $index++]  = 'INFOSNAVIG';
        }
        if ($this->isColumnModified(MeedlecontactTableMap::SCORE)) {
            $modifiedColumns[':p' . $index++]  = 'SCORE';
        }
        if ($this->isColumnModified(MeedlecontactTableMap::ACCEPTE_NEWSLETTER)) {
            $modifiedColumns[':p' . $index++]  = 'ACCEPTE_NEWSLETTER';
        }
        if ($this->isColumnModified(MeedlecontactTableMap::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'CREATED_AT';
        }
        if ($this->isColumnModified(MeedlecontactTableMap::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'UPDATED_AT';
        }

        $sql = sprintf(
            'INSERT INTO meedleContact (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'ID':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'CIVILITE':
                        $stmt->bindValue($identifier, $this->civilite, PDO::PARAM_STR);
                        break;
                    case 'NOM':
                        $stmt->bindValue($identifier, $this->nom, PDO::PARAM_STR);
                        break;
                    case 'PRENOM':
                        $stmt->bindValue($identifier, $this->prenom, PDO::PARAM_STR);
                        break;
                    case 'EMAIL':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'PHONE':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);
                        break;
                    case 'SUJET':
                        $stmt->bindValue($identifier, $this->sujet, PDO::PARAM_STR);
                        break;
                    case 'DESCRIPTION':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case 'AUTRE':
                        $stmt->bindValue($identifier, $this->autre, PDO::PARAM_STR);
                        break;
                    case 'INFOSCAPTCHA':
                        $stmt->bindValue($identifier, $this->infoscaptcha, PDO::PARAM_STR);
                        break;
                    case 'INFOSNAVIG':
                        $stmt->bindValue($identifier, $this->infosnavig, PDO::PARAM_STR);
                        break;
                    case 'SCORE':
                        $stmt->bindValue($identifier, $this->score, PDO::PARAM_STR);
                        break;
                    case 'ACCEPTE_NEWSLETTER':
                        $stmt->bindValue($identifier, $this->accepte_newsletter, PDO::PARAM_INT);
                        break;
                    case 'CREATED_AT':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'UPDATED_AT':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
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
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = MeedlecontactTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getCivilite();
                break;
            case 2:
                return $this->getNom();
                break;
            case 3:
                return $this->getPrenom();
                break;
            case 4:
                return $this->getEmail();
                break;
            case 5:
                return $this->getPhone();
                break;
            case 6:
                return $this->getSujet();
                break;
            case 7:
                return $this->getDescription();
                break;
            case 8:
                return $this->getAutre();
                break;
            case 9:
                return $this->getInfoscaptcha();
                break;
            case 10:
                return $this->getInfosnavig();
                break;
            case 11:
                return $this->getScore();
                break;
            case 12:
                return $this->getAccepteNewsletter();
                break;
            case 13:
                return $this->getCreatedAt();
                break;
            case 14:
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
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {
        if (isset($alreadyDumpedObjects['Meedlecontact'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Meedlecontact'][$this->getPrimaryKey()] = true;
        $keys = MeedlecontactTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCivilite(),
            $keys[2] => $this->getNom(),
            $keys[3] => $this->getPrenom(),
            $keys[4] => $this->getEmail(),
            $keys[5] => $this->getPhone(),
            $keys[6] => $this->getSujet(),
            $keys[7] => $this->getDescription(),
            $keys[8] => $this->getAutre(),
            $keys[9] => $this->getInfoscaptcha(),
            $keys[10] => $this->getInfosnavig(),
            $keys[11] => $this->getScore(),
            $keys[12] => $this->getAccepteNewsletter(),
            $keys[13] => $this->getCreatedAt(),
            $keys[14] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }


        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param      string $name
     * @param      mixed  $value field value
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return void
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = MeedlecontactTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @param      mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setCivilite($value);
                break;
            case 2:
                $this->setNom($value);
                break;
            case 3:
                $this->setPrenom($value);
                break;
            case 4:
                $this->setEmail($value);
                break;
            case 5:
                $this->setPhone($value);
                break;
            case 6:
                $this->setSujet($value);
                break;
            case 7:
                $this->setDescription($value);
                break;
            case 8:
                $this->setAutre($value);
                break;
            case 9:
                $this->setInfoscaptcha($value);
                break;
            case 10:
                $this->setInfosnavig($value);
                break;
            case 11:
                $this->setScore($value);
                break;
            case 12:
                $this->setAccepteNewsletter($value);
                break;
            case 13:
                $this->setCreatedAt($value);
                break;
            case 14:
                $this->setUpdatedAt($value);
                break;
        } // switch()
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
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = MeedlecontactTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCivilite($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setNom($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setPrenom($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setEmail($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setPhone($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setSujet($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setDescription($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setAutre($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setInfoscaptcha($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setInfosnavig($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setScore($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setAccepteNewsletter($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setCreatedAt($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setUpdatedAt($arr[$keys[14]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(MeedlecontactTableMap::DATABASE_NAME);

        if ($this->isColumnModified(MeedlecontactTableMap::ID)) $criteria->add(MeedlecontactTableMap::ID, $this->id);
        if ($this->isColumnModified(MeedlecontactTableMap::CIVILITE)) $criteria->add(MeedlecontactTableMap::CIVILITE, $this->civilite);
        if ($this->isColumnModified(MeedlecontactTableMap::NOM)) $criteria->add(MeedlecontactTableMap::NOM, $this->nom);
        if ($this->isColumnModified(MeedlecontactTableMap::PRENOM)) $criteria->add(MeedlecontactTableMap::PRENOM, $this->prenom);
        if ($this->isColumnModified(MeedlecontactTableMap::EMAIL)) $criteria->add(MeedlecontactTableMap::EMAIL, $this->email);
        if ($this->isColumnModified(MeedlecontactTableMap::PHONE)) $criteria->add(MeedlecontactTableMap::PHONE, $this->phone);
        if ($this->isColumnModified(MeedlecontactTableMap::SUJET)) $criteria->add(MeedlecontactTableMap::SUJET, $this->sujet);
        if ($this->isColumnModified(MeedlecontactTableMap::DESCRIPTION)) $criteria->add(MeedlecontactTableMap::DESCRIPTION, $this->description);
        if ($this->isColumnModified(MeedlecontactTableMap::AUTRE)) $criteria->add(MeedlecontactTableMap::AUTRE, $this->autre);
        if ($this->isColumnModified(MeedlecontactTableMap::INFOSCAPTCHA)) $criteria->add(MeedlecontactTableMap::INFOSCAPTCHA, $this->infoscaptcha);
        if ($this->isColumnModified(MeedlecontactTableMap::INFOSNAVIG)) $criteria->add(MeedlecontactTableMap::INFOSNAVIG, $this->infosnavig);
        if ($this->isColumnModified(MeedlecontactTableMap::SCORE)) $criteria->add(MeedlecontactTableMap::SCORE, $this->score);
        if ($this->isColumnModified(MeedlecontactTableMap::ACCEPTE_NEWSLETTER)) $criteria->add(MeedlecontactTableMap::ACCEPTE_NEWSLETTER, $this->accepte_newsletter);
        if ($this->isColumnModified(MeedlecontactTableMap::CREATED_AT)) $criteria->add(MeedlecontactTableMap::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(MeedlecontactTableMap::UPDATED_AT)) $criteria->add(MeedlecontactTableMap::UPDATED_AT, $this->updated_at);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(MeedlecontactTableMap::DATABASE_NAME);
        $criteria->add(MeedlecontactTableMap::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return   int
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
     * @param      object $copyObj An object of \MeedleContact\Model\Meedlecontact (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCivilite($this->getCivilite());
        $copyObj->setNom($this->getNom());
        $copyObj->setPrenom($this->getPrenom());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setSujet($this->getSujet());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setAutre($this->getAutre());
        $copyObj->setInfoscaptcha($this->getInfoscaptcha());
        $copyObj->setInfosnavig($this->getInfosnavig());
        $copyObj->setScore($this->getScore());
        $copyObj->setAccepteNewsletter($this->getAccepteNewsletter());
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
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return                 \MeedleContact\Model\Meedlecontact Clone of current object.
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
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->civilite = null;
        $this->nom = null;
        $this->prenom = null;
        $this->email = null;
        $this->phone = null;
        $this->sujet = null;
        $this->description = null;
        $this->autre = null;
        $this->infoscaptcha = null;
        $this->infosnavig = null;
        $this->score = null;
        $this->accepte_newsletter = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
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
        return (string) $this->exportTo(MeedlecontactTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     ChildMeedlecontact The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[MeedlecontactTableMap::UPDATED_AT] = true;

        return $this;
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

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
