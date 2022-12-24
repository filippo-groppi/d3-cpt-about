<?php

/**
* Plugin Name: D3 CPT About
* Plugin URI: https://www.derved.com/
* Description: Create About Custom Post Type
* Version: 0.1
* Author: DERVED®
* Author URI: https://www.derved.com/
**/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

$d3_cpt_about_plugin_dir_path = WP_PLUGIN_DIR . '/d3-cpt-about';

function d3_cpt_about_register_post_type() {
    include("templates/d3-cpt-about.php");
}

add_action( 'init', 'd3_cpt_about_register_post_type' );