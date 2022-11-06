<?php $eventDate = new DateTime(get_field('event_date')); ?>
<div class="event-summary">
    <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
        <span class="event-summary__month"><?= $eventDate->format('M'); ?></span>
        <span class="event-summary__day"><?= $eventDate->format('d'); ?></span>
    </a>
    <div class="event-summary__content">
        <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
        <p><?= has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 18); ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
    </div>
</div>