<?php
get_header();
pageBanner([
    'title' => 'All Events',
    'subtitle' => 'See what\'s going on in our world'
]);
?>
<div class="container container--narrow page-section">
    <?php
    while (have_posts()) :
        the_post();
        get_template_part('template-parts/content', get_post_type());
    endwhile;
    echo paginate_links();
    ?>
    <hr class="section-break">
    <p>Looking for a recap of past events? <a href="<?= site_url('past-events') ?>">Check out our past events archive</a>.</p>
</div>
<?php
get_footer();
