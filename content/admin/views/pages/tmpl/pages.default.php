<div class="adminform_wrapper">
    <form name="pagesForm" action="/admin/pages/" method="post">
        <table class="adminTable">
            <thead>
                <tr>
                    <td align="left" class="indent_left_10" width="70%">Name</td>
                    <td width="7%">Ordering</td>
                    <td width="10%">Parent ID</td>
                    <td width="8%">Page Type</td>
                    <td width="5%">Status</td>
                </tr>
            </thead>
            <tbody>
                <?php if( is_array( $this->Pages ) ): ?>
                    <?php foreach( $this->Pages as $key => $value ): ?>
                        <tr>

                            <?php 
                            $dashes = "";
                            $x = 0;
                            if( (int)$value->get('level') > 1 )
                            {
                                $dashes .= "<span class='dot-sep'>";
                                while( $x < (int)$value->get('level') - 1 )
                                {
                                    $dashes .= "&nbsp;&nbsp;--| ";
                                    $x++;
                                }    
                                $dashes .= "</span>";
                            }
                            ?>
                            <td><?php echo $dashes; ?>
                                <a href="/admin/pages/?id=<?php echo $value->get('id'); ?>">
                                    <?php echo $value->get('name'); ?>
                                </a>
                            </td>
                             <td align="center">
                                 <div class="ordering_box">
                                     <span class="<?php echo ( (int)$value->get('lft') != 0 ) ? 'up_arrow' : 'no_arrow'; ?>" id="<?php echo $value->get('id'); ?>:<?php echo $value->get('lft'); ?>:decrement"></span>
                                     <span class="<?php echo ( (int)$value->get('rgt') != 0 ) ? 'down_arrow' : 'no_arrow'; ?>" id="<?php echo $value->get('id'); ?>:<?php echo $value->get('rgt'); ?>:increment"></span>
                                 </div>
                             </td>
                            <td align="center"><?php echo $value->get('parent_id'); ?></td>
                            <td align="center"><?php echo $value->get('page_type'); ?></td>
                            <td align="center">
                                <div class="status_box">
                                    <?php $status = ( (bool)$value->get('status') ) ? 'status_ok' : 'status_off'; ?>
                                    <span id="<?php echo $value->get('id'); ?>" class="<?php echo $status; ?>"></span>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    
        <input type="hidden" name="source_element" id="source_element" value=""/>
        <input type="hidden" name="target_placement" id="target_placement" value=""/>
        <input type="hidden" name="movement_direction" id="movement_direction" value=""/>
        <input type="hidden" name="task" id="task" value=""/>
    
    </form>
</div>



