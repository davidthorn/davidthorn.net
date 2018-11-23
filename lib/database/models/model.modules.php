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

require_once TABLES_DIR . "table.modules.php";


class ModelModules extends Model {
    
    
    public function __construct() {
        parent::__construct();
        
    }
    
    public static function getModules()
    {
        
        
        $sql = "select * from modules order by id asc";
        
        $query = MySQL::query($sql);
        
        if( $query )
        {
            
            if( MySQL::getNumRows() > 0 )
            {
                
                if( !class_exists( 'ModulesObject' ) )
                {
                    require_once MODELS_DIR . 'model.modules.php';
                } 
                
                $modules =& MySQL::getRows('ModulesObject');
                
                if( $modules != null )
                {
                    return $modules;
                }
            }
            
        }
        
        return null;
        
        
        
    }
    
    public static function getModule( $id )
    {
        
        
        $sql = "select * from modules where id=" . $id;
        
        $query = MySQL::query($sql);
        
        if( $query )
        {
            
            if( MySQL::getNumRows() == 1 )
            {
                
                
                $module =& MySQL::getRow('ModulesObject');
                
                if( $module != null )
                {
                    return $module;
                }
            }
            
        }
        
        return null;
        
        
        
    }
    
}

?>
