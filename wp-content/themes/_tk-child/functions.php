<?php

function theme_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );
    wp_enqueue_script('child-slider', get_stylesheet_directory_uri() . '/includes/js/slider.js', array('jquery') );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );


register_nav_menus( array(
	'top'  => __( 'Header top menu', '_tk-child' ),
) );

add_theme_support( 'post-thumbnails' );

// add more link to excerpt
function themify_custom_excerpt_more($more) {
   global $post;
   return '<a class="more-link" href="'. get_permalink($post->ID) . '">'. __('Read More', 'themify') .'</a>';
}
add_filter('excerpt_more', 'themify_custom_excerpt_more');


function custom_excerpt_length( $length ) {
	return $length;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 100 );

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'about', __( 'About Menu', '_tk-child' ) );
}


function my_post_queries( $query ) {
  // not an admin page and it is the main query
  if (!is_admin() && $query->is_main_query()){

    if(is_tax()){
      // show 50 posts on custom taxonomy pages
      $query->set('posts_per_page', 50);
    }
  }
}
add_action( 'pre_get_posts', 'my_post_queries' );

?>