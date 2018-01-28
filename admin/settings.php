<?php
add_action( 'admin_menu', 'add_anchor_links_add_admin_menu' );
add_action( 'admin_init', 'add_anchor_links_settings_init' );


function add_anchor_links_add_admin_menu(  ) { 

	add_submenu_page( 'options-general.php', 'Add Anchor Links', 'Add Anchor Links', 'manage_options', 'add_anchor_links', 'add_anchor_links_options_page' );

}


function add_anchor_links_settings_init(  ) { 

	register_setting( 'pluginPage', 'add_anchor_links_settings' );

	add_settings_section(
		'add_anchor_links_design_section', 
		__( 'Design', 'add-anchor-links' ), 
		'add_anchor_links_empty_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'own_css', 
		__( 'Use your own CSS', 'add-anchor-links' ), 
		'own_css_render', 
		'pluginPage', 
		'add_anchor_links_design_section' 
    );

    add_settings_section(
		'add_anchor_links_apply_on_section', 
		__( 'Apply on', 'add-anchor-links' ), 
		'add_anchor_links_empty_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'post_types', 
		__( 'Add anchors on', 'add-anchor-links' ), 
		'post_types_render', 
		'pluginPage', 
		'add_anchor_links_apply_on_section' 
    );
    

}

function own_css_render(  ) { 

    global $add_anchor_links_options;
    
	?>
	<input type='checkbox' name='add_anchor_links_settings[own_css]' value='1' <?php checked( $add_anchor_links_options['own_css'], 1 ); ?>>
	<?php

}

function post_types_render(  ) { 

    global $add_anchor_links_options;
    $post_types = add_anchor_links_post_types();
    foreach ( $post_types as $pt ) {        
        ?>
        <label><input type='checkbox' name='add_anchor_links_settings[<?php echo $pt; ?>]' value='1' <?php checked( $add_anchor_links_options[$pt], 1 ); ?>><?php echo $pt; ?></label><br /><?php
    }    

}

function add_anchor_links_empty_section_callback(  ) { 
}

function add_anchor_links_options_page(  ) { 

	?>
	<form action='options.php' method='post'>

		<h2>Add Anchor Links</h2>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}