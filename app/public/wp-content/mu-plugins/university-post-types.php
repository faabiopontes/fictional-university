<?php

function university_post_types()
{
    // Event Post Type
    register_post_type('event', [
        'show_in_rest' => true,
        'supports' => [
            'title',
            'editor',
            'excerpt',
        ],
        'rewrite' => [
            'slug' => 'events',
        ],
        'has_archive' => true,
        'public' => true,
        'labels' => [
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event',
        ],
        'menu_icon' => 'dashicons-calendar',
    ]);

    // Program Post Type
    register_post_type('program', [
        'show_in_rest' => true,
        'supports' => [
            'title',
            'editor',
        ],
        'rewrite' => [
            'slug' => 'programs',
        ],
        'has_archive' => true,
        'public' => true,
        'labels' => [
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs',
            'singular_name' => 'Program',
        ],
        'menu_icon' => 'dashicons-awards',
    ]);

    // Professor Post Type
    register_post_type('professor', [
        'show_in_rest' => true,
        'supports' => ['title', 'editor'],
        'public' => true,
        'labels' => [
            'name' => 'Professors',
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit Professor',
            'all_items' => 'All Professors',
            'singular_name' => 'Professor'
        ],
        'menu_icon' => 'dashicons-welcome-learn-more'
    ]);
}
add_action('init', 'university_post_types');
