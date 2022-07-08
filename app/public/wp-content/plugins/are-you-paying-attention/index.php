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
        wp_register_style('quizeditcss', plugin_dir_url(__FILE__) . 'build/index.css');
        wp_register_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', ['wp-blocks', 'wp-element', 'wp-editor']);
        register_block_type('ourplugin/are-you-paying-attention', [
            'editor_script' => 'ournewblocktype',
            'editor_style' => 'quizeditcss',
            'render_callback' => [$this, 'theHTML']
        ]);
    }

    function theHTML($attributes) {
        if(!is_admin()) {
            wp_enqueue_script('attentionFrontend', plugin_dir_url(__FILE__) . 'build/frontend.js', ['wp-element'], null, true);
            wp_enqueue_style('attentionFrontendStyles', plugin_dir_url(__FILE__) . 'build/frontend.css', ['wp-element']);
        }

        ob_start() ?>

        <div class="paying-attention-update-me"></div>

        <?php return ob_get_clean();
    }
}

$areYouPayingAttention = new AreYouPayingAttention();