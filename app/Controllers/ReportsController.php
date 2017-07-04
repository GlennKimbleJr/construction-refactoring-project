<?php 

namespace App\Controllers;

use App\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;

class ReportsController extends Controller
{
    /**
     * @return \Zend\Diactoros\Response
     */
    public function index()
    {
        return $this->view('report');
    }
}
