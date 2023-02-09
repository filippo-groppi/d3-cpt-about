<?php

/**
* Plugin Name: D3 CPT About
* Plugin URI: https://www.derved.com/wp-plugins/d3-suite/d3-cpt-about
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

    $labels = array(
        'name' => __( 'D3 About', 'd3' ),
        'singular_name' => __( 'About', 'd3' ),
        'add_new' => __( 'New About Section', 'd3' ),
        'add_new_item' => __( 'Add New About Section', 'd3' ),
        'edit_item' => __( 'Edit About Section', 'd3' ),
        'new_item' => __( 'New About Section', 'd3' ),
        'view_item' => __( 'View About Section', 'd3' ),
        'search_items' => __( 'Search About Sections', 'd3' ),
        'not_found' =>  __( 'No About Section Found', 'd3' ),
        'not_found_in_trash' => __( 'No About Section found in Trash', 'd3' ),
    );

    $args = array(
        'labels' => $labels,
        'has_archive' => true,
        'public' => true,
        'hierarchical' => false,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'custom-fields',
            'thumbnail',
            'page-attributes'
        ),
        'taxonomies' => 'category',
        'rewrite'   => array( 'slug' => 'about' ),
        'show_ui' => true,
        'show_in_menu' => 'd3-cpts',
        'show_in_rest' => true
    );

    register_post_type( 'd3_cpt_about', $args );
}

add_action( 'init', 'd3_cpt_about_register_post_type' );


/**
 * Submenu Content
 */

function print_d3_cpt_about()  {
    include("templates/d3-submenu-page-content.php");
}


/**
 * Submenu Page
 */

function d3_cpt_about_admin_submenu()  {
    add_submenu_page(
        'd3-suite',
        'D3 CPT About', // page title
        'D3 CPT About', // menu title
        'manage_options', // capability
        'd3-cpt-about', // menu slug
        'print_d3_cpt_about'  // callback function
    );
}


/**
 * Menu Content
 */

function d3_cpt_about_print_d3_suite()  {
    include("templates/d3-suite-page-content.php");
}


/**
 * Menu Page
 */

function d3_cpt_about_admin_menu()
{
    global $menu;
    $menuExist = false;
    foreach ($menu as $item) {
        if (strtolower($item[0]) == strtolower('D3 Suite')) {
            $menuExist = true;
        }
    }
    if (!$menuExist) {
        add_menu_page(
            'D3 Suite', // page title
            'D3 Suite', // menu title
            'manage_options', // capability
            'd3-suite', // menu slug
            'd3_cpt_about_print_d3_suite',  // callback function
            'dashicons-admin-customizer'
        );
    }
    d3_cpt_about_admin_submenu();
}

add_action( 'admin_menu', 'd3_cpt_about_admin_menu' );



/**
 * Menu Page
 */

function d3_cpt_about_d3_cpts_menu()
{
    global $menu;
    $menuExist = false;
    foreach ($menu as $item) {
        if (strtolower($item[0]) == strtolower('D3 CPTs')) {
            $menuExist = true;
        }
    }
    if (!$menuExist) {
        add_menu_page(
            'D3 CPTs', // page title
            'D3 CPTs', // menu title
            'manage_options', // capability
            'd3-cpts', // menu slug
            'd3_cpt_about_print_d3_cpts',  // callback function
            'dashicons-admin-post', // icon
            5 // position
        );
    }
}

add_action( 'admin_menu', 'd3_cpt_about_d3_cpts_menu' );

