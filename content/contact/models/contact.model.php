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
class ContactModelContact extends Model {
    
    
    public function __construct() {
        Logger::debug('Model [ ContactModelContact ] constructor called ');
        parent::__construct();
    }
    
    
    public function getList()
    {
        Logger::debug('Model [ ContactModelContact ] method getList fired');
    }
    
}

?>
