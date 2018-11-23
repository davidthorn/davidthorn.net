<?php



class ModuleMenu 
{
    
    private $ModData = null;
    
    private $MenuItems = array();
    
    private $params = null;
    
    public function __construct(  ModulesObject $moddata  )
    {
        
        $this->ModData = $moddata;
        
        
        
    }
    
    
    public function render()
    {
     
        $params         =   $this->ModData->get('params');
        
        $parent_id      =   $params->get('parent_id');
        
        $parent         =   null;
        
        
        
        if( (int)$params->get('parent_id') === 1 )
        {
            $parent = ModelPages::getMenu_root();
        }
        else
        {
            
            $parent = ModelPages::getPage( $parent_id );
            
        }
        
        $start_level    =   $params->get('start_level');
        $end_level      =   $params->get('end_level'); 
        
        
        
        //$this->MenuItems = ModelPages::getAllPagesByMenuID ( $parent_id , $start_level , $end_level );
        ModelPages::getSubMenus( $parent , $end_level );
        
        $this->MenuItems =& $parent->children;
        
        
        if( $this->MenuItems != null )
        {
            ob_start();
            require 'default.php';
            return ob_get_clean();
        }
        else
        {
           
        }
        
        
        return false;
        
    }
    
    
    
    
    
}





?>
