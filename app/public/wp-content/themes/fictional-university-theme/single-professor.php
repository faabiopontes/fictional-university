<?php
get_header();
the_post(); // each time the_post runs it gets info from the next post
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
    <div class="generic-content">
        <?php the_content(); ?>
    </div>
    <?php
    $relatedPrograms = get_field('related_programs');
    if ($relatedPrograms) :
    ?>

        <hr class="section-break">
        <h2 class="headline headline--medium">Related Program(s)</h2>
        <ul class="link-list min-list">
            <?php
            foreach ($relatedPrograms as $program) :
            ?>
                <li><a href="<?= get_the_permalink($program); ?>"><?= get_the_title($program); ?>
                    <?php
                endforeach;
                    ?>
        </ul>
    <?php endif; ?>
</div>
<?php
get_footer();
?>