<?php

// =============================================================================
// VIEWS/ETHOS/TEMPLATE-CATEGORIES.PHP
// -----------------------------------------------------------------------------
// Categories page for X-child theme.
// =============================================================================

?>

<?php get_header(); ?>

  <div class="x-container-fluid max width main">

    <div class="offset cf">
      <div class="<?php x_main_content_class(); ?>" role="main">

        <?php x_get_view( 'ethos', '_categories' ); ?>
      </div>

      <?php get_sidebar(); ?>

    </div>
  </div>

<?php get_footer(); ?>
