<?php

// =============================================================================
// VIEWS/GLOBAL/_ARTICLES.PHP
// -----------------------------------------------------------------------------
// Includes the index output.
// =============================================================================

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
  'post_type'      => 'post',
  'paged'          => $paged,
  'orderby'        => 'date',
  'meta_key'       => 'article',
  'meta_value'     => 1
);
$wp_query = new WP_Query( $args );
?>

<?php x_get_view( 'global', '_script', 'isotope-index' ); ?>

<div id="x-iso-container" class="x-iso-container x-iso-container-posts cols-3">
  <?php if ( $wp_query->have_posts() ) : ?>
    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
      <?php x_ethos_entry_cover( 'main-content' ); ?>
    <?php endwhile; ?>
  <?php else : ?>
    <?php x_get_view( 'global', '_content-none' ); ?>
  <?php endif; ?>

</div>

<?php pagenavi(); ?>
