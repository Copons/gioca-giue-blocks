( function( $ ) {
	$( window ).on( 'scroll', debounce( function() {
		if ( window.innerWidth <= 600 && window.scrollY > 46 ) {
			$( '.gioca-giue-overlay' ).addClass( 'is-stuck-to-top' );
		} else {
			$( '.gioca-giue-overlay' ).removeClass( 'is-stuck-to-top' );
		}
	}, 100 ) );

	$( '.gioca-giue-overlay-toggle' ).on( 'click', () => {
		$( 'body' ).toggleClass( 'is-overlay-active' );
	} );
} )( jQuery );

function debounce ( callback, wait ) {
	let timeout = null;

	return ( ...args ) => {
		window.clearTimeout( timeout );
		timeout = window.setTimeout( () => {
			callback.apply( null, args );
		}, wait );
	};
}
