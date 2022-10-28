<?php
get_header();
the_post(); // each time the_post runs it gets info from the next post
pageBanner();
?>
<div class="container container--narrow page-section">
    <div class="generic-content">
        <div class="row group">
            <div class="one-third"><?php the_post_thumbnail('professorPortrait'); ?></div>
            <div class="two-thirds"><?php the_content(); ?></div>
        </div>
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