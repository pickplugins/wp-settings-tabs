<?php	
if ( ! defined('ABSPATH')) exit;  // if direct access


$plugin_slug_settings_tab = array();

$plugin_slug_settings_tab[] = array(
    'id' => 'general',
    'title' => sprintf(__('%s General','plugin-textdomain'),'<i class="fas fa-list-ul"></i>'),
    'priority' => 1,
    'active' => true,
);

$plugin_slug_settings_tab[] = array(
    'id' => 'option',
    'title' => sprintf(__('%s Options','plugin-textdomain'),'<i class="fas fa-filter"></i>'),
    'priority' => 2,
    'active' => false,
);



$plugin_slug_settings_tab = apply_filters('plugin_slug_settings_tabs', $plugin_slug_settings_tab);

$tabs_sorted = array();
foreach ($plugin_slug_settings_tab as $page_key => $tab) $tabs_sorted[$page_key] = isset( $tab['priority'] ) ? $tab['priority'] : 0;
array_multisort($tabs_sorted, SORT_ASC, $plugin_slug_settings_tab);


wp_enqueue_style('font-awesome-5');
wp_enqueue_style('settings-tabs');
wp_enqueue_script('settings-tabs');
wp_enqueue_script('jquery');
wp_enqueue_script('jquery-ui-sortable');
wp_enqueue_script( 'jquery-ui-core' );
wp_enqueue_script('jquery-ui-accordion');

?>
<div class="wrap">
	<div id="icon-tools" class="icon32"><br></div><h2><?php echo sprintf(__('%s Settings', 'plugin-textdomain'), 'Plguin Name')?></h2>
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	        <input type="hidden" name="plugin_slug_hidden" value="Y">
            <?php
            if(!empty($_POST['plugin_slug_hidden'])){

                $nonce = sanitize_text_field($_POST['_wpnonce']);

                if(wp_verify_nonce( $nonce, 'plugin_slug_nonce' ) && $_POST['plugin_slug_hidden'] == 'Y') {

                    do_action('plugin_slug_settings_save');

                    ?>
                    <div class="updated notice  is-dismissible"><p><strong><?php _e('Changes Saved.', 'plugin-textdomain' ); ?></strong></p></div>

                    <?php
                }
            }
            ?>
            <div class="settings-tabs vertical has-right-panel">

                <div class="settings-tabs-right-panel">
                    <?php
                    foreach ($plugin_slug_settings_tab as $tab) {
                        $id = $tab['id'];
                        $active = $tab['active'];

                        ?>
                        <div class="right-panel-content <?php if($active) echo 'active';?> right-panel-content-<?php echo $id; ?>">
                            <?php

                            do_action('plugin_slug_settings_tabs_right_panel_'.$id);
                            ?>

                        </div>
                        <?php

                    }
                    ?>
                </div>

                <ul class="tab-navs">
                    <?php
                    foreach ($plugin_slug_settings_tab as $tab){
                        $id = $tab['id'];
                        $title = $tab['title'];
                        $active = $tab['active'];
                        $data_visible = isset($tab['data_visible']) ? $tab['data_visible'] : '';
                        $hidden = isset($tab['hidden']) ? $tab['hidden'] : false;
                        ?>
                        <li <?php if(!empty($data_visible)):  ?> data_visible="<?php echo $data_visible; ?>" <?php endif; ?> class="tab-nav <?php if($hidden) echo 'hidden';?> <?php if($active) echo 'active';?>" data-id="<?php echo $id; ?>"><?php echo $title; ?></li>
                        <?php
                    }
                    ?>
                </ul>



                <?php
                foreach ($plugin_slug_settings_tab as $tab){
                    $id = $tab['id'];
                    $title = $tab['title'];
                    $active = $tab['active'];
                    ?>

                    <div class="tab-content <?php if($active) echo 'active';?>" id="<?php echo $id; ?>">
                        <?php
                        do_action('plugin_slug_settings_content_'.$id, $tab);
                        ?>


                    </div>

                    <?php
                }
                ?>

            </div>

            <div class="clear clearfix"></div>
            <p class="submit">
                <?php wp_nonce_field( 'plugin_slug_nonce' ); ?>
                <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes','plugin-textdomain' ); ?>" />
            </p>
		</form>
</div>
