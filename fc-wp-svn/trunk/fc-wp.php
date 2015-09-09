<?php
/**
 * @package fc-wp
 * @version 0.2
 */
/*
Plugin Name: FusionCharts for Wordpress
Plugin URI: http://wordpress.org/plugins/fc-wp/
Description: This is a plugin of FusionCharts for wordpress to add interactive javascript charts in your wordpress site's post or page
Author: Sahasrangshu Guha 
Contributor: Uttam Thapa
Version: 0.2
Author URI: https://github.com/sguha-work/
Contributor URI: https://github.com/ukthapa/
*/

// including the file that contains the functionalities
include_once 'functionality.php';

//adding the actions
add_action( 'admin_notices', 'fcwp_showButton' );
add_action( 'admin_head', 'fcwp_addCss' );
add_action( 'admin_head', 'fcwp_addScript' );
add_action( 'admin_head', 'fcwp_addFormTemplate' );
add_action( 'wp_ajax_get_chart', 'fcwp_getChart' );
?>