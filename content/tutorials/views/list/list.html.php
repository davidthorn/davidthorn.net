<?php


    class TutorialsViewList extends View
    {
    
        
        public function __construct() {
            parent::__construct();
        }
        
        
        public function display()
        {
            
            $tutorials = $this->get('Tutorials');
            
            
            
            $this->assignRef('Tutorials', $tutorials);
            
            parent::display();
        }
        
        
    }

?>
