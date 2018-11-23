<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of application
 *
 * @author david
 */
class Application {
    
    
    public static function getSite()
    {
        
        if( !class_exists( "Site" ) )
        {
            require_once LIB_ROOT . 'site' . DS . 'site.php';
        }
        
        
        
    }
    
    
    public static function getTemplate()
    {
        
    }
    
    
}

?>
