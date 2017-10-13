<?php

function theme_scripts() {

	// css
	wp_enqueue_style( 'theme-name-css', get_template_directory_uri() . '/css/theme-name.min.css', array(), '20171013' );

	// js
	wp_enqueue_script( 'theme-name-js', get_template_directory_uri() . '/js/theme-name.min.js', array(), '20171013', true );

	// Moves all scripts to wp_footer action
	remove_action('wp_head', 'wp_print_scripts');
	remove_action('wp_head', 'wp_print_head_scripts', 9);
	remove_action('wp_head', 'wp_enqueue_scripts', 1);
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );
