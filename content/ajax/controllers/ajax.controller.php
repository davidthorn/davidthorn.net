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
class AjaxControllerAjax extends Controller {
    
    public function __construct() {
       Logger::debug('Controller [ HomeControllerHome ] constructor fired');
        parent::__construct();
        
        if( $_SERVER['REQUEST_METHOD'] != "POST" )
        {
            if( !preg_match( "{davidthorn.net}" , $_SERVER['HTTP_REFERER'] ) )
            {
                $this->setRedirect("/");
            }
            //$this->setRedirect("/");
        }
    }
    
    public function test()
    {
        Logger::debug('Controller [ HomeControllerHome ] test method fired');
        $this->setRedirect('redirect to here');
    }
    
    public function getViews()
    {
        
        $page_type = $_POST['page_type'];
        
        $std = new stdClass();
        
        $std->views = array();
        
        foreach( Site::getViews($page_type) as $key => $value )
        {
            $std->views[$value] = Site::getTmpls( $page_type , $value );
            
        }
       
        echo json_encode( $std );
        
    }
    
}

?>
