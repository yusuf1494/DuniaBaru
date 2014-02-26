<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AppRoute extends BaseRoute{
    public function __construct() {
        parent::__construct();
    }
    
    public function login(){
        $this->renderPage('login.twig');
    }
    
    public function authenticate(){
        $request = $this->app->request();
        
        $username = $request->post('username');
        $password = $request->post('password');
        
        if($username == 'yusuf1494' && $password == 'yusuf'){
            $this->app->redirect("/");
        }
    }
}