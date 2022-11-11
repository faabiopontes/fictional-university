<?php
get_header();
the_post(); // each time the_post runs it gets info from the next post
pageBanner();
$mapLocation = get_field('map_location');
?>
<div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
            <a class="metabox__blog-home-link" href="<?= get_post_type_archive_link('campus'); ?>">
                <i class="fa fa-home" aria-hidden="true"></i> All Campuses
            </a>
            <span class="metabox__main"><?= the_title() ?></span>
        </p>
    </div>
    <div class="generic-content">
        <?php the_content(); ?>
    </div>

    <div class="acf-map">
        <div data-lat="<?= $mapLocation['lat']; ?>" data-lng="<?= $mapLocation['lng']; ?>" class="marker">
            <h3><?php the_title(); ?></h3>
            <p><?= $mapLocation['address'] ?></p>
        </div>
    </div>
    <?php
    $relatedPrograms = new WP_Query([
        'posts_per_page' => -1,
        'post_type' => 'program',
        'orderby' => 'title',
        'order' => 'asc',
        'meta_query' => [
            [
                'key' => 'related_campuses',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"',
            ],
        ]
    ]);
    if ($relatedPrograms->have_posts()) :
    ?>
        <hr class="section-break">
        <h2 class="headline headline--medium">Programs Available At This Campus</h2>
        <ul class="min-list link-list">
            <?php
            while ($relatedPrograms->have_posts()) :
                $relatedPrograms->the_post();
            ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
            <?php
            endwhile;
            ?>
        </ul>
    <?php
    endif;
    wp_reset_postdata(); // reset post to current URL base post 
    ?>
</div>
<?php
get_footer();
?>