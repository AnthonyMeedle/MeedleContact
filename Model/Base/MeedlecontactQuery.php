<?php

namespace MeedleContact\Model\Base;

use \Exception;
use \PDO;
use MeedleContact\Model\Meedlecontact as ChildMeedlecontact;
use MeedleContact\Model\MeedlecontactQuery as ChildMeedlecontactQuery;
use MeedleContact\Model\Map\MeedlecontactTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'meedleContact' table.
 *
 *
 *
 * @method     ChildMeedlecontactQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMeedlecontactQuery orderByCivilite($order = Criteria::ASC) Order by the civilite column
 * @method     ChildMeedlecontactQuery orderByNom($order = Criteria::ASC) Order by the nom column
 * @method     ChildMeedlecontactQuery orderByPrenom($order = Criteria::ASC) Order by the prenom column
 * @method     ChildMeedlecontactQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildMeedlecontactQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildMeedlecontactQuery orderBySujet($order = Criteria::ASC) Order by the sujet column
 * @method     ChildMeedlecontactQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildMeedlecontactQuery orderByAutre($order = Criteria::ASC) Order by the autre column
 * @method     ChildMeedlecontactQuery orderByInfoscaptcha($order = Criteria::ASC) Order by the infosCaptcha column
 * @method     ChildMeedlecontactQuery orderByInfosnavig($order = Criteria::ASC) Order by the infosNavig column
 * @method     ChildMeedlecontactQuery orderByScore($order = Criteria::ASC) Order by the score column
 * @method     ChildMeedlecontactQuery orderByAccepteNewsletter($order = Criteria::ASC) Order by the accepte_newsletter column
 * @method     ChildMeedlecontactQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildMeedlecontactQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildMeedlecontactQuery groupById() Group by the id column
 * @method     ChildMeedlecontactQuery groupByCivilite() Group by the civilite column
 * @method     ChildMeedlecontactQuery groupByNom() Group by the nom column
 * @method     ChildMeedlecontactQuery groupByPrenom() Group by the prenom column
 * @method     ChildMeedlecontactQuery groupByEmail() Group by the email column
 * @method     ChildMeedlecontactQuery groupByPhone() Group by the phone column
 * @method     ChildMeedlecontactQuery groupBySujet() Group by the sujet column
 * @method     ChildMeedlecontactQuery groupByDescription() Group by the description column
 * @method     ChildMeedlecontactQuery groupByAutre() Group by the autre column
 * @method     ChildMeedlecontactQuery groupByInfoscaptcha() Group by the infosCaptcha column
 * @method     ChildMeedlecontactQuery groupByInfosnavig() Group by the infosNavig column
 * @method     ChildMeedlecontactQuery groupByScore() Group by the score column
 * @method     ChildMeedlecontactQuery groupByAccepteNewsletter() Group by the accepte_newsletter column
 * @method     ChildMeedlecontactQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildMeedlecontactQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildMeedlecontactQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMeedlecontactQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMeedlecontactQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMeedlecontact findOne(ConnectionInterface $con = null) Return the first ChildMeedlecontact matching the query
 * @method     ChildMeedlecontact findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMeedlecontact matching the query, or a new ChildMeedlecontact object populated from the query conditions when no match is found
 *
 * @method     ChildMeedlecontact findOneById(int $id) Return the first ChildMeedlecontact filtered by the id column
 * @method     ChildMeedlecontact findOneByCivilite(string $civilite) Return the first ChildMeedlecontact filtered by the civilite column
 * @method     ChildMeedlecontact findOneByNom(string $nom) Return the first ChildMeedlecontact filtered by the nom column
 * @method     ChildMeedlecontact findOneByPrenom(string $prenom) Return the first ChildMeedlecontact filtered by the prenom column
 * @method     ChildMeedlecontact findOneByEmail(string $email) Return the first ChildMeedlecontact filtered by the email column
 * @method     ChildMeedlecontact findOneByPhone(string $phone) Return the first ChildMeedlecontact filtered by the phone column
 * @method     ChildMeedlecontact findOneBySujet(string $sujet) Return the first ChildMeedlecontact filtered by the sujet column
 * @method     ChildMeedlecontact findOneByDescription(string $description) Return the first ChildMeedlecontact filtered by the description column
 * @method     ChildMeedlecontact findOneByAutre(string $autre) Return the first ChildMeedlecontact filtered by the autre column
 * @method     ChildMeedlecontact findOneByInfoscaptcha(string $infosCaptcha) Return the first ChildMeedlecontact filtered by the infosCaptcha column
 * @method     ChildMeedlecontact findOneByInfosnavig(string $infosNavig) Return the first ChildMeedlecontact filtered by the infosNavig column
 * @method     ChildMeedlecontact findOneByScore(string $score) Return the first ChildMeedlecontact filtered by the score column
 * @method     ChildMeedlecontact findOneByAccepteNewsletter(int $accepte_newsletter) Return the first ChildMeedlecontact filtered by the accepte_newsletter column
 * @method     ChildMeedlecontact findOneByCreatedAt(string $created_at) Return the first ChildMeedlecontact filtered by the created_at column
 * @method     ChildMeedlecontact findOneByUpdatedAt(string $updated_at) Return the first ChildMeedlecontact filtered by the updated_at column
 *
 * @method     array findById(int $id) Return ChildMeedlecontact objects filtered by the id column
 * @method     array findByCivilite(string $civilite) Return ChildMeedlecontact objects filtered by the civilite column
 * @method     array findByNom(string $nom) Return ChildMeedlecontact objects filtered by the nom column
 * @method     array findByPrenom(string $prenom) Return ChildMeedlecontact objects filtered by the prenom column
 * @method     array findByEmail(string $email) Return ChildMeedlecontact objects filtered by the email column
 * @method     array findByPhone(string $phone) Return ChildMeedlecontact objects filtered by the phone column
 * @method     array findBySujet(string $sujet) Return ChildMeedlecontact objects filtered by the sujet column
 * @method     array findByDescription(string $description) Return ChildMeedlecontact objects filtered by the description column
 * @method     array findByAutre(string $autre) Return ChildMeedlecontact objects filtered by the autre column
 * @method     array findByInfoscaptcha(string $infosCaptcha) Return ChildMeedlecontact objects filtered by the infosCaptcha column
 * @method     array findByInfosnavig(string $infosNavig) Return ChildMeedlecontact objects filtered by the infosNavig column
 * @method     array findByScore(string $score) Return ChildMeedlecontact objects filtered by the score column
 * @method     array findByAccepteNewsletter(int $accepte_newsletter) Return ChildMeedlecontact objects filtered by the accepte_newsletter column
 * @method     array findByCreatedAt(string $created_at) Return ChildMeedlecontact objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return ChildMeedlecontact objects filtered by the updated_at column
 *
 */
abstract class MeedlecontactQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \MeedleContact\Model\Base\MeedlecontactQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\MeedleContact\\Model\\Meedlecontact', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMeedlecontactQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMeedlecontactQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \MeedleContact\Model\MeedlecontactQuery) {
            return $criteria;
        }
        $query = new \MeedleContact\Model\MeedlecontactQuery();
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
     * @return ChildMeedlecontact|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MeedlecontactTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MeedlecontactTableMap::DATABASE_NAME);
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
     * @return   ChildMeedlecontact A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, CIVILITE, NOM, PRENOM, EMAIL, PHONE, SUJET, DESCRIPTION, AUTRE, INFOSCAPTCHA, INFOSNAVIG, SCORE, ACCEPTE_NEWSLETTER, CREATED_AT, UPDATED_AT FROM meedleContact WHERE ID = :p0';
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
            $obj = new ChildMeedlecontact();
            $obj->hydrate($row);
            MeedlecontactTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildMeedlecontact|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
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
    public function findPks($keys, $con = null)
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
     * @return ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MeedlecontactTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MeedlecontactTableMap::ID, $keys, Criteria::IN);
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
     * @return ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MeedlecontactTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MeedlecontactTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MeedlecontactTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the civilite column
     *
     * Example usage:
     * <code>
     * $query->filterByCivilite('fooValue');   // WHERE civilite = 'fooValue'
     * $query->filterByCivilite('%fooValue%'); // WHERE civilite LIKE '%fooValue%'
     * </code>
     *
     * @param     string $civilite The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function filterByCivilite($civilite = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($civilite)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $civilite)) {
                $civilite = str_replace('*', '%', $civilite);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MeedlecontactTableMap::CIVILITE, $civilite, $comparison);
    }

    /**
     * Filter the query on the nom column
     *
     * Example usage:
     * <code>
     * $query->filterByNom('fooValue');   // WHERE nom = 'fooValue'
     * $query->filterByNom('%fooValue%'); // WHERE nom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nom The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function filterByNom($nom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nom)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nom)) {
                $nom = str_replace('*', '%', $nom);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MeedlecontactTableMap::NOM, $nom, $comparison);
    }

    /**
     * Filter the query on the prenom column
     *
     * Example usage:
     * <code>
     * $query->filterByPrenom('fooValue');   // WHERE prenom = 'fooValue'
     * $query->filterByPrenom('%fooValue%'); // WHERE prenom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $prenom The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function filterByPrenom($prenom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($prenom)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $prenom)) {
                $prenom = str_replace('*', '%', $prenom);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MeedlecontactTableMap::PRENOM, $prenom, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MeedlecontactTableMap::EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%'); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phone)) {
                $phone = str_replace('*', '%', $phone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MeedlecontactTableMap::PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the sujet column
     *
     * Example usage:
     * <code>
     * $query->filterBySujet('fooValue');   // WHERE sujet = 'fooValue'
     * $query->filterBySujet('%fooValue%'); // WHERE sujet LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sujet The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function filterBySujet($sujet = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sujet)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $sujet)) {
                $sujet = str_replace('*', '%', $sujet);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MeedlecontactTableMap::SUJET, $sujet, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MeedlecontactTableMap::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the autre column
     *
     * Example usage:
     * <code>
     * $query->filterByAutre('fooValue');   // WHERE autre = 'fooValue'
     * $query->filterByAutre('%fooValue%'); // WHERE autre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $autre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function filterByAutre($autre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($autre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $autre)) {
                $autre = str_replace('*', '%', $autre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MeedlecontactTableMap::AUTRE, $autre, $comparison);
    }

    /**
     * Filter the query on the infosCaptcha column
     *
     * Example usage:
     * <code>
     * $query->filterByInfoscaptcha('fooValue');   // WHERE infosCaptcha = 'fooValue'
     * $query->filterByInfoscaptcha('%fooValue%'); // WHERE infosCaptcha LIKE '%fooValue%'
     * </code>
     *
     * @param     string $infoscaptcha The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function filterByInfoscaptcha($infoscaptcha = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($infoscaptcha)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $infoscaptcha)) {
                $infoscaptcha = str_replace('*', '%', $infoscaptcha);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MeedlecontactTableMap::INFOSCAPTCHA, $infoscaptcha, $comparison);
    }

    /**
     * Filter the query on the infosNavig column
     *
     * Example usage:
     * <code>
     * $query->filterByInfosnavig('fooValue');   // WHERE infosNavig = 'fooValue'
     * $query->filterByInfosnavig('%fooValue%'); // WHERE infosNavig LIKE '%fooValue%'
     * </code>
     *
     * @param     string $infosnavig The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function filterByInfosnavig($infosnavig = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($infosnavig)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $infosnavig)) {
                $infosnavig = str_replace('*', '%', $infosnavig);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MeedlecontactTableMap::INFOSNAVIG, $infosnavig, $comparison);
    }

    /**
     * Filter the query on the score column
     *
     * Example usage:
     * <code>
     * $query->filterByScore('fooValue');   // WHERE score = 'fooValue'
     * $query->filterByScore('%fooValue%'); // WHERE score LIKE '%fooValue%'
     * </code>
     *
     * @param     string $score The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function filterByScore($score = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($score)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $score)) {
                $score = str_replace('*', '%', $score);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MeedlecontactTableMap::SCORE, $score, $comparison);
    }

    /**
     * Filter the query on the accepte_newsletter column
     *
     * Example usage:
     * <code>
     * $query->filterByAccepteNewsletter(1234); // WHERE accepte_newsletter = 1234
     * $query->filterByAccepteNewsletter(array(12, 34)); // WHERE accepte_newsletter IN (12, 34)
     * $query->filterByAccepteNewsletter(array('min' => 12)); // WHERE accepte_newsletter > 12
     * </code>
     *
     * @param     mixed $accepteNewsletter The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function filterByAccepteNewsletter($accepteNewsletter = null, $comparison = null)
    {
        if (is_array($accepteNewsletter)) {
            $useMinMax = false;
            if (isset($accepteNewsletter['min'])) {
                $this->addUsingAlias(MeedlecontactTableMap::ACCEPTE_NEWSLETTER, $accepteNewsletter['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accepteNewsletter['max'])) {
                $this->addUsingAlias(MeedlecontactTableMap::ACCEPTE_NEWSLETTER, $accepteNewsletter['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MeedlecontactTableMap::ACCEPTE_NEWSLETTER, $accepteNewsletter, $comparison);
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
     * @return ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(MeedlecontactTableMap::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(MeedlecontactTableMap::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MeedlecontactTableMap::CREATED_AT, $createdAt, $comparison);
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
     * @return ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(MeedlecontactTableMap::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(MeedlecontactTableMap::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MeedlecontactTableMap::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMeedlecontact $meedlecontact Object to remove from the list of results
     *
     * @return ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function prune($meedlecontact = null)
    {
        if ($meedlecontact) {
            $this->addUsingAlias(MeedlecontactTableMap::ID, $meedlecontact->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the meedleContact table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MeedlecontactTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MeedlecontactTableMap::clearInstancePool();
            MeedlecontactTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildMeedlecontact or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildMeedlecontact object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MeedlecontactTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MeedlecontactTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        MeedlecontactTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MeedlecontactTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(MeedlecontactTableMap::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(MeedlecontactTableMap::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(MeedlecontactTableMap::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(MeedlecontactTableMap::UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(MeedlecontactTableMap::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ChildMeedlecontactQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(MeedlecontactTableMap::CREATED_AT);
    }

} // MeedlecontactQuery
