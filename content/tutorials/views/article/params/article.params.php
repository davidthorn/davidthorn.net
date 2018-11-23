<li>

    <?php
        if( !class_exists('ModelTutorialsCategories') )
        {
            require_once MODELS_DIR . 'model.tutorialcategories.php';
        }
    ?>
    
    <?php $cats = ModelTutorialsCategories::getTutorialsCategories(); ?>
    <label>Tutorial Category</label>
  
    <?php if( is_array( $cats ) ): ?>
    
    
    <?php $params = $page->get('params'); ?>
    
    
       <select name="jform[params][tutorial_category]">
            <?php $selected = ""; ?>
            <?php foreach( $cats as $value ): ?>
                <?php if( $value->get('id') == $params->get('tutorial_category') ): ?>
                    <?php $selected = "selected"; ?>
                <?php endif; ?>
                <option value="<?php echo $value->get('id'); ?>" <?php echo $selected ?>><?php echo  $value->get('name'); ?></option>
                <?php $selected = false; ?> 
            <?php endforeach; ?>
        </select>
    
    <?php endif; ?>
    
</li>


<li>
    
    <?php
        if( !class_exists('ModelTutorials') )
        {
            require_once MODELS_DIR . 'model.tutorials.php';
        }
    ?>
   
    <?php $tuts = ModelTutorials::getTutorials( $params->get('tutorial_category') ); ?>
   
    <label>Tutorial ID</label>
  
    <?php if( is_array( $tuts ) ): ?>
    
    
     <select name="jform[params][tutorial_id]">
            <?php $selected = ""; ?>
            <?php foreach( $tuts as $value ): ?>
                <?php if( $value->get('id') == $params->get('tutorial_id') ): ?>
                    <?php $selected = "selected"; ?>
                <?php endif; ?>
                <option value="<?php echo $value->get('id'); ?>" <?php echo $selected ?>><?php echo  $value->get('title'); ?></option>
                <?php $selected = false; ?> 
            <?php endforeach; ?>
        </select>
    
    <?php endif; ?>
    
</li>