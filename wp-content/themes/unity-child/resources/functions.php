<?php

namespace App;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
  // Enqueue files for child theme (which include the core assets as imports)
  wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
  wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);

  // Set array of theme customizations for JS
  wp_localize_script( 'sage/main.js', 'simple_options', array('fonts' => get_theme_mod('theme_fonts'), 'colors' => get_theme_mod('theme_color')) );
}, 100);

/**
 * REMOVE WP EMOJI
 */
 remove_action('wp_head', 'print_emoji_detection_script', 7);
 remove_action('wp_print_styles', 'print_emoji_styles');
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Enable plugins to manage the document title
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
 */
add_theme_support('title-tag');

/**
 * Register navigation menus
 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
 */
register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage'),
    'social_links' => __('Social Links', 'sage')
]);

/**
 * Enable post thumbnails
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 */
add_theme_support('post-thumbnails');

/**
 * Enable HTML5 markup support
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
 */
add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

/**
 * Enable selective refresh for widgets in customizer
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
 */
add_theme_support('customize-selective-refresh-widgets');

/**
* Add support for Gutenberg.
*
* @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
*/
add_theme_support( 'align-wide' );
add_theme_support( 'disable-custom-colors' );
add_theme_support( 'wp-block-styles' );

/**
 * Enqueue editor styles for Gutenberg
 */
// function simple_editor_styles() {
//   wp_enqueue_style( 'simple-gutenberg-style', asset_path('styles/main.css') );
// }
// add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\simple_editor_styles' );

/**
 * Add image quality
 */
add_filter('jpeg_quality', function($arg){return 100;});

/**
 * Enable logo uploader in customizer
 */
add_image_size('simple-logo', 200, 200, false);
add_image_size('simple-logo-2x', 400, 400, false);
add_theme_support('custom-logo', array(
  'size' => 'simple-logo-2x'
));

/**
 * Set image sizes
 */
update_option( 'thumbnail_size_w', 300 );
update_option( 'thumbnail_size_h', 300 );
update_option( 'thumbnail_crop', 1 );
update_option( 'medium_size_w', 600 );
update_option( 'medium_size_h', 600 );
add_image_size('tiny-thumbnail', 80, 80, true);
add_image_size('small-thumbnail', 150, 150, true);
add_image_size('medium-square-thumbnail', 400, 400, true);


add_filter( 'image_size_names_choose', function( $sizes ) {
  return array_merge( $sizes, array(
    'tiny-thumbnail' => __( 'Tiny Thumbnail' ),
    'small-thumbnail' => __( 'Small Thumbnail' ),
    'medium-square-thumbnail' => __( 'Medium Square Thumbnail' ),
  ) );
} );

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
  $config = [
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ];
});

/**
 * Add case studies post type
 */
function add_post_type() {
 $argsCaseStudies = array(
   'labels' => array(
				'name' => 'Case Studies',
				'singular_name' => 'Case Study',
				'add_new' => 'Add New',
				'add_new_item' => 'Add New Case Study',
				'edit' => 'Edit',
				'edit_item' => 'Edit Case Study',
				'new_item' => 'New Case Study',
				'view_item' => 'View Case Study',
				'search_items' => 'Search Case Studies',
				'not_found' =>  'Nothing found in the Database.',
				'not_found_in_trash' => 'Nothing found in Trash',
				'parent_item_colon' => ''
   ),
   'public' => true,
   'exclude_from_search' => false,
   'publicly_queryable' => true,
   'show_ui' => true,
   'show_in_nav_menus' => false,
   'menu_position' => 20,
   'menu_icon' => 'dashicons-megaphone',
   'capability_type' => 'page',
   'hierarchical' => false,
   'supports' => array(
     'title',
     'editor',
     'revisions',
     'page-attributes',
     'thumbnail'
   ),
   'has_archive' => false,
   'rewrite' => array(
     'slug' => 'case-study'
   )
 );
 register_post_type( 'ff-case-study', $argsCaseStudies );

 $argsCompanies = array(
   'labels' => array(
				'name' => 'Companies',
				'singular_name' => 'Company',
				'add_new' => 'Add New',
				'add_new_item' => 'Add New Company',
				'edit' => 'Edit',
				'edit_item' => 'Edit Company',
				'new_item' => 'New Company',
				'view_item' => 'View Company',
				'search_items' => 'Search Companies',
				'not_found' =>  'Nothing found in the Database.',
				'not_found_in_trash' => 'Nothing found in Trash',
				'parent_item_colon' => ''
   ),
   'public' => false,
   'exclude_from_search' => true,
   'publicly_queryable' => true,
   'show_ui' => true,
   'show_in_nav_menus' => false,
   'menu_position' => 21,
   'menu_icon' => 'dashicons-groups',
   'capability_type' => 'page',
   'hierarchical' => false,
   'supports' => array(
     'title',
     'revisions',
     'page-attributes',
   ),
   'has_archive' => false,
   'rewrite' => false
 );
 register_post_type( 'ff-company', $argsCompanies );
}
add_action( 'init', __NAMESPACE__.'\\add_post_type' );
