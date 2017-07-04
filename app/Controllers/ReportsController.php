<?php 

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;

class ReportsController extends BaseController
{
    /**
     * @return \Zend\Diactoros\Response
     */
    public function index()
    {
        return $this->view('report');
    }
}
