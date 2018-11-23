<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of table
 *
 * @author david
 */
class TableBaseObject {
    
    
    public function __construct( $object ) {
        
        if( is_object( (object)$object ) )
        {
            foreach( $object as $k => $v )
            {
                if( property_exists( $this , $k ) )
                {
                    if( $k == 'params' )
                    {
                        if( !class_exists( 'ParamsObject' ) )
                        {
                            require_once LIB_ROOT . 'mvc' . DS  . 'params.php';
                        }
                        $this->$k = new ParamsObject( $v );
                    }
                    else
                    {
                        $this->$k = $v;
                    }
                    
                }
            }
        }
        
    }
    
    public function get( $var )
    {
        
        if( property_exists( $this , $var ) )
        {
            if( $var == 'params' )
            {
                
                if( property_exists( $this , 'params' ) )
                {
                    return $this->params;
                }
                
            }
            return $this->$var;
        }
        
        return false;
        
    }
    
    public function getParameter( $var )
    {
        
        $params = $this->get('params');
        
        
        
        if( $params instanceof ParamsObject )
        {
            return $params->get( $var );
        }
        
        return false;
        
    }
}

?>
