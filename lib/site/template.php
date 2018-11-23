<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of template
 *
 * @author david
 */
class Template {
    
    
    
    private static $TemplateName = null;
    
    private static $TemplateContent = null;
    
    public static function getTemplate( $name = 'main' )
    {
       
        if( self::$TemplateContent != null )
        {
            return self::$TemplateContent;
        }
        
        if( $name == 'main' && self::$TemplateName != null )
        {
            $name = self::$TemplateName;
        }
        
        
        if( is_dir( TEMPLATES_DIR . strtolower( $name ) . DS ) )
        {
            self::$TemplateName = $name;
            ob_start();
            
            require_once TEMPLATES_DIR . strtolower( $name ) . DS . 'index.php';
            $content = ob_get_clean();
            self::$TemplateContent =& $content;
            
        }
        
        return self::$TemplateContent;
        
    }
    
    private static function getTemplateName()
    {
        return self::$TemplateName;
    }
    
    private static function getContent()
    {
        return self::getTemplate();
    }
    
}

?>
