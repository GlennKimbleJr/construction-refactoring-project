<?php 

namespace App\Reports;

use App\Database;
use App\Models\Bidder;
use App\Models\Contact;

class BidderParticipationReport
{
    /**
     * @param App\Database $db
     */
    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * Generate the report.
     * 
     * @return array
     */
    public function get()
    {
        return (new Contact($this->db))->getByBidPercentage();
    }

    /**
     * Update the bid percentage for the contacts.
     * 
     * @return array
     */
    public function update()
    {
        $contacts = new Contact($this->db);

        $bidders = new Bidder($this->db);
        
        foreach ($contacts->get() as $contact) {

            $willBidCount = $bidders->getTotalTimesBid('will', $contact['id']);
            $wontBidCount = $bidders->getTotalTimesBid('wont', $contact['id']);

            $totalBids = $willBidCount + $wontBidCount;
            $bidPercentage = ($willBidCount / $totalBids) * 100;

            if ($totalBids) {
                $contacts->updateColumn($contact['id'], 'bid_per', $bidPercentage);
            }
        }
    }
}