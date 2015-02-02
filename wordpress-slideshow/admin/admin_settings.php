<?php

/**
 *  Admin Setting Page
 */
add_action( 'admin_menu', 'register_bxslider_menu_page' );
function register_bxslider_menu_page()
{
	add_menu_page("BxSlider Settings", "BxSlider", "manage_options", "custom-bxslider","bx_slider_settings");
}

/**
 *  functions callback bxslider settings
 */
function bx_slider_settings() 
{
	//save the data
	if($_SERVER['REQUEST_METHOD']=="POST") {
		if(isset($_POST['bx_slides']) && $_POST['bx_slides']!="") {
			update_option("bx_slides", $_POST['bx_slides']);
		} else {
			delete_option("bx_slides");
		}
	}
	$arrSlidesId=get_option("bx_slides");
?>
		<div class="wrap">
			<h2>Custom BxSlider</h2>
			<fieldset>
				<legend>Slides</legend>
					<button type="button" class="button" id="addSlides">Add Slides</button>
					<form action="" method="post" class="clear">
						<ul id="Slides">
							<?php
							if($arrSlidesId) {
								foreach($arrSlidesId as $intSlideId) {
							?>
							<li style="list-style-type:none;" class="bx_thumbnails" title="Drag and drop to sort the item">
								<div><span class="bx-movable"></span>
									<a href="javascript:void(0);" class="bx_remove_item" title="Click to delete this item"><span>delete</span></a>
									<?php echo wp_get_attachment_image($intSlideId); ?>
									<input type="hidden" name="bx_slides[]" value="<?php echo $intSlideId;?>" />
								</div>
							</li>
							<?php 
								}
							}
							?>
						</ul>
						<br class="clear" />
						<button type="submit" class="button button-primary button-large clear">Save</button>
					</form>
			</fieldset>
		</div>
	<?php 
}

/**
 * register scripts and css required
 */
 add_action("admin_head", "register_header_files");
 
 function register_header_files(){
 	//register scripts
 	wp_register_script("bxslider-admin", plugin_dir_url(__FILE__)."js/custom-admin.js",array("jquery"));
 	
 	//register stryles
	wp_register_style("jqueryui", plugin_dir_url(__FILE__)."css/jquery-ui.css");
	wp_register_style("custom-admin", plugin_dir_url(__FILE__)."css/custom-admin.css");
	
	// enque scripts
	wp_enqueue_script("jquery");
 	wp_enqueue_script("jquery-ui-core");
 	wp_enqueue_script("jquery-ui-widget");
 	wp_enqueue_script("jquery-ui-sortable");
 	wp_enqueue_script("bxslider-admin");
 	
 	// enque media for uplod frame
 	wp_enqueue_media();
 	
 	// enque styles
 	wp_enqueue_style("jqueryui");
 	wp_enqueue_style("custom-admin");
 }