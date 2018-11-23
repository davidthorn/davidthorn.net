<div class="adminform_wrapper">
    <form action="/admin/modules" method="post">
        <input type="hidden" name="task" id="task" value="add"/>
            <table class="adminTable" width="100%">
                <thead>
                    <tr>
                        
                        <td align="left" style="text-indent: 10px;">Title</td>
                        <td align="left" style="text-indent: 10px;">Name</td>
                        <td>Position</td>
                        <td>Status</td>
                        <td>Module Type</td>
                        <td>ID</td>
                    </tr>
                </thead>
                
                <tbody>
                    <?php if( $this->Modules != null && is_array( $this->Modules ) ): ?>
                        <?php foreach ($this->Modules as $key => $module): ?>
                        <tr>
                            
                            <td>
                                <a href="/admin/modules/?id=<?php echo $module->get('id'); ?>">
                                    <?php echo $module->get('title'); ?>
                                </a>
                            </td>
                            <td style="text-indent: 10px;"><i><?php echo $module->get('name'); ?></i></td>
                            <td align="center"><?php echo $module->get('position'); ?></td>
                            <td align="center">
                                <div class="status_box">
                                    <?php $status = ( (bool)$module->get('status') ) ? 'status_ok' : 'status_off'; ?>
                                    <span id="<?php echo $module->get('id'); ?>" class="<?php echo $status; ?>"></span>
                                </div>
                            </td>
                            <td align="center"><?php echo $module->get('mod_type'); ?></td>
                            <td align="center"><?php echo $module->get('id'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
    </form>
</div>
