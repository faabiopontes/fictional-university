<?php

/*
  Plugin Name: Featured Professor Block Type
  Version: 1.0
  Author: Fabio Pontes
  Author URI: https://www.udemy.com/user/bradschiff/
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class FeaturedProfessor {
  function __construct() {
    add_action('init', [$this, 'onInit']);
  }

  function onInit() {
    wp_register_script('featuredProfessorScript', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-i18n', 'wp-editor'));
    wp_register_style('featuredProfessorStyle', plugin_dir_url(__FILE__) . 'build/index.css');

    register_block_type('ourplugin/featured-professor', array(
      'render_callback' => [$this, 'renderCallback'],
      'editor_script' => 'featuredProfessorScript',
      'editor_style' => 'featuredProfessorStyle'
    ));
  }

  function renderCallback($attributes) {
    return '<p>We will replace this content soon.</p>';
  }

}

$featuredProfessor = new FeaturedProfessor();