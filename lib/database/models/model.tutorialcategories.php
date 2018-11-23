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



class ModelTutorialsCategories extends Model {
    
    public static function getTutorialsCategories( )
    {
        
        $sql = "select * from tutorial_categories where status=1 order by ordering asc";
        
        $query = mysql_query( $sql );
        
        if( $query )
        {
            
            if( mysql_num_rows( $query ) > 0  )
            {
                $rows = array();
                
                if( !class_exists('TutorialObject') )
                {
                    require_once TABLES_DIR . 'table.tutorialcategories.php';
                }
                
                while( $row = mysql_fetch_object( $query ) )
                {
                    
                    $rows[ $row->id ] = new TutorialCategoriesObject( $row );
                    
                }
                
                return $rows;
                
            }
            
        }
        
    }
    
}

?>
