<?php

/*
    Plugin Name: Our First Unique Plugin
    Description: A truly amazing plugin.
    Version: 1.0
    Author: Fabio Pontes
    Author URI: https://github.com/faabiopontes
    Text Domain: wcpdomain
    Domain Path: /languages
*/

class WordCountAndTimePlugin
{
    function __construct()
    {
        $this->menu_slug = 'word-count-settings-page';
        $this->option_group = 'wordcountplugin';
        add_action('admin_menu', [$this, 'adminPage']);
        add_action('admin_init', [$this, 'settings']);
        add_filter('the_content', [$this, 'ifWrap']);
        add_action('init', [$this, 'languages']);
    }

    function languages() {
        load_plugin_textdomain('wcpdomain', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

    function ifWrap($content)
    {
        if (
            is_main_query() and
            is_single() and
            (get_option('wcp_wordcount', '1') or
                get_option('wcp_charactercount', '1') or
                get_option('wcp_readtime', '1')
            )
        ) {
            return $this->createHTML($content);
        }
        return $content;
    }

    function createHTML($content)
    {
        $html = '<h3>' . esc_html(get_option('wcp_headline', 'Post Statistics')) . '</h3><p>';

        // get word count once because both wordcount and read time will need it.
        if (get_option('wcp_wordcount', '1') or get_option('wcp_readtime', '1')) {
            $wordCount = str_word_count(strip_tags($content));
        }

        if (get_option('wcp_wordcount', '1')) {
            $html .= esc_html__('This post has','wcpdomain') . ' ' . $wordCount . ' ' . esc_html__('words','wcpdomain') . '.<br>';
        }

        if (get_option('wcp_readtime', '1')) {
            $readTime = round($wordCount / 225);
            $html .= 'This post has will take about ' . ($readTime ? $readTime : 1) . ' minute';
            $html .=  ($readTime > 1 ? 's' : '') . ' to read.<br>';
        }

        if (get_option('wcp_charactercount', '1')) {
            $html .= 'This post has ' . strlen(strip_tags($content)) . ' characters.<br>';
        }

        $html .= '</p>';

        if (get_option('wcp_location', '0') == '0') {
            return $html . $content;
        }

        return $content . $html;
    }

    function settings()
    {
        add_settings_section('wcp_first_section', null, null, 'word-count-settings-page');

        add_settings_field('wcp_location', 'Display Location', [$this, 'locationHTML'], $this->menu_slug, 'wcp_first_section');
        register_setting($this->option_group, 'wcp_location', ['sanitize_callback' => [$this, 'sanitizeLocation'], 'default' => '0']);

        add_settings_field('wcp_headline', 'Headline Text', [$this, 'headlineHTML'], $this->menu_slug, 'wcp_first_section');
        register_setting($this->option_group, 'wcp_headline', ['sanitize_callback' => 'sanitize_text_field', 'default' => 'Post Statistics']);

        add_settings_field('wcp_wordcount', 'Word Count', [$this, 'checkboxHTML'], $this->menu_slug, 'wcp_first_section', ['fieldName' => 'wcp_wordcount']);
        register_setting($this->option_group, 'wcp_wordcount', ['sanitize_callback' => 'sanitize_text_field', 'default' => '1']);

        add_settings_field('wcp_charactercount', 'Character Count', [$this, 'checkboxHTML'], $this->menu_slug, 'wcp_first_section', ['fieldName' => 'wcp_charactercount']);
        register_setting($this->option_group, 'wcp_charactercount', ['sanitize_callback' => 'sanitize_text_field', 'default' => '1']);

        add_settings_field('wcp_readtime', 'Read Time', [$this, 'checkboxHTML'], $this->menu_slug, 'wcp_first_section', ['fieldName' => 'wcp_readtime']);
        register_setting($this->option_group, 'wcp_readtime', ['sanitize_callback' => 'sanitize_text_field', 'default' => '1']);
    }

    function sanitizeLocation($input)
    {
        if ($input != '0' and $input != '1') {
            add_settings_error('wcp_location', 'wcp_location_error', 'Invalid Display Location value');
            return get_option('wcp_location');
        }
        return $input;
    }

    function locationHTML()
    { ?>
        <select name="wcp_location">
            <option value="0" <?php selected(get_option('wcp_location'), '0') ?>>Beginning of post</option>
            <option value="1" <?php selected(get_option('wcp_location'), '1') ?>>End of post</option>
        </select>
    <?php }

    function checkboxHTML($args)
    { ?>
        <input type="checkbox" name="<?php echo $args['fieldName'] ?>" value="1" <?php checked(get_option($args['fieldName']), '1') ?>>
    <?php }

    function headlineHTML()
    { ?>
        <input type="text" name="wcp_headline" value="<?php echo esc_attr(get_option('wcp_headline')) ?>">
    <?php }

    function adminPage($adminMenu)
    {
        add_options_page('Word Count Settings', esc_html__('Word Count', 'wcpdomain'), 'manage_options', $this->menu_slug, [$this, 'ourHTML']);
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
