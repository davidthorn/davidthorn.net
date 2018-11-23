<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller
 *
 * @author david
 */
class Controller {
    
    
    private $_content_name = null;
    private $_view_name = null;
    private $_tmpl_name = null;
    private $_model_name = null;
    
    private $_is_redirect = false;
    private $_redirect_url = null;
    
    public function __construct() {
        Logger::debug('Parent Controller Constructor fired');
    }
    
    
    
    public function call_task()
    {
        Logger::debug('Controller call_task has been fired');
        if( isset( $_POST['task'] ) )
        {
            
            if( method_exists( $this , $_POST['task'] ) )
            {
                $method = $_POST['task'];
                Logger::debug('Controller call_task found task method, calling...');
                $this->$method();
            }
        }
        
    }
    
    public function execute()
    {
        Logger::debug('Controller calling execute');
        //call any tasks which may need to be done
        //if POST task var isset then this will be fired if a method exists
        $this->call_task();

        //redirect if needed
        $this->redirect();
        
        
        
        
    }
    
    private function redirect()
    {
        Logger::debug('Controller check if redirect is required');
        if( $this->_is_redirect )
        {
            header('location: ' . $this->_redirect_url);
            Logger::debug('Controller redireting now');
        }
        
    }
    
    public function setRedirect( $link )
    {
        Logger::debug('Controller [ setRedirect ] redirect has been set to ' . $link);
        $this->_redirect_url = $link;
        $this->_is_redirect = true;
    }
    
    
    public function getModel()
    {
        
        $model = ContentLoader::getModel();
        return $model;
        
    }
    
    public function getTmplName()
    {
        
    }
    
}

?>
