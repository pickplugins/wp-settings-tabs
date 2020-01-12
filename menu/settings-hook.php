<?php	
if ( ! defined('ABSPATH')) exit;  // if direct access


add_action('plugin_slug_settings_content_general', 'plugin_slug_settings_content_general');

if(!function_exists('plugin_slug_settings_content_general')) {
    function plugin_slug_settings_content_general($tab){

        $settings_tabs_field = new settings_tabs_field();

        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Custom HTML', 'plugin-textdomain'); ?></div>
            <p class="description section-description"><?php echo __('This is custom HTML section description.', 'plugin-textdomain'); ?></p>
            <?php
            ob_start();
            ?>
            <p>Hello custom HTML section, you can use any HTML tags here and php code here.</p>
            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'shortcodes',
                'parent'		=> 'related_post_settings',
                'title'		=> __('Custom HTML','plugin-textdomain'),
                'details'	=> __('Custom HTML field description','plugin-textdomain'),
                'type'		=> 'custom_html',
                'html'		=> $html,

            );

            $settings_tabs_field->generate_field($args);

            ?>
        </div>
        <?php
    }
}


add_action('plugin_slug_settings_content_option', 'plugin_slug_settings_content_option');

if(!function_exists('plugin_slug_settings_content_option')) {
    function plugin_slug_settings_content_option($tab){

        $settings_tabs_field = new settings_tabs_field();

        $option_name_1 = get_option('option_name_1');


        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Input fields', 'plugin-textdomain'); ?></div>
            <p class="description section-description"><?php echo __('Create some basic options.', 'plugin-textdomain'); ?></p>

            <?php


            $args = array(
                'id'		=> 'option_name_1',
                //'parent'		=> '_settings[options]',
                'title'		=> __('Select','plugin-textdomain'),
                'details'	=> __('This is select field.','plugin-textdomain'),
                'type'		=> 'select',
                'value'		=> $option_name_1,
                'default'		=> 'true',
                'args'		=> array('true'=>__('True','plugin-textdomain'), 'false'=>__('False','plugin-textdomain')),
            );

            $settings_tabs_field->generate_field($args);

            ?>
        </div>
        <?php
    }
}




add_action('plugin_slug_settings_save', 'plugin_slug_settings_save');

if(!function_exists('plugin_slug_settings_save')) {
    function plugin_slug_settings_content_option($tab){

    }

}