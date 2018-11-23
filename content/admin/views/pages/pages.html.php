<?php


    Site::addScript("/content/admin/views/pages/js/admin_pages_ordering.js");
    Site::addScript("/content/admin/views/pages/js/admin_pages_status.js");
    
    class AdminViewPages extends View
    {
    
        
        public function __construct() {
            parent::__construct();
        }
        
        
        public function display()
        {
            
            
            if( isset( $_GET['id'] ) )
            {
                
                ToolBar::title("Page Listing - Administration");
                ToolBar::Apply("apply", "Save");
                ToolBar::Save("save", "Save &amp; Close");
                ToolBar::Delete("remove", "Delete");
                ToolBar::Close("cancel", "Close");
                
                $this->setLayout('edit');
                
                $pages = $this->get('Page');
            
                $this->assignRef("Page", $pages);
                
            }
            else if( isset( $_POST['task'] ) && $_POST['task'] == "add" )
            {
                
                ToolBar::title("Page Listing - Administration");
                ToolBar::Apply("apply", "Save");
                ToolBar::Save("save", "Save &amp; Close");
                ToolBar::Close("cancel", "Close");
                
                $this->setLayout('edit');
                
                $pages = new PageObject( new stdClass() );
            
                $this->assignRef("Page", $pages);
            }
            else
            {
                
                ToolBar::title("Page Listing - Administration");
                ToolBar::AddNew("add", "Add New");
                $pages = $this->get('Pages');
            
                $this->assignRef("Pages", $pages);
            }
            
            
            
            parent::display();
        }
        
        
        
        
    }

?>
