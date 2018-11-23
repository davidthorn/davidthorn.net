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

class MenusObject  extends TableBaseObject {
    
    //primary key
    //type = int
    public $id = null;
    
    //@varchar 255
    public $name = "";
    
    //@varchar 255
    public $title = "";
    
    //@int 1
    public $status = 0;
    
    //varchar 255
    public $link = "";
    
    //@int 11
    public $parent_id = 0;
    
    //@int 1
    public $allow_submenus = 0;
    
    //@int 11
    public $max_level = 0;
    
    
    
   
   
    
    
    
    
    public function __construct( $object ) {
        
            
            parent::__construct($object);
           
            
            
    }
    
   
    
    
    
    
    
}

?>
