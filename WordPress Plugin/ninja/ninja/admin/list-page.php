<?php

 
function ninja_admin_page_list(){
    ?>
    <div class="wrap">
    
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

            <table class="form-table" role="presentation">
                <tbody id="admin_cake_list" data-url="<?php echo get_admin_url('admin.php?page=ninja-plugin-add')?>">
                    <tr>
                        <td><strong><?php _e( 'Cake Name', 'ninja' );?></strong></td>
                        <td><strong><?php _e( 'Action', 'ninja' );?></strong></td>
                    </tr>
                    <tr>
                        <td>Cake Name</td>
                        <td>Action</td>
                    </tr>
                    
                </tbody>
            </table>
    </div>
    <?php
}