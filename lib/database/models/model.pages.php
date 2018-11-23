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



require_once TABLES_DIR . 'table.pages.php';

class ModelPages extends Model {
   
    
    private static $ActivePage = null;
    
    
    public static function getAll()
    {
        
        $sql = "select * from pages order by menu_id asc, ordering asc";
        
        $query = MySQL::query( $sql );
        
        if( $query )
        {
            
            if( MySQL::getNumRows() > 0 )
            {
                $pages = MySQL::getRows('PageObject');
                return $pages;
            }
        }
        return null;
    }
    
    public static function getAllPagesByMenuID( $parent_id , $start_level , $end_level )
    {
        $sql     =  "select * from pages where parent_id=$parent_id ";
        $sql    .=  "and level=$start_level "; 
        $sql    .=  "and status=1  ";
        $sql    .=  "order by ordering asc";
        
        $query = MySQL::query( $sql );
        
        if( $query )
        {
            if( MySQL::getNumRows() > 0 )
            {
                $pages = MySQL::getRows('PageObject');
                return $pages;
            }
        }
        
        return null;
    }
    
    public static function getSubMenus( PageObject &$parentObject , $max_level )
    {
        
        $parent_id  =   $parentObject->get('id');
        $level      =   ( (int)$parentObject->get('level') + 1 );
        
        $parentObject->children = null;
        
        $sql     =  "select * from pages where parent_id=$parent_id ";
        $sql    .=  "and level=$level "; 
        $sql    .=  "and status=1  ";
        $sql    .=  "order by ordering asc";
        
        $query = MySQL::query( $sql );
        
        if( $query )
        {
            if( MySQL::getNumRows() > 0 )
            {
                $pages = MySQL::getRows('PageObject');
                if( (int)$max_level > $level )
                {
                    foreach( $pages as $key => $sub )
                    {
                        self::getSubMenus( $pages[$key ] , $max_level );
                    }
                }
                
                
                $parentObject->children =& $pages;
                return $pages;
            }
        }
        
        return null;
    }
    
    
    public static function getPage( $page_id )
    {
        
        $sql = "select * from pages where id=$page_id";
        
        $query = MySQL::query($sql);
        
        if( $query )
        {
            if( MySQL::getNumRows() == 1 )
            {
                $page = MySQL::getRow('PageObject');
                return $page;
            }
        }
        
        return null;
        
    }
    
    public static function getMenu_root()
    {
       $sql = "select * from pages where name='Menu_root'";
        
        $query = MySQL::query($sql);
        
        if( $query )
        {
            if( MySQL::getNumRows() == 1 )
            {
                
                $page = MySQL::getRow('PageObject');
                return $page;
            }
        }
        
        return null; 
    }
    
    public static function getPlacement( PageObject $parentPageObject )
    {
        
        $sql     =  "select * from pages ";
        $sql    .=  "where parent_id=" . $parentPageObject->get('id') . " ";
        $sql    .=  "and level=" . ($parentPageObject->get('level') + 1) . " ";
        $sql    .=  "order by ordering desc limit 1";
        
        $query = MySQL::query($sql);
        
        if( $query )
        {
            if( MySQL::getNumRows() == 1 )
            {
                $row = MySQL::getRow('PageObject');
                return ( $row != null ) ? ( $row->get('ordering') + 1 ) : -1;
            }
        }
        return 1;
        
    }
    
    
    public static function compare( PageObject &$pageObject )
    {
        
        $current = self::getPage( $pageObject->get('id') );
        
        if( $current != null )
        {
            
            //first check parent id is the same, if so then no big checks required
            if( (int)$current->get('parent_id') != (int)$pageObject->get('parent_id')   )
            {
                $new_parent = self::getPage( $pageObject->get('parent_id') );
                
                $pageObject->level = ( $new_parent->get('level') + 1 );
            
                $pageObject->ordering = self::getPlacement( $new_parent );
            }
            
            self::__update_link( $pageObject );
        }
        
        return null;
    }

    
    /*public static function reorder( $level = 1 , $parent_id = 0 )
    {
        
        $sql = "select * from pages where parent_id=$parent_id and level=" . $level . " order by ordering asc";
        
        $query = MySQL::query($sql);
        
        if( $query )
        {
            
            if( MySQL::getNumRows() > 0 )
            {
                
                $rows = MySQL::getRows('PageObject');
                
                if( $rows != null && is_array( $rows ) )
                {
                    $ordering_val = 1;
                    foreach( $rows as $k => $value )
                    {
                        $value->ordering = $ordering_val;
                        $success = MySQL::update($value, 'pages', 'id');
                        
                        if( $success )
                        {
                            self::reorder( $value->level + 1 ,  $value->id );
                        }
                        
                        $ordering_val++;
                    }
                }
            }
        }
    }*/
    
    private static function __update_link( PageObject &$pageObject )
    {
        
        $page_name = self::__clean_text( $pageObject->get('name') );
        
        $level = (int)$pageObject->get('level');
        
        $link = "";
        
        $temp_level = $level;
        $current_page = $pageObject;
        while( $temp_level > 0 )
        {
            if( (int)$current_page->get('level') > 1 )
            {
                $parent = self::getPage( $current_page->get('parent_id') );
            
                if( $parent instanceof PageObject )
                {
                    $parent_name = self::__clean_text( $parent->get('name') );

                    $link = $parent_name . "/" . $link;
                    
                    //read to loop once again,set the current page to check for next parent
                    $current_page = $parent;

                    $temp_level--;
                }
            }
            else
            {
                $temp_level = 0;
                break;
            }
        }
        
        $link = strtolower( $link . $page_name );
        
        $pageObject->link = $link;
        
        
    }
    
    private static function __clean_text( $text )
    {
       return preg_replace( "{[\W_]}" , "-" ,  $text );
    }
    
    
    public static function getPageByLink( $link )
    {
        $sql = "select * from pages where link='$link' limit 1";
            
        $query = MySQL::query( $sql );

        if( $query )
        {
            if( MySQL::getNumRows() == 1 )
            {
                return MySQL::getRow('PageObject');
            }    
        }
        return null;
    }
    
    
    public static function getHomePage()
    {
        $sql = "select * from pages where home=1";
        
        $query = MySQL::query( $sql );
        
        if( $query )
        {
            
            if( MySQL::getNumRows() == 1 )
            {
                return MySQL::getRow('PageObject');
            }
        }
        
        return false;
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
            
            //test that this is the home page
            if( empty( $_GET['url'] ) || $path == "/" )
            {
                $home = self::getHomePage();
                
                if( $home instanceof PageObject )
                {
                    self::$ActivePage =& $home;
                    return $home;
                }
                
            }
            else
            {
                if( strlen( $path ) > 1 && substr( $path , -1 ) == "/" )
                {
                    $path = substr( $path , 0 , strlen( $path ) - 1 );
                }
            }
            
            
            $page = self::getPageByLink( $path );
            
            if( $page != null )
            {
                self::$ActivePage =& $page;
                return self::$ActivePage;
            }
            else
            {
                return self::getHomePage();
            }
        }
        //in all other circumstances, return a PageObject to prevent any further issues
        return new PageObject( new stdClass() );
    }
    
    
}

?>
