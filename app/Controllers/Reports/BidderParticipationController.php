<?php 

namespace App\Controllers\Reports;

use App\Controller;
use App\Reports\BidderParticipationReport;
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
        $report = new BidderParticipationReport($this->db);

        $report->update();

        return $this->view('report/bid', [
            'title' => 'Reports: Bid Percentage',
            'contacts' => $report->get()
        ]);
    }
}
