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
    <?php print_r( $params->get('tutorial_id') ); ?>
       <select name="jform[params][tutorial_category]">
            <?php $selected = ""; ?>
            <?php foreach( $cats as $value ): ?>
                <?php if( $value->get('id') == $params->get('tutorial_category') ): ?>
                    <?php $selected = "selected='selected'"; ?>
                <?php endif; ?>
                <option value="<?php echo $value->get('id'); ?>" <?php echo $selected ?>><?php echo  $value->get('name'); ?></option>
                <?php $selected = false; ?> 
            <?php endforeach; ?>
        </select>
    
    <?php endif; ?>
    
</li>
