<?php

/*
    Plugin Name: Our First Unique Plugin
    Description: A truly amazing plugin.
    Version: 1.0
    Author: Fabio Pontes
    Author URI: https://github.com/faabiopontes
*/

add_filter('the_content', 'addToEndOfPost');

function addToEndOfPost($content) {
    if (is_page() && is_main_query()) {
        return $content . '<p>My name is Fabio</p>.';
    }

    return $content;
}