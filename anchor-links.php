<?php

/*
  Plugin Name: Anchor Links
  Description: TODO
  Version:     0.0.1
  Author:      Karolína Vyskočilová
  Author URI:  https://kybernaut.cz
  Text Domain: anchor-links
  Domain Path: /languages
 
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

define('ANCHOR_LINKS_DIR', plugin_dir_path(__FILE__));
define('ANCHOR_LINKS_URL', plugin_dir_url(__FILE__));
define('ANCHOR_LINKS_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('ANCHOR_LINKS_VERSION', '0.0.1');

// Localize plugin
add_action('init', 'anchor_links_localize_plugin');
function anchor_links_localize_plugin() {
    load_plugin_textdomain('anchor-links', false, ANCHOR_LINKS_DIR . 'languages/');
}

// Is WooCommerce active?
add_action('plugins_loaded', 'anchor_links_plugin_init');

function anchor_links_plugin_init() {

    if ( is_admin() ) {
        //add_action('admin_enqueue_scripts', 'anchor_links_admin_scripts');
        //add_filter('woocommerce_get_settings_pages', 'anchor_links_woocommerce_get_settings_pages');
        add_filter('plugin_action_links_' . ANCHOR_LINKS_PLUGIN_BASENAME, 'anchor_links_plugin_action_links');
    }

    if ( is_anchor_links_active() ) {
        //require_once( ANCHOR_LINKS_DIR . 'includes/class-anchor-links-api.php' );
        //require_once( ANCHOR_LINKS_DIR . 'includes/class-anchor-links-orders.php' );
        //require_once( ANCHOR_LINKS_DIR . 'includes/class-anchor-links-wc-ajax.php' );
    }
}

// Add settings link
function anchor_links_plugin_action_links($links) {
    $action_links = array(
	'settings' => '<a href="' . admin_url('admin.php?page=wc-settings&tab=anchor-links') . '" aria-label="' . esc_attr__('View Anchor Links settings', 'anchor-links') . '">' . esc_html__('Settings', 'anchor-links') . '</a>',
    );
    // TODO Fix link

    return array_merge($action_links, $links);
}