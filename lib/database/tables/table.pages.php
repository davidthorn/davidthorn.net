<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menucats
 *
 * @author David
 */

require_once TABLES_DIR . 'table.base.php';

class PageObject extends TableBaseObject{
    
    //primary key
    //type = int
    public $id = null;
    
    //@varchar 255
    public $name = null;
    
    //@varchar 255
    public $page_type = null;
    
    //@varchar 255
    public $view = null;
    
    //@varchar 255
    public $tmpl = null;
    
    //@text
    public $params = null;
    
    //@varchar 255
    public $link = null;
    
    //@int 11
    public $article_id = 0;
    
    //@varchar 255
    public $page_heading = null;
    
    //@varchar 255
    public $browser_title = null;
    
    //@varchar 255
    public $container_class = null;
    
    //@int 11
    public $parent_id = 0;
    
    //@int 11
    public $level = 0;
    
    //@int 11
    public $menu_id = null;
    
    //@int 1
    public $status = 0;
    
    //@int 1
    public $home = 0;
   
    //@int 11
    public $ordering = 0;
    
    
    public function __construct( $object ) {
        
        
        parent::__construct( $object );
           
    }
    
    
    
    
    
}

?>
