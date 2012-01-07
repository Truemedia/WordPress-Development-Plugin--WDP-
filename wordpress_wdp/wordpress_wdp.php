<?php
/**
 * @package Web_Des_Features
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
// [shortdebug var_pageurl="wordpress function" var_user="wordpress function"]
function shortdebug_func( $atts ) {
	extract( shortcode_atts( array(
		'var_pageurl' => 'something',
		'var_user' => 'something else',
	), $atts ) );

	return "var_pageurl = {$var_pageurl}, var_user = {$var_user}";
}
add_shortcode( 'shortdebug', 'shortdebug_func' );
?>
