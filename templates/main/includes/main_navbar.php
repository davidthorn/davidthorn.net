<ul class="main_navbar">
    
    <?php
    
    $items = MenuCats::getAll('main_navbar');
        
    if( $items != null && is_array( $items ) )
    {
        
        if( count( $items ) > 0  )
        {
            
            foreach( $items as $k => $v )
            {
               ?>
                <li>
                    <a href="<?php echo $v->link; ?>"><?php echo $v->name; ?></a>
                </li>
               <?php
            }
            
        }
        
    }
    
    
    ?>
    
    

</ul>
  