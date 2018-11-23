<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of contentloader
 *
 * @author david
 */
class ContentLoader {
    
    
    private static $PageObject = null;
    
    private static $ContentName = null;
    
    private static $ContentPath = null;
    
    private static $ContentFileToLoad = null;
    
    
    private static $ControllerName = null;
    private static $ControllerPath = null;
    private static $ControllerObjectToLoad = null;
    private static $ControllerObject = null;
    
    
    private static $ModelName = null;
    private static $ModelPath = null;
    private static $ModelObjectToLoad = null;
    private static $ModelObject = null;
    
    private static $ViewName = null;
    private static $ViewPath = null;
    private static $ViewObjectToLoad = null;
    private static $ViewObject = null;
    

    
    public static function initialise( PageObject $pageObject )
    {
        
        if( $pageObject instanceof PageObject )
        {
            
            self::$PageObject = $pageObject;
            
            
            self::_set_content_vars();
            
            self::_set_controller_vars( self::$PageObject->get('view') );
            
            self::_set_model_vars( self::$PageObject->get('view') );
            
            self::_set_view_vars( self::$PageObject->get('view') );
            
            
            //load Controller -> Model --> View
            
            if( self::$ControllerObjectToLoad != null && self::$ModelObjectToLoad != null && self::$ViewObjectToLoad != null )
            {
                
                require_once self::$ContentFileToLoad;
                
                self::_load_controller_object();
            
                self::_load_model_object();

                self::_load_view_object();

            }
            
            if( is_object( self::$ControllerObject ) && is_object( self::$ModelObject ) && is_object( self::$ViewObject ) )
            {
                Logger::debug("Checking if all MVC Objects are set");
                if(method_exists(  self::$ControllerObject , 'execute' ) )
                {
                    Logger::debug("Executing Controller->execute");
                    self::$ControllerObject->execute();
                }
                
            }
            
            
            
            
        }
        
    }
    
    
    public static function render( )
    {
        
        if( is_object( self::$ViewObject ) )
        {
           ob_start();
           Logger::debug('ContentLoader [ render ] ViewObect->display being called');
           self::$ViewObject->display();
           $content = ob_get_clean();
           
           if( !class_exists( "Template" ) )
           {
               require_once LIB_ROOT . 'site' . DS  . "template.php";
           }
           
           $page_title = Site::getPageTitle();
           
           $content = $page_title . $content;
           
           $template =& Template::getTemplate();
           
           $template =& str_replace("###__CONTENT__###", $content, $template);
           
           return $template;
        }
                    
        
                
        
    }
    
    
    public static function check_ajax()
    {
        
        if( strtolower( self::getContentName() ) == "ajax" )
        {
            echo self::$ViewObject->display();
            return true;
        }
        
        return false;
        
    }
    
    
    /*
     * 
     *      SETTING AND LOADING THE CONTENT FILE
     *      ============================================
     */
    
    private static function _set_content_vars( )
    {
        if( self::$ContentName == null )
        {
            if( self::$PageObject->get('page_type') != null )
            {
                if( is_dir( CONTENT_DIR . self::$PageObject->get('page_type') . DS ) )
                {
                    self::$ContentName = self::$PageObject->get('page_type');
                    self::$ContentPath = CONTENT_DIR . self::$PageObject->get('page_type') . DS;
                    
                    if( file_exists( self::$ContentPath . strtolower( self::$ContentName ) . '.php' ) )
                    {
                        
                        self::$ContentFileToLoad = self::$ContentPath . strtolower( self::$ContentName ) . '.php';
                        
                    }
                }
            }
        }
    }
    
    
    
    /*
     * 
     *      SETTING AND LOADING THE CONTROLLER FILE AND OBJECT
     *      ============================================
     */
    
    private static function _set_controller_vars( $controller_name )
    {
        if( self::$ContentPath != null )
        {
            
            if( is_dir( self::$ContentPath . 'controllers' . DS ) )
            {
                self::$ControllerPath = self::$ContentPath . 'controllers' . DS;
                self::$ControllerName =  strtolower( $controller_name );
                
                if( file_exists( self::$ControllerPath . self::$ControllerName . '.controller.php' ) )
                {
                    self::$ControllerObjectToLoad = self::$ControllerPath . self::$ControllerName . '.controller.php';
                    Logger::debug("Controller controller file found " .self::$ControllerPath . self::$ControllerName . '.controller.php' );
                }
            }
        }
    }
    
