<?php

define( 'MATERIAL_SYMBOLS', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200' );

function gioca_giue_after_setup_theme() {
	add_editor_style( [ 'style.css', MATERIAL_SYMBOLS ] );
}
add_action( 'after_setup_theme', 'gioca_giue_after_setup_theme' );

function gioca_giue_enqueue_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );
	$version_string = is_string( $theme_version ) ? $theme_version : false;

	wp_enqueue_style( 'gioca-giue-icons', MATERIAL_SYMBOLS, [], false );
	wp_enqueue_style( 'gioca-giue-style', get_stylesheet_uri(), [], $version_string );

	wp_enqueue_script(
		'gioca-giue-overlay',
		get_template_directory_uri() . '/scripts/overlay.js',
		['jquery'],
		$version_string,
		true
	);

	wp_enqueue_script(
		'gioca-giue-magnific-popup-library',
		get_template_directory_uri() . '/assets/vendors/magnific-popup.min.js',
		['jquery'],
		false,
		true
	);
	wp_enqueue_script(
		'gioca-giue-magnific-popup',
		get_template_directory_uri() . '/scripts/magnific-popup.js',
		['jquery', 'gioca-giue-magnific-popup-library'],
		false,
		true
	);
	wp_enqueue_style(
		'gioca-giue-magnific-popup-library',
		get_template_directory_uri() . '/assets/vendors/magnific-popup.css',
		[],
		false
	);
}
add_action( 'wp_enqueue_scripts', 'gioca_giue_enqueue_scripts' );


/**
 * Turn comments into querele
 */

function gioca_giue_comment_form_defaults( $fields ) {
	$fields['title_reply'] = __( 'Querela', 'gioca-giue' );
	$fields['title_reply_to'] = __( 'Querela %s', 'gioca-giue' );
	$fields['cancel_reply_link'] = __( 'Cancella controquerela', 'gioca-giue' );
	$fields['label_submit'] = __( 'Invia Querela', 'gioca-giue' );

	return $fields;
}
add_filter( 'comment_form_defaults', 'gioca_giue_comment_form_defaults', 20, 1 );

function gioca_giue_comment_reply_link_args( $args, $comment, $post ) {
	$args['reply_text'] = __( 'Controquerela', 'gioca-giue' );
	$args['reply_to_text'] = __( 'Controquerela %s', 'gioca-giue' );

	return $args;
}
add_filter( 'comment_reply_link_args', 'gioca_giue_comment_reply_link_args', 20, 3 );

function gioca_giue_gettext( $translation, $text, $domain ) {
	switch ( $text ) {
		// core/post-comments-link
		case 'No comments<span class="screen-reader-text"> on %s</span>':
			return __( '0 querele', 'gioca-giue' );

		// core/comments-pagination-next
		case 'Newer Comments':
			return __( 'Prossime Querele', 'gioca-giue' );

		// core/comments-pagination-previous
		case 'Older Comments':
			return __( 'Querele Precedenti', 'gioca-giue' );

		// core/comments-title
		case 'One response to %s':
			return __( 'Una querela a %s', 'gioca-giue' );
		case 'One response':
			return __( 'Una querela', 'gioca-giue' );
		case 'Response to %s':
			return __( 'Querela a %s', 'gioca-giue' );
		case 'Responses to %s':
			return __( 'Querele a %s', 'gioca-giue' );
		case 'Response':
			return __( 'Querela', 'gioca-giue' );
		case 'Responses':
			return __( 'Querele', 'gioca-giue' );
	}

	return $translation;
}
add_filter( 'gettext', 'gioca_giue_gettext', 20, 3 );

function gioca_giue_gettext_with_context( $translation, $text, $context, $domain ) {
	// wp-includes/comment-template.php
	if ( $text === 'Comment' && $context === 'noun' ) {
		return _x( 'Querela', 'noun', 'gioca-giue' );
	}

	return $translation;
}
add_filter( 'gettext_with_context', 'gioca_giue_gettext_with_context', 20, 4 );

function gioca_giue_ngettext( $translation, $single, $plural, $number, $domain ) {
	// core/post-comments-link
	if (
		$single === '%1$s comment<span class="screen-reader-text"> on %2$s</span>' &&
		$plural === '%1$s comments<span class="screen-reader-text"> on %2$s</span>'
	) {
		return _n( '%1$s querela', '%1$s querele', $number, 'gioca-giue' );
	}

	// core/comments-title
	if ( $single === '%1$s response to %2$s' && $plural === '%1$s responses to %2$s' ) {
		return _n( '%1$s querela a %2$s', '%1$s querele a %2$s', $number, 'gioca-giue' );
	}
	if ( $single === '%s response' && $plural === '%s responses' ) {
		return _n( '%s querela', '%s querele', $number, 'gioca-giue' );
	}

	return $translation;
}
add_filter( 'ngettext', 'gioca_giue_ngettext', 20, 5 );
