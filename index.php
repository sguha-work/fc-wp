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


// This just echoes the chosen line
function fcWpShowButton() {
	$referPage = $_SERVER['PHP_SELF'];
	if(strpos($referPage,"post.php")!==false || strpos($referPage,"post-new.php")!==false) {
		echo "<a href='javascript:void(0)' id='fcwp_button'>Create fusionchart for this Page/Post</a>";
	}
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'fcWpShowButton' );

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
