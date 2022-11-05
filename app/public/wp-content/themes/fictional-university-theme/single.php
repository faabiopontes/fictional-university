<?php
get_header();
the_post(); // each time the_post runs it gets info from the next post
pageBanner();
?>
<div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
            <a class="metabox__blog-home-link" href="<?= site_url('/blog'); ?>">
                <i class="fa fa-home" aria-hidden="true"></i> Blog Home
            </a>
            <span class="metabox__main">Posted by <?php the_author_posts_link() ?> on <?php the_time('n.j.y') ?> in <?= get_the_category_list(', '); ?></span>
        </p>
    </div>
    <div class="generic-content">
        <?php the_content(); ?>
    </div>
</div>
<?php
get_footer();
?>