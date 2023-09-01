<?php

/*
Plugin Name: WP Custom Login UI
Plugin URI:
Description: Custom Login Page
Version: 1.0.0
Author: WP Custom Login
Author URI:
License: GPLv2 or later
Text Domain: wpcl
*/
function wpcl_add_theme_page()
{
    add_menu_page('Login Option for Admin', 'Login Option', 'manage_options', 'wpcl_plugin_option', 'wpcl_create_page', 'dashicons-admin-tools', 101);
};
add_action('admin_menu', 'wpcl_add_theme_page');


//plugin callback

function wpcl_create_page()
{
?>
    <div class="wpcl_main_area">
        <div class="wpcl_body_area">
            <h3 id='title'>
                <?php print esc_attr('Login Page Customizer') ?>
            </h3>
            <form action="options.php" method="post">
                <?php wp_nonce_field('update-options'); ?>

                <!-- PRIMARY COLOR -->
                <label for="wpcl-primary-color" name="wpcl-primary-color"><?php print esc_attr('Primary Color'); ?></label>
                <input type="color" name="wpcl-primary-color" value="<?php print get_option('wpcl-primary-color') ?>">
                <!-- MAIN LOGO -->
                <label for="wpcl-logo-image-url" name="wpcl-logo-image-url"><?php print esc_attr('Logo URL'); ?></label>
                <input type="input" name="wpcl-logo-image-url" value="<?php print get_option('wpcl-logo-image-url') ?>">
                <!-- BG IMAGE -->
                <label for="wpcl-bg-image" name="wpcl-bg-image"><?php print esc_attr('Logo URL'); ?></label>
                <input type="input" name="wpcl-bg-image" value="<?php print get_option('wpcl-bg-image') ?>">
                <!-- BG IMAGE OPACITY-->
                <label for="wpcl-bg-image-opacity" name="wpcl-bg-image-opacity"><?php print esc_attr('BG IMAGE OPACITY'); ?></label>
                <input type="number" name="wpcl-bg-image-opacity" value="<?php print get_option('wpcl-bg-image') ?>">


                <input type="hidden" name="action" value="update">
                <input type="hidden" name="page_options" value="wpcl-primary-color,wpcl-logo-image-url,wpcl-bg-image,wpcl-bg-image-opacity">
                <input type="submit" name="submit" class="button button-primary" value="<?php _e('Save Changes', 'wpcl') ?>">
            </form>

        </div>
        <div class="wpcl_side_area">

        </div>
    </div>
<?php
};


function wpcl_login_enqueue_register()
{
    wp_enqueue_style('wpcl-login-enqueue', plugins_url('css/wpcl_style.css', __FILE__), false, "1.0.0");
};
add_action('login_enqueue_scripts', 'wpcl_login_enqueue_register');

function wpcl_login_logo_change()
{
?>
    <style>
        #login h1 a,
        .login h1 a {
            background-image: url(<?php print get_option('wpcl-logo-image-url') ?>) !important;
        }
    </style>

<?php
}
add_action('login_enqueue_scripts', 'wpcl_login_logo_change');

// Changing Login form logo url
function wpcl_login_logo_url_change()
{
    return home_url();
}
add_filter('login_headerurl', 'wpcl_login_logo_url_change');
