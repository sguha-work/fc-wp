<?php
/**
 * @package fc-wp
 * @version 0.2
 */
/*
Plugin Name: FC-WP
Plugin URI: http://wordpress.org/plugins/fc-wp/
Description: This is a plugin of FusionCharts for wordpress to add interactive javascript charts in your wordpress site's post or page
Author: Sahasrangshu Guha 
Contributor: Uttam Thapa
Version: 0.2
Author URI: https://github.com/sguha-work/
Contributor URI: https://github.com/ukthapa/
*/
function fcwp_checkPage() {
	$referPage = $_SERVER['PHP_SELF'];
	if(strpos($referPage,"post.php")!==false || strpos($referPage,"post-new.php")!==false) {
		return 1;
	}
	return 0;
}

function fcwp_showButton() {
	if(fcwp_checkPage()) {
		echo "<a href='javascript:void(0)' id='fcwp_button'><img height='20' width='20' src='".plugins_url('assets/images/fc.png', __FILE__)."'>&nbsp;&nbsp;&nbsp;Create fusionchart for this Page/Post</a>";
	}
}
add_action( 'admin_notices', 'fcwp_showButton' );

function fcwp_addCss() {
	if(fcwp_checkPage()) {
		echo "<link rel='stylesheet' href='".plugins_url('assets/css/button-style.css', __FILE__)."'/>";
		echo "<link rel='stylesheet' href='".plugins_url('assets/css/form-style.css', __FILE__)."'/>";
	}
}
add_action( 'admin_head', 'fcwp_addCss' );

function fcwp_addJs() {
	if(fcwp_checkPage()) {
		echo "<script type='text/javascript'>window.fcwp_main = {};fcwp_main.fcwp_pluginPath = '".plugins_url('assets/',__FILE__)."'.split('assets/')[0];</script>";
		echo "<script type='text/javascript' src=".plugins_url('assets/js/chart-types.js', __FILE__)."></script>";
		echo "<script type='text/javascript' src=".plugins_url('assets/js/form-function.js', __FILE__)."></script>";	
		echo "<script type='text/javascript' src=".plugins_url('assets/js/button-function.js', __FILE__)."></script>";
	}
}
add_action( 'admin_head', 'fcwp_addJs' );

function fcwp_addFormTemplate() {
	if(fcwp_checkPage()) {
		echo "<script type='text/html' id='fcwp_formTemplate'>".file_get_contents(plugins_url('assets/html/form.html', __FILE__))."</script>";	
	}	
}
add_action( 'admin_head', 'fcwp_addFormTemplate' );
?>