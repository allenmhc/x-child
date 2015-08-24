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
  array('x-stack', 'x-shortcodes'));

if (! function_exists( 'load_google_fonts ')):
function load_google_fonts() {
  wp_register_style('googleFonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700,700italic|Lato:700,400,300,100|Open+Sans:300|;subset=latin,latin-ext');
  wp_enqueue_style( 'googleFonts');
}
endif;

add_action('wp_print_styles', 'load_google_fonts');


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
      } elseif ( is_page_template( 'template-about.php' ) ) {
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

// Entry Meta
// =============================================================================

if ( !function_exists( 'x_ethos_entry_meta' ) ) :
  function x_ethos_entry_meta() {

    $date = sprintf( '<span><time class="entry-date" datetime="%1$s">%2$s</time></span>',
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date() )
    );

    if ( get_post_type() == 'x-portfolio' ) {
      if ( has_term( '', 'portfolio-category', NULL ) ) {
        $categories        = get_the_terms( get_the_ID(), 'portfolio-category' );
        $separator         = ', ';
        $categories_output = '';
        foreach ( $categories as $category ) {
          $categories_output .= '<a href="'
                              . get_term_link( $category->slug, 'portfolio-category' )
                              . '" title="'
                              . esc_attr( sprintf( __( "View all posts in: &ldquo;%s&rdquo;", '__x__' ), $category->name ) )
                              . '"> '
                              . $category->name
                              . '</a>'
                              . $separator;
        }

        $categories_list = sprintf( '<span>%1$s %2$s',
          __( 'Posted in', '__x__' ),
          trim( $categories_output, $separator )
        );
      } else {
        $categories_list = '';
      }
    } else {
      $categories        = get_the_category();
      $separator         = ', ';
      $categories_output = '';
      foreach ( $categories as $category ) {
        $categories_output .= '<a href="'
                            . get_category_link( $category->term_id )
                            . '" title="'
                            . esc_attr( sprintf( __( "View all posts in: &ldquo;%s&rdquo;", '__x__' ), $category->name ) )
                            . '"> '
                            . $category->name
                            . '</a>'
                            . $separator;
      }

      $categories_list = sprintf( '<span>%1$s %2$s</span>',
        __( 'Posted in', '__x__' ),
        trim( $categories_output, $separator )
      );
    }

    if ( comments_open() ) {

      $title  = apply_filters( 'x_entry_meta_comments_title', get_the_title() );
      $link   = apply_filters( 'x_entry_meta_comments_link', get_comments_link() );
      $number = apply_filters( 'x_entry_meta_comments_number', get_comments_number() );

      if ( $number == 0 ) {
        $text = __( 'Leave a Comment' , '__x__' );
      } else if ( $number == 1 ) {
        $text = $number . ' ' . __( 'Comment' , '__x__' );
      } else {
        $text = $number . ' ' . __( 'Comments' , '__x__' );
      }

      $comments = sprintf( '<span><a href="%1$s" title="%2$s" class="meta-comments">%3$s</a></span>',
        esc_url( $link ),
        esc_attr( sprintf( __( 'Leave a comment on: &ldquo;%s&rdquo;', '__x__' ), $title ) ),
        $text
      );

    } else {

      $comments = '';

    }

    if ( x_does_not_need_entry_meta() ) {
      return;
    } else {
      printf( '<p class="p-meta">%1$s%2$s</p>',
        $categories_list,
        $date
      );
    }

  }
endif;


// Social icons and links
// =============================================================================
if ( ! function_exists( 'x_social_global' ) ) :
  function x_social_global() {

    $twitter     = "https://twitter.com/allenmhc";
    $google_plus = "https://plus.google.com/+AllenCheungMH";
    $linkedin    = "https://www.linkedin.com/in/allencheung";
    $rss         = "http://allenc.com/feed/";
    $github      = "https://github.com/allenmhc";

    $output = '<div class="x-social-global">';

    $output .= '<a href="' . $twitter     . '" class="twitter" title="Twitter" target="_blank"><i class="x-icon-twitter-square"></i></a>';
    $output .= '<a href="' . $google_plus . '" class="google-plus" title="Google+" target="_blank"><i class="x-icon-google-plus-square"></i></a>';
    $output .= '<a href="' . $linkedin    . '" class="linkedin" title="LinkedIn" target="_blank"><i class="x-icon-linkedin-square"></i></a>';
    $output .= '<a href="' . $github      . '" class="github" title="Github" target="_blank"><i class="x-icon-github-square"></i></a>';
    $output .= '<a href="' . $rss         . '" class="rss" title="RSS" target="_blank"><i class="x-icon-rss-square"></i></a>';

    $output .= '</div>';

    echo $output;

  }
endif;


// Archive calendar JavaScripts
if ( ! function_exists('archive_calendar_script') ):
function archive_calendar_script() {
  wp_enqueue_script('archive-calendar-customization',
                    get_stylesheet_directory_uri() . '/js/archive-calendar.js',
                    array( 'jquery' ));
}
endif;
add_action('wp_enqueue_scripts', 'archive_calendar_script');


// Ad block after post
if ( ! function_exists('after_content_google_ads_code') ):
function after_content_google_ads_code() {
  echo <<<ADS
  <div class="ad-unit ad-unit-post">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Responsive -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-4920071993370936"
         data-ad-slot="9131674607"
         data-ad-format="auto"></ins>
    <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
  </div>
ADS;
}
endif;

add_action('x_after_the_content_end', 'after_content_google_ads_code');
