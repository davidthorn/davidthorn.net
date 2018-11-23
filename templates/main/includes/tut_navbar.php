<?php

$cats = MenuCats::getAll('tut_navbar');
$menu = MenuCats::getMenu('tut_navbar');
$modules = Modules::getModules('leftbox');


?>


<?php if( $modules != null ): ?>
    <?php if( is_array( $modules ) && count( $modules ) > 0 ): ?>
        <?php foreach( $modules as $k => $mod ): ?>
        <div class="tut_navbar">

            <?php if( $menu != null ): ?>
            <h3><?php echo $mod->title; ?></h3>
            <ul class="menu_vert">

                <?php if( is_array( $cats ) ): ?>
                <?php foreach( $cats as $key => $cat ): ?>
                <li>
                    <a href="<?php echo $cat->link; ?>/"><?php echo $cat->name; ?></a>
                </li>

                <?php endforeach; ?>
                <?php endif; ?>
            </ul>

            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>
                    