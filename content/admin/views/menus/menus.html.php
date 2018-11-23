<?php


    require_once MODELS_DIR . 'model.menus.php';


    class AdminViewMenus extends View
    {
    
        
        public function __construct() {
            parent::__construct();
        }
        
        
        public function display()
        {
            
            if( isset( $_GET['id'] ) )
            {
                
                ToolBar::Apply('apply', "Save");
                ToolBar::Save('save', "Save &amp; Close");
                ToolBar::Close('cancel', "Close");
                
                $this->setLayout('edit');
                
                $Menu = $this->get('Menu');
                $this->assignRef("Menu", $Menu);
            }
            else if( isset( $_POST['task'] ) && $_POST['task'] == 'add' )
            {
                $this->setLayout('edit');
                $Menu = new MenusObject( new stdClass() );
                $this->assignRef("Menu", $Menu);
            }
            else
            {
                ToolBar::AddNew("add", "Add New");
                $Menus = $this->get('Menus');
                $this->assignRef("Menus", $Menus );
            }
            
            
           
            
            
            parent::display();
        }
        
        
        
        
    }

?>
