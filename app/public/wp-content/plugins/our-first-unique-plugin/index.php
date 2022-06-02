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
        add_action('admin_menu', array($this, 'adminPage'));
    }

    function adminPage($adminMenu)
    {
        add_options_page('Word Count Settings', 'Word Count', 'manage_options', 'word-count-settings-page', array($this, 'ourHTML'));
    }

    function ourHTML()
    { ?>
        <div class="wrap">
            <h1>Word Count Settings</h1>
        </div>
<?php }
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();
