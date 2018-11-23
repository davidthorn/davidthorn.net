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

require_once TABLES_DIR . "table.modtypes.php";


class ModelModuleTypes extends Model {
    
    
    public function __construct() {
        parent::__construct();
        
    }
    
    public static function getModulesTypes()
    {
        
        
        $sql = "select * from module_types order by id asc";
        
        $query = MySQL::query($sql);
        
        if( $query )
        {
            
            if( MySQL::getNumRows() > 0 )
            {
                
                if( !class_exists( 'ModulesTypesObject' ) )
                {
                    require_once MODELS_DIR . 'model.modtypes.php';
                } 
                
                $modules =& MySQL::getRows('ModulesTypesObject');
                
                if( $modules != null )
                {
                    return $modules;
                }
            }
            
        }
        
        return null;
        
        
        
    }
    
    public static function getModulesType( $id )
    {
        
        
        $sql = "select * from module_types where id=" . $id;
        
        $query = MySQL::query($sql);
        
        if( $query )
        {
            
            if( MySQL::getNumRows() == 1 )
            {
                
                
                $module =& MySQL::getRow('ModulesTypesObject');
                
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
