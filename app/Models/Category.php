<?php 

namespace App\Models;

use App\Model;
use App\Models\Bidder;

class Category extends Model
{
    /**
     * The database table's name.
     * 
     * @var string
     */
    protected $table = 'categories';

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

    /**
     * Return a nested list of bidders for each category in a project.
     * 
     * @param  integer $project_id
     * @return array
     */
    public function withBiddersForProject($project_id)
    {
        $categories = $this->get();

        foreach ($categories as $key => $category) {
            $categories[$key]['bidders'] = (new Bidder($this->db))
                ->getSelectedBiddersForProjectByCategory($project_id, $category['id']);
        }

        return $categories;
    }
}