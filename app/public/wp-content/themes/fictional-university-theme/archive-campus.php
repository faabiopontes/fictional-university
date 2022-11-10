<?php
get_header();
pageBanner([
    'title' => 'Our Campuses',
    'subtitle' => 'We have several conviniently located campuses.'
]);
?>
<div class="container container--narrow page-section">
    <div class="acf-map">
        <?php
        while (have_posts()) :
            the_post();
            $mapLocation = get_field('map_location');
        ?>
            <div data-lat="<?= $mapLocation['lat']; ?>" data-lng="<?= $mapLocation['lng']; ?>" class="marker">
            </div>
        <?php
        endwhile;
        echo paginate_links();
        ?>
    </div>
</div>
<?php
get_footer();
