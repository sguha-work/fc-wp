<?php
/**
 * @package Fc-wp
 * @version 0.1
 */
/*
Plugin Name: Fusionchart For Wordpress
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: This is a plugin of FusionCharts for wordpress to add interactive chart in your post or page
Author: Sahasrangshu Guha
Version: 0.1
Author URI: 
*/
function checkPage() {
	$referPage = $_SERVER['PHP_SELF'];
	if(strpos($referPage,"post.php")!==false || strpos($referPage,"post-new.php")!==false) {
		return 1;
	}
	return 0;
}
// This just echoes the chosen line
function fcWpShowButton() {
	if(checkPage()) {
		echo "<a href='javascript:void(0)' id='fcwp_button'>Create fusionchart for this Page/Post</a>";
	}
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'fcWpShowButton' );

function addButtonCss() {
	if(checkPage()) {
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
}

add_action( 'admin_head', 'addButtonCss' );

// function addButtonJs() {
// 	if(checkPage()) {

// 	}
// }
// add_action( 'admin_head', 'addButtonJs' );

?>
