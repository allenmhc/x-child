<?php

// =============================================================================
// VIEWS/GLOBAL/_BRAND.PHP
// -----------------------------------------------------------------------------
// Outputs the brand.
// =============================================================================

$site_name        = get_bloginfo( 'name' );
$site_description = get_bloginfo( 'description' );
?>

<?php echo ( is_front_page() ) ? '<h1 class="visually-hidden">' . $site_name . '</h1>' : ''; ?>

<div class="site-header-wrapper x-brand">
  <a class="site-header-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo $site_description; ?>" rel="home" class="<?php x_brand_class(); ?>">

    <div class="site-title-icon">
      <div class="first dot"></div>
      <div class="second dot"></div>
      <div class="third dot"></div>
    </div>

    <div class="site-title-block">
      <h1 class="site-title">
        <span class="domain">allenc</span><span class="tld">.com</span>
      </h1>
      <h2 class="site-description"><?php echo $site_description; ?></h2>
    </div>

  </a>
</div>
