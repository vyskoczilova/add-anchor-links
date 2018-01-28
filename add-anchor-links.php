<?php

/*
  Plugin Name: Add Anchor Links
  Description: TODO
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

define('ADD_ANCHOR_LINKS_DIR', plugin_dir_path(__FILE__));
define('ADD_ANCHOR_LINKS_URL', plugin_dir_url(__FILE__));
define('ADD_ANCHOR_LINKS_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('ADD_ANCHOR_LINKS_VERSION', '0.0.1');

global $add_anchor_links_options;
$add_anchor_links_options = get_option( 'add_anchor_links_settings' );

// Localize plugin
add_action('init', 'add_anchor_links_localize_plugin');
function add_anchor_links_localize_plugin() {
    load_plugin_textdomain('add-anchor-links', false, ADD_ANCHOR_LINKS_DIR . 'languages/');
}

// Is WooCommerce active?
add_action('plugins_loaded', 'add_anchor_links_plugin_init');

function add_anchor_links_plugin_init() {

    global $add_anchor_links_options;
    
    if ( is_admin() ) {

        //add_action('admin_enqueue_scripts', 'add_anchor_links_admin_scripts');
        //add_filter('woocommerce_get_settings_pages', 'add_anchor_links_woocommerce_get_settings_pages');
        require_once( ADD_ANCHOR_LINKS_DIR . 'admin/settings.php' );
        add_filter('plugin_action_links_' . ADD_ANCHOR_LINKS_PLUGIN_BASENAME, 'add_anchor_links_plugin_action_links');

    } elseif( is_single('post') ) {

        if ( ! $add_anchor_links_options['own_css'] ) {            
            add_action('enqueue_scripts', 'add_anchor_links_scripts');
        }

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
	wp_enqueue_script('add-anchor-links-style', ADD_ANCHOR_LINKS_URL . 'assets/css/add-anchor-links.css', ADD_ANCHOR_LINKS_VERSION );
}

// TODO show link icon?