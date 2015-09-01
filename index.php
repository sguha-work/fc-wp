<?php
/**
 * @package Fc-wp
 * @version 0.1
 */
/*
Plugin Name: Fusionchart For Wordpress
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: This is a plugin of FusionCharts for wordpress to add interactive chart in your post or page
Author: Angshu Guha
Version: 0.1
Author URI: 
*/

// function hello_dolly_get_lyric() {
// 	/** These are the lyrics to Hello Dolly */
// 	$lyrics = "Hello, Dolly";

// 	// Here we split it into lines
// 	$lyrics = explode( "\n", $lyrics );

// 	// And then randomly choose a line
// 	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
// }

// This just echoes the chosen line, we'll position it later
function fcWpShowButton() {
	echo "<a id='fcwp_button'>$chosen</a>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'fcWpShowButton' );

// We need some CSS to position the paragraph
// function dolly_css() {
// 	// This makes sure that the positioning is also good for right-to-left languages
// 	$x = is_rtl() ? 'left' : 'right';

	// echo "
	// <style type='text/css'>
	// #dolly {
	// 	float: $x;
	// 	padding-$x: 15px;
	// 	padding-top: 5px;		
	// 	margin: 0;
	// 	font-size: 11px;
	// }
	// </style>
	// ";
// }

function addButtonCss() {
	$x = is_rtl() ? 'left' : 'right';
	echo "
		<style type='text/css'>
			#fcwp_button {
				float: $x;
				padding-$x: 15px;
				padding-top: 5px;		
				margin: 0;
				font-size: 11px;
			}
		</style>
	";
}

add_action( 'admin_head', 'addButtonCss' );

?>
