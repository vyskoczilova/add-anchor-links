<?php

/**
 * Admin settings
 *
 * @package    WordPress
 * @subpackage Add anchor links
 * @since 1.0.0
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
	die;
}

/**
 *
 * Add submenu to Settings.
 *
 * @since 1.0.0
 * @return void
 */
function add_anchor_links_add_admin_menu()
{

	add_submenu_page('options-general.php', 'Add Anchor Links', 'Add Anchor Links', 'manage_options', 'add_anchor_links', 'add_anchor_links_options_page');
}
add_action('admin_menu', 'add_anchor_links_add_admin_menu');

/**
 * Add settings.
 *
 * @since 1.0.0
 * @return void
 */
function add_anchor_links_settings_init()
{

	register_setting('add_anchor_links_plugin_page', 'add_anchor_links_settings');

	add_settings_section(
		'add_anchor_links_design_section',
		__('Design', 'add-anchor-links'),
		'add_anchor_links_empty_section_callback',
		'add_anchor_links_plugin_page'
	);

	add_settings_field(
		'own_css',
		__('Use your own CSS', 'add-anchor-links'),
		'add_anchor_links_own_css_render',
		'add_anchor_links_plugin_page',
		'add_anchor_links_design_section'
	);

	add_settings_section(
		'add_anchor_links_apply_on_section',
		__('Apply on', 'add-anchor-links'),
		'add_anchor_links_empty_section_callback',
		'add_anchor_links_plugin_page'
	);

	add_settings_field(
		'post_types',
		__('Add anchors on', 'add-anchor-links'),
		'add_anchor_links_post_types_render',
		'add_anchor_links_plugin_page',
		'add_anchor_links_apply_on_section'
	);

	add_settings_section(
		'add_anchor_links_scope_section',
		__('Scope: By default, anchors are added to all headings and nowhere else.', 'add-anchor-links'),
		'add_anchor_links_empty_section_callback',
		'add_anchor_links_plugin_page'
	);

	add_settings_field(
		'scope',
		__('Override defaults:', 'add-anchor-links'),
		'add_anchor_links_scope_render',
		'add_anchor_links_plugin_page',
		'add_anchor_links_scope_section'
	);
}
add_action('admin_init', 'add_anchor_links_settings_init');

/**
 * Render settings: Own CSS
 *
 * @since 1.0.0
 * @return void
 */
function add_anchor_links_own_css_render()
{

	global $add_anchor_links_options;

	?>
	<input type='checkbox' name='add_anchor_links_settings[own_css]' value='1' <?php checked($add_anchor_links_options['own_css'], 1); ?>>
	<?php
}

/**
 * Render settings: Post types
 *
 * @since 1.0.0
 * @return void
 */
function add_anchor_links_post_types_render()
{

	global $add_anchor_links_options;
	$post_types = add_anchor_links_post_types();
	foreach ($post_types as $pt) {
		if (! isset($add_anchor_links_options[$pt])) {
			$add_anchor_links_options[$pt] = false;
		}
		?>
		<label><input type='checkbox' name='add_anchor_links_settings[<?php echo esc_attr($pt); ?>]' value='1' <?php checked($add_anchor_links_options[$pt], 1); ?>><?php echo esc_attr($pt); ?></label><br /><?php
	}
}

/**
 * Render settings: Scope.
 *
 * @since TBD
 * Using a way to restore full backwards compatibility while yet getting
 * around of needing default-checked boxes, as these are not feasible in
 * WordPress default option pages because settings set to none disappear
 * from the DB and are thus reset to their default value.
 * @return void
 */
function add_anchor_links_scope_render()
{

	global $add_anchor_links_options;
	$scope = [ 'headings', 'paragraphs' ];
	foreach ($scope as $sc) {
		if (! isset($add_anchor_links_options[$sc])) {
			$add_anchor_links_options[$sc] = false;
		}
	}
		?>
		<label><input type='checkbox' name='add_anchor_links_settings[paragraphs]' value='1' <?php checked($add_anchor_links_options[ 'paragraphs' ], 1); ?>><?php echo __( 'Add anchors also (or only) to paragraphs, list items and block quotes.', 'add-anchor-links' ); ?></label><br />
		<label><input type='checkbox' name='add_anchor_links_settings[headings]' value='1' <?php checked($add_anchor_links_options[ 'headings' ], 1); ?>><?php echo __( 'Do not add anchors to headings (because these may get them otherwise).', 'add-anchor-links' ); ?></label><br /><?php
}

/**
 * Render settings: Empty section callback
 *
 * @since 1.0.0
 * @return void;
 */
function add_anchor_links_empty_section_callback()
{
}

/**
 * Render settings: Options page
 *
 * @since 1.0.0
 * @return void
 */
function add_anchor_links_options_page()
{

	?>
	<form action='options.php' method='post'>

		<h2><?php echo esc_html_e('Add Anchor Links', 'add-anchor-links'); ?></h2>

		<?php
		settings_fields('add_anchor_links_plugin_page');
		do_settings_sections('add_anchor_links_plugin_page');
		submit_button();
		?>

	</form>
	<?php
}
