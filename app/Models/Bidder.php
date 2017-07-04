<?php 

namespace App\Models;

use App\Model;

class Bidder extends Model
{
    /**
     * The database table's name.
     * 
     * @var string
     */
    protected $table = 'bidders';

    /**
     * Return the resource or throw an exception if not found.
     * 
     * @param  integer $id
     * @return array
     */
    public function getWinnerOrFail($id)
    {
        return $this->db->getFirstOrFail("SELECT b.*, c.company, cat.name as 'category_name' FROM {$this->table} as b, contacts as c, categories as cat WHERE b.contact_id = c.id AND b.category_id = cat.id AND b.id = ?", [$id]);
    }

    /**
     * Update the status column of the resource.
     * 
     * @param integer $id
     * @param string $status
     */
    public function setStatus($id, $status)
    {
        $this->db->setData("UPDATE {$this->table} SET status = ? WHERE id = ?", [
            $status, $id
        ]);
    }

    /**
     * Update the score column of the resource.
     * 
     * @param integer $id
     * @param integer $score
     */
    public function setScore($id, $score)
    {
        $this->db->setData("UPDATE {$this->table} SET score = ? WHERE id = ?", [$score, $id]);
    }

    /**
     * Mark a bidder as the winner and all other bidders in that project/category pair as loosers.
     * 
     * @param  integer $winner_id
     * @param  integer $project_id
     * @param  integer $category_id
     */
    public function award($winner_id, $project_id, $category_id)
    {
        $this->db->setData("UPDATE {$this->table} SET win = '1' WHERE id = ?", [$winner_id]);

        $this->db->setData(
            "UPDATE {$this->table} SET win = '0' WHERE id != ? AND project_id = ? AND category_id = ?", 
            [$winner_id, $project_id, $category_id]
        );
    }
}