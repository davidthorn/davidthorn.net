<?php 
$menu = $this->Menu;
?>
<div class="adminform_wrapper">

    <form action="/admin/menus/?id=<?php echo $menu->get('id'); ?>" method="post">

                <input type="hidden" id="task" name="task" value="save" />
                <input type="hidden" name="jform[id]" value="<?php echo $menu->get('id'); ?>" />
        
        
                <div class="section">
                    
                    <h3>Menu Information<span class="drop_arrows"></span></h3>
                   
                    <div class="adminInner">
                        <ul class="adminForm">

                            <li>
                                <label>Name</label>
                                <input type="text" name="jform[name]" value="<?php echo $menu->get('name'); ?>" class="inputbox"/>
                            </li>

                            <li>
                                <label>Name</label>
                                <input type="text" name="jform[title]" value="<?php echo $menu->get('title'); ?>" class="inputbox"/>
                            </li>

                            <li>
                                <label>Status</label>
                                <?php  ?>
                                <select class="selectbox" name="jform[status]">
                                    <?php $selected = ( $menu->get('status')  ) ?>
                                    <option value="0" <?php echo ( (bool)!$menu->get('status') ) ? "selected" : false; ?> >Disabled</option>
                                    <option value="1" <?php echo ( (bool)$menu->get('status') ) ? "selected" : false; ?> >Enabled</option>
                                </select>
                            </li>

                           <li>
                                <label>Link</label>
                                <input type="text" name="jform[link]" value="<?php echo $menu->get('link'); ?>" class="inputbox"/>
                           </li>

                           <li>
                                <label>Allow Sub Menus</label>
                                <?php  ?>
                                <select class="selectbox" name="jform[allow_submenus]">
                                    <?php $selected = ( $menu->get('allow_submenus')  ) ?>
                                    <option value="0" <?php echo ( (bool)!$menu->get('allow_submenus') ) ? "selected" : false; ?> >Disabled</option>
                                    <option value="1" <?php echo ( (bool)$menu->get('allow_submenus') ) ? "selected" : false; ?> >Enabled</option>
                                </select>
                           </li>

                           <li>
                                <label>Max Sub Levels</label>
                                <input type="text" name="jform[max_level]" value="<?php echo $menu->get('max_level'); ?>" class="inputbox"/>
                           </li>
                      </ul> 
                    </div>  
                </div>
    </form>
</div>

