<?php
/**
 * Plugin Name: BEECH Login
 * Plugin URI: https://beech.agency
 * Description: Makes your login screen look amazing!
 * Version: 2.5
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
	 $position   = 4;    

	 add_submenu_page( 
		 $parent_slug,
		 $page_title,                  
		 $menu_title,                   
		 $capability,                   
		 $menu_slug,                   
		 $function,                   
		 $icon_url,                   
		 $position 
	); 
	add_action( 'admin_init', 'BEECH_update_login_screen' ); 
}

require 'components/beech_login-login-page.php';
require 'components/beech_login-admin-page.php';
require 'components/beech_login-messages.php';
