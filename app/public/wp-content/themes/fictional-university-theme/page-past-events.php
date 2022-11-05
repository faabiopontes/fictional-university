<?php
get_header();
pageBanner([
  'title' => 'Past Events',
  'subtitle' => 'A recap of our past events.',
]);
?>
<div class="container container--narrow page-section">
  <?php
  $today = date('Ymd');
  $pastEvents = new WP_Query([
    'paged' => get_query_var('paged', 1),
    'post_type' => 'event',
    'orderby' => 'meta_value',
    'order' => 'asc',
    'meta_key' => 'event_date',
    'meta_query' => [
      [
        'key' => 'event_date',
        'compare' => '<',
        'value' => $today,
      ]
    ]
  ]);

  while ($pastEvents->have_posts()) :
    $pastEvents->the_post();
    $eventDate = new DateTime(get_field('event_date'));
  ?>
    <div class="event-summary">
      <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
        <span class="event-summary__month"><?= $eventDate->format('M'); ?></span>
        <span class="event-summary__day"><?= $eventDate->format('d'); ?></span>
      </a>
      <div class="event-summary__content">
        <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
        <p><?= wp_trim_words(get_the_content(), 18); ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
      </div>
    </div>
  <?php
  endwhile;
  echo paginate_links([
    'total' => $pastEvents->max_num_pages
  ]);
  ?>
</div>
<?php
get_footer();
