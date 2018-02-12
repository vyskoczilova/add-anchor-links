<?php

/*
  Plugin Name: Add Anchor Links
  Description: Creates anchor links to heading tags in the content.
  Version:     1.0.1
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
define('ADD_ANCHOR_LINKS_VERSION', '1.0.1');

/**
 * Localize plugin
 * @since 1.0.0
 */
add_action('init', 'add_anchor_links_localize_plugin');
function add_anchor_links_localize_plugin() {
    load_plugin_textdomain('add-anchor-links', false, ADD_ANCHOR_LINKS_DIR . 'languages/');
}

/**
 * Load plugin
 * @since 1.0.0
 */
add_action('plugins_loaded', 'add_anchor_links_plugin_init', 99);
function add_anchor_links_plugin_init() {    
    
    if ( is_admin() ) {

        require_once( ADD_ANCHOR_LINKS_DIR . 'admin/settings.php' );
        add_filter('plugin_action_links_' . ADD_ANCHOR_LINKS_PLUGIN_BASENAME, 'add_anchor_links_plugin_action_links');
        add_action( 'admin_notices', 'add_anchor_links_admin_notice_activation' );

    } else {     
        
        add_action('wp_enqueue_scripts', 'add_anchor_links_scripts');
        require_once( ADD_ANCHOR_LINKS_DIR . 'include/class-add-anchor-links.php' );        

    }

}

/**
 * Add settings link
 * @since 1.0.0
 */
function add_anchor_links_plugin_action_links($links) {
    $action_links = array(
	'settings' => '<a href="' . admin_url('options-general.php?page=add_anchor_links') . '" aria-label="' . esc_attr__('View Add Anchor Links settings', 'add-anchor-links') . '">' . esc_html__('Settings', 'add-anchor-links') . '</a>',
    );

    return array_merge($action_links, $links);
}

/**
 * Load scripts and styles
 * @since 1.0.0
 * @since 1.0.1 ADD_ANCHOR_LINKS_DONT_LOAD_CSS
 */
function add_anchor_links_scripts() {

    // Don't load scripts if disabled by settings or by constant
    global $add_anchor_links_options;
    if ( defined( 'ADD_ANCHOR_LINKS_DONT_LOAD_CSS' ) && ADD_ANCHOR_LINKS_DONT_LOAD_CSS || $add_anchor_links_options['own_css'] ) {
        return;
    }

    if ( is_singular( add_anchor_links_post_types( true ) ) ) {
        wp_enqueue_style('add-anchor-links-style', ADD_ANCHOR_LINKS_URL . 'assets/css/add-anchor-links.css', array(), ADD_ANCHOR_LINKS_VERSION );
    }

}

/**
 * Default options
 * @since 1.0.0
 */
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

/**
 * Get post types where the AAL is enabled
 * @since 1.0.0
 */
function add_anchor_links_post_types( $active = false ) {

    $post_types = get_post_types( array(
        'public'   => true,
    ) );

    if ( $active ) {

        global $add_anchor_links_options;
        $_post_types = $post_types;
        $post_types = array();

        foreach( $_post_types as $pt ) {     
            if ( isset($add_anchor_links_options[$pt] ) && $add_anchor_links_options[$pt] ) {
                $post_types[] = $pt;
            }
        }

    }

    return $post_types;
}

/**
 * Runs only when the plugin is activated.
 * @since 1.0.1
 */
function add_anchor_links_activation_hook() {
 
    /* Create transient data */
    set_transient( 'aal-admin-notice-activation', true, 5 );

}
register_activation_hook( __FILE__, 'add_anchor_links_activation_hook' );
 
/**
 * Admin Notice on Activation.
 * @since 1.0.1
 */
function add_anchor_links_admin_notice_activation(){
 
    /* Check transient, if available display notice */
    if( get_transient( 'aal-admin-notice-activation' ) ){
        ?>
        <div class="notice notice-warning is-dismissible">
            <p><b><?php printf( esc_html__( 'ADD ANCHOR LINKS:%s Don\'t forget to set up the plugin in %ssettings%s.', 'add-anchor-links' ), '</b>', '<a href="' . admin_url('options-general.php?page=add_anchor_links') . '" aria-label="' . esc_attr__('View Add Anchor Links settings', 'add-anchor-links') . '">', '</a>' ); ?></p>
        </div>
        <?php
        /* Delete transient, only display this notice once. */
        delete_transient( 'aal-admin-notice-activation' );
    }
}