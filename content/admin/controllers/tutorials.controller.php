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
class AdminControllerTutorials extends Controller {
    
    public function __construct() {
       Logger::debug('Controller [ PagesControllerPages ] constructor fired');
        parent::__construct();
    }
    
    
    
    public function apply()
    {
        $id = $this->store();
        $this->setRedirect("/admin/tutorials/?id=" . $id  . "&params=" . $jform . "&status=sucess" );
    }
    
    public function save()
    {
        
        $this->store();
        $this->setRedirect("/admin/tutorials/" );
    }
    
    public function cancel()
    {
        $this->setRedirect("/admin/tutorials/" );
    }
    
    public function store()
    {
        $model = $this->getModel();
        $id = $model->save();
        return $id;
    }
    
    public function remove()
    {
        
        $model = $this->getModel();
        $success = $model->delete();
        $this->setRedirect("/admin/tutorials/?remove=" . $success);
        
    }
    
    
    public function decrement()
    {
        $test = 1;
        if( !class_exists('MenuHelper') )
        {
            $test = 2;
            require_once LIB_ROOT . 'site' . DS  . 'menuhelper.php';
            if( MenuHelper::decrement($_POST['source_element'], $_POST['movement_direction'], $_POST['target_placement']) )
            {
                $test = 3;
            }
            
        }
        $this->setRedirect("/admin/tutorials/?decrement=$test" );
        
    }
    
    public function increment()
    {
        $test = 1;
        if( !class_exists('MenuHelper') )
        {
            $test = 2;
            require_once LIB_ROOT . 'site' . DS  . 'menuhelper.php';
            if( MenuHelper::increment($_POST['source_element'], $_POST['movement_direction'], $_POST['target_placement']) )
            {
                $test = 3;
            }
            
        }
        $this->setRedirect("/admin/tutorials/?increment=$test" );
        
    }
    
    public function update_status()
    {
        
        $model = $this->getModel();
        $success = $model->update_status();
        
        $this->setRedirect( "/admin/tutorials/?success=" . $success );
        
    }
    
}

?>
