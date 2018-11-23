<div class="adminform_wrapper">
    <form action="/admin/menus" method="post">
        <input type="hidden" name="task" value="add"/>
            <table class="adminTable" width="100%">
                <thead>
                    <tr>
                        <td width="45%" align="left" style="text-indent: 10px;">Title</td>
                        <td align="left" style="text-indent: 10px;">Name</td>
                        
                        <td width="7%">Status</td>
                        <td width="7%">Parent ID</td>
                        <td width="7%" align="center">ID</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if( $this->Menus != null && is_array( $this->Menus ) ): ?>
                        <?php foreach ($this->Menus as $key => $menu): ?>
                        <tr>
                           
                            <td>
                                <a href="/admin/menus/?id=<?php echo $menu->get('id'); ?>">
                                    <?php echo $menu->get('title'); ?>
                                </a>
                            </td>
                            <td style="text-indent: 10px;"><i><?php echo $menu->get('name'); ?></i></td>
                            <td align="center">
                                <div class="status_box">
                                    <?php $status = ( (bool)$menu->get('status') ) ? 'status_ok' : 'status_off'; ?>
                                    <span id="<?php echo $menu->get('id'); ?>" class="<?php echo $status; ?>"></span>
                                </div>
                            </td>
                            <td align="center"><?php echo $menu->get('parent_id'); ?></td>
                             <td align="center"><?php echo $menu->get('id'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
    </form>
</div>
