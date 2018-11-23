<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tutorials
 *
 * @author david
 */
class AdminModelAdmin extends Model {
    
    
    public function __construct() {
        Logger::debug('Model [ AdminModelAdmin ] constructor called ');
        parent::__construct();
    }
    
    
    public function getList()
    {
        Logger::debug('Model [ AdminModelAdmin ] method getList fired');
    }
    
}

?>
