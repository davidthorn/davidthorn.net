<?php 
$tutorial = $this->Tutorial;
?>
<div class="adminform_wrapper">

    <form action="/admin/tutorials/?id=<?php echo $tutorial->get('id'); ?>" method="post">
            <input type="hidden" name="task" id="task" value="" />
            <input type="hidden" name="jform[id]" value="<?php echo $tutorial->get('id'); ?>" />
            <input type="hidden" name="jform[page_id]" value="<?php echo $tutorial->get('page_id'); ?>" />
            <input type="hidden" name="jform[ordering]" value="<?php echo $tutorial->get('ordering'); ?>"/>
            
            <div class="section">
               <h3>Tutorial Information<span class="drop_arrows"></span></h3>
               <div class="adminInner">
                <ul class="adminForm">
                    
                    <li>
                        <label>Title</label>
                        <input type="text" name="jform[title]" value="<?php echo $tutorial->get('title'); ?>" class="inputbox"/>
                   </li>
                   
                    <li>
                        <label>Description</label>
                        <input type="text" name="jform[description]" value="<?php echo $tutorial->get('description'); ?>" class="inputbox"/>
                   </li>
                   
                   <li>
                        <label>Video Url</label>
                        <input type="text" name="jform[video_url]" value="<?php echo $tutorial->get('video_url'); ?>" class="inputbox"/>
                   </li>
                   
                   <li>
                        <label>Category ID</label>
                        <input type="text" name="jform[category_id]" value="<?php echo $tutorial->get('category_id'); ?>" class="inputbox"/>
                   </li>
               
                   
                   <li>
                      <label>Status</label>
                      <?php  ?>
                      <select class="selectbox" name="jform[status]">
                          <?php $selected = ( $tutorial->get('status')  ) ?>
                          <option value="0" <?php echo ( (bool)!$tutorial->get('status') ) ? "selected" : false; ?> >Disabled</option>
                          <option value="1" <?php echo ( (bool)$tutorial->get('status') ) ? "selected" : false; ?> >Enabled</option>
                      </select>
                     
                  </li>
                  
                  <li>
                        <label>Alias</label>
                        <input type="text" name="jform[alias]" value="<?php echo $tutorial->get('alias'); ?>" class="inputbox"/>
                   </li>
                   
                   <li>
                        <label>Uploaded Date</label>
                        <input type="text" name="jform[uploaded_date]" value="<?php echo $tutorial->get('uploaded_date'); ?>" class="inputbox"/>
                   </li>
                   
                   <li>
                        <label>Last Modified</label>
                        <input type="text" name="jform[last_modified]" value="<?php echo $tutorial->get('last_modified'); ?>" class="inputbox"/>
                   </li>
                   
                </ul>
             </div>
            </div> 
   
            
        <div class="section">
          <h3>Parameters<span class="drop_arrows"></span></h3>
          <div class="adminInner">
            <ul id="params_page_edit" class="adminForm">
                <?php #ContentLoader::getParamsFile( $tutorial ); ?>
            </ul>
          </div>
        </div>
            
            
            
            
            
            
            

            


    </form>

</div>

