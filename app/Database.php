<?php 

namespace App;

use \PDO;

class Database
{
    protected $db;
    
    /**
     * Creates a new pdo object.
     */
    public function __construct($dsn, $username, $password)
    {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $this->db = $pdo;
    }
    
    /**
     * Builds and executes prepared statement OR runs query.
     * 
     * @param  string $query
     * @param  array  $params
     * @return object
     */
    public function prepare($query, $params = null)
    {
        if ($params == null) {
            return $this->db->query($query);
        }

        $query = $this->db->prepare($query);
        $query->execute($params);

        return $query;
    }
    
    /** 
     * Returns array of data.
     * 
     * @param  string $query
     * @param  array  $params
     * @return array
     */
    public function getData($query, $params = null)
    {
        return $this->prepare($query, $params)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Adds a new record or updates an existing record.
     * 
     * @param  string $query
     * @param  array  $params
     */
    public function setData($query, $params)
    {
        return $this->prepare($query, $params);
    }
    
    /**
     * Counts the number of records that match the query.
     * 
     * @param  string  $query
     * @param  array   $params
     * @return integer
     */
    public function getCount($query, $params = null)
    {
        return $this->prepare($query, $params)
            ->rowCount();
    }
    
    /**
     * Return the auto-incremented id of the last record added to database.
     * 
     * @return integer
     */
    public function getID()
    {
        return $this->db->lastInsertId();
    }

    /**
     * Returns the number or rows updated by the executed query supplied.
     * 
     * @param  \PDOStatement $query
     * @return integer
     */
    public function updated(\PDOStatement $query)
    {
        return $query->rowCount();
    }
}
