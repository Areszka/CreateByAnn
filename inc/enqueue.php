<?php

/**
 * Understrap enqueue scripts
 *
 * @package understrap
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (!function_exists('understrap_scripts')) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function understrap_scripts()
	{
		// Get the theme data.
		$the_theme = wp_get_theme();
		$theme_version = $the_theme->get('Version');

		wp_enqueue_style('styles', get_template_directory_uri() . '/bundle/style.bundle.css');
		
		$js_version = $theme_version . '.' . filemtime(get_template_directory() . '/bundle/main.bundle.js');
		wp_enqueue_script('scripts', get_template_directory_uri() . '/bundle/main.bundle.js', array(), $js_version, true);
		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}
} // endif function_exists( 'understrap_scripts' ).

add_action('wp_enqueue_scripts', 'understrap_scripts');
