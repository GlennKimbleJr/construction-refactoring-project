<?php 

namespace App\Controllers\Reports;

use App\Controllers\BaseController;
use Psr\Http\Message\ServerRequestInterface as Request;

class BidderSatisfactionController extends BaseController
{
    /**
     * Update and display report.
     * 
     * @return \Zend\Diactoros\Response
     */
    public function index()
    {
        // Update contacts score
        $contacts = $this->db->getData("SELECT id FROM contacts");
        
        foreach ($contacts as $contact) {

            $score = $this->db->getFirst(
                "SELECT sum(score) as sum FROM bidders WHERE contact_id = ? AND score != '0'", 
                [$contact['id']]
            );

            $scoredBidTotal = $this->db->getCount(
                "SELECT NULL FROM bidders WHERE contact_id = ? AND score != '0'",
                [$contact['id']]
            );

            $scoreAverage = $score['sum'] / $scoredBidTotal;

            if ($score['sum']) {
                $this->db->setData("UPDATE contacts SET score_per = ? WHERE id = ?", 
                    [$scoreAverage, $contact['id']]
                );
            }
        }

        return $this->view('report/score', [
            'title' => 'Reports: Score',
            'contacts' => $this->db->getData("SELECT * FROM contacts WHERE score_per != '0' ORDER BY score_per")
        ]);
    }
}
