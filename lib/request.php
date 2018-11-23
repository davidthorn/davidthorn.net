<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of request
 *
 * @author David
 */
class Request {

    
    private static $URL_PATH = null;
    private static $QUERY_STRING = null;
    
    private static $Content = null;
    
    
    private static function cleanUrl()
    {
        
        if( isset( $_GET['url'] ) )
        {
            $url = explode( "/" ,  $_GET['url'] );
            
            if( count( $url ) > 0  )
            {
            
                if( count( $url ) == 1 )
                {
                    //then there were no leading slash, and this is a content page
                }
                
            }
            
            self::$URL_PATH = $_GET['url'];
        }
        
    }
    
}

?>
