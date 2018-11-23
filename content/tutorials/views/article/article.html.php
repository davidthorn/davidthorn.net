<?php


    class TutorialsViewArticle extends View
    {
    
        
        public function __construct() {
            parent::__construct();
        }
        
        
        public function display()
        {
            
            $tutorial = $this->get('Tutorial');
            
            $this->assignRef( 'Tutorial' , $tutorial );
            
            parent::display();
        }
        
        
    }

?>
