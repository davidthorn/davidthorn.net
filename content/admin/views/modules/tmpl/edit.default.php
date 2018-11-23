<?php 
$module = $this->Module;
ToolBar::title("Edit Module [ " . $module->get('title') . " ]");
?>
<div class="adminform_wrapper">

    <form action="/admin/modules/?id=<?php echo $module->get('id'); ?>" method="post">

        <div class="admin_toolbar">
            <ul>
                <input type="hidden" name="task" id="task" value="" />
                <input type="hidden" name="jform[id]" value="<?php echo $module->get('id'); ?>" />
            </ul>
        </div>
        
        
        
        
                
          <div class="section">
            <h3>Module Information<span class="drop_arrows"></span></h3>
             <div class="adminInner">
                <ul class="adminForm">
                    
                <li>
                    <label>Name</label>
                    <input type="text" name="jform[name]" value="<?php echo $module->get('name'); ?>" class="inputbox"/>
               </li>
               
               <li>
                    <label>Title</label>
                    <input type="text" name="jform[title]" value="<?php echo $module->get('title'); ?>" class="inputbox"/>
               </li>
               
               <li>
                    <label>Position</label>
                    <input type="text" name="jform[position]" value="<?php echo $module->get('position'); ?>" class="inputbox"/>
               </li>
               
               <li>
                    <label>Status</label>
                    <?php  ?>
                    <select class="selectbox" name="jform[status]">
                        <?php $selected = ( $module->get('status')  ) ?>
                        <option value="0" <?php echo ( (bool)!$module->get('status') ) ? "selected" : false; ?> >Disabled</option>
                        <option value="1" <?php echo ( (bool)$module->get('status') ) ? "selected" : false; ?> >Enabled</option>
                    </select>

               </li>
               
                <li>
                    <label>Ordering</label>
                    <input type="text" name="jform[ordering]" value="<?php echo $module->get('ordering'); ?>" class="inputbox"/>
               </li>
               
               
               <li>
                    <label>Module Type</label>
                    <?php $mod_types = Modules::getModTypes();?>
                      <select class="selectbox" id="menu_id" name="jform[mod_type]">
                          <?php $selected = ""; ?>
                          <?php foreach( $mod_types as $value ): ?>
                              <?php if( $value->get('id') == $module->get('mod_type') ): ?>
                                  <?php $selected = "selected"; ?>
                              <?php endif; ?>
                              <option value="<?php echo $value->get('id'); ?>" <?php echo $selected ?>><?php echo  $value->get('name'); ?></option>
                              <?php $selected = false; ?> 
                          <?php endforeach; ?>
                      </select>
               </li>
               
               
               <li>
                    <label>Container Class</label>
                    <input type="text" name="jform[container_class]" value="<?php echo $module->get('container_class'); ?>" class="inputbox"/>
               </li>
               
                </ul>
             </div>
          </div>
        
         <div class="section">
           <h3>Parameters<span class="drop_arrows"></span></h3>
            <div class="adminInner">
                <?php Modules::getParamsFile( $module->get('mod_type') , $module ); ?>
            </div>
         </div>
        
            
        
        
           

    </form>

</div>

