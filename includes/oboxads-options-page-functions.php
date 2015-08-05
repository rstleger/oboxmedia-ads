<?php
function oboxads_ads_in_posts_render(  ) { 

	$options = get_option( 'oboxads_settings' );
	?>
	<input type='checkbox' name='oboxads_settings[oboxads_ads_in_posts]' <?php checked( $options['oboxads_ads_in_posts'], 1 ); ?> value='1'>
	<?php

}


function oboxads_domain_render(  ) { 

	$options = get_option( 'oboxads_settings' );
    
    $domain = (isset($options['oboxads_domain']) ? $options['oboxads_domain'] :  $_SERVER['SERVER_NAME'] );
	?>
	<input type='text' name='oboxads_settings[oboxads_domain]' value="<?php echo esc_attr( $domain ); ?>">
	<?php

}

function oboxads_settings_section_callback(  ) { 

//	echo __( 'This section description', 'oboxads' );

}


function oboxads_options_page(  ) { 

	?>
	<form action='options.php' method='post'>
		
		<h2>Oboxads</h2>
		
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
		
	</form>
	<?php

}
