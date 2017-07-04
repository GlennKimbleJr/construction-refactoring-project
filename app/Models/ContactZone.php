<?php 

namespace App\Models;

use App\Model;

class ContactZone extends Model
{
    /**
     * The database table's name.
     * 
     * @var string
     */
    protected $table = 'contacts_zones';

    /**
     * Store a newly created resource in storage.
     * 
     * @param integer $contact_id
     * @param integer $zone_id
     */
    public function add($contact_id, $zone_id)
    {
        $this->db->setData("INSERT INTO `{$this->table}` (`contact_id`, `zone_id`) VALUES (?, ?)", 
            [$contact_id, $zone_id]
        );
    }

    /**
     * Create a new resource from each zone.
     * 
     * @param integer $contact_id
     * @param integer $zone_id
     */
    public function addZones($contact_id, $zones)
    {
        foreach ($zones as $zone_id) {
            $this->add($contact_id, $zone_id);
        }
    }

    /**
     * Delete all contacts_zones relationships for a contact
     * 
     * @param  integer $contact_id
     */
    public function deleteAll($contact_id)
    {
        $this->db->setData("DELETE FROM `{$this->table}` WHERE `contact_id` = ?", [$contact_id]);
    }

    /**
     * Get a collection of ContactZones by contact_id
     * 
     * @param  integer $id
     * @return array
     */
    public function getZonesByContact($id)
    {
        return $this->db->getData("SELECT * FROM {$this->table} as cz, zones as z WHERE cz.zone_id = z.id AND cz.contact_id = ?", [$id]);
    }
}