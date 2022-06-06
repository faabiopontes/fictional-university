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
        $mainPageHook = add_menu_page('Words To Filter', 'Word Filter', 'manage_options', $this->menu_slug, [$this, 'wordFilterPage'], 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xMCAyMEMxNS41MjI5IDIwIDIwIDE1LjUyMjkgMjAgMTBDMjAgNC40NzcxNCAxNS41MjI5IDAgMTAgMEM0LjQ3NzE0IDAgMCA0LjQ3NzE0IDAgMTBDMCAxNS41MjI5IDQuNDc3MTQgMjAgMTAgMjBaTTExLjk5IDcuNDQ2NjZMMTAuMDc4MSAxLjU2MjVMOC4xNjYyNiA3LjQ0NjY2SDEuOTc5MjhMNi45ODQ2NSAxMS4wODMzTDUuMDcyNzUgMTYuOTY3NEwxMC4wNzgxIDEzLjMzMDhMMTUuMDgzNSAxNi45Njc0TDEzLjE3MTYgMTEuMDgzM0wxOC4xNzcgNy40NDY2NkgxMS45OVoiIGZpbGw9IiNGRkRGOEQiLz4KPC9zdmc+Cg==', 100);
        add_submenu_page($this->menu_slug, 'Words To Filter', 'Word List', 'manage_options', $this->menu_slug, [$this, 'wordFilterPage']);
        add_submenu_page($this->menu_slug, 'Word Filter Options', 'Options', 'manage_options', 'word-filter-options', [$this, 'optionsSubPage']);
        add_action("load-{$mainPageHook}", [$this, 'mainPageAssets']);
    }

    function mainPageAssets() {
        wp_enqueue_style('filterAdminCss', plugin_dir_url(__FILE__) . 'styles.css');
    }

    function wordFilterPage() { ?>
        <div class="wrap">
            <h1>Word Filter</h1>
            <form method="post">
                <label for="plugin_words_to_filter"><p>Enter a <strong>comma-separated</strong> list of words to filter from your site's content</p></label>
                <div class="word-filter__flex-container">
                    <textarea name="plugin_words_to_filter" id="plugin_words_to_filter" placeholder="bad, mean, awful, horrible"></textarea>
                </div>
                <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
            </form>
        </div>
    <?php }

    function optionsSubPage() { ?>
        Hello World from the options page.
    <?php }
}

$ourWordFilterPlugin = new OurWordFilterPlugin();