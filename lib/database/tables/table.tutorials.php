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

class TutorialObject  extends TableBaseObject {
    
    //primary key
    //type = int
    public $id = null;
    
    //@int 11
    public $page_id = 0;
    
    //@varchar 255
    public $title = "";
    
    //@text
    public $description = "";
    
    //@varchar 255
    public $video_url = "";
    
    //@int 11
    public $category_id = 0;
    
    //@int 11
    public $ordering = 0;
    
    //@text
    public $params = "";
    
    //@int 1
    public $status = 0;
    
    //@varchar 255
    public $alias = "";

    
    //@datetime 
    public $uploaded_date = "0000-00-00 00:00:00";
    
    //@datetime 
    public $last_modified =  "0000-00-00 00:00:00";
    
    
    //NONE TABLE DATA
    
    public $PageData = null;
    
    
    public $link = null;
    
    public function __construct( $object ) {
        
            
            parent::__construct($object);
            
            
            
    }
    
    public function getPageData( $page_id )
    {
        
        $page =  ModelPages::getPage($this->page_id);
        $this->PageData =& $page;
        $this->link = $this->PageData->get('link');
        return $this->PageData;
    }
    
    
    
    
    
}

?>
