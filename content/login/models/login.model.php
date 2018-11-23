<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tutorials
 *
 * @author david
 */
class LoginModelLogin extends Model {
    
    
    public function __construct() {
        Logger::debug('Model [ LoginModelLogin ] constructor called ');
        parent::__construct();
    }
    
    public function login( $username , $password )
    {
        
        if( !class_exists( 'ModelUsers' ) )
        {
            require_once MODELS_DIR . 'model.users.php';
        }
        
        if( ModelUsers::login($username, $password) )
        {
            
        }
        
    }
    
    public function logout()
    {
        
        setcookie("admin", "", time() - 3600 * 7, "/", ".davidthorn.net", 0);
    }
}

?>
