<?php 

namespace App\Controllers;

use App\Controller;

class HomeController extends Controller
{
    /**
     * Application main page.
     * 
     * @return \Zend\Diactoros\Response
     */
    public function index()
    {
        return $this->view('home', ['title' => 'Home']);
    }
}
