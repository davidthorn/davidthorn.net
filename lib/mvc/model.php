<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author david
 */
class Model {
    
    
    public function __construct() {
       
        Logger::debug('Parent Model Constructor fired');
        
    }
    
    
    public function reorder( $identifier_name , $identifier_value , $table_name , $primary_key )
    {
        
        
        $sql = "select ordering from $table_name where $indentifier=$identifier_value order by ordering asc";
        
        $query = MySQL::query($sql);
        
        if( $query )
        {
            
            if( MySQL::getNumRows() > 0 )
            {
                
                $rows = MySQL::getRows();
                
                if( $rows != null && is_array( $rows ) )
                {
                    $ordering_val = 1;
                    foreach( $rows as $k => $value )
                    {
                        $value->ordering = $ordering_val;
                        
                        $update_sql = "update $table_name set ordering=" . $value->ordering . " where $identifier_name=$identifier_value";
                        
                        $success = MySQL::query($update_sql);
                        
                        if( !$success )
                        {
                            echo "problem";
                        }
                        
                        $ordering_val++;
                    }
                }
            }
        }
        
        
    }
    
   
}

?>
