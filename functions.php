<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/editor.php',   
	'/custom-fields.php',                       // Load Editor functions.
);

foreach ( $understrap_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

function category_custom_post_type() {
	$args = array(
        'labels' => array(
            'name' => esc_attr__('Produkty'),
			'singular_name' => esc_attr__('Produkt'),
			'add_new' => 'Dodaj nowy produkt',
        ),
        'public' => true,
		'has_archive' => false,
		'hierarchical' => true,
		'taxonomies' => array('category', 'post_tag'),
        'supports' => array('thumbnail', 'title', 'editor'),
	);
	register_post_type('product', $args );
}
add_action('init', 'category_custom_post_type');
