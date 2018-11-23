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
class AjaxModelAjax extends Model {
    
    
    public function __construct() {
        Logger::debug('Model [ HomeModelHome ] constructor called ');
        parent::__construct();
    }
    
    
    public function getList()
    {
        Logger::debug('Model [ HomeModelHome ] method getList fired');
    }
    
}

?>
