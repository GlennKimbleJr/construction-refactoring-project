<?php 

namespace App\Controllers\Reports;

use App\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;

class BidderParticipationController extends Controller
{
    /**
     * Update and display report.
     * 
     * @return \Zend\Diactoros\Response
     */
    public function index()
    {
        // Update contacts bid percentage
        $contacts = $this->db->getData("SELECT id FROM contacts");
        
        foreach ($contacts as $contact) {

            $willBidCount = $this->db->getCount(
                "SELECT null FROM bidders WHERE contact_id = ? AND status='will'",
                [$contact['id']]
            );

            $wontBidCount = $this->db->getCount(
                "SELECT null FROM bidders WHERE contact_id = ? AND status='wont'",
                [$contact['id']]
            );

            $totalBids = $willBidCount + $wontBidCount;
            $bidPercentage = ($willBidCount / $totalBids) * 100;

            if ($totalBids) {
                $this->db->setData("UPDATE contacts SET bid_per=? WHERE id=?", 
                    [$bidPercentage, $contact['id']]
                );
            }
        }

        return $this->view('report/bid', [
            'title' => 'Reports: Bid Percentage',
            'contacts' => $this->db->getData("SELECT * FROM contacts WHERE bid_per > 0 ORDER BY bid_per")
        ]);
    }
}
