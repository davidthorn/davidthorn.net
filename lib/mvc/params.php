<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of params
 *
 * @author david
 */
class ParamsObject {
    
    
    private $params = null;
    
    public function __construct( $json ) {
        
        
        $this->params = $this->decode( $json );
        
    }
    
    
    public function get( $var )
    {
        
        
        
        if( property_exists( $this->params , $var ) )
        {
            
            return $this->params->$var;
        }
        
        return false;
        
    }
    
    public function set( $var , $value )
    {
        
        $this->params->$var = $value;
         
    }
    
    public function encode()
    {
        return json_encode( $this->params );
    }
    
    public function decode( $json )
    {
        return json_decode( $json );
    }
    
}

?>
