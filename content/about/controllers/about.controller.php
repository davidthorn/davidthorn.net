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
class AboutControllerAbout extends Controller {
    
    public function __construct() {
       Logger::debug('Controller [ AboutControllerAbout ] constructor fired');
        parent::__construct();
    }
    
    public function test()
    {
        Logger::debug('Controller [ AboutControllerAbout ] test method fired');
        $this->setRedirect('redirect to here');
        
        
    }
    
}

?>
