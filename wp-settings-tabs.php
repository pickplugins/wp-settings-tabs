<?php
/*
Plugin Name: WP Settings Tabs
Plugin URI:
Description:
Version: 1.0.0
Author: PickPlugins
Author URI: https://www.pickplugins.com/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access

define('wpsettingstabs_plugin_url', plugins_url('/', __FILE__)  );
define('wpsettingstabs_plugin_dir', plugin_dir_path( __FILE__ ) );

require_once( wpsettingstabs_plugin_dir . 'class-settings-tabs.php');
require_once( wpsettingstabs_plugin_dir . 'menu/settings-hook.php');



add_action( 'admin_enqueue_scripts', '_admin_scripts' );

function _admin_scripts(){
    wp_register_script('settings-tabs', wpsettingstabs_plugin_url.'settings-tabs.js' , array( 'jquery' ));
    wp_register_style('settings-tabs', wpsettingstabs_plugin_url.'settings-tabs.css');
}

add_action( 'admin_menu', 'wp_settings_tabs_menu_init', 12 );

function wp_settings_tabs_menu_init(){

    add_menu_page(__('Setting Tabs','textdomain'), __('Setting Tabs','textdomain'), 'manage_options', 'wp_settings_tabs', 'wp_settings_tabs_settings', 'dashicons-align-right');
}

function wp_settings_tabs_settings(){
    include('menu/settings.php');

}