    private static function _load_controller_object()
    {
        if( self::$ControllerObjectToLoad != null && file_exists( self::$ControllerObjectToLoad ) )
        {
            require_once self::$ControllerObjectToLoad;
            
            $classname = ucfirst( self::$ContentName ) . 'Controller' . ucfirst( self::$ControllerName );
            
            if( class_exists( $classname ) )
            {
               Logger::debug("Instantiating Controller Object [ $classname ]");
                self::$ControllerObject = new $classname();
                
            }
        }
    }
    
    
     /*
     * 
     *      SETTING AND LOADING THE MODEL FILE AND OBJECT
     *      ============================================
     */
    
    private static function _set_model_vars( $model_name )
    {
        if( self::$ContentPath != null )
        {
            
            if( is_dir( self::$ContentPath . 'models' . DS ) )
            {
                self::$ModelPath = self::$ContentPath . 'models' . DS;
                self::$ModelName =  strtolower( $model_name );
                
                if( file_exists( self::$ModelPath . self::$ModelName . '.model.php' ) )
                {
                    self::$ModelObjectToLoad = self::$ModelPath . self::$ModelName . '.model.php';
                    
                }
            }
        }
    }
    
    private static function _load_model_object()
    {
        if( self::$ModelObjectToLoad != null && file_exists( self::$ModelObjectToLoad ) )
        {
            require_once self::$ModelObjectToLoad;
            
            $classname = ucfirst( self::$ContentName ) . 'Model' . ucfirst( self::$ModelName );
            
            if( class_exists( $classname ) )
            {
                Logger::debug("Instantiating Model [ $classname ]");
                self::$ModelObject = new $classname();
            }
        }
    }
    
    
    /*
     * 
     *      SETTING AND LOADING THE VIEW FILE AND OBJECT
     *      ============================================
     */
    
    private static function _set_view_vars( $view_name )
    {
        if( self::$ContentPath != null )
        {
            
            if( is_dir( self::$ContentPath . 'views' . DS . strtolower( $view_name )  . DS ) )
            {
                self::$ViewPath = self::$ContentPath . 'views' . DS . strtolower( $view_name )  . DS;
                self::$ViewName =  strtolower( $view_name );
                
                if( file_exists( self::$ViewPath . self::$ViewName . '.html.php' ) )
                {
                    self::$ViewObjectToLoad = self::$ViewPath . self::$ViewName . '.html.php';
                }
            }
        }
    }
    
    private static function _load_view_object()
    {
        if( self::$ViewObjectToLoad != null && file_exists( self::$ViewObjectToLoad ) )
        {
            require_once self::$ViewObjectToLoad;
            
            $classname = ucfirst( self::$ContentName ) . 'View' . ucfirst( self::$ViewName );
            
            if( class_exists( $classname ) )
            {
                Logger::debug("Instantiating View [ $classname ]");
                self::$ViewObject = new $classname();
            }
        }
    }
    
    
    
    private static function _load_params_file( PageObject $page )
    {
        
       $con_path = CONTENT_DIR;
       
       if( is_dir( $con_path . $page->get('page_type') . DS ) )
       {
           $con_path = $con_path . $page->get('page_type') . DS . 'views' . DS. $page->get('view') . DS;
           
           if( is_dir( $con_path ) )
           {
               $con_path = $con_path . 'params' . DS . $page->get('tmpl') . '.params.php'; 
              
               if( file_exists( $con_path ) )
               {
                   require_once $con_path;
               }
           }
       }
        
        
    }
    
    public static function getParamsFile( PageObject $page )
    {
        self::_load_params_file( $page );
    }
    
    
    public static function getModelPath()
    {
        return self::$ModelPath;
    }
    
    public static function getModelName()
    {
        return ucfirst( self::$ModelName );
    }
    
    
    public static function getModel()
    {
        Logger::debug('ContentLoader returning Model');
        return self::$ModelObject;
    }
    
    public static function getContentPath()
    {
        return self::$ContentPath;
    }
    
    public static function getContentName()
    {
        return ucfirst( self::$ContentName );
    }
    
    public static function getViewPath()
    {
        return self::$ViewPath;
    }
    
    public static function getViewName()
    {
        return self::$ViewName;
    }
    
    
    public static function setGetVariables()
    {
        
        if( isset( $_GET['query'] ) && !empty( $_GET['query'] ) )
        {
            
            $bits = explode( "&" , $_GET['query'] );
            
            if( count( $bits ) > 0 )
            {
                
                foreach( $bits as $bit )
                {
                    
                    $kv = explode( "=" , $bit );
                    
                    if( count( $kv ) >= 1 )
                    {
                        
                        $_GET[ $kv[0] ] = $kv[1];
                        
                    }
                    
                }
                
            }
            
        }
        
    }
    
}

?>
