<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tutorials
 *
 * @author david
 */
class AdminModelModules extends Model {
    
    
    public function __construct() {
        Logger::debug('Model [ AdminModelAdmin ] constructor called ');
        parent::__construct();
        
    }
    
    
    
    public function getModule()
    {
        
        if( isset( $_GET['id'] ) )
        {
            
            $query = MySQL::query( "select * from modules where id=" . $_GET['id'] );
            
            if( $query )
            {
                if( MySQL::getNumRows() == 1 )
                {
                    
                    if( !class_exists( "ModulesObject" ) )
                    {
                        require_once MODELS_DIR . 'model.modules.php';
                    }
                    
                    $module =& MySQL::getRow('ModulesObject');
                    
                    return $module;
                }
            }
            
        }
        
        return null;
        
    }
    
    public function getModules()
    {
        
        $query = MySQL::query("select * from modules order by id asc");
        
        if( $query )
        {
            
            if( MySQL::getNumRows() > 0 )
            {
                
                if( !class_exists( "ModulesObject" ) )
                {
                    require_once MODELS_DIR . 'model.modules.php';
                }
                
                $rows =& MySQL::getRows('ModulesObject');
                if( $rows != null )
                {
                    
                    return $rows;
                    
                }
                
            }
            
            
            
        }
        
        return null;
        
    }
    
    
    public function save()
    {
        
        $jform = $_POST['jform'];
        
        if( !class_exists( 'ModulesObject' ) )
        {
            require_once MODELS_DIR . 'model.modules.php';
        } 
        
        
        
        if( isset( $jform['params'] ) )
        {
            
            $jform['params'] = json_encode($jform['params']);
            
        }
        else
        {
            $jform['params'] = json_encode( new stdClass() );
        }
        
        $module = new ModulesObject( $jform );
        $module->params = $module->params->encode();
        
        if( empty( $jform['id'] ) )
        {
            
            if( MySQL::insert($module, 'modules', 'id') )
            {
                return $module->id;
            }
        }
        else
        {
            if( MySQL::update($module, 'modules', 'id') )
            {
                return $module->id;
            }
        }
        
        
        
        return false;
        
    }
    
    
    public function delete()
    {
        
        if( isset( $_POST['jform']['id'] ) )
        {
            
            $id = (int)$_POST['jform']['id'];
            
            if( MySQL::delete( $id, 'modules', 'id') )
            {
                return true;
                
            }
            
            
            
        }
        
        return false;
        
        
    }
    
}

?>
