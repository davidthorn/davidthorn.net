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
class AdminControllerMenus extends Controller {
    
    public function __construct() {
       Logger::debug('Controller [ PagesControllerPages ] constructor fired');
        parent::__construct();
    }
    
    public function test()
    {
        Logger::debug('Controller [ PagesControllerPages ] test method fired');
        $this->setRedirect('redirect to here');
        
        
    }
    
    public function save()
    {
        
        $model = $this->getModel();
        $id = $model->save();
        $this->setRedirect("/admin/menus/?id=" . $id  . "&status=sucess" );
    }
    
}

?>
