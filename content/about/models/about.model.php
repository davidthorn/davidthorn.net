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
class AboutModelAbout extends Model {
    
    
    public function __construct() {
        Logger::debug('Model [ AboutModelAbout ] constructor called ');
        parent::__construct();
    }
    
    
    public function getList()
    {
        Logger::debug('Model [ AboutModelAbout ] method getList fired');
    }
    
}

?>
