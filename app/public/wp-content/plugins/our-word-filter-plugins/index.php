<?php

/*
    Plugin Name: Our Word Filter Plugin
    Description: Replaces a list of words.
    Version: 1.0
    Author: Fabio Pontes
    Author URI: https://github.com/faabiopontes
*/

if ( !defined('ABSPATH')) exit; // Exit if accessed directly

class OurWordFilterPlugin {
    function __construct() {
        $this->menu_slug = 'ourwordfilter';
        add_action('admin_menu', [$this, 'ourMenu']);
    }

    function ourMenu() {
        add_menu_page('Words To Filter', 'Word Filter', 'manage_options', $this->menu_slug, [$this, 'wordFilterPage'], 'dashicons-smiley', 100);
        add_submenu_page($this->menu_slug, 'Words To Filter', 'Word List', 'manage_options', $this->menu_slug, [$this, 'wordFilterPage']);
        add_submenu_page($this->menu_slug, 'Word Filter Options', 'Options', 'manage_options', 'word-filter-options', [$this, 'optionsSubPage']);
    }

    function wordFilterPage() { ?>
        Hello World.
    <?php }

    function optionsSubPage() { ?>
        Hello World from the options page.
    <?php }
}

$ourWordFilterPlugin = new OurWordFilterPlugin();