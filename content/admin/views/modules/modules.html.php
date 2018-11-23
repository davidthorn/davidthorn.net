<?php


    require_once MODELS_DIR . 'model.menus.php';


    class AdminViewModules extends View
    {
    
        
        public function __construct() {
            parent::__construct();
        }
        
        
        public function display()
        {
            
            if( isset( $_GET['id'] ) )
            {
                
                ToolBar::title("Edit Module");
                ToolBar::Apply("apply", "Save");
                ToolBar::Save("save", "Save &amp; Close");
                ToolBar::Delete("remove", "Delete");
                ToolBar::Close("cancel", "Cancel");
                
                $this->setLayout('edit');
                
                $Menu = $this->get('Module');
                $this->assignRef("Module", $Menu);
            }
            else if( isset( $_POST['task'] ) && $_POST['task'] == 'add' )
            {
                $this->setLayout('edit');
                if( !class_exists( 'ModulesObject' ) )
                {
                    require_once MODELS_DIR . 'model.modules.php';
                }
                $Menu = new ModulesObject( new stdClass() );
                $this->assignRef("Module", $Menu);
            }
            else
            {
                ToolBar::title("List Modules - Module Administration");
                ToolBar::AddNew("add", "New");
                ToolBar::Close("cancel", "Cancel");
                
                $Menus = $this->get('Modules');
                $this->assignRef("Modules", $Menus );
            }
            
            
           
            
            
            parent::display();
        }
        
        
        
        
    }

?>
