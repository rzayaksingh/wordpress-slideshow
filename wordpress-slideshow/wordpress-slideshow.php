<?php
/*
Plugin Name: Wordpress slideshow
Plugin URI: 
Description: please put [myslideshow] shotcode, It uses <a href="http://bxslider.com/">BXSlider</a>
Author: Rzayak Singh Oberoi
Version: 1.0
Author URI : 
Licence: GLP V2
*/

if(is_admin()) {
	require_once plugin_dir_path(__FILE__).'/admin/admin_settings.php';
}

/**
 * Add Shortcode for triggering slideshow
 * 
 */
add_shortcode("myslideshow", "displayBxslider");
function displayBxslider()
{
	$arrSlidesId=get_option("bx_slides");
	if($arrSlidesId) {
?>
		<ul class="bxslider">
		<?php
			foreach ($arrSlidesId as $intSlideId){				
		?>		<li><?php echo wp_get_attachment_image($intSlideId,"full"); ?></li>
		<?php 
			}
		?>
		</ul>
	<?php
	} else {
		echo "<h4>Please upload some images !</h4>";
	}
}

/**
 * register scripts and css required
 * 
 */
add_action("wp_head","bxsliderLoadHeaders");

function bxsliderLoadHeaders()
{
	//register scripts	
	wp_register_script("bxslider-js", plugin_dir_url(__FILE__)."lib/jquery.bxslider/jquery.bxslider.min.js",array("jquery"));
	wp_register_script("custom-bxslider-js", plugin_dir_url(__FILE__)."js/boxslider-custom.js",array("jquery","bxslider-js"));
	
	//register styles
	wp_register_style("bxslider-css", plugin_dir_url(__FILE__)."lib/jquery.bxslider/jquery.bxslider.css");
	wp_register_style("custom-bxslider-css", plugin_dir_url(__FILE__)."css/bx-slideshow.css");
	
	//enque scripts
	wp_enqueue_script("jquery");
	wp_enqueue_script("bxslider-js",array("jquery"));
	wp_enqueue_script("custom-bxslider-js",array("jquery","bxslider-js"));
	
	//enque styles
	wp_enqueue_style("bxslider-css");
	wp_enqueue_style("custom-bxslider-css");	
}