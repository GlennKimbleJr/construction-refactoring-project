<?php 

namespace App;

use App\Database;

class Model
{
    /**
     * The database table's name.
     * 
     * @var string
     */
    protected $table;

    /**
     * @param App\Database $db
     */
    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * Return the resource.
     * 
     * @param  string $columns columns needed from table
     * @param  string $orderBy order results by
     * @return array
     */
    public function get($columns = '*', $orderBy = null)
    {
        return $this->db->getData("SELECT {$columns} FROM {$this->table} {$orderBy}");
    }

    /**
     * Return the resource or throw an exception if not found.
     * 
     * @param  integer $id
     * @param  string $columns columns needed from table
     * @return array
     */
    public function firstOrFail($id, $columns = '*')
    {
        return $this->db->getFirstOrFail("SELECT {$columns} FROM {$this->table} WHERE id = ?", [$id]);
    }

    /**
     * Destroy a resource.
     * 
     * @param  integer $id
     */
    public function delete($id)
    {
        $query = $this->db->setData("DELETE FROM {$this->table} WHERE id = ?", [$id]);

        return $this->db->updated($query);
    }
}
