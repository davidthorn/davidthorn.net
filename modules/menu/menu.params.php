    <?php $params = $module->get('params'); ?>
    <ul class="adminForm">

    <li>
        <label>Menu</label>
        <?php $menus = Site::getMenus();?>
          <select  class="selectbox" id="menu_id" name="jform[params][menu_id]">
              <?php $selected = ""; ?>
              <?php foreach( $menus as $value ): ?>
                  <?php if( $value->get('id') == $params->get('menu_id') ): ?>
                      <?php $selected = "selected"; ?>
                  <?php endif; ?>
                  <option value="<?php echo $value->get('id'); ?>" <?php echo $selected ?>><?php echo  $value->get('title'); ?></option>
                  <?php $selected = false; ?> 
              <?php endforeach; ?>
          </select>

    </li>
    
    <li>
        <label>Parent ID</label>
        <?php $items = ModelPages::getAll(  ); ?>
        <select class="selectbox" name="jform[params][parent_id]">
          <?php if( is_array( $items ) ): ?>
              <?php $selected = ""; ?>
              <?php foreach( $items as $k => $item ): ?>
                    <?php if( $item->get('id') == $params->get('parent_id') ): ?>
                                <?php $selected = "selected"; ?>
                    <?php endif; ?>
                    <option <?php echo $selected ?> value="<?php echo $k; ?>"><?php echo $item->get('name'); ?></option>
                    <?php $selected = false; ?>
              <?php endforeach; ?>

        <?php endif; ?>
        </select>
    </li>
    
    <li>
        <label>Show Title</label>
        <?php  ?>
        <select class="selectbox" name="jform[params][show_title]">
            <option value="0" <?php echo ( (bool)!$params->get('show_title') ) ? "selected" : false; ?> >No</option>
            <option value="1" <?php echo ( (bool)$params->get('show_title') ) ? "selected" : false; ?> >Yes</option>
        </select>
    </li>
    
    <li>
        <label>Allow Sub Menus</label>
        <?php  ?>
        <select  class="selectbox" name="jform[params][allow_submenus]">
            <option value="0" <?php echo ( (bool)!$params->get('allow_submenus') ) ? "selected" : false; ?> >No</option>
            <option value="1" <?php echo ( (bool)$params->get('allow_submenus') ) ? "selected" : false; ?> >Yes</option>
        </select>
    </li>
    
    <li>
        <label>Start Level</label>
        <?php  ?>
        <select class="selectbox" name="jform[params][start_level]">
            <?php for( $x = 0; $x < 10; $x++ ): ?>
                <option value="<?php echo $x; ?>" <?php echo ( (int)$params->get('start_level') == $x ) ? "selected" : false; ?> ><?php echo $x; ?></option>
            <?php endfor; ?>
        </select>
    </li>
    
    <li>
        <label>End Level</label>
        <?php  ?>
        <select class="selectbox" name="jform[params][end_level]">
            <?php for( $x = 0; $x < 10; $x++ ): ?>
                <option value="<?php echo $x; ?>" <?php echo ( (int)$params->get('end_level') == $x ) ? "selected" : false; ?> ><?php echo $x; ?></option>
            <?php endfor; ?>
        </select>
    </li>

   <li>
        <label>Menu Suffix</label>
        <input type="text" name="jform[params][menu_suffix]" value="<?php echo $params->get('menu_suffix'); ?>" class="inputbox"/>
   </li>
   
   <li>
        <label>Menu #ID</label>
        <input type="text" name="jform[params][menu_tag_id]" value="<?php echo $params->get('menu_tag_id'); ?>" class="inputbox"/>
   </li>

    </ul>

