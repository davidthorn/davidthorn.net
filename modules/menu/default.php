<?php

if( !function_exists( 'loop_children' ) )
{
    function loop_children( PageObject $page )
    {
        $active = Site::getActivePage();
        $output = "";
        if( $page->get('page_type') == "login" && isset( $_COOKIE['admin'] ) )
        {
            $page->name = 'Logout';
        }

        $active_class =  ( $active->get('id') == $page->get('id') ) ? 'active' : false;
        $parent_class =  ( $active->get('parent_id') == $page->get('id') ) ? 'parent' : false;
        
        $output .= "<li class='$parent_class'>";
        $output .= "<a class='$active_class' href=\"" . $page->get('link') . "\">" . $page->get('name') . "</a>";
            if( $page->get('children') != null )
            {
                $output .= "<ul class=\"submenu\">";
                            foreach( $page->get('children') as $k => $v )
                            {
                                $output .= loop_children( $v );
                            }
                
                $output .= "</ul>";
            }
        $output .= "</li>";

        return $output;

    }    
}

?>


<div class="<?php echo $this->ModData->container_class; ?>">

    <?php $params = $this->ModData->get('params'); ?>
    
    <?php if( $params->get('show_title') ): ?>
    
        <h3>
            <?php echo $this->ModData->get('title'); ?>
        </h3>
    
    <?php endif; ?>
    
    
    <ul class="<?php echo $params->get('menu_suffix'); ?>">

        <?php if( is_array( $this->MenuItems ) ): ?>
        
            <?php foreach( $this->MenuItems as $key => $cat ): ?>
                    <?php echo loop_children( $cat ); ?>
            <?php endforeach; ?>
    </ul>

<?php endif; ?>
</div>
