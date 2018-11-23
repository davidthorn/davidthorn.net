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

class TutorialCategoriesObject extends TableBaseObject {
    
    //primary key
    //type = int
    public $id = null;
    
    //@varchar 255
    public $name = null;
    
    //@text
    public $description = null;
    
    //@int 11
    public $ordering = null;
    
    //@text
    public $params = null;
    
    //@int 1
    public $status = null;
    
    //@int(11)
    public $parent_id = 0;
    
    
    public function __construct( $object ) {
        
        parent::__construct( $object );
            
    }
    
    
    
}

?>
