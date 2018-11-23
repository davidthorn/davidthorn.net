<?php


    class LoginViewLogin extends View
    {
    
        private $UsernameText = null;
        
        private $PasswordText = null;
        
        
        public function __construct() {
            parent::__construct();
        }
        
        
        public function display()
        {
            
            
            if( !isset( $_COOKIE['admin'] ) )
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
            }
            else
            {
                echo "layout set";
                $this->setLayout('logout');
            }
            
            
            
            
            
            parent::display();
        }
        
        
        public function getInput( $var )
        {
            
            if( property_exists( $this , $var ) )
            {
                return $this->$var;
            }
            
            return null;
            
        }
        
        
    }

?>
