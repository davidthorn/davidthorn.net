<?php


    Site::addScript("/content/admin/views/pages/js/admin_pages_ordering.js");
    Site::addScript("/content/admin/views/pages/js/admin_pages_status.js");
    
    class AdminViewTutorials extends View
    {
    
        
        public function __construct() {
            parent::__construct();
        }
        
        
        public function display()
        {
            
            if( !class_exists( "ModelTutorials" ) )
            {
                require_once MODELS_DIR . 'model.tutorials.php';
            }
            
            if( isset( $_GET['id'] ) )
            {
                
                ToolBar::title("Edit Tutorial - Administration");
                ToolBar::Apply("apply", "Save");
                ToolBar::Save("save", "Save &amp; Close");
                ToolBar::Delete("remove", "Delete");
                ToolBar::Close("cancel", "Close");
                
                $this->setLayout('edit');
                
                $pages = $this->get('Tutorial');
            
                $this->assignRef("Tutorial", $pages);
                
            }
            else if( isset( $_POST['task'] ) && $_POST['task'] == "add" )
            {
                
                ToolBar::title("Add New Tutorial - Administration");
                ToolBar::Apply("apply", "Save");
                ToolBar::Save("save", "Save &amp; Close");
                ToolBar::Close("cancel", "Close");
                
                $this->setLayout('edit');
                
                $pages = new TutorialObject( new stdClass() );
            
                $this->assignRef("Tutorial", $pages);
            }
            else
            {
                
                ToolBar::title("Tutorial Listing - Administration");
                ToolBar::AddNew("add", "Add New");
                $pages = $this->get('Tutorials');
            
                $this->assignRef("Tutorials", $pages);
            }
            
            
            
            parent::display();
        }
        
        
        
        
    }

?>
