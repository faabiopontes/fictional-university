<?php
get_header();

while (have_posts()) :
  the_post();
?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?= get_theme_file_uri('/images/ocean.jpg') ?>)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?= the_title(); ?></h1>
      <div class="page-banner__intro">
        <p>DON'T FORGET TO REPLACE ME LATER</p>
      </div>
    </div>
  </div>

  <div class="container container--narrow page-section">
    <?php
    $theParentID = wp_get_post_parent_id(get_the_ID());
    $isChild = $theParentID !== 0;
    if ($isChild) : ?>
      <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?= get_permalink($theParentID); ?>">
            <i class="fa fa-home" aria-hidden="true"></i> Back to <?= get_the_title($theParentID); ?></a> <span class="metabox__main"><?= the_title(); ?></span>
        </p>
      </div>
    <?php
    endif;

    $hasChildren = get_pages([
      'child_of' => get_the_ID()
    ]);

    if ($isChild or $hasChildren) : ?>
      <div class="page-links">
        <h2 class="page-links__title"><a href="<?= get_permalink($theParentID); ?>"><?= get_the_title($theParentID); ?></a></h2>
        <ul class="min-list">
          <?php
          wp_list_pages([
            'title_li' => NULL,
            'child_of' => $isChild ? $theParentID : get_the_ID(),
            'sort_column' => 'menu_order'
          ]);
          ?>
        </ul>
      </div>
    <?php endif; ?>

    <div class="generic-content">
      <?= the_content(); ?>
    </div>
  </div>
<?php
endwhile;
get_footer();
?>