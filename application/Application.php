<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Application extends \Slim\Slim{
    public function __construct(array $userSettings = array()) {
        parent::__construct($userSettings);
    }
}