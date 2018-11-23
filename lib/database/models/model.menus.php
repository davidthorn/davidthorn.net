<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menus
 *
 * @author david
 */

require_once TABLES_DIR . "table.menus.php";


class ModelMenus extends Model {
    
    public static function getMenus()
    {
        
        
        $sql = "select * from menus order by id asc";
        
        $query = mysql_query( $sql );
        
        if( $query )
        {
            
            if( mysql_num_rows( $query ) > 0 )
            {
                
                $rows = array();
                
                while( $row = mysql_fetch_object( $query ) )
                {
                    $rows[ $row->id ] = new MenusObject( $row );
                }
                
                return $rows;
                
            }
            
        }
        
        
        
    }
    
    
}

?>
