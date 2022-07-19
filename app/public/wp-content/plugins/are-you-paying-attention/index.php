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
        register_block_type(__DIR__, [
            'render_callback' => [$this, 'theHTML']
        ]);
    }

    function theHTML($attributes) {
        if(!is_admin()) {
            wp_enqueue_script('attentionFrontend', plugin_dir_url(__FILE__) . 'build/frontend.js', ['wp-element'], null, true);
        }

        ob_start() ?>

        <div class="paying-attention-update-me">
            <pre style="display: none"><?= wp_json_encode($attributes) ?></pre>
        </div>

        <?php return ob_get_clean();
    }
}

$areYouPayingAttention = new AreYouPayingAttention();