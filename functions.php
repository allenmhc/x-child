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

wp_enqueue_style('x-child-app',
  get_stylesheet_directory_uri() . '/framework/css/app.css',
  array('x-child'));
