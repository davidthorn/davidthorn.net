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
class AdminModelPages extends Model {
    
    
    public function __construct() {
        Logger::debug('Model [ PagesModelPages ] constructor called ');
        parent::__construct();
    }
    
    
    public function getPages()
    {
        if( !class_exists( 'MenuHelper' ) )
        {
            require_once LIB_ROOT . 'site' . DS . 'menuhelper.php';
        }
        return MenuHelper::listAll();
        
    }
    
    public function getPage()
    {
        return ModelPages::getPage($_GET['id']);
        
    }
    
    public function update_status()
    {
        
        $page = ModelPages::getPage($_POST['source_element']);
        $page->status = ( (int)$page->get('status') ) ? 0 : 1;
        
        if( MySQL::update($page, 'pages', 'id') )
        {
            return true;
        }
        
        return false;
        
    }
    
    public function save()
    {
        
        $jform = $_POST['jform'];
        
        if( isset( $jform['params'] ) )
        {
            
            $jform['params'] = json_encode($jform['params']);
            
        }
        else
        {
            $jform['params'] = json_encode( new stdClass() );
        }
        
        
        
        $page = new PageObject( $jform );
        
        $page->params = $page->params->encode();
        
        
        $page_id = false;
        
        if( empty( $jform['id'] ) )
        {
           
            $parent = ModelPages::getPage($jform['parent_id']); 
            
            $next_placement = ModelPages::getPlacement( $parent );
            
            $page->ordering = $next_placement;
            
            $page->level = $parent->level + 1;
            
            MySQL::insert( $page, 'pages' );
            
            $page_id =  $page->get('id');
        }
        else
        {
            
            ModelPages::compare($page);
            
            
            
            if(!MySQL::update( $page, "pages", "id"))
            {
               throw new Exception("There was an error with the MySQL::update query"); 
            }
            $page_id = $page->get('id');
        }
        
        
        $this->reorder( "parent_id" , $page->get('parent_id') , "pages" , 'id' );
        
        
        
        return $page_id;
        
        
    }
    
    
    public function delete()
    {
        
        if( isset( $_POST['jform']['id'] ) )
        {
            
            $id = (int)$_POST['jform']['id'];
            
            if( MySQL::delete( $id, 'pages', 'id') )
            {
                ModelPages::reorder();
                return true;
                
            }
            
            
            
        }
        
        return false;
        
        
    }
    
    
    
}

?>
