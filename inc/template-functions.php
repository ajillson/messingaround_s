<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Messing_Around
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function messingaround_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'messingaround_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function messingaround_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'messingaround_pingback_header' );

/**
 * Post navigation (previous / next post) for single posts.
 */
function messingaround_post_navigation() {
	the_post_navigation( array(
		'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'humescores' ) . '</span> ' .
			'<span class="screen-reader-text">' . __( 'Next post:', 'humescores' ) . '</span> ' .
			'<span class="post-title">%title</span>',
		'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'humescores' ) . '</span> ' .
			'<span class="screen-reader-text">' . __( 'Previous post:', 'humescores' ) . '</span> ' .
			'<span class="post-title">%title</span>',
	) );
}