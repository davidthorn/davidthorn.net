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
class AdminControllerModules extends Controller {
    
    public function __construct() {
       Logger::debug('Controller [ PagesControllerPages ] constructor fired');
        parent::__construct();
    }
    
    public function test()
    {
        Logger::debug('Controller [ PagesControllerPages ] test method fired');
        $this->setRedirect('redirect to here');
    }
    
    
    public function remove()
    {
        
        $model = $this->getModel();
        if( $model->delete() )
        {
            $this->setRedirect("/admin/modules/?delete=1");
        }
        else
        {
            $this->setRedirect("/admin/modules/?delete=0");
        }
        
    }
    
    public function apply()
    {
        return $this->store();
    }
    
    public function save()
    {
        
        $id = $this->store();
        $this->setRedirect("/admin/modules/?success=" . $id );
    }
    
    public function store()
    {
        $model = $this->getModel();
        $id = $model->save();
        return $id;
    }
    
    public function cancel()
    {
        $active = Site::getActivePage();
        if( $active->get('tmpl') == "default" )
        {
            $this->setRedirect("/admin/");
        }
        else
        {
            $this->setRedirect("/admin/modules/");
        }
        
    }
    
    
    
}

?>
