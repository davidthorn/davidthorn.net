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
class TutorialsModelList extends Model {
    
    
    public function __construct() {
        Logger::debug('Model [ TutorialsModelList ] constructor called ');
        parent::__construct();
    }
    
    
    public function getList()
    {
        Logger::debug('Model [ TutorialsModelList ] method getList fired');
    }
    
    public function getTutorials()
    {
        
        $active = ModelPages::getActive();
        
        $params = $active->get('params');
        
       
        
        $tut_cat = null;
        
        if( is_object( $params ) && $params->get('tutorial_category') )
        {
          
            $tut_cat = $params->get('tutorial_category');
        }
        
        if( $tut_cat != null )
        {
            if( !class_exists( 'ModelTutorials' ) )
            {
                require_once MODELS_DIR . 'model.tutorials.php';
            }
            
            $tuts = ModelTutorials::getTutorials( $tut_cat );
            
            return $tuts;
        }
        
        
        
    }
    
    public function getCategories()
    {
        
        $cats = ModelTutorialsCategories::getTutorialsCategories();
        return $cats;
        
    }
    
}

?>
