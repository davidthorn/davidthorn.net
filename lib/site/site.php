<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of site
 *
 * @author david
 */
class Site {

    
    private static $ActivePage = null;
    
    private static $ScriptFiles = array();
    private static $StyleSheetFiles = array();
    
    private static $TemplateName = null;
    
    public static function addScript( $filename )
    {
        
        self::$ScriptFiles[] = $filename;
        
    }
    
    public static function addStyleSheet( $filename )
    {
        
        self::$StyleSheetFiles[] = $filename;
        
    }
    
    
    
    
    public static function getHead()
    {
        
        $head = "";
        
        if( count( self::$ScriptFiles ) > 0  )
        {
            
            foreach( self::$ScriptFiles as $value )
            {
                $head .= '<script type="text/javascript" src="' . $value . '"></script>' . "\r\n";
            }
            
        }
        
        if( count( self::$StyleSheetFiles ) > 0  )
        {
            
            foreach( self::$StyleSheetFiles as $value )
            {
                $head .= '<link rel="stylesheet" href="' . $value . '"/>'  . "\r\n";
            }
            
        }
        
        
        return $head;
        
    }
    
    
    public static function getTitle()
    {
        
        $page = self::getActivePage();
        return $page->get('browser_title');
        
    }
    
    
    public static function getActivePage()
    {
        
        
        if( self::$ActivePage != null )
        {
            return self::$ActivePage;
        }
        
        $page = ModelPages::getActive();
        
        if( is_object($page ) )
        {
            
            self::$ActivePage =& $page; 
            
        }
        
        return self::$ActivePage;
        
    }
    
    public static function getPageTypes()
    {
        
        $views_path = scandir( CONTENT_DIR );
        
        $types = array();
        foreach( $views_path as $key => $path )
        {
           if( $path != "." && $path != ".." )
           {
               $types[] = $path;
           }
        }
        
        return $types;
    }
    
    public static function getMenus()
    {
        
        if( !class_exists( "ModelMenus" ) )
        {
            require_once MODELS_DIR . 'model.menus.php';
        }
        
        $menus = ModelMenus::getMenus();
        return $menus;
    }
    
    public static function getViews( $page_type )
    {
        
        $content_path = CONTENT_DIR;
        
        if( is_dir( $content_path . strtolower( $page_type ) . DS . 'views' . DS ) )
        {
            
            $views = scandir( $content_path . strtolower( $page_type ) . DS . 'views' . DS );
            
            if( is_array( $views ) )
            {
                $new_views = array();
                foreach( $views as $key => $value )
                {
                    if( $value != "."  && $value != ".." )
                    {
                        $new_views[] = $value;
                    }
                }
                
                return (object)$new_views;
                
            }
            
        }
        
    }
    
    public static function getTmpls( $page_type , $view_name )
    {
        
        $content_path = CONTENT_DIR;
        $path = $content_path . strtolower( $page_type ) . DS . 'views' . DS . $view_name . DS . 'tmpl' . DS;
        
        if( is_dir( $path ) )
        {
            
            $tmpls = scandir( $path );
            
            if( is_array( $tmpls ) )
            {
                
                foreach( $tmpls as $key => $value )
                {
                    if( $value == "."  || $value == ".." )
                    {
                        unset( $tmpls[ $key ] );
                    }
                    else
                    {
                        $tmpls[ $key ] = ucfirst( str_replace(".default.php", "", $value ) );
                    }
                }
                
                return $tmpls;
                
            }
            
        }
        
    }
    
    
    public static function getPageTitle()
    {
        
        $active = Site::getActivePage();
        $page_title_content = "";
        $title_text = null;
        $buttons = null;
        
        if( !class_exists( 'ToolBar' ) )
        {
            require_once LIB_ROOT . 'site' . DS . 'toolbar.php';
        }
        
        if( ToolBar::IsActive() )
        {
            $buttons        .=   ToolBar::render();
            $title_text     =   ToolBar::getTitle();
        }
        
        if( $title_text == null )
        {
            $title_text = $active->get('page_heading');
        }
        
        $page_title_content .= "<div class='main_title_wrapper'>";
        $page_title_content .= "<h3 class='mainbody_title'>";
        $page_title_content .=  $title_text;
        
        $page_title_content .= $buttons;
        
        $page_title_content .= "</h3>";
        $page_title_content .= "</div>";
        return $page_title_content;
        
        
        
        
    }
    
}

?>
