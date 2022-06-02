<?php

/*
    Plugin Name: Our First Unique Plugin
    Description: A truly amazing plugin.
    Version: 1.0
    Author: Fabio Pontes
    Author URI: https://github.com/faabiopontes
*/

class WordCountAndTimePlugin
{
    function __construct()
    {
        $this->menu_slug = 'word-count-settings-page';
        $this->option_group = 'wordcountplugin';
        add_action('admin_menu', array($this, 'adminPage'));
        add_action('admin_init', array($this, 'settings'));
    }

    function settings() {
        add_settings_section('wcp_first_section', null, null, 'word-count-settings-page');
        add_settings_field('wcp_location', 'Display Location', array($this, 'locationHTML'), $this->menu_slug, 'wcp_first_section');
        register_setting($this->option_group, 'wcp_location', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));
    }

    function locationHTML() { ?>
        <select name="wcp_location">
            <option value="0">Beginning of post</option>
            <option value="1">End of post</option>
        </select>
    <?php }

    function adminPage($adminMenu)
    {
        add_options_page('Word Count Settings', 'Word Count', 'manage_options', $this->menu_slug, array($this, 'ourHTML'));
    }

    function ourHTML()
    { ?>
        <div class="wrap">
            <h1>Word Count Settings</h1>
            <form action="options.php" method="POST">
            <?php
                settings_fields($this->option_group);
                do_settings_sections($this->menu_slug);
                submit_button();
            ?>
            </form>
        </div>
<?php }
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();
