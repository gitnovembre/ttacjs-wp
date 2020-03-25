<?php
if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['ttacjs_image'] ) ) :
		update_option( 'ttacjs_image', absint( $_POST['ttacjs_image'] ) );
	endif;
	wp_enqueue_media();
	?>
    <div class='image-preview-wrapper'>
        <img id='image-preview' src='<?php echo wp_get_attachment_url( get_option( 'ttacjs_image' ) ); ?>' width='200'>
	</div>
	<label for="">Pour les images "carrées", il est conseillé d'uploader une image de max 90-100px de large.</label><br />
    <input id="upload_image_button" type="button" class="button" value="<?php _e( 'Ajouter une image' ); ?>" />
    <input type='hidden' name='ttacjs_image' id='ttacjs_image' value='<?php echo get_option( 'ttacjs_image' ); ?>'>
<?php
$my_saved_attachment_post_id = get_option( 'ttacjs_image', 0 );
if($my_saved_attachment_post_id == '') { $my_saved_attachment_post_id = 0; }
	?><script type='text/javascript'>
		jQuery( document ).ready( function( $ ) {
			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
			jQuery('#upload_image_button').on('click', function( event ){
				event.preventDefault();
				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					// Set the post ID to what we want
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
					// Open frame
					file_frame.open();
					return;
				} else {
					// Set the wp.media post id so the uploader grabs the ID we want when initialised
					wp.media.model.settings.post.id = set_to_post_id;
				}
				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Séléctionner une image',
					button: {
						text: 'Utiliser cette image',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});
				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();
					// Do something with attachment.id and/or attachment.url here
					$( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
					$( '#ttacjs_image' ).val( attachment.id );
					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});
					// Finally, open the modal
					file_frame.open();
			});
			// Restore the main ID when the add media button is pressed
			jQuery( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
		});
	</script>