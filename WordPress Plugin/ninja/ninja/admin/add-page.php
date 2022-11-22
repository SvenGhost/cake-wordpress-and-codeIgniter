<?php
 
function ninja_admin_page_add(){

    $cakeid = (isset($_GET['cakeid'])) ? $_GET['cakeid'] : '';
    $action = (isset($_GET['action'])) ? $_GET['action'] : '';

    ?>
    <div class="wrap">
    
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

        <form method="post" action="#" id="ninja_add_cake_form">
            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row"><label for="product_name"><?php _e( 'Cake Name', 'ninja' );?></label></th>
                        <td><input name="product_name" type="text" id="product_name" class="regular-text" placeholder="Type cake name here."></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="product_images"><?php _e( 'Cake Images', 'ninja' );?></label></th>
                        <td><input name="product_images[]" type="file" id="product_images" class="" multiple></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e( 'Cake Type', 'ninja' );?></th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text"><span><?php _e( 'Cake Type', 'ninja' );?></span></legend>
                                <label><input type="radio" name="product_type" value="Sugar Free"> <span class="date-time-text format-i18n"><?php _e( 'Sugar Free', 'ninja' );?></span></label><br>
                                <label><input type="radio" name="product_type" value="Brownie"> <span class="date-time-text format-i18n"><?php _e( 'Brownie', 'ninja' );?></span></label><br>
                                <label><input type="radio" name="product_type" value="Cupcakes"> <span class="date-time-text format-i18n"><?php _e( 'Cupcakes', 'ninja' );?></span></label><br>
                                <label><input type="radio" name="product_type" value="Chocolate strip"> <span class="date-time-text format-i18n"><?php _e( 'Chocolate strip', 'ninja' );?></span></label><br>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="product_recipe"><?php _e( 'Cake Receipe', 'ninja' );?></label></th>
                        <td><textarea name="product_recipe" rows="8" cols="50" id="product_recipe" class="code"></textarea></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="product_price"><?php _e( 'Price', 'ninja' );?></label></th>
                        <td><input name="product_price" type="text" id="product_price" class="regular-text" placeholder="Price"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="">&nbsp;</label></th>
                        <td>
                            <p class="submit"><input type="submit" name="submit_cake" id="submit_cake" class="button button-primary" value="Add Cake"></p><br>
                            <div id="ninja_add_success"></div>
                        </td>
                    </tr>


                </tbody>
            </table>
            <input type="hidden" name="auth_token" value="Ninja@cake_Project**">
        </form>
    </div>
    <?php
}