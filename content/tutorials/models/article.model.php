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
class TutorialsModelArticle extends Model {
    
    
    public function __construct() {
        Logger::debug('Model [ TutorialsModelArticle ] constructor called ');
        parent::__construct();
    }
    
    
    public function getTutorial()
    {
        
        $active = ModelPages::getActive();
        
        $params = $active->get('params');
        
        $tutorial_id = null;
        
        
        if( $params->get('tutorial_id') )
        {
            $tutorial_id = $params->get('tutorial_id');
        }
        
        if( $tutorial_id != null )
        {
            if( !class_exists( 'ModelTutorials' ) )
            {
                require_once MODELS_DIR . 'model.tutorials.php';
            }
            $tutorial = ModelTutorials::getTutorial($tutorial_id);
            
            return $tutorial;
        }
        
    }
    
    
    
}

?>
