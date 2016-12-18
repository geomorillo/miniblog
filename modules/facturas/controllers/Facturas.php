<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace modules\facturas\controllers;

/**
 * Description of Facturas
 *
 * @author Daniel Navarro Ramírez
 */
use system\core\Controller;
use system\http\Response;
//use system\helpers\Auth\Auth;

class Facturas extends Controller {
    
    private $auth;
    private $response;
    
    public function __construct() {
        parent::__construct();
        $this->view->useTemplate("empty");
        $this->response = new Response();
     //   $this->auth = new Auth();
    }
    
    public function before()
    {
//        if (!$this->auth->isLogged()) {
//            $this->response->redirect("login");
//        }
    }
    
    public function index()
    {
        $data["title"] = "Facturas";
        echo $this->view->render("index", $data);
    }
}
