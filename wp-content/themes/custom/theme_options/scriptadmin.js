jQuery(document).ready(function() {

/* ==========================================================================
   Logo Uploader
   ========================================================================== */


	jQuery('.image_button').live('click', function() {
	
		wp.media.editor.send.attachment = function(props, attachment) {
			jQuery('.logo_image').val(attachment.url);
		}

		wp.media.editor.open(this);

		return false;
	});
	
/* ==========================================================================
   Slider Items Uploader
   ========================================================================== */	
	
	jQuery('.sliderbutton').live('click', function() {
	
		var i = jQuery(this).attr('id');
	
		wp.media.editor.send.attachment = function(props, attachment) {
			jQuery('.slider_image_'+i).val(attachment.url);
		}

		wp.media.editor.open(this);

		return false;
	});		

/* ==========================================================================
   Slider Add Item
   ========================================================================== */	
	
	var scntDiv = jQuery('#p_scents');
	var i = jQuery('#p_scents p').size();
	
	jQuery('#addScnt').live('click', function() {
		jQuery('<p><label for="p_scnts"><input type="text" id="p_scnt" size="80" name="lupercalia_options[frontpage_branding_field][slider_image][' + i + ']" value="Slider ' + i + ' Image" class="slider_image_' + i + '" /> <input type="submit" class="button sliderbutton" id="'+i+'" value="Upload Image" /> </label><br /><label for="p_scnts"><input type="text" id="p_scnt" size="80" name="lupercalia_options[frontpage_branding_field][slider_title][' + i + ']" value="Slider ' + i + ' title" /></label><br /><label for="p_scnts"><input type="text" id="p_scnt" size="80" name="lupercalia_options[frontpage_branding_field][slider_desc][' + i + ']" value="Slider ' + i + ' Decription" /></label> <a href="#" id="remScnt">Remove item</a></p>').appendTo(scntDiv);
		i++;
			return false;
	});
	
/* ==========================================================================
   Sidebar Remove Item
   ========================================================================== */	
	
	jQuery('#remScnt').live('click', function() { 
			if( i > 1 ) {
				jQuery(this).parents('p').remove();
				i--;
			}
			return false;
	});	

});




