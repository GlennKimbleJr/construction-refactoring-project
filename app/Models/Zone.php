<?php 

namespace App\Models;

use App\Model;

class Zone extends Model
{
    /**
     * The database table's name.
     * 
     * @var string
     */
    protected $table = 'zones';

    /**
     * Store a newly created resource in storage.
     * 
     * @param string $name
     * @return boolean
     */
    public function add($name)
    {
        $query = $this->db->setData("INSERT INTO `{$this->table}` (name) VALUES (?)", [$name]);

        return $this->db->updated($query);
    }

    /**
     * Update an existing resource.
     * 
     * @param  integer $id
     * @param  string $name
     * @return boolean
     */
    public function update($id, $name)
    {
        $query = $this->db->setData("UPDATE {$this->table} SET name = ? WHERE id = ?", [$name, $id]);

        return $this->db->updated($query);
    }

}
