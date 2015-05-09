<?php

// =============================================================================
// VIEWS/ETHOS/_CATEGORIES.PHP
// -----------------------------------------------------------------------------
// Includes category filters.
// =============================================================================

$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$categories = get_categories( array( 'include' => get_theme_mod( 'x_ethos_filterable_index_categories' ) ) );

?>

<ul class="option-set unstyled" data-option-key="filter">
  <li>
    <a href="#" class="x-index-filters cf">
      <span class="x-index-filter-label">Filter by Topic</span>
      <i class="x-icon-chevron-down"></i>
    </a>
    <ul class="x-index-filters-menu unstyled">

      <li><a href="#" class="selected" data-category-id="0"><?php echo __( 'All', '__x__' ) ?></a></li>
      <?php foreach ( $categories as $category ) { ?>
        <?php static $i = 1; $selected = ( $i == 1 ) ? 'class="selected"' : ''; ?>

        <li><a href="#" <?php echo $selected; ?> data-category-id="<?php echo $category->term_id ?>"><?php echo $category->name; ?></a></li>

        <?php $i++; ?>
      <?php } ?>
    </ul>
  </li>
</ul>

<div class="x-filterable-index">

  <?php

  foreach ( $categories as $category ) {

    static $j = 1;

    $selected = ( $j == 1 ) ? ' selected' : '';
    $accent   = x_ethos_category_accent_color( $category->term_id, '#333333' );
    $wp_query = new WP_Query( array( 'post_type' => 'post', 'paged' => $paged, 'cat' => $category->term_id ) );

    echo '<div class="x-filterable-category-group' . $selected . '" data-category-id="' . $category->term_id . '">';

      if ( $wp_query->have_posts() ) :
        while ( $wp_query->have_posts() ) : $wp_query->the_post();
          x_get_view( 'ethos', 'content', get_post_format() );
        endwhile;
      endif;

      echo '<a href="' . get_category_link( $category->term_id ) . '" class="x-btn-filterable x-btn">See All ' . $category->name . ' Posts</a>';

    echo '</div>';

    wp_reset_query();

    $j++;

  }

  ?>

</div>

<script>

  jQuery('.x-index-filters').click(function(e) {
    e.preventDefault();
    var $this = jQuery(this);
    $this.parent().find('ul').slideToggle(600, 'easeOutExpo');
    if ( $this.hasClass('selected') ) {
      $this.removeClass('selected');
    } else {
      $this.addClass('selected');
    }
  });

  jQuery('.x-index-filters-menu a').click(function(e) {
    e.preventDefault();
    var $this       = jQuery(this);
    var $filter_cat = $this.data('category-id');
    jQuery('.x-index-filter-label').text($this.text());
    if ( ! $this.hasClass('selected') ) {
      $this.closest('ul').find('a').removeClass('selected');
      $this.addClass('selected');
    }
    jQuery('.x-filterable-category-group').each(function() {
      $this = jQuery(this);
      if ( $this.data('category-id') === $filter_cat ) {
        $this.css({ 'display' : 'block', 'visibility' : 'visible' });
        $this.find('.x-btn-filterable').css({ 'display' : 'block' });
      } else {
        $this.css({ 'display' : 'none', 'visibility' : 'hidden' });
      }
    });
  });

</script>
