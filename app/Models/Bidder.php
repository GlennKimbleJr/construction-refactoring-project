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

    public function add($project_id, $contact_id, $category_id)
    {
        $query = $this->db->setData(
            "INSERT INTO `bidders` (project_id, contact_id, category_id, status, win, score) 
                VALUES (?, ?, ?, ?, ?, ?)", [$project_id, $contact_id, $category_id, '', '', 'NA']);

        return $this->db->updated($query);
    }

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
     * Get all bidders for a project that have been awarded the bid in each decided category.
     * 
     * @param  integer $project_id
     * @return array
     */
    public function getProjectWinners($project_id)
    {
        return $this->db->getData("SELECT b.*, c.company, c.email, cat.name as category FROM {$this->table} as b, contacts as c, categories as cat WHERE b.contact_id = c.id AND b.category_id = cat.id AND b.project_id = ? AND b.win = 1", [$project_id]);
    }

    /**
     * Get all participating bidders for a project in each undecided category.
     * 
     * @param  integer $project_id
     * @return array
     */
    public function getProjectParticipatingBiddersForUndecidedCategories($project_id)
    {
        return $this->db->getData("SELECT b.*, c.company, c.email, cat.name as category_name, cat.id as category_id FROM {$this->table} as b, contacts as c, categories as cat WHERE b.contact_id = c.id AND b.project_id = ? AND b.category_id = cat.id AND b.win = '' AND b.status != 'wont'", [$project_id]);
    }

    /**
     * Get all all bidders for a project by category.
     * 
     * @param  integer $project_id
     * @param  integer $category_id
     * @return array
     */
    public function getSelectedBiddersForProjectByCategory($project_id, $category_id)
    {
        return $this->db->getData( "SELECT c.company FROM {$this->table} as b, contacts as c WHERE b.contact_id = c.id AND b.project_id = ? AND b.category_id = ?", [$project_id, $category_id]);
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