<?php
/*
Plugin Name: Strategic eMarketing USA ePay
Plugin URI: http://www.douglasconsulting.net
Description: The Strategic eMarketing USA ePay plugin. Updated for Making Headway website.
Version: 0.6 Beta
Author: Jason Douglas
Author URI: http://www.douglasconsulting.net
License: GPL
*/

//Template Config File
require_once(dirname(__FILE__)."/config.php");

/** HOOKS **/

/* This calls sem_usaepay_init() function when wordpress initializes. */

/* Runs when Plugin is activated. */

/* Runs on plugin deactivated. */

/** Admin Stuff **/

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
add_action( 'admin_menu', 'sem_usaepay_admin_menu' );

/** SHORTCODES **/

/** FUNCTIONS **/
/**
 * Installer function
 */
function sem_usaepay_install()
{
	add_option(SEM_USAEPAY_VERSION, $sem_usaepay_version);
	add_option(SEM_USAEPAY_KEY, $sem_usaepay_key);
	add_option(SEM_USAEPAY_TESTMODE, $sem_usaepay_testmode);
	add_option(SEM_USAEPAY_NOTIFICATION_EMAIL, $sem_usaepay_notification_email);
}
register_activation_hook( __FILE__, 'sem_usaepay_install' );

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
	delete_option( SEM_USAEPAY_NOTIFICATION_EMAIL );
}
register_deactivation_hook( __FILE__, 'sem_usaepay_uninstall' );

/**
 * Called on init of WordPress.
 */
function sem_usaepay_init()
{
}
add_action('init', 'sem_usaepay_init');

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
add_shortcode( 'sem_usaepay_form', 'sem_usaepay_form_shortcode' );

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
add_action('wp_head', 'sem_usaepay_js_header' );

