( function( $ ) {
	const $images = $( "a[href*='.jpg'], a[href*='.jpeg'], a[href*='.gif'], a[href*='.png'], a[href*='.JPG'], a[href*='.JPEG'], a[href*='.GIF'], a[href*='.PNG'], a[href*='.webp'], a[href*='.WEBP']" );

	$images.each( function() {
		if (
			$( this ).next().is( 'figcaption' ) ||
			$( this ).next().hasClass( 'wp-element_caption' ) ||
			$( this ).next().hasClass( 'wp-caption-text' )
		) {
			$( this ).attr( 'title', '<span>' + $( this ).next().html() + '</span>' );
		}
	} );

	$images.magnificPopup( {
		closeOnContentClick: true,
		image: { verticalFit: true },
		type: 'image',
		zoom: { enabled: true },
	} );
} )( jQuery );
