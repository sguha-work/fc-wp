<?php
	
	function fcwp_checkPage() {
		$referPage = $_SERVER['PHP_SELF'];
		if(strpos($referPage,"post.php")!==false || strpos($referPage,"post-new.php")!==false) {
			return 1;
		}
		return 0;
	}

	function fcwp_showButton() {
		if(fcwp_checkPage()) {
			echo "<a href='javascript:void(0)' id='fcwp_button'><img height='20' width='20' src='".plugins_url('assets/images/fc.png', __FILE__)."'>&nbsp;&nbsp;&nbsp;Create FusionCharts for this Page/Post</a>";
		}
	}

	function fcwp_addCss() {
		if(fcwp_checkPage()) {
			wp_enqueue_style(
				'button-style',
				plugins_url('assets/css/button-style.css', __FILE__)	
			);
			wp_enqueue_style(
				'form-style',
				plugins_url('assets/css/form-style.css', __FILE__)	
			);
		}
	}

	function fcwp_addScript() {
		if(fcwp_checkPage()) {
			echo "<script type='text/javascript'>window.fcwp_main = {};fcwp_main.fcwp_pluginPath = '".plugins_url('assets/',__FILE__)."'.split('assets/')[0];</script>";
			wp_enqueue_script(
				'chart-type',
				plugins_url( 'assets/js/chart-types.js' , __FILE__ )
			);
			wp_enqueue_script(
				'form-function',
				plugins_url( 'assets/js/form-function.js' , __FILE__ )
			);
			wp_enqueue_script(
				'button-function',
				plugins_url( 'assets/js/button-function.js' , __FILE__ )
			);
		}
	}

	function fcwp_addFormTemplate() {
		if(fcwp_checkPage()) {
			echo "<script type='text/html' id='fcwp_formTemplate'>".file_get_contents(plugins_url('assets/html/form.html', __FILE__))."</script>";	
		}	
	}

	function fcwp_getChart() {
		include_once 'fusioncharts.php';
		$fcwp_chart;
	    if(isset($_POST['chartDataType'])&&sanitize_text_field($_POST['chartDataType'])!="jsonurl"&&sanitize_text_field($_POST['chartDataType'])!="xmlurl") {
	        $fcwp_chart = new fcwp_FusionCharts(
	            sanitize_text_field($_POST['chartType']), 
	            sanitize_text_field($_POST['chartId']), 
	            sanitize_text_field($_POST['chartWidth']), 
	            sanitize_text_field($_POST['chartHeight']), 
	            sanitize_text_field($_POST['chartContainerId']), 
	            sanitize_text_field($_POST['chartDataType']), 
	            '{  
	               "chart":
	               {  
	                  "caption":"'.sanitize_text_field($_POST['chartTitle']).'",
	                  "subCaption":"",
	                  "theme":"ocean"
	               },
	               "data":'.sanitize_text_field($_POST['chartData']).'
	        }');    
	    } else {
	        $fcwp_chart = new fcwp_FusionCharts(
	            sanitize_text_field($_POST['chartType']), 
	            sanitize_text_field($_POST['chartId']), 
	            sanitize_text_field($_POST['chartWidth']), 
	            sanitize_text_field($_POST['chartHeight']), 
	            sanitize_text_field($_POST['chartContainerId']), 
	            sanitize_text_field($_POST['chartDataType']), 
	            sanitize_text_field($_POST['chartData'])
	        );
	    }
	    echo "<div id='".sanitize_text_field($_POST['chartContainerId'])."'></div><script type='text/javascript' src='".plugins_url('assets/',__FILE__)."fc-assets/fusioncharts.js'></script>".$fcwp_chart->fcwp_render();
		wp_die();
	}

?>