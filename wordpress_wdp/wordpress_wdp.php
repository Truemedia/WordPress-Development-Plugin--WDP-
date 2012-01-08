<?php
/**
 * @package WordPress_Development_Plugin
 * @version 1.0
 */
/*
Plugin Name: WordPress Development Plugin
Plugin URI: http://mediacityonline.net/projects/wordpressdevelopmentplugin
Description: A WordPress plugin that allows you to create wordpress themes and plugins with an efficient automated workflow
Author: Wade Penistone
Version: 1.0
Author URI: http://mediacityonline.net
*/

// INCLUDES of this initial plugin file
/* include WP_CONTENT_DIR."/plugins/wordpress_wdp/plugin.php"; */
/* include WP_CONTENT_DIR."/plugins/wordpress_wdp/theme.php"; */

// ACTIONS/CONTROLLERS
add_action('wp_dashboard_setup', 'wdp_add_plugindev_dashboard_widgets' ); /* Setup everything needed to view the plugin dev widget correctly */
add_action('wp_dashboard_setup', 'wdp_add_themedev_dashboard_widgets' ); /* Setup everything needed to view the theme dev widget correctly */
// admin -> menu
/* add_utility_page('Add a plugin', 'a custom title', 'administrator', 'add-plugin', 'development_view'); */
add_shortcode( 'shortdebug', 'shortdebug_func' );

// VIEWS/HTML templates this plugin displays
function plugin_development_dashboard_view(){ /* Dashboard widget HTML inside container */
	return "my widget text to see plugin stuff wuz here 011";
}
function theme_development_dashboard_view(){ /* Dashboard widget HTML inside container */
	return "my widget for editing themes and theme stuff";
}

// MODELS the pure logical parts of the plugin
/* prepares logic and pairs it with html output for plugin dev dashboard widget */
function wdp_dashboard_plugindev_widget_function() {

/* view for plugin dev dash widget */
echo(plugin_development_dashboard_view());
}
/* prepares logic and pairs it with html output for theme dev dashboard widget */
function wdp_dashboard_themedev_widget_function() {

/* view for theme dev dash widget */
echo(theme_development_dashboard_view());
}
// [shortcode var_pageurl="wordpress function" var_user="wordpress function"]
function shortdebug_func( $atts ) {
	extract( shortcode_atts( array(
		'var_pageurl' => 'something',
		'var_user' => 'something else',
	), $atts ) );

	return "var_pageurl = {$var_pageurl}, var_user = {$var_user}";
}

// INSTALLERS
/* install the plugin dev dashboard item */
function wdp_add_plugindev_dashboard_widgets() {
wp_add_dashboard_widget('wdp_plugindev_dashboard_widget', 'WordPress create a plugin', 'wdp_dashboard_plugindev_widget_function');

// Globalize the metaboxes array, this holds all the widgets for wp-admin
global $wp_meta_boxes;

// Get the regular dashboard widgets array
// (which has our new widget already but at the end)
$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

// Backup and delete our new dashbaord widget from the end of the array
$demo_widget_backup = array('wdp_plugindev_dashboard_widget' =>
$normal_dashboard['wdp_plugindev_dashboard_widget']);
unset($normal_dashboard['wdp_plugindev_dashboard_widget']);

// Merge the two arrays together so our widget is at the beginning
$sorted_dashboard = array_merge($demo_widget_backup, $normal_dashboard);

// Save the sorted array back into the original metaboxes
$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}

/* install the theme dev dashboard item */
function wdp_add_themedev_dashboard_widgets() {
wp_add_dashboard_widget('wdp_themedev_dashboard_widget', 'WordPress create a theme', 'wdp_dashboard_themedev_widget_function');

// Globalize the metaboxes array, this holds all the widgets for wp-admin
global $wp_meta_boxes;

// Get the regular dashboard widgets array
// (which has our new widget already but at the end)
$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

// Backup and delete our new dashbaord widget from the end of the array
$demo_widget_backup = array('wdp_themedev_dashboard_widget' =>
$normal_dashboard['wdp_themedev_dashboard_widget']);
unset($normal_dashboard['wdp_themedev_dashboard_widget']);

// Merge the two arrays together so our widget is at the beginning
$sorted_dashboard = array_merge($demo_widget_backup, $normal_dashboard);

// Save the sorted array back into the original metaboxes
$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
?>
