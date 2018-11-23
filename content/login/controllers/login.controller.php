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
class LoginControllerLogin extends Controller {
    
    public function __construct() {
       Logger::debug('Controller [ LoginControllerLogin ] constructor fired');
        parent::__construct();
    }
    
    public function test()
    {
        Logger::debug('Controller [ LoginControllerLogin ] test method fired');
        $this->setRedirect('redirect to here');
        
        
    }
    
    public function logout()
    {
        
        $model = $this->getModel();
        $model->logout();
        $this->setRedirect("/login");
        
    }
    
    public function validate()
    {
        
        $jform = null;
            
        if( isset( $_POST['jform'] ) )
        {
            $jform = $_POST['jform'];
        }

        if( $jform != null )
        {
            if( isset( $jform['username'] ) )
            {
                $this->UsernameText = $jform['username'];
            }

            if( isset( $jform['password'] ) )
            {
                $this->PasswordText = $jform['password'];
            }
        }
        
        
        $model = $this->getModel();
        $success = $model->login( $this->UsernameText , $this->PasswordText );
        
    }
    
}

?>
