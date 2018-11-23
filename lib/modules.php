<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modules
 *
 * @author David
 */

require_once MODELS_DIR . 'model.modtypes.php';

class Modules {
    
    
    private static $Content = null;
    
    private static $ModTypes = null;
    
    private static $Modules = null;
    
    public static function getModules( $position )
    {
        
       
        $sql = "select * from modules where position='$position' order by ordering asc";

        $query = mysql_query( $sql );

        if( $query )
        {

            if( mysql_num_rows($query) > 0 )
            {

                $rows = array();

                
                if( !class_exists( "ModulesObject" ) )
                {
                    require_once MODELS_DIR . 'model.modules.php';
                }
                
                while( $row = mysql_fetch_object( $query ) )
                {
                    $rows[ $row->name ] = new ModulesObject( $row );
                }
                return $rows;
            }

        }    
    

        return null;
        
    }
    
    
    public static function getModTypes()
    {
        
        if( self::$ModTypes != null )
        {
            return self::$ModTypes;
        }
        
       
        self::$ModTypes = ModelModuleTypes::getModulesTypes();
        return self::$ModTypes;
        
    }
    
    public static function renderModules(  $position )
    {
        
        $modules = self::getModules($position);
        $types = self::getModTypes();
        
        
        if( !is_array( $types ) )
        {
            throw new Exception("Module types is not an array please check what is wrong here ");
        }
       
        
        $content = "";
        
        if( $modules != null )
        {
            
            if( is_array( $modules ) )
            {
                
                foreach( $modules as $k => $module )
                {
                 
                    
                    
                    
                    if( array_key_exists( (int)$module->get('mod_type') , $types ) )
                    {
                        $type = $types[ $module->get('mod_type') ];
                        
                        if( is_dir( MODULES_DIR . $type->mod_type . DS  ) )
                        {
                            
                            
                            require_once MODULES_DIR . $type->mod_type . DS . $type->mod_type . '.php';
                           
                            $classname = "Module" . ucfirst( $type->mod_type );
                            
                            if( class_exists( $classname ) )
                            {
                                 
                                $mod_class = new $classname( $module );
                                
                                
                                $content .= $mod_class->render();
                                
                                
                            }
                            
                            
                            
                        }
                        
                    }
                    
                }
                
            }
            
        }
        
        return $content;
        
        
    }
    
    
    public static function getParamsFile( $mod_type , ModulesObject $module )
    {
        
        
        $module_type = ModelModuleTypes::getModulesType( $mod_type );
        
        if( $module_type != null )
        {
           $mod_name = $module_type->get('mod_type');
        
            if( is_dir( MODULES_DIR . strtolower( $mod_name ) . DS ) )
            {
                $path = MODULES_DIR . strtolower( $mod_name ) . DS;

                if( file_exists( $path . strtolower( $mod_name ) . '.params.php' ) )
                {
                    require_once $path . strtolower( $mod_name ) . '.params.php';
                }
            } 
        }
        
        
        
        
        
        
    }
    
    
}

?>
