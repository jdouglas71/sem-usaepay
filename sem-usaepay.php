<?php
/*
Plugin Name: Strategic eMarketing USA ePay
Plugin URI: http://www.douglasconsulting.net
Description: The Strategic eMarketing USA ePay plugin.
Version: 0.5 Alpha
Author: Jason Douglas
Author URI: http://www.douglasconsulting.net
License: GPL
*/

//Template Config File
require_once(dirname(__FILE__)."/config.php");

/** HOOKS **/

/* This calls sem_usaepay_init() function when wordpress initializes. */
add_action('init', 'sem_usaepay_init');
add_action('wp_head', 'sem_usaepay_js_header' );

/* Runs when Plugin is activated. */
register_activation_hook( __FILE__, 'sem_usaepay_install' );

/* Runs on plugin deactivated. */
register_deactivation_hook( __FILE__, 'sem_usaepay_uninstall' );

/** Admin Stuff **/
add_action( 'admin_menu', 'sem_usaepay_admin_menu' );

/**
 * Add our admin menu to the dashboard.
 */
function sem_usaepay_admin_menu()
{
	add_options_page( 'SEM USA ePay', 'SEM USA ePay', 'administrator', 'sem_usaepay', 'sem_usaepay_admin_page');
}

/**
 * Show the admin page.
 */ 
function sem_usaepay_admin_page()
{
	include( 'sem-usaepay-admin.php' );
}

/** SHORTCODES **/
add_shortcode( 'sem_usaepay_form', 'sem_usaepay_form_shortcode' );

/** FUNCTIONS **/
/**
 * Installer function
 */
function sem_usaepay_install()
{
	global $wpdb;
	global $sem_usaepay_version;
	global $sem_usaepay_key;

	//Update Options
	if( !add_option(SEM_USAEPAY_VERSION, $sem_usaepay_version) )
	{
		update_option(SEM_USAEPAY_VERSION, $sem_usaepay_version);
	}

	//Add Options
	if( !add_option( SEM_USAEPAY_KEY, $sem_usaepay_key ) )
	{
		update_option( SEM_USAEPAY_KEY, $sem_usaepay_key );
	}

	if( !add_option( SEM_USAEPAY_TESTMODE, $sem_usaepay_testmode ) )
	{
		update_option( SEM_USAEPAY_TESTMODE, $sem_usaepay_testmode );
	}

}

/**
 * Uninstall Function.
 */
function sem_usaepay_uninstall()
{
	global $wpdb;

	//Clear out options
	delete_option( SEM_USAEPAY_VERSION );
	delete_option( SEM_USAEPAY_KEY );
	delete_option( SEM_USAEPAY_TESTMODE );
}

/**
 * Called on init of WordPress.
 */
function sem_usaepay_init()
{
	global $sem_usaepay_version;
	global $sem_usaepay_key;
	global $sem_usaepay_testmode;

	if( !is_admin() )
	{
		$sem_usaepay_version = get_option( SEM_USAEPAY_VERSION );
		$sem_usaepay_key = get_option( SEM_USAEPAY_KEY );
		$sem_usaepay_testmode = get_option( SEM_USAEPAY_TESTMODE );
	}
}

/**
 * Form Template
 */
function sem_usaepay_form_shortcode($atts, $content=null)
{
	logToFile( "sem_usaepay_form_shortcode.\n" );
	//Extract atts

	$retval = "<link rel='stylesheet' href='".SEM_USAEPAY_CSS."' type='text/css' media='screen'/>".
		       sem_usaepay_form(); 

	logToFile( $retval );

	return $retval;
}

/**
 * Set up header for AJAX calls.
 */
function sem_usaepay_js_header()
{
	wp_print_scripts( array('sack') );
	?>
	<script type='text/javascript'>

	</script>
	<?php
}

?>
