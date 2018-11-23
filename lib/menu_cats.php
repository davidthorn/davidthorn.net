<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menu_cats
 *
 * @author David
 */

require_once TABLES_DIR . 'menucats.php';

class MenuCats {
   
    
    private static $ActivePage = null;
    
    
    public static function getAll( $menu_name )
    {
        $menu = self::getMenu($menu_name);
        
        
        if( $menu != null )
        {
            
            $id = $menu->id;
            
            $sql = "select * from menu_cats where menu_id=$id order by ordering asc";

            $query = mysql_query( $sql );

            if( $query )
            {

                if( mysql_num_rows($query) > 0 )
                {

                    $rows = array();

                    while( $row = mysql_fetch_object( $query ) )
                    {
                        if( $row->link  == "" && $row->home  == 1 )
                        {
                            $row->link = "/";
                        }
                        $rows[ $row->id ] = new MenuCatsObject( $row );
                       
                    }
                    return $rows;
                }

            }    
        }
        
        return null;
        
    }
    
    public static function getMenu( $menu_name )
    {
        $id = $menu_name;
        $sql = "select * from menus where name='$menu_name'";
        
        $query = mysql_query( $sql );
        
        if( $query )
        {
            
            if( mysql_num_rows($query) == 1 )
            {
                $row = mysql_fetch_object( $query );
                return $row;
            }
            
        }
        
        return null;
    }
    
    public static function getActive()
    {
        
        if( self::$ActivePage != null )
        {
            return self::$ActivePage;
        }
        
        $path = null;
        
        if( isset( $_GET['url'] ) )
        {
            
            $path = $_GET['url'];
            
            if( $path != "/" && substr( $path , -1 ) == "/" )
            {
                $path = substr( $path , 0 , strlen( $path ) - 1 );
            }
            
            
            $sql = "select * from menu_cats where link='$path' limit 1";
            
            $query = mysql_query( $sql );
            
            if( mysql_num_rows( $query ) == 1 )
            {
                $row = mysql_fetch_object( $query );
                //$row->cat =
                return new MenuCatsObject( $row );
            }
            
        }
     
            return new MenuCatsObject( new stdClass() );
        
        
    }
    
    
}

?>
