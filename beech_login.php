<?php
/**
 * Plugin Name: BEECH Login
 * Plugin URI: https://beech.agency
 * Description: Makes your login screen look amazing!
 * Version: 4.0
 * Author: BEECH
 * Author URI: https://beech.agency
 */

if( ! class_exists( 'BEECH_Updater' ) ){
	include_once( plugin_dir_path( __FILE__ ) . 'updater.php' );
}

$updater = new BEECH_Updater( __FILE__ );
$updater->set_username( 'BeechAgency' );
$updater->set_repository( 'beech_login' );
/*
	$updater->authorize( 'abcdefghijk1234567890' ); // Your auth code goes here for private repos
*/
$updater->initialize();

 // Set up settings
if( !function_exists("BEECH_update_login_screen") ) { 
	function BEECH_update_login_screen() {   
		register_setting( 'BEECH-login-screen-settings', 'BEECH_login_screen_background_image' ); 
		register_setting( 'BEECH-login-screen-settings', 'BEECH_login_screen_brand_image' ); 
		register_setting( 'BEECH-login-screen-settings', 'BEECH_login_screen_background_texture' ); 
		register_setting( 'BEECH-login-screen-settings', 'BEECH_login_screen_primary_color' ); 
		register_setting( 'BEECH-login-screen-settings', 'BEECH_login_screen_secondary_color' ); 
		register_setting( 'BEECH-login-screen-settings', 'BEECH_login_left_background_style' ); 
		register_setting( 'BEECH-login-screen-settings', 'BEECH_login_background_full_only' ); 
		register_setting( 'BEECH-login-screen-settings', 'BEECH_login_background_custom_css' ); 
		register_setting( 'BEECH-login-screen-settings', 'BEECH_login_display_message_box' );  
		register_setting( 'BEECH-login-screen-settings', 'BEECH_login_screen_partnership_logo' ); 
		register_setting( 'BEECH-login-screen-settings', 'BEECH_login_screen_partnership_message' ); 
		register_setting( 'BEECH-login-screen-settings', 'BEECH_login_message_box_custom_message' );
		register_setting( 'BEECH-login-screen-settings', 'BEECH_login_documentation_link' );
		register_setting( 'BEECH-login-screen-settings', 'BEECH_login_posts_on_login_page' );
		register_setting( 'BEECH-login-screen-settings', 'BEECH_login_invert_logo' );
		register_setting( 'BEECH-login-screen-settings', 'BEECH_login_hide_language_switcher' );
		register_setting( 'BEECH-login-screen-settings', 'BEECH_login_healthcheck_token' );

		if (!get_option('BEECH_login_healthcheck_token')) {
			update_option('BEECH_login_healthcheck_token', wp_generate_password(32, false));
		}
	}
}

// Set up menu
function BEECH_login_admin_menu() {

	 $parent_slug = 'themes.php';
	 $page_title = 'Update Login Page';   
	 $menu_title = 'Beech Login Page';   
	 $capability = 'manage_options';   
	 $menu_slug  = 'beech-login-page';  
	 $function   = 'BEECH_login_admin_page';   
	 $icon_url   = 'dashicons-media-code';   
	 $position   = (int) 4;    

	 add_submenu_page( 
		 $parent_slug,
		 $page_title,                  
		 $menu_title,                   
		 $capability,                   
		 $menu_slug,                   
		 $function,                                 
		 $position 
	); 
	add_action( 'admin_init', 'BEECH_update_login_screen' ); 
}

add_action('rest_api_init', function () {
    register_rest_route('beech/v1', '/health', [
        'methods' => 'GET',
        'callback' => function () {
            return [
                'status' => 'ok',
                'site' => get_bloginfo('name'),
                'url' => get_bloginfo('url'),
                'theme_count' => count(wp_get_themes()),
                'plugin_count' => count(get_plugins()),
                'wp_version' => get_bloginfo('version'),
                'timestamp' => current_time('mysql'),
            ];
        },
        'permission_callback' => function () {
            $token = $_GET['token'] ?? '';
            $saved_token = get_option('BEECH_login_healthcheck_token');

            return hash_equals($saved_token, $token);
        },
    ]);
});

require 'components/beech_login-login-page.php';
require 'components/beech_login-admin-page.php';
require 'components/beech_login-messages.php';
