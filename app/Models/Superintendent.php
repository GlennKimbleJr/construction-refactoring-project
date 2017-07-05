<?php 

namespace App\Models;

use App\Model;

class Superintendent extends Model
{
    /**
     * The database table's name.
     * 
     * @var string
     */
    protected $table = 'supers';

    /**
     * Store a newly created resource in storage.
     * 
     * @param array $request
     * @return boolean
     */
    public function add($request)
    {
        $query = $this->db->setData("INSERT INTO `{$this->table}` (name, phone) VALUES (?, ?)", [
            $request['name'],
            $request['phone']
        ]);

        return $this->db->updated($query);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param integer $id
     * @param array $request
     * @return boolean
     */
    public function update($id, $request)
    {
        $query = $this->db->setData("UPDATE `{$this->table}` SET name = ?, phone = ? WHERE id = ?", [
            $request['name'],
            $request['phone'],
            $id
        ]);

        return $this->db->updated($query);
    }
}
