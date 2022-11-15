( function( $ ) {

  $(document).ready(function($){


  	// Search in Header.

    if( $('.search-icon').length > 0 ) {
      $('.search-icon').click(function(e){
        e.preventDefault();
        $('.search-box-wrap').slideToggle();
      });
    }

    // Trigger mobile menu.
    $('#mobile-trigger').sidr({
		timing: 'ease-in-out',
		speed: 500,
		source: '#mob-menu',
		name: 'sidr-main'
    });

    // Implement go to top.
    if ( 1 === parseInt( X_Bliss_Custom_Options.go_to_top_status, 10 ) ) {
    	var $scroll_obj = $( '#btn-scrollup' );
    	$( window ).scroll(function(){
    		if ( $( this ).scrollTop() > 100 ) {
    			$scroll_obj.fadeIn();
    		} else {
    			$scroll_obj.fadeOut();
    		}
    	});

    	$scroll_obj.click(function(){
    		$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
    		return false;
    	});
    } // End if go to top.

  });

} )( jQuery );
