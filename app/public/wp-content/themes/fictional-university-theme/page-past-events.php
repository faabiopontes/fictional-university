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
    get_template_part('template-parts/content', get_post_type());
  endwhile;
  echo paginate_links([
    'total' => $pastEvents->max_num_pages
  ]);
  ?>
</div>
<?php
get_footer();
