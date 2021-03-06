<?php

// =============================================================================
// VIEWS/GLOBAL/_ABOUT.PHP
// -----------------------------------------------------------------------------
// Includes the index output.
// =============================================================================

?>
<article class="page type-page about">
<div class="entry-wrap entry-content">

  <div class="x-container max width">
    <h1 class="h-custom-headline right-text h3 accent"><span>Hello</span></h1>
    <div class="x-column x-sm x-1-2" style="bottom: 0px; opacity: 1;" data-x-element="column" data-x-params="{&quot;fade&quot;:true,&quot;animation&quot;:&quot;in-from-bottom&quot;}" data-fade="true">
      <div class="profile-image"></div>
    </div>

    <div class="x-column x-sm x-1-2">
      <p>
        My name is Allen. By day I’m a software engineer, building the front and
        back ends of sophisticated web applications. I’m currently working as a director
        of engineering at a startup called Affirm, with prior gigs at Counsyl, Square,
        and Google.
      </p>
      <p>
        I registered <em>allenc.com</em> back in 2011 to jot down my thoughts around
        work and various hobbies. With work, I primarily write about technology,
        software development and people management.  My hobbyist blogging topics consist
        of stimulating books, video games, and living in the San Francisco Bay Area.
      </p>
      <p>
        When not wordifying my opinions onto virtual parchment, I can be found
        hanging out with my wife and our incredibly energetic children.
      </p>
    </div>
  </div>

  <?php
    $report = Word_Stats_Core::recount_totals();
    $post_count = $report[ 'type_count' ][ 'post' ];
    $word_count = $report[ 'author_count_total' ][ -1 ];
    $avg_words_per_post = round($word_count / $post_count);
    $days_since = floor((time() - strtotime("2011-04-30")) / (60 * 60 * 24));
  ?>
  <div class="x-container max width">
    <h2 class="h-custom-headline right-text h5 accent"><span>Stats</span></h2>
    <div class="x-column x-sm x-1-3">
      <div class="x-counter counter-posts" data-x-element="counter"
        data-x-params='{"numEnd":<?php echo $post_count; ?>,"numSpeed":1000}'>
        <span class="text-above">Authored</span>
        <div class="number-wrap w-h">
          <span class="number"><?php echo $post_count; ?></span>
        </div>
        <span class="text-below">Posts</span>
      </div>
    </div>
    <div class="x-column x-sm x-1-3">
      <div class="x-counter counter-avgwords" data-x-element="counter"
        data-x-params='{"numEnd":<?php echo $avg_words_per_post; ?>,"numSpeed":2000}'>
        <span class="text-above">Averaging</span>
        <div class="number-wrap w-h">
          <span class="number"><?php echo $avg_words_per_post; ?></span>
        </div>
        <span class="text-below">words per post</span>
      </div>
    </div>
    <div class="x-column x-sm x-1-3">
      <div class="x-counter counter-age" data-x-element="counter"
      data-x-params='{"numEnd":<?php echo $days_since; ?>,"numSpeed":3000}'>
        <span class="text-above">Over</span>
        <div class="number-wrap w-h">
          <span class="number"><?php echo $days_since; ?></span>
        </div>
        <span class="text-below">Days</span>
      </div>
    </div>
  </div>

  <div class="x-container max width">
    <div class="x-column x-sm x-1-3">
      <h2 class="h-custom-headline h5 accent"><span>Colophon</span></h2>
      <p>
        <em>allenc.com</em> is powered by <a
        href="https://wordpress.org/">WordPress</a>. The visual design is my
        customization of Themeforest’s <a href="http://theme.co/x/">X Theme</a>,
        available on <a href="https://github.com/allenmhc/x-child">Github</a>.
        <em>allenc.com</em> is registered and hosted by <a
        href="https://www.siteground.com/">SiteGround</a>.
      </p>
      <p>
        Fonts are provided by <a href="https://www.google.com/fonts">Google Fonts</a>.
        Titles and headers are rendered with the <a
        href="https://www.google.com/fonts/specimen/Lato">Lato</a> typeface, while the
        text body is primarily <a
        href="https://www.google.com/fonts/specimen/Source+Sans+Pro">Source Sans
        Pro</a>.
      </p>
      <p>
        I do most of my blogging in the <a href="http://www.getblogo.com">Blogo</a> OS X
        app, posting 2-3 times a week.
      </p>
    </div>

    <div class="x-column x-sm x-2-3">
      <h2 class="h-custom-headline h5 accent"><span>Recommended</span></h2>
      <a href="<?php echo home_url(); ?>/2011/04/how-to-score-a-google-onsite-interview/">
        <div id="x-content-band-1" class="x-content-band recommended-box bg-image bg-image-google">
          <h6 class="x-container">How to Score a Google Onsite Interview</h6>
        </div>
      </a>
      <a href="<?php echo home_url(); ?>/2012/02/why-javascript-is-a-joy/">
        <div id="x-content-band-2" class="x-content-band recommended-box bg-image bg-image-javascript">
          <h6 class="x-container">Why Javascript is a Joy</h6>
        </div>
      </a>
      <a href="<?php echo home_url(); ?>/2015/04/salary-requirements-for-a-house-in-silicon-valley/">
        <div id="x-content-band-3" class="x-content-band recommended-box bg-image bg-image-house">
          <h6 class="x-container">Salary Requirements for a House in Silicon Valley</h6>
        </div>
      </a>
    </div>
  </div>

</div>
</article>
