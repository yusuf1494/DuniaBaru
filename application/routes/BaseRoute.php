<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class BaseRoute {
    protected $app;
    
    protected $em;
    
    public function __construct() {
        $this->app = \Slim\Slim::getInstance();
    }
    
    protected function renderPage($viewFile){
        $this->app->render($viewFile);
    }
}