<?php

/*
    Plugin Name: Are You Paying Attention Quiz
    Description: Give your readers a multiple choice question.
    Version: 1.0
    Author: Fabio Pontes
    Author URI: https://github.com/faabiopontes
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class AreYouPayingAttention {
    function __construct() {
        add_action('enqueue_block_editor_assets', [$this, 'adminAssets']);
    }

    function adminAssets() {
        wp_enqueue_script('ournewblocktype', plugin_dir_url(__FILE__) . 'test.js', ['wp-blocks', 'wp-element']);
    }
}

$areYouPayingAttention = new AreYouPayingAttention();