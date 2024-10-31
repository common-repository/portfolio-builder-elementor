<?php 
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}
/*
 * @package portfolio builder
 * since 1.0.0
 * 
*/

 //select category
function portfolio_builder_elementor_post_category() {

  $terms = get_terms( array(
    'taxonomy'       => 'portfolio-category',
    'hide_empty'     => false,
    'posts_per_page' => - 1,
  ) );

  $category_list = [];
  foreach ( $terms as $post ) {
    $category_list[ $post->term_id ] = [ $post->name ];
  }

  return $category_list;

}

//select post 
function portfolio_builder_elementor_select_post() {

  $args       = array( 'post_type' => 'portfolio', 'posts_per_page' => - 1 );
  $post_lists = [];

  if ( $postlists = get_posts( $args ) ) {
    foreach ( $postlists as $postlist ) {
      (int) $post_lists[ $postlist->ID ] = $postlist->post_title;
    }
  } else {
    (int) $post_lists['0'] = esc_html__( 'No Post Found', 'swp-portfolio' );
  }

  return $post_lists;

}

function portfolio_builder_elementor_get_cat_name( $cat_id ) {
  $cat_id   = (int) $cat_id;
  $category = get_term( $cat_id, 'portfolio-category' );

  if ( ! $category || is_wp_error( $category ) ) {
    return '';
  }

  return $category->name;
}

// caategory slug
function portfolio_builder_elementor_get_cat_slug( $cat_id ) {
  $cat_id   = (int) $cat_id;
  $category = get_term( $cat_id, 'portfolio-category' );

  if ( ! $category || is_wp_error( $category ) ) {
    return '';
  }

  return $category->slug;
}


 add_filter('single_template',  'portfolio_builder_elementor_template');

  function portfolio_builder_elementor_template($template)
    {
        global $post;

        if ('portfolio' === $post->post_type && locate_template(array('single-portfolio.php')) !== $template) {
            /*
            * This is a 'portfolio' post
            * AND a 'single portfolio template' is not found on
            * theme or child theme directories, so load it
            * from our plugin directory.
            */
            return PORTFOLIO_BUILDER_ELEMENTOR_ROOT_PATH . '/single/single-portfolio.php';
        }

        return $template;
    }

// set image size

add_image_size( 'swp-portfolio-general', 550, 390, true );
add_image_size( 'swp-portfolio-card', 350, 350, true );
add_image_size( 'swp-portfolio-related', 357, 357, true );
add_image_size( 'swp-portfolio-isotope', 255, 255, true );
add_image_size( 'swp-portfolio-isotope-two', 540, 370, true );
add_image_size( 'swp-portfolio-slider', 350, 240, true );
add_image_size( 'swp-portfolio-slider-two', 570, 390, true );
add_image_size( 'swp-portfolio-masonry', 350, 0, true );
add_image_size( 'swp-portfolio-masonry-two', 370, 0, true );
add_image_size( 'swp-portfolio-masonry-three', 255, 0, true );
add_image_size( 'swp-portfolio-masonry-four', 285, 0, true );


