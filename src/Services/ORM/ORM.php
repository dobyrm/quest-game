<?php

/**
 * Class ORM
 */
namespace Services\ORM;

use Exception;
use PDO;

final class ORM
{
    /**
     * @var PDO $dbh
     */
    private $dbh;

    /**
     * @var string $sql
     */
    private $sql = '';

    /**
     * ORM constructor.
     */
    public function __construct()
    {
        if (!$this->dbh) {
            $this->connect();
        }
    }

    /**
     * Connection
     */
    private function connect()
    {
        $this->dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.'', DB_USER, DB_PASSWORD);
        $this->dbh->exec("set names ".DB_CHARSET);
    }

    /**
     * @param string $sql
     * @return ORM
     */
    public static function query(string $sql)
    {
        $orm = new ORM();
        $orm->sql = $sql;

        return $orm;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function findAll(): array
    {
        try {
            $sth = $this->dbh->prepare($this->sql);
            if ($sth->execute()) {

                return $sth->fetchAll(PDO::FETCH_ASSOC);
            }

            return [];
        } catch (Exception $e) {

            throw new Exception('Failed to select data');
        }
    }

    /**
     * @return array
     * @throws Exception
     */
    public function find(): array
    {
        try {
            $sth = $this->dbh->prepare($this->sql);
            if ($sth->execute()) {

                return $sth->fetch(PDO::FETCH_ASSOC);
            }

            return [];
        } catch (Exception $e) {

            throw new Exception('Failed to select data');
        }
    }

    /**
     * ORM destruct.
     */
    public function __destruct()
    {
        $this->dbh = null;
        $this->sql = '';
    }

}