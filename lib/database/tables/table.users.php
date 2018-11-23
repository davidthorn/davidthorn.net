<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of table
 *
 * @author david
 */
class TableUsersObject extends TableBaseObject {
    
    
    //@int (11)
    public $id = null;
    
    //@varchar(255)
    public $name = null;
    
    //@varchar(255)
    public $surname = null;
    
    
    //@varchar(255)
    public $email = null;
    
    //@varchar 255
    public $username = null;
    
    //@varchar(255)
    public $password = null;
    
    //@varchar(255)
    public $salt = null;
    
    //@int 11
    public $privilege = null;
    
    //@varchar(255)
    public $session = null;
    
    
    //@datetime
    public $last_logged_in = null;
    
    //@varchar(255)
    public $ipaddr = null;
    
    public function __construct($object) {
        parent::__construct($object);
    }
    
    
    
    
    
}

?>
