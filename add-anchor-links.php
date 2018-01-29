<?php

/*
  Plugin Name: Add Anchor Links
  Description: Creates anchor links to heading tags in the content.
  Version:     0.0.1
  Author:      Karolína Vyskočilová
  Author URI:  https://kybernaut.cz
  Text Domain: add-anchor-links
  Domain Path: /languages
 
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

global $add_anchor_links_options;
// plugin options    
$add_anchor_links_options = wp_parse_args( get_option( 'add_anchor_links_settings', array()), add_anchor_links_options_defaults() );

define('ADD_ANCHOR_LINKS_DIR', plugin_dir_path(__FILE__));
define('ADD_ANCHOR_LINKS_URL', plugin_dir_url(__FILE__));
define('ADD_ANCHOR_LINKS_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('ADD_ANCHOR_LINKS_VERSION', '0.0.1');

// Localize plugin
add_action('init', 'add_anchor_links_localize_plugin');
function add_anchor_links_localize_plugin() {
    load_plugin_textdomain('add-anchor-links', false, ADD_ANCHOR_LINKS_DIR . 'languages/');
}

// Load plugin
add_action('plugins_loaded', 'add_anchor_links_plugin_init', 99);
function add_anchor_links_plugin_init() {    
    
    if ( is_admin() ) {

        require_once( ADD_ANCHOR_LINKS_DIR . 'admin/settings.php' );
        add_filter('plugin_action_links_' . ADD_ANCHOR_LINKS_PLUGIN_BASENAME, 'add_anchor_links_plugin_action_links');

    } else {

        global $add_anchor_links_options;
        if ( ! $add_anchor_links_options['own_css'] ) {            
            add_action('wp_enqueue_scripts', 'add_anchor_links_scripts');
        }
        require_once( ADD_ANCHOR_LINKS_DIR . 'include/class-add-anchor-links.php' );        

    }

}

// Add settings link
function add_anchor_links_plugin_action_links($links) {
    $action_links = array(
	'settings' => '<a href="' . admin_url('options-general.php?page=add_anchor_links') . '" aria-label="' . esc_attr__('View Anchor Links settings', 'add-anchor-links') . '">' . esc_html__('Settings', 'add-anchor-links') . '</a>',
    );

    return array_merge($action_links, $links);
}

// Load scripts and styles
function add_anchor_links_scripts() {
    if ( is_singular( add_anchor_links_post_types( true ) ) ) {
        wp_enqueue_style('add-anchor-links-style', ADD_ANCHOR_LINKS_URL . 'assets/css/add-anchor-links.css', array(), ADD_ANCHOR_LINKS_VERSION );
    }
}

// Default options
function add_anchor_links_options_defaults() {
    $default_options = array( 
        'own_css' => false,
        'post_types' => false,
    );
    $post_types = add_anchor_links_post_types();
    foreach ( $post_types as $pt ) {
        $default_options[$pt] = false;
    }
    return $default_options;
}

// Get post types
function add_anchor_links_post_types( $active = false ) {

    $post_types = get_post_types( array(
        'public'   => true,
    ) );

    if ( $active ) {

        global $add_anchor_links_options;
        $_post_types = $post_types;
        foreach( $_post_types as $pt ) {
            if ( $add_anchor_links_options[$pt] ) {
                $post_types[] = $pt;
            }
        }

    }

    return $post_types;
}