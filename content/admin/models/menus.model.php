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
class AdminModelMenus extends Model {
    
    
    public function __construct() {
        Logger::debug('Model [ AdminModelAdmin ] constructor called ');
        parent::__construct();
        
    }
    
    
    
    public function getMenu()
    {
        
        if( isset( $_GET['id'] ) )
        {
            
            $query = MySQL::query( "select * from menus where id=" . $_GET['id'] );
            
            if( $query )
            {
                if( MySQL::getNumRows() == 1 )
                {
                    
                    if( !class_exists( "MenusObject" ) )
                    {
                        require_once MODELS_DIR . 'model.menus.php';
                    }
                    
                    $menu =& MySQL::getRow('MenusObject');
                    
                    return $menu;
                }
            }
            
        }
        
        return null;
        
    }
    
    public function getMenus()
    {
        
        $query = MySQL::query("select * from menus order by id asc");
        
        if( $query )
        {
            
            if( MySQL::getNumRows() > 0 )
            {
                
                if( !class_exists( "MenusObject" ) )
                {
                    require_once MODELS_DIR . 'model.menus.php';
                }
                
                $rows =& MySQL::getRows('MenusObject');
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
        
        
        
        
        $menu = new MenusObject( $jform );
        
        if( empty( $jform['id'] ) )
        {
            
            if( MySQL::insert($menu, 'menus', 'id') )
            {
                return $menu->id;
            }
        }
        else
        {
            if( MySQL::update($menu, 'menus', 'id') )
            {
                return $menu->id;
            }
        }
        
        
        
        return false;
        
    }
    
}

?>
