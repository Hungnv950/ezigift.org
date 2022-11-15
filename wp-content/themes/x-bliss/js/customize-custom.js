( function( $, api ) {

	$( document ).ready( function( $ ) {

		$( '#customize-control-theme_options-featured_banner_status' ).on('change',function(){
			var selected_value = $(this).find('option:selected').val();
			if ( 'disabled' !== selected_value ) {
				$('#customize-control-theme_options-featured_slider_status').find('select').val('disabled').trigger('change');
			}
		});

		$( '#customize-control-theme_options-featured_slider_status' ).on('change',function(){
			var selected_value = $(this).find('option:selected').val();
			if ( 'disabled' !== selected_value ) {
				$('#customize-control-theme_options-featured_banner_status').find('select').val('disabled').trigger('change');
			}
		});

	});

} )( jQuery, wp.customize );
