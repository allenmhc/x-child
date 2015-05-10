<?php

// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Overwrite or add your own custom functions to X in this file.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Parent Stylesheet
//   02. Additional Functions
// =============================================================================

// Enqueue Parent Stylesheet
// =============================================================================

add_filter( 'x_enqueue_parent_stylesheet', '__return_true' );



// Additional Functions
// =============================================================================

if (! function_exists('x_child_body_class_info')):
  function x_child_body_class_info ($output) {
    if (is_page_template('template-categories.php')) {
      $output[] .= 'blog';
    }
    return $output;
  }
endif;

add_filter( 'body_class', 'x_child_body_class_info', 20000 );

// Post Categories
// =============================================================================

if ( ! function_exists( 'x_ethos_post_categories' ) ) :
  function x_ethos_post_categories() {

    $categories      = get_the_terms( get_the_ID(), 'category' );
    $separator       = " &sdot; ";
    $categories_list = '';

    foreach ( $categories as $category ) {
      $categories_list .= $category->name . $separator;
    }

    $categories_output = trim( $categories_list, $separator );

    return $categories_output;

  }
endif;


// Child CSS rules
// =============================================================================

wp_enqueue_style('x-child-app',
  get_stylesheet_directory_uri() . '/framework/css/app.css',
  array('x-child'));


// Get Content Layout
// =============================================================================

//
// First checks if the global content layout is "full-width." If the global
// content layout is not "full-width," (i.e. displays a sidebar) then it runs
// through all possible pages to determine the correct layout for that template.
//

if ( ! function_exists( 'x_get_content_layout' ) ) :
  function x_get_content_layout() {

    $content_layout = x_get_option( 'x_layout_content', 'content-sidebar' );

    if ( $content_layout != 'full-width' ) {
      if ( is_home() ) {
        $opt    = x_get_option( 'x_blog_layout', 'sidebar' );
        $layout = ( $opt == 'sidebar' ) ? $content_layout : $opt;
      } elseif ( is_singular( 'post' ) ) {
        $meta   = get_post_meta( get_the_ID(), '_x_post_layout', true );
        $layout = ( $meta == 'on' ) ? 'full-width' : $content_layout;
      } elseif ( x_is_portfolio_item() ) {
        $layout = 'full-width';
      } elseif ( x_is_portfolio() ) {
        $meta   = get_post_meta( get_the_ID(), '_x_portfolio_layout', true );
        $layout = ( $meta == 'sidebar' ) ? $content_layout : $meta;
      } elseif ( is_page_template( 'template-layout-content-sidebar.php' ) ) {
        $layout = 'content-sidebar';
      } elseif ( is_page_template( 'template-layout-sidebar-content.php' ) ) {
        $layout = 'sidebar-content';
      } elseif ( is_page_template( 'template-layout-full-width.php' ) ) {
        $layout = 'full-width';
      } elseif ( is_page_template( 'template-articles.php' ) ) {
        $layout = 'full-width';
      } elseif ( is_archive() ) {
        if ( x_is_shop() || x_is_product_category() || x_is_product_tag() ) {
          $opt    = x_get_option( 'x_woocommerce_shop_layout_content', 'sidebar' );
          $layout = ( $opt == 'sidebar' ) ? $content_layout : $opt;
        } else {
          $opt    = x_get_option( 'x_archive_layout', 'sidebar' );
          $layout = ( $opt == 'sidebar' ) ? $content_layout : $opt;
        }
      } elseif ( x_is_product() ) {
        $layout = 'full-width';
      } elseif ( x_is_bbpress() ) {
        $opt    = x_get_option( 'x_bbpress_layout_content', 'sidebar' );
        $layout = ( $opt == 'sidebar' ) ? $content_layout : $opt;
      } elseif ( x_is_buddypress() ) {
        $opt    = x_get_option( 'x_buddypress_layout_content', 'sidebar' );
        $layout = ( $opt == 'sidebar' ) ? $content_layout : $opt;
      } elseif ( is_404() ) {
        $layout = 'full-width';
      } else {
        $layout = $content_layout;
      }
    } else {
      $layout = $content_layout;
    }

    return $layout;

  }
endif;
