<?php 
$page = $this->Page;
?>
<div class="adminform_wrapper">

    <form action="/admin/pages/?id=<?php echo $page->get('id'); ?>" method="post">
            <input type="hidden" name="task" id="task" value="" />
            <input type="hidden" name="jform[id]" value="<?php echo $page->get('id'); ?>" />
            <input type="hidden" name="jform[ordering]" value="<?php echo $page->get('ordering'); ?>"/>
            
            <div class="section">
               <h3>Menu Information<span class="drop_arrows"></span></h3>
               <div class="adminInner">
                <ul class="adminForm">
                    
                    <li>
                        <label>Name</label>
                        <input type="text" name="jform[name]" value="<?php echo $page->get('name'); ?>" class="inputbox"/>
                   </li>
               
                    <li>
                         <label>Page Type</label>

                         <?php $pTypes = Site::getPageTypes();?>
                         <select class="selectbox" id="page_type" name="jform[page_type]">
                             <?php $selected = ""; ?>
                             <?php foreach( $pTypes as $value ): ?>
                                 <?php if( $value == $page->get('page_type') ): ?>
                                     <?php $selected = "selected"; ?>
                                 <?php endif; ?>
                                 <option value="<?php echo $value; ?>" <?php echo $selected ?>><?php echo ucfirst( $value ); ?></option>
                                 <?php $selected = false; ?> 
                             <?php endforeach; ?>
                         </select>
                     </li>
               
                    <li>
                        <label>View</label>

                        <?php $pViews = Site::getViews( $page->get('page_type') );?>
                        <select class="selectbox" id="views_holder" name="jform[view]">
                            <?php $selected = ""; ?>
                            <?php foreach( $pViews as $value ): ?>
                                <?php if( $value == $page->get('view') ): ?>
                                    <?php $selected = "selected"; ?>
                                <?php endif; ?>
                                <option value="<?php echo $value; ?>" <?php echo $selected ?>><?php echo ucfirst( $value ); ?></option>
                                <?php $selected = false; ?> 
                            <?php endforeach; ?>
                        </select>

                    </li>
                    <li>
                        <label>Template</label>
                        <?php $pTmpls = Site::getTmpls( $page->get('page_type') , $page->get('view') );?>
                        <select class="selectbox" id="tmpl_holder" name="jform[tmpl]">
                            <?php $selected = ""; ?>
                            <?php foreach( $pTmpls as $value ): ?>
                                <?php if( strtolower( $value ) ==  $page->get('tmpl')  ): ?>
                                    <?php $selected = "selected"; ?>
                                <?php endif; ?>
                                <option value="<?php echo strtolower( $value ); ?>" <?php echo $selected ?>><?php echo ucfirst( $value ); ?></option>
                                <?php $selected = false; ?> 
                            <?php endforeach; ?>
                        </select>
                    </li>
                </ul>
             </div>
            </div> 
               
               
           <div class="section">
               <h3>Menu Information<span class="drop_arrows"></span></h3>
               <div class="adminInner">
                <ul class="adminForm">
                    <li>
                        <label>Link</label>
                        <input readonly type="text" name="jform[link]" value="<?php echo $page->get('link'); ?>" class="inputbox"/>
                     </li>

                     <li>
                        <label>Page Heading</label>
                        <input type="text" name="jform[page_heading]" value="<?php echo $page->get('page_heading'); ?>" class="inputbox"/>
                     </li>

                    <li>
                        <label>Browser Title</label>
                        <input type="text" name="jform[browser_title]" value="<?php echo $page->get('browser_title'); ?>" class="inputbox"/>
                    </li>
                    <li>
                        <label>Container Class</label>
                        <input type="text" name="jform[container_class]" value="<?php echo $page->get('container_class'); ?>" class="inputbox"/>
                    </li>  
                </ul>
               </div>     
           </div>
               
           <div class="section">
               <h3>Menu Information<span class="drop_arrows"></span></h3>
               <div class="adminInner">
            
               <ul class="adminForm">  
                  <li>
                      <label>Menu</label>
                      <?php $menus = Site::getMenus();?>
                        <select class="selectbox" id="menu_id" name="jform[menu_id]">
                            <?php $selected = ""; ?>
                            <?php foreach( $menus as $value ): ?>
                                <?php if( $value->get('id') == $page->get('menu_id') ): ?>
                                    <?php $selected = "selected"; ?>
                                <?php endif; ?>
                                <option value="<?php echo $value->get('id'); ?>" <?php echo $selected ?>><?php echo  $value->get('name'); ?></option>
                                <?php $selected = false; ?> 
                            <?php endforeach; ?>
                        </select>
                      
                  </li>
                    
                  <li>
                      <label>Parent ID</label>
                      <?php $items = ModelPages::getAll( $page->get('menu_id') ); ?>
                      <select class="selectbox" name="jform[parent_id]">
                         
                      <?php if( is_array( $items ) ): ?>
                            <?php $selected = ""; ?>
                            <?php foreach( $items as $k => $item ): ?>
                                  <?php if( (int)$item->get('id') == (int)$page->get('parent_id') ): ?>
                                              <?php $selected = "selected"; ?>
                                  <?php endif; ?>
                                  <option <?php echo $selected ?> value="<?php echo $k; ?>"><?php echo $item->get('name'); ?></option>
                                  <?php $selected = false; ?>
                            <?php endforeach; ?>
                      
                      <?php endif; ?>
                      </select>
                  </li>
                  <li>
                      <label>Level</label>
                      <input readonly type="text" name="jform[level]" value="<?php echo $page->get('level'); ?>" class="inputbox"/>
                  </li>
                  
                  <li>
                      <label>Status</label>
                      <?php  ?>
                      <select class="selectbox" name="jform[status]">
                          <?php $selected = ( $page->get('status')  ) ?>
                          <option value="0" <?php echo ( (bool)!$page->get('status') ) ? "selected" : false; ?> >Disabled</option>
                          <option value="1" <?php echo ( (bool)$page->get('status') ) ? "selected" : false; ?> >Enabled</option>
                      </select>
                     
                  </li>
                  <li>
                      <label>Home</label>
                      <select class="selectbox" name="jform[home]">
                          <?php $selected = ( $page->get('home')  ) ?>
                          <option value="0" <?php echo ( (bool)!$page->get('home') ) ? "selected" : false; ?> >No</option>
                          <option value="1" <?php echo ( (bool)$page->get('home') ) ? "selected" : false; ?> >Yes</option>
                      </select>
                  </li>
                  
                </ul>
               </div>
            </div>
            
        <div class="section">
          <h3>Menu Information<span class="drop_arrows"></span></h3>
          <div class="adminInner">
            <ul id="params_page_edit" class="adminForm">
                <?php ContentLoader::getParamsFile( $page ); ?>
            </ul>
          </div>
        </div>
            
            
            
            
            
            
            

            


    </form>

</div>

