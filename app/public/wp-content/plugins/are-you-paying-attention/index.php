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
        add_action('init', [$this, 'adminAssets']);
    }

    function adminAssets() {
        wp_register_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', ['wp-blocks', 'wp-element']);
        register_block_type('ourplugin/are-you-paying-attention', [
            'editor_script' => 'ournewblocktype',
            'render_callback' => [$this, 'theHTML']
        ]);
    }

    function theHTML($attributes) {
        ob_start() ?>

        <h3>Today the sky is completely <?= esc_html($attributes['skyColor']) ?> and this grass is <?= esc_html($attributes['grassColor']) ?>!!!</h3>

        <?php return ob_get_clean();
    }
}

$areYouPayingAttention = new AreYouPayingAttention();