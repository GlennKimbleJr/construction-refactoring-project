<?php 

namespace App\Reports;

use App\Database;
use App\Models\Bidder;
use App\Models\Contact;

class BidderSatisfactionReport
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
        return (new Contact($this->db))->getByScorePercentage();
    }

    /**
     * Update the score percentage for the contacts.
     * 
     * @return array
     */
    public function update()
    {
        $contacts = new Contact($this->db);

        $bidders = new Bidder($this->db);
        
        foreach ($contacts->get() as $contact) {

            $score = $bidders->sumOfScores($contact['id']);

            $scoredBidTotal = $bidders->totalTimesScored($contact['id']);

            $scoreAverage = $score['sum'] / $scoredBidTotal;

            if ($score['sum']) {
                $contacts->updateColumn($contact['id'], 'score_per', $scoreAverage);
            }
        }
    }
}