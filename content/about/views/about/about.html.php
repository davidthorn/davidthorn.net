<?php


    class AboutViewAbout extends View
    {
    
        
        public function __construct() {
            parent::__construct();
        }
        
        
        public function display()
        {
            
            $this->get('List');
            
            parent::display();
        }
        
        
    }

?>
