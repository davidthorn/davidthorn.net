<?php 

    
    
    if( $this->Tutorials != null )
    {
        foreach( $this->Tutorials as $key => $tutorial )
        {
            
            
            
            $data = $tutorial->getPageData( $tutorial->get('page_id') );
            $data->get('link');
            
            
            echo "<a href='".$tutorial->get('link')."'>" . $tutorial->get('title') . "</a><br>";
            
        }
        
    }

   

?>


