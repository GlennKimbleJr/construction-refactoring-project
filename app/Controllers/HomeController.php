<?php 

namespace App\Controllers;

class HomeController extends BaseController
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
