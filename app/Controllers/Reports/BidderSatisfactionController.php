<?php 

namespace App\Controllers\Reports;

use App\Controller;
use App\Reports\BidderSatisfactionReport;
use Psr\Http\Message\ServerRequestInterface as Request;

class BidderSatisfactionController extends Controller
{
    /**
     * Update and display report.
     * 
     * @return \Zend\Diactoros\Response
     */
    public function index()
    {
        $report = new BidderSatisfactionReport($this->db);

        $report->update();

        return $this->view('report/score', [
            'title' => 'Reports: Score',
            'contacts' => $report->get()
        ]);
    }
}
