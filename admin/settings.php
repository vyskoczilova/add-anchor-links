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
		'add_anchor_links_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'own_css', 
		__( 'Use your own CSS', 'add-anchor-links' ), 
		'own_css_render', 
		'pluginPage', 
		'add_anchor_links_design_section' 
	);

	add_settings_field( 
		'show_icon', 
		__( 'Show Link icon next to heading', 'add-anchor-links' ), 
		'show_icon_render', 
		'pluginPage', 
		'add_anchor_links_design_section' 
	);

}


function own_css_render(  ) { 

	$options = get_option( 'add_anchor_links_settings' );
	?>
	<input type='checkbox' name='add_anchor_links_settings[own_css]' <?php checked( $options['own_css'], 1 ); ?> value='1'>
	<?php

}


function show_icon_render(  ) { 

	$options = get_option( 'add_anchor_links_settings' );
	?>
	<input type='checkbox' name='add_anchor_links_settings[show_icon]' <?php checked( $options['show_icon'], 1 ); ?> value='1'>
	<?php

}


function add_anchor_links_settings_section_callback(  ) { 

	echo __( 'Modify the Add Links Section desing settings.', 'add-anchor-links' );

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

?>