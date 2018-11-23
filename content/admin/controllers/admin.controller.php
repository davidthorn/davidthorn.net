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
class AdminControllerAdmin extends Controller {
    
    public function __construct() {
       Logger::debug('Controller [ AdminControllerAdmin ] constructor fired');
        parent::__construct();
    }
    
    public function test()
    {
        Logger::debug('Controller [ AdminControllerAdmin ] test method fired');
        $this->setRedirect('redirect to here');
        
        
    }
    
}

?>
