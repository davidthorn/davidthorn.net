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

require_once TABLES_DIR . 'table.tutorials.php';

class ModelTutorials extends Model {
    
    
   
    public static function getTutorials( $category_id )
    {
        
        $sql = "select * from tutorials where category_id=$category_id order by ordering asc";
        
        $query = mysql_query( $sql );
        
        if( $query )
        {
            
            if( mysql_num_rows( $query ) > 0  )
            {
                $rows = array();
                while( $row = mysql_fetch_object( $query ) )
                {
                    
                    $obj = new TutorialObject( $row );
                    
                    $rows[ $row->id ] = new TutorialObject( $row );
                    
                    
                }
                
                return $rows;
            }
            
        }
        
        
    }
    
    public static function getTutorial( $tutorial_id )
    {
        
        $sql = "select * from tutorials where id=$tutorial_id";
        
        $query = mysql_query( $sql );
        
        if( $query )
        {
            if( mysql_num_rows( $query ) == 1 )
            {
                
                $row = mysql_fetch_object( $query );
                
                $tutorial = new TutorialObject( $row );
                return $tutorial;
            }
            
        }
    }
    
    public static function getPlacement( $category_id )
    {
        
        $sql     =  "select * from tutorials ";
        $sql    .=  "where category_id=" . $category_id . " ";
        $sql    .=  "order by ordering desc limit 1";
        
        $query = MySQL::query($sql);
        
        if( $query )
        {
            if( MySQL::getNumRows() == 1 )
            {
                $row = MySQL::getRow('TutorialObject');
                return ( $row != null ) ? ( $row->get('ordering') + 1 ) : -1;
            }
        }
        return 1;
        
    }
    
    public static function compare( TutorialObject &$tutorialObject )
    {
        
        $current = self::getTutorial( $tutorialObject->get('id') );
        
        if( $current != null )
        {
            
            //first check parent id is the same, if so then no big checks required
            if( (int)$current->get('category_id') != (int)$tutorialObject->get('category_id')   )
            {
                $new_parent = self::getTutorial( $tutorialObject->get('category_id') );
                
                $tutorialObject->ordering = self::getPlacement( $new_parent );
            }
            
        }
        
        return null;
    }
    
    
    /*public static function reorder( $parent_id )
    {
        
        $sql = "select * from tutorials where category_id=$parent_id order by ordering asc";
        
        $query = MySQL::query($sql);
        
        if( $query )
        {
            
            if( MySQL::getNumRows() > 0 )
            {
                
                $rows = MySQL::getRows('TutorialObject');
                
                if( $rows != null && is_array( $rows ) )
                {
                    $ordering_val = 1;
                    foreach( $rows as $k => $value )
                    {
                        $value->ordering = $ordering_val;
                        $success = MySQL::update($value, 'tutorials', 'id');
                        
                        if( !$success )
                        {
                            echo "problem";
                        }
                        
                        $ordering_val++;
                    }
                }
            }
        }
    }*/
    
    
    
}

?>
