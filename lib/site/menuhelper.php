<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menuhelper
 *
 * @author david
 */
class MenuHelper {
    

        private static $MenuItems = array();
        
    
        public static function listAll()
        {
            
            
            $items = array();
            $root = self::__getItems(1 , 1);
            
           return self::$MenuItems;
                    
            
            
            
        }
        
        private static function __getItems( $parent_id , $level )
        {
            
            $root_query = MySQL::query("select * from pages where parent_id=$parent_id and level=$level order by ordering asc");
            
            if( $root_query )
            {
                $num_children = MySQL::getNumRows();
                if( $num_children > 0  )
                {
                    
                    if( !class_exists( 'PageObject' ) )
                    {
                        require_once MODELS_DIR . 'model.pages.php';
                    }
                    
                    $root_items = MySQL::getRows('PageObject');
                    
                    
                    if( $root_items != null && is_array( $root_items ) )
                    {
                        
                        
                        foreach( $root_items  as $k => $page )
                        {
                            
                            if( (int)$page->get('ordering') < $num_children )
                            {
                                $page->rgt = ( (int)$page->get('ordering') + 1 );
                            }
                            else
                            {
                                $page->rgt = 0;
                            }
                            
                            if( (int)$page->get('ordering') > 1 )
                            {
                                $page->lft = ( (int)$page->get('ordering') - 1 );
                            }
                            else
                            {
                               $page->lft = 0; 
                            }
                            self::$MenuItems[ $page->get('id') ] = $page;
                            self::__getItems( $page->get('id') , $page->get('level') + 1  );
                            
                        }
                    
                        
                    }
                    
                    
                    
                }
                
            }
            
            return null;
        }
        
        
        public static function decrement( $page_id , $direction , $target_placement )
        {
            
            $row_query = MySQL::query("select * from pages where id=" . $page_id);
            
            if( $row_query )
            {
                
                if( MySQL::getNumRows() == 1 )
                {
                    
                    $row = MySQL::getRow('PageObject');
                    
                    if( $row instanceof PageObject )
                    {
                        
                        $parent_id      =   (int)$row->get('parent_id');
                        $level          =   (int)$row->get('level');
                        
                        $update = MySQL::query( "update pages set ordering=ordering + 1 where parent_id=$parent_id and level=$level and ordering=$target_placement" );
                        
                        if( $update )
                        {
                            $row->ordering  = (int)$target_placement;
                            $query = MySQL::update( $row , 'pages', 'id');
                            
                            if( $query )
                            {
                                return true;
                            }
                        }
                        
                    }
                    
                }
                
            }
            
            
        }
        
        public static function increment( $page_id , $direction , $target_placement )
        {
            
            $row_query = MySQL::query("select * from pages where id=" . $page_id);
            
            if( $row_query )
            {
                
                if( MySQL::getNumRows() == 1 )
                {
                    
                    $row = MySQL::getRow('PageObject');
                    
                    if( $row instanceof PageObject )
                    {
                        
                        $parent_id      =   (int)$row->get('parent_id');
                        $level          =   (int)$row->get('level');
                        
                        $update = MySQL::query( "update pages set ordering=ordering - 1 where parent_id=$parent_id and level=$level and ordering=$target_placement" );
                        
                        if( $update )
                        {
                            $row->ordering  = (int)$target_placement;
                            $query = MySQL::update( $row , 'pages', 'id');
                            
                            if( $query )
                            {
                                return true;
                            }
                        }
                        
                    }
                    
                }
                
            }
            
            
        }

    
    
}

?>
