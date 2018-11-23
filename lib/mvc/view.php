<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of view
 *
 * @author david
 */

require_once LIB_ROOT . 'site' . DS  . 'toolbar.php';

class View {
    
    
    private $LayoutFileToLoad = null;
    
    private $ModelFileToLoad = null;
    
    public function __construct() {
    
        
        Logger::debug("Setting Default Layout in View Constructor");
        $this->setLayout();
        
    }
    
    
    protected function setLayout( $tmpl = false )
    {
       
        
        $contentPath = ContentLoader::getContentPath();
        
        $view_name = ContentLoader::getViewName();
        
        if( !$tmpl )
        {
            Logger::debug('SetLayout - modifying from default layout to $tmpl');
            $tmpl = strtolower( $view_name );
        }
        
        
        
        if( is_dir( $contentPath . 'views' . DS . strtolower( $view_name ) . DS . 'tmpl' . DS ) )
        {
            $tmpl_path = $contentPath . 'views' . DS . strtolower( $view_name ) . DS . 'tmpl' . DS;
            
            if( file_exists( $tmpl_path . $tmpl . '.' . "default" . '.php' ) )
            {
                $this->LayoutFileToLoad = $tmpl_path . $tmpl . '.' . 'default' . '.php';
            }
        }
        
    }
    
    protected function getModel( $name = false )
    {
        Logger::debug('Collecting Model');
        return ContentLoader::getModel();
        
    }
    
    public function display()
    {
        
        if( $this->LayoutFileToLoad != null )
        {
            require_once $this->LayoutFileToLoad;
        }
        
    }
    
    public function assignRef( $var , &$value )
    {
        $this->$var = $value;
    }
    
    public function get( $name , $params = false )
    {
        
        $model = $this->getModel();
        
        if( method_exists( $model , 'get' . ucfirst( $name ) ) )
        {
            Logger::debug('View Parent [ get ] called $name = ' . $name );
            $method = 'get' . ucfirst( $name );
            
            return $model->$method();
        }
        
    }
    
    public function getInput( $var )
    {
        
        if( property_exists( $this , $var ) )
        {
            return $this->$var;
        }
        
        return false;
        
    }
    
    
    
    
}

?>
