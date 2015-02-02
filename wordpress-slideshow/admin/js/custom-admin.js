jQuery(document).ready(function(){
	// add images with wordpress upload frame
	jQuery('#addSlides').click(function(e) {

		e.preventDefault();
		frame = wp.media({
			title : 'Choose Images for Slide',
			frame: 'post',
			multiple : true, // set to false if you want only one image
			library : { type : 'image'},
			button : { text : 'Add Image' },
		});

		frame.on('close',function(data) {
			var imageArray = [];
			images = frame.state().get('selection');
			images.each(function(image) {
				imageArray.push(image.attributes.url); // want other attributes? Check the available ones with 
				//console.log(image.attributes);
				the_list = '<li style="list-style-type:none;" class="bx_thumbnails" title="Drag and drop to sort the item"><div><span class="bx-movable"></span><a href="javascript:void(0);" class="bx_remove_item" title="Click to delete this item"><span>delete</span></a><img src="'+ image.attributes.sizes.thumbnail.url +'"><input type="hidden" name="bx_slides[]" value="'+ image.id +'" /></div></li>';
				jQuery("#Slides").append(the_list);
			});

			jQuery(".bx_remove_item").click(function() {
				jQuery(this).parent().parent().remove();
			});


		});
		frame.open()
	});
	
	// make it jqueryui sortable
	jQuery("#Slides").sortable();
	
	// remove images
	jQuery(".bx_remove_item").click(function() {
		jQuery(this).parent().parent().remove();
	});
});