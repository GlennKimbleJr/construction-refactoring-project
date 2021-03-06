<?php

namespace App\Models;

use App\Model;

class Project extends Model
{
    /**
     * The database table's name.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * Store a newly created resource in storage.
     *
     * @param array $request
     * @return boolean
     */
    public function add($request)
    {
        $query = $this->db->setData("INSERT INTO `{$this->table}` (name, bidduedate, location) VALUES (?, ?, ?)", [
            $request['name'],
            $request['due3'] . '-' . $request['due1'] . '-' . $request['due2'],
            $request['location']
        ]);

        return $this->db->updated($query);
    }

    /**
     * Update a exiting resource.
     *
     * @param  integer $id
     * @param  array $request
     * @return boolean
     */
    public function update($id, $request)
    {
        $query = $this->db->setData("UPDATE projects SET name=?, bidduedate=?, plans=?, location=?, planuser=?, planpass=?, owner_name=?, owner_phone=?, super_id=? WHERE id=?", [
                $request['name'],
                $request['due3'] . '-' . $request['due1'] . '-' . $request['due2'],
                $request['plans'],
                $request['location'],
                $request['planuser'],
                $request['planpass'],
                $request['owner_name'],
                $request['owner_phone'],
                $request['super'],
                $id
            ]);

        return $this->db->updated($query);
    }

    /**
     * Mark a project as being complete.
     *
     * @param  integer $id
     */
    public function complete($id)
    {
        $this->db->setData("UPDATE {$this->table} SET completedate = ? WHERE id = ?", [date("Y-m-d"), $id]);
    }

    /**
     * Return a sorted collection of resources.
     *
     * @param  string $sort
     * @return array
     */
    public function getSortable($sort)
    {
        return $this->db->getData("SELECT * FROM {$this->table} {$sort}");
    }

    /**
     * Return a sorted collection of resources with the superintendants contact information.
     *
     * @param  integer $id
     * @return array
     */
    public function withSuperintendantOrFail($id)
    {
        return $this->db->getFirstOrFail("SELECT p.*, s.name as super_name, s.phone as super_phone FROM {$this->table} as p, supers as s WHERE p.super_id = s.id AND p.id = ?", [$id]);
    }
}
