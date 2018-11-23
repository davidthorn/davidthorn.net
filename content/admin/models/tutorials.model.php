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
class AdminModelTutorials extends Model {
    
    
    public function __construct() {
        Logger::debug('Model [ PagesModelPages ] constructor called ');
        
        if( !class_exists('ModelTutorials') )
        {
            require_once MODELS_DIR . 'model.tutorials.php';
        }
        
        parent::__construct();
    }
    
    
    
    public function getTutorials()
    {
        return ModelTutorials::getTutorials(1);
    }
    
    public function getTutorial()
    {
        return ModelTutorials::getTutorial( $_GET['id'] );
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
        
        
        
        $tutorial = new TutorialObject( $jform );
        
        $tutorial->params = $tutorial->params->encode();
        
        
        $tutorial_id = false;
        
        if( empty( $jform['id'] ) )
        {
           
            $next_placement = ModelTutorials::getPlacement( $tutorial->get('category_id')  );
            
            $tutorial->ordering = $next_placement;
            
            MySQL::insert( $tutorial, 'tutorials' , 'id' );
            
            $tutorial_id =  $tutorial->get('id');
        }
        else
        {
            
            ModelTutorials::compare($tutorial);
            
            
            
            if(!MySQL::update( $tutorial, "tutorials", "id"))
            {
               throw new Exception("There was an error with the MySQL::update query"); 
            }
            $tutorial_id = $tutorial->get('id');
        }
        
        
        $this->reorder("category_id", $tutorial->get('category_id'), 'tutorials', 'id');
        //ModelTutorials::reorder( $tutorial->get('category_id') );
        
        #echo $tutorial_id;
        
        return $tutorial_id;
        
        
    }
    
    
    public function delete()
    {
        
        if( isset( $_POST['jform']['id'] ) )
        {
            
            $id = (int)$_POST['jform']['id'];
            
            if( MySQL::delete( $id, 'tutorials', 'id') )
            {
                ModelTutorials::reorder();
                return true;
                
            }
            
            
            
        }
        
        return false;
        
        
    }
    
    public function update_status()
    {
        
        $tutorial = ModelTutorials::getTutorial($_POST['source_element']);
        $tutorial->status = ( (int)$tutorial->get('status') ) ? 0 : 1;
        
        if( MySQL::update($tutorial, 'tutorials', 'id') )
        {
            return true;
        }
        
        return false;
        
    }
    
    
    
}

?>
