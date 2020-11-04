<?php
/**
 * Add Anchor Links <https://github.com/vyskoczilova/add-anchor-links>
 * WordPress plugin <https://fr.wordpress.org/plugins/add-anchor-links/>
 * Author: Karolína Vyskočilová <https://kybernaut.cz>
 * 
 * Forked on GitHub by pewgeuges on 2020-10-20T0159+0200
 * Last modified:  2020-10-21T2259+0200
 */
// If this file is called directly, abort and display a message:
if ( ! defined( 'WPINC' ) ) {
	die( nl2br( "\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;en:&nbsp;&nbsp;&nbsp;&nbsp;This PHP file cannot be displayed in the browser.\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;For a quick look, please open this content as a plain text file if there is any with the same name.\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You may also wish to download the target and open the file in a text editor.\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fr&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;Ce fichier ne peut pas s'afficher dans le navigateur.\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pour un aperçu du contenu, ouvrez s.v.p. le fichier texte de même nom s’il existe.\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vous pouvez aussi télécharger la cible du lien et ouvrir le fichier dans votre éditeur de texte." ) );
}
  
add_action( 'admin_menu', 'add_anchor_links_add_admin_menu' );
add_action( 'admin_init', 'add_anchor_links_settings_init' );

/**
 * @since 1.0.0
 */
function add_anchor_links_add_admin_menu(  ) { 

	add_submenu_page( 'options-general.php', 'Add Anchor Links', 'Add Anchor Links', 'manage_options', 'add_anchor_links', 'add_anchor_links_options_page' );

}

/**
 * @since 1.0.0
 */
function add_anchor_links_settings_init(  ) { 

	register_setting( 'add_anchor_links_plugin_page', 'add_anchor_links_settings' );

	add_settings_section(
		'add_anchor_links_design_section', 
		__( 'Design', 'add-anchor-links' ), 
		'add_anchor_links_empty_section_callback', 
		'add_anchor_links_plugin_page'
	);

	add_settings_field( 
		'own_css', 
		__( 'Use your own CSS', 'add-anchor-links' ), 
		'add_anchor_links_own_css_render', 
		'add_anchor_links_plugin_page', 
		'add_anchor_links_design_section' 
    );

    add_settings_section(
		'add_anchor_links_apply_on_section', 
		__( 'Apply on', 'add-anchor-links' ), 
		'add_anchor_links_empty_section_callback', 
		'add_anchor_links_plugin_page'
	);

	add_settings_field( 
		'post_types', 
		__( 'Add anchors on types:', 'add-anchor-links' ), 
		'add_anchor_links_post_types_render', 
		'add_anchor_links_plugin_page', 
		'add_anchor_links_apply_on_section' 
    );
    
	add_settings_field( 
		'elements', 
		__( 'Add anchors on elements:', 'add-anchor-links' ), 
		'add_anchor_links_element_types_render', 
		'add_anchor_links_plugin_page', 
		'add_anchor_links_apply_on_section' 
    );
    

}

/**
 * @since 1.0.0
 */
function add_anchor_links_own_css_render(  ) { 

    global $add_anchor_links_options;
    
	?>
	<input type='checkbox' name='add_anchor_links_settings[own_css]' value='1' <?php checked( $add_anchor_links_options['own_css'], 1 ); ?>>
	<?php

}

/**
 * @since 1.0.0
 */
function add_anchor_links_post_types_render() { 

    global $add_anchor_links_options;
    $post_types = add_anchor_links_post_types();
    foreach ( $post_types as $pt ) {
		if ( ! isset( $add_anchor_links_options[$pt] )) {
			$add_anchor_links_options[$pt] = false;
		}        
        ?>
        <label><input type='checkbox' name='add_anchor_links_settings[<?php echo $pt; ?>]' value='1' <?php checked( $add_anchor_links_options[$pt], 1 ); ?>><?php echo $pt; ?></label><br /><?php
    }    

}

/**
 * @since 1.1.0
 */
function add_anchor_links_element_types_render() { 

    global $add_anchor_links_options;
    $element_types = array( 'headings', 'paragraphs' );
    foreach ( $element_types as $et ) {
		if ( ! isset( $add_anchor_links_options[$et] )) {
			$add_anchor_links_options[$et] = false;
		}        
        ?>
        <label><input type='checkbox' name='add_anchor_links_settings[<?php echo $et; ?>]' value='1' <?php checked( $add_anchor_links_options[$et], 1 ); ?>><?php echo $et; ?></label><br /><?php
    }    

}

/**
 * @since 1.0.0
 */
function add_anchor_links_empty_section_callback() { 
}

/**
 * @since 1.0.0
 */
function add_anchor_links_options_page(  ) { 

	?>
	<form action='options.php' method='post'>

		<h2><?php _e('Add Anchor Links','add-anchor-links'); ?></h2>

		<?php
		settings_fields( 'add_anchor_links_plugin_page' );
		do_settings_sections( 'add_anchor_links_plugin_page' );
		submit_button();
		?>

	</form>
	<?php

}
