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

class ModulesObject  extends TableBaseObject {
    
    //primary key
    //type = int
    public $id = null;
    
    //@varchar 255
    public $name = "";
    
    //varchar 255
    public $position = "";
    
    //@int 1
    public $status = 0;
    
    //@varchar 255
    public $title = "";
    
    //@int 11
    public $ordering = 0;
    
    //@varchar 255
    public $container_class = "";
    
    //@int 11
    public $mod_type = 0;
    
    //@text
    public $params = "";
    
    
    public function __construct( $object ) {
            parent::__construct($object);
    }
}

?>
