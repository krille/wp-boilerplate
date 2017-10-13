<?php

if ( ! function_exists( 'theme_setup' ) ) :
	function theme_setup() {

		// Enable title tag
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'thumb', 600, 600, true );
		add_image_size( 'thumb-large', 1200, 1200, true );
		add_image_size( 'widescreen', 1200, 630, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main-nav' => 'Navigation'
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	}
endif;
add_action( 'after_setup_theme', 'theme_setup' );



/*
 * Remove default image sizes
 */
function remove_default_image_sizes( $sizes ) {
	unset( $sizes[ 'thumbnail' ]);
	unset( $sizes[ 'medium' ]);
	unset( $sizes[ 'medium_large' ]);
	unset( $sizes[ 'large' ]);

	return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'remove_default_image_sizes' );



/*
 * Add new image sizes to back office
 */
function add_new_image_sizes($sizes) {
	$new_sizes = array(
		'thumb' 	 => 'Square',
		'widescreen' => 'Widescreen'
	);

   return array_merge($sizes, $new_sizes);
}
add_filter('image_size_names_choose', 'add_new_image_sizes');



/*
 * WP-Admin TinyMCE stylesheet
 */
add_editor_style( 'css/theme-name.min.css' );



/*
 * Facebook OG-meta
 */
function add_opengraph_doctype($output) {
	return $output . '
	xmlns="https://www.w3.org/1999/xhtml"
	xmlns:og="https://ogp.me/ns#"
	xmlns:fb="http://www.facebook.com/2008/fbml"';
}

function facebook_open_graph() {

	global $post;

	// Single pages
	if ( is_singular() ) {

		// Site name and URL
		echo '<meta property="og:url" content="' . get_permalink() . '"/>';
		echo '<meta property="og:site_name" content="THEME-NAME.se"/>';

		// Image
		if( has_post_thumbnail( $post->ID ) ) {
			$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'widescreen' );
			echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
		}
		else {
			$default_image = get_template_directory_uri() . '/img/og-image.png';
			echo '<meta property="og:image" content="' . $default_image . '"/>';
		}

		if ( !empty($post->post_content) ) {
			$excerpt = wp_trim_words( $post->post_content, 20, '' );
		}
		else {
			$excerpt = get_bloginfo('description');
		}

		echo '<meta property="og:title" content="' . get_the_title() . '"/>';
		echo '<meta property="og:description" content="' . $excerpt . '"/>';
		echo '<meta property="og:type" content="article"/>';
	}
}
add_filter('language_attributes', 'add_opengraph_doctype');
add_action( 'wp_head', 'facebook_open_graph', 5 );
