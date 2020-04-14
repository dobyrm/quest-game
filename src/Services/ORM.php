<?php

/**
 * Class ORM
 */
namespace Services;

use Exception;
use PDO;

final class ORM
{
    /**
     * @var $dbh
     */
    private $dbh;

    /**
     * @var $sql
     */
    private $sql = '';

    /**
     * @var $table
     */
    private $table;

    /**
     * @var $fields
     */
    private $fields;

    /**
     * @var $join
     */
    private $join = '';

    /**
     * @var $leftJoin
     */
    private $leftJoin = '';

    /**
     * @var $groupBy
     */
    private $groupBy = '';

    /**
     * @var $limit
     */
    private $limit;

    /**
     * @var $offset
     */
    private $offset;

    /**
     * ControllerDataForDatabase constructor.
     */
    public function __construct()
    {
        if(!$this->dbh) {
            $this->connect();
        }
    }

    /**
     * Connect to mysql
     */
    private function connect()
    {
        $this->dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.'', DB_USER, DB_PASSWORD);
        $this->dbh->exec("set names ".DB_CHARSET);
    }

    /**
     * Set table name for selected
     *
     * @param $table
     * @return ORM
     */
    public static function table($table)
    {
        $orm = new ORM();
        $orm->table = $table;
        $orm->sql = 'SELECT '. '*'
            .' FROM '. $orm->table;

        return $orm;
    }

    /**
     * Set fields for selected
     *
     * @param $fields
     * @return ORM
     */
    public function fields($fields)
    {
        $this->fields = implode(',', $fields);
        $this->sql = 'SELECT '. $this->fields
            .' FROM '. $this->table;

        return $this;
    }

    /**
     * Set join
     *
     * @param $tables
     * @param $conditions
     * @return $this
     */
    public function join($tables, $conditions)
    {
        $join = '';
        for ($i = 0; $i < count($tables); $i++) {
            $join .= ' JOIN ' . $tables[$i] . ' ON ' . $conditions[$i];
        }
        $this->join = $join;

        return $this;
    }

    /**
     * Set left join
     *
     * @param $table
     * @param $condition
     * @return $this
     */
    public function leftJoin($table, $condition)
    {
        $this->leftJoin = ' LEFT JOIN ' . $table . ' ON ' . $condition;

        return $this;
    }

    /**
     * Set group by
     *
     * @param $groupBy
     * @return $this
     */
    public function groupBy($groupBy)
    {
        $this->groupBy = ' GROUP BY ' . implode(',', $groupBy);
        $this->sql = 'SELECT '. $this->fields
            .' FROM '. $this->table
            . $this->leftJoin
            . $this->join
            . $this->groupBy;

        return $this;
    }

    /**
     * Set limit for selected
     *
     * @param $limit
     * @return $this
     */
    public function limit($limit)
    {
        $this->limit = $limit;
        $this->sql = 'SELECT '. $this->fields
            .' FROM '. $this->table
            . $this->leftJoin
            . $this->join
            . $this->groupBy
            . ' LIMIT '. $this->limit;

        return $this;
    }

    /**
     * Set offset for selected
     *
     * @param $offset
     * @return $this
     */
    public function offset($offset)
    {
        $this->offset = $offset;
        $this->sql = 'SELECT '. $this->fields
            .' FROM '. $this->table
            . $this->leftJoin
            . $this->join
            . $this->groupBy
            . ' LIMIT '. $this->limit
            . ' OFFSET '. $this->offset;

        return $this;
    }

    /**
     * Sql select by database for params
     *
     * @return bool
     * @throws Exception
     */
    public function find()
    {
        try {
            $sth = $this->dbh->prepare($this->sql);
            if($sth->execute()) {

                return $sth->fetchAll(PDO::FETCH_ASSOC);
            }

            return false;
        } catch (Exception $e) {

            throw new Exception('Failed to select data');
        }
    }

    /**
     * Count rows
     *
     * @return bool|int
     */
    public static function countRows($table)
    {
        $orm = new ORM();
        $sql = "SELECT COUNT(*) FROM ".$table;

        $sth = $orm->dbh->prepare($sql);

        if($sth->execute()) {

            return (int) $sth->fetchColumn();
        }

        return false;
    }

    /**
     * sqlClean destruct.
     */
    public function __destruct()
    {
        $this->dbh = null;
        $this->sql = '';
        $this->table = null;
        $this->fields = null;
        $this->limit = null;
        $this->offset = null;
    }

}