<?php
get_header();
the_post(); // each time the_post runs it gets info from the next post
pageBanner();
?>
<div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
            <a class="metabox__blog-home-link" href="<?= get_post_type_archive_link('program'); ?>">
                <i class="fa fa-home" aria-hidden="true"></i> All Programs
            </a>
            <span class="metabox__main"><?= the_title() ?></span>
        </p>
    </div>
    <div class="generic-content">
        <?php the_content(); ?>
    </div>
    <?php
    $relatedProfessors = new WP_Query([
        'posts_per_page' => -1,
        'post_type' => 'professor',
        'orderby' => 'title',
        'order' => 'asc',
        'meta_query' => [
            [
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"',
            ],
        ]
    ]);
    if ($relatedProfessors->have_posts()) :
    ?>
        <hr class="section-break">
        <h2 class="headline headline--medium"><?= get_the_title(); ?> Professors</h2>
        <ul class="professor-cards">
            <?php

            while ($relatedProfessors->have_posts()) :
                $relatedProfessors->the_post();
                $eventDate = new DateTime(get_field('event_date'));
            ?>
                <li class="professor-card__list-item">
                    <a class="professor-card" href="<?php the_permalink(); ?>">
                        <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape'); ?>">
                        <span class="professor-card__name"><?php the_title(); ?></span>
                    </a>
                </li>

            <?php
            endwhile;
            ?>
        </ul>
    <?php
    endif;

    wp_reset_postdata(); // reset post to current URL base post 
    $today = date('Ymd');
    $homepageEvents = new WP_Query([
        'posts_per_page' => 2,
        'post_type' => 'event',
        'orderby' => 'meta_value',
        'order' => 'asc',
        'meta_key' => 'event_date',
        'meta_query' => [
            [
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
            ],
            [
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"',
            ],
        ]
    ]);
    if ($homepageEvents->have_posts()) :
    ?>
        <hr class="section-break">
        <h2 class="headline headline--medium">Upcoming <?= get_the_title(); ?> Events</h2>
    <?php

        while ($homepageEvents->have_posts()) :
            $homepageEvents->the_post();
            get_template_part('template-parts/content', get_post_type());
        endwhile;
    endif;
    wp_reset_postdata(); // reset post to current URL base post 
    ?>
</div>
<?php
get_footer();
?>