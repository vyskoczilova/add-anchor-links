<?php

/**
 * Main plugin file
 *
 * @package    WordPress
 * @subpackage Add anchors links
 * @since 1.0.0
 */

/**
 * Plugin Name: Add Anchor Links
 * Description: Creates anchor links to heading tags in the content. Modified by Benjamin Antupit to add Heroic Block support.
 * Version:     1.0.5
 * Author:      Karolína Vyskočilová
 * Author URI:  https://kybernaut.cz
 * Text Domain: add-anchor-links
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

global $add_anchor_links_options;
// Plugin options.
$add_anchor_links_options = wp_parse_args(get_option('add_anchor_links_settings', []), add_anchor_links_options_defaults());

define('ADD_ANCHOR_LINKS_DIR', plugin_dir_path(__FILE__));
define('ADD_ANCHOR_LINKS_URL', plugin_dir_url(__FILE__));
define('ADD_ANCHOR_LINKS_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('ADD_ANCHOR_LINKS_VERSION', '1.0.5');

/**
 * Localize plugin
 *
 * @since 1.0.0
 * @return void
 */
function add_anchor_links_localize_plugin()
{
	load_plugin_textdomain('add-anchor-links', false, ADD_ANCHOR_LINKS_DIR . 'languages/');
}
add_action('init', 'add_anchor_links_localize_plugin');

/**
 * Load plugin
 *
 * @since 1.0.0
 * @return void
 */
function add_anchor_links_plugin_init()
{

	if (is_admin()) {
		require_once(ADD_ANCHOR_LINKS_DIR . 'admin/settings.php');
		add_filter('plugin_action_links_' . ADD_ANCHOR_LINKS_PLUGIN_BASENAME, 'add_anchor_links_plugin_action_links');
		add_action('admin_notices', 'add_anchor_links_admin_notice_activation');
	} else {
		add_action('wp_enqueue_scripts', 'add_anchor_links_scripts');
		require_once(ADD_ANCHOR_LINKS_DIR . 'include/class-add-anchor-links.php');
		$aal = new Kybernaut\AddAnchorLinks();
		$aal->init();
	}
}
add_action('plugins_loaded', 'add_anchor_links_plugin_init', 99);

/**
 * Add settings link
 *
 * @since 1.0.0
 * @param array $links Array of setting links.
 * @return array
 */
function add_anchor_links_plugin_action_links($links)
{
	$action_links = [
	'settings' => '<a href="' . admin_url('options-general.php?page=add_anchor_links') . '" aria-label="' . esc_attr__('View Add Anchor Links settings', 'add-anchor-links') . '">' . esc_html__('Settings', 'add-anchor-links') . '</a>',
	];

	return array_merge($action_links, $links);
}

/**
 * Load scripts and styles
 *
 * @since 1.0.0
 * @since 1.0.1 ADD_ANCHOR_LINKS_DONT_LOAD_CSS
 * @since TBD   Minified stylesheet.
 */
function add_anchor_links_scripts()
{

	// Don't load scripts if disabled by settings or by constant.
	global $add_anchor_links_options;
	if (defined('ADD_ANCHOR_LINKS_DONT_LOAD_CSS') && ADD_ANCHOR_LINKS_DONT_LOAD_CSS || $add_anchor_links_options['own_css']) {
		return;
	}

	// Load minified stylesheet for production.
	if (is_singular(add_anchor_links_post_types(true))) {
		wp_enqueue_style('add-anchor-links-style', ADD_ANCHOR_LINKS_URL . 'assets/css/add-anchor-links.min.css', [], ADD_ANCHOR_LINKS_VERSION);
	}
}

/**
 * Default options
 *
 * @since 1.0.0
 * @since TBD  Scope, whether to add links to paragraphs.
 * Any setting registered as false disappears from the DB,
 * because false is is not registered.
 * @return array
 */
function add_anchor_links_options_defaults()
{
	$default_options = [
		'own_css' => false,
		'post_types' => false,
		'headings' => false, // Mustn’t default to true.
		'paragraphs' => false,
		'accordions' => false,
		'toggles' => false,
	];
	$post_types = add_anchor_links_post_types();
	foreach ($post_types as $pt) {
		$default_options[$pt] = false;
	}
	return $default_options;
}

/**
 * Get post types where the All is enabled
 *
 * @since 1.0.0
 * @param bool $active Active.
 * @return array $post_types
 */
function add_anchor_links_post_types($active = false)
{

	$post_types = get_post_types([
		'public'   => true,
	]);

	if ($active) {
		global $add_anchor_links_options;
		$_post_types = $post_types;
		$post_types = [];

		foreach ($_post_types as $pt) {
			if (isset($add_anchor_links_options[$pt]) && $add_anchor_links_options[$pt]) {
				$post_types[] = $pt;
			}
		}
	}

	return $post_types;
}

/**
 * Runs only when the plugin is activated.
 *
 * @since 1.0.1
 * @return void
 */
function add_anchor_links_activation_hook()
{

	// Create transient data.
	set_transient('aal-admin-notice-activation', true, 5);
}
register_activation_hook(__FILE__, 'add_anchor_links_activation_hook');

/**
 * Admin Notice on Activation.
 *
 * @since 1.0.1
 * @return void
 */
function add_anchor_links_admin_notice_activation()
{

	/* Check transient, if available display notice */
	if (get_transient('aal-admin-notice-activation')) {
		?>
		<div class="notice notice-warning is-dismissible">
			<?php /* translators: 1st tag is </b>, 2nd opening anchor tag, 3rd closing anchor tag */ ?>
			<p><b><?php printf(esc_html__('ADD ANCHOR LINKS:%1$s Don\'t forget to set up the plugin in %2$ssettings%3$s.', 'add-anchor-links'), '</b>', '<a href="' . esc_attr(admin_url('options-general.php?page=add_anchor_links')) . '" aria-label="' . esc_attr__('View Add Anchor Links settings', 'add-anchor-links') . '">', '</a>'); ?></p>
		</div>
		<?php
		/* Delete transient, only display this notice once. */
		delete_transient('aal-admin-notice-activation');
	}
}
