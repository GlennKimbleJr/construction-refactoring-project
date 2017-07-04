<?php 

namespace App\Models;

use App\Model;

class Contact extends Model
{
    /**
     * The database table's name.
     * 
     * @var string
     */
    protected $table = 'contacts';

    /**
     * Store a newly created resource in storage.
     * 
     * @param array $request
     */
    public function add($request)
    {
        $query = $this->db->setData("INSERT INTO `{$this->table}` (`first`, `last`, `street`, `city`, `state`, `email`, `officephone`, `cellphone`, `fax`, `category_id`, `company`, `zip`, `score_per`, `bid_per`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
                $request['first'],
                $request['last'],
                $request['street'],
                $request['city'],
                $request['state'],
                $request['email'],
                $request['officephone'],
                $request['cellphone'],
                $request['fax'],
                $request['type'],
                $request['company'],
                $request['zip'],
                '0',
                '0'
            ]);

        if (! $this->db->updated($query)) return false;
        return $this->db->getID();
    }

    /**
     * Update an existing resource in storage.
     * 
     * @param integer $id
     * @param array $request
     */
    public function update($id, $request)
    {
        $query = $this->db->setData("UPDATE {$this->table} SET first = ?, last = ?, street = ?, city = ?, state = ?, email = ?, officephone = ?, cellphone = ?, fax = ?, category_id = ?, company = ?, zip = ? WHERE id = ?", [
                $request['first'],
                $request['last'],
                $request['street'],
                $request['city'],
                $request['state'],
                $request['email'],
                $request['officephone'],
                $request['cellphone'],
                $request['fax'],
                $request['type'],
                $request['company'],
                $request['zip'],
                $id
            ]);

        return $this->db->updated($query);
    }

    /**
     * Return the resource.
     * 
     * @param  string $sort
     * @return array
     */
    public function getSortable($sort)
    {
        return $this->db->getData("SELECT c.*, cat.name as type FROM {$this->table} as c, categories as cat WHERE cat.id = c.category_id ORDER BY {$sort}");
    }

    /**
     * Return the resource.
     * 
     * @param  string $sort
     * @param  integer $category_id
     * @return array
     */
    public function getSortableByCategory($sort, $category_id)
    {
        return $this->db->getData("SELECT c.*, cat.name as type FROM {$this->table} as c, categories as cat WHERE c.category_id = cat.id AND c.category_id = ? ORDER BY {$sort}", [$category_id]);
    }

    /**
     * Return the resource.
     * 
     * @param  string $sort
     * @param  integer $zone_id
     * @return array
     */
    public function getSortableByZone($sort, $zone_id)
    {
        return $this->db->getData("SELECT c.* FROM {$this->table} as c, contacts_zones as cz WHERE cz.contact_id = c.id AND cz.zone_id = ? ORDER BY {$sort}", [$zone_id]);
    }

    /**
     * Get the the resource with the category name or throw an exception.
     * 
     * @param  integer $id
     * @return array
     */
    public function getFirstWithTypeOrFail($id)
    {
        return $this->db->getFirstOrFail("SELECT c.*, cat.name as type FROM {$this->table} as c, categories as cat WHERE c.category_id = cat.id AND c.id = ?", [$id]);
    }
}
