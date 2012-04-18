<?php
/**
 * Twenty Twelve Theme Options
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/**
 * Register the form setting for our twenty_twelve_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, twenty_twelve_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are complete, properly
 * formatted, and safe.
 *
 * We also use this function to add our theme option if it doesn't already exist.
 */
function twenty_twelve_theme_options_init() {

	// If we have no options in the database, let's add them now.
	if ( false === twenty_twelve_get_theme_options() )
		add_option( 'twenty_twelve_theme_options', twenty_twelve_get_default_theme_options() );

	register_setting(
		'twenty_twelve_options',       // Options group, see settings_fields() call in twenty_twelve_theme_options_render_page()
		'twenty_twelve_theme_options', // Database option, see twenty_twelve_get_theme_options()
		'twenty_twelve_theme_options_validate' // The sanitization callback, see twenty_twelve_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see twenty_twelve_theme_options_add_page()
	);

	// Register our individual settings fields
	add_settings_field(
		'enable_fonts', // Unique identifier for the field for this section
		__( 'Enable Web Fonts', 'twentytwelve' ), // Setting field label
		'twenty_twelve_settings_field_enable_fonts', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see twenty_twelve_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);
}
add_action( 'admin_init', 'twenty_twelve_theme_options_init' );

/**
 * Add our theme options page to the admin menu.
 *
 * This function is attached to the admin_menu action hook.
 */
function twenty_twelve_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'twentytwelve' ),   // Name of page
		__( 'Theme Options', 'twentytwelve' ),   // Label in menu
		'edit_theme_options',                    // Capability required
		'theme_options',                         // Menu slug, used to uniquely identify the page
		'twenty_twelve_theme_options_render_page' // Function that renders the options page
	);
}
add_action( 'admin_menu', 'twenty_twelve_theme_options_add_page' );

/**
 * Returns the default options.
 */
function twenty_twelve_get_default_theme_options() {
	$default_theme_options = array(
		'enable_fonts' => 'off',
	);

	return apply_filters( 'twenty_twelve_default_theme_options', $default_theme_options );
}

/**
 * Returns the options array.
 */
function twenty_twelve_get_theme_options() {
	return get_option( 'twenty_twelve_theme_options', twenty_twelve_get_default_theme_options() );
}

/**
 * Renders the enable fonts checkbox setting field.
 */
function twenty_twelve_settings_field_enable_fonts() {
	$options = twenty_twelve_get_theme_options();
	?>
	<label for"enable-fonts">
		<input type="checkbox" name="twenty_twelve_theme_options[enable_fonts]" id="enable-fonts" <?php checked( 'on', $options['enable_fonts'] ); ?> />
		<?php _e( 'Yes, I&#8217;d like to enable the gorgeous, open-source <em>Open Sans</em> typeface.', 'twentytwelve' );  ?>
	</label>
	<?php
}

/**
 * Returns the options array.
 */
function twenty_twelve_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', 'twentytwelve' ), wp_get_theme() ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'twenty_twelve_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see twenty_twelve_theme_options_init()
 */
function twenty_twelve_theme_options_validate( $input ) {
	$output = $defaults = twenty_twelve_get_default_theme_options();

	// The enable fonts checkbox should either be on or off
	if ( ! isset( $input['enable_fonts'] ) )
		$input['enable_fonts'] = 'off';
	$output['enable_fonts'] = ( $input['enable_fonts'] == 'on' ? 'on' : 'off' );

	return apply_filters( 'twenty_twelve_theme_options_validate', $output, $input, $defaults );
}
