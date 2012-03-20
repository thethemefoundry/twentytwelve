/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */

jQuery( document ).ready( function( $ ) {
	var browserWidth = $( window ).width(),
	    masthead = $( '#masthead' );

	$.fn.smallMenu = function() {
		$( masthead ).find( '.site-navigation' ).removeClass( 'main-navigation' ).addClass( 'main-small-navigation' );
		$( masthead ).find( '.site-navigation h3' ).removeClass( 'assistive-text' ).addClass( 'menu-toggle' );

		$( '.menu-toggle' ).click( function() {
			$( masthead ).find( '.menu' ).toggle();
			$( this ).toggleClass( 'toggled-on' );
		} );
	};

	$( window ).resize( function() {
		if ( browserWidth < 600 ) {
			$.fn.smallMenu();
		} else {
			$( masthead ).find( '.site-navigation' ).removeClass( 'main-small-navigation' ).addClass( 'main-navigation' );
			$( masthead ).find( '.site-navigation h3' ).removeClass( 'menu-toggle' ).addClass( 'assistive-text' );
			$( masthead ).find( '.menu' ).removeAttr( 'style' );
		}
	} );

	if ( browserWidth < 600 ) {
		$.fn.smallMenu();
	}
} );
