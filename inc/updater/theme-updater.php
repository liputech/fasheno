<?php
/**
 * @author  RadiusTheme
 * @since   1.0.1
 * @version 1.0.1
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

add_action( 'after_setup_theme', 'rdtheme_edd_theme_updater', 20 );

function rdtheme_edd_theme_updater(){
	$theme_data = wp_get_theme( get_template() );

	// Config settings
	$config = array(
		'remote_api_url' => 'https://www.radiustheme.com', // Site where EDD is hosted
		'item_id'        => 305544, // ID of item in site where EDD is hosted
		'theme_slug'     => '_rt_fasheno', // Theme slug
		'version'        => $theme_data->get( 'Version' ), // The current version of this theme
		'author'         => $theme_data->get( 'Author' ), // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => '' // Optional, allows for a custom license renewal link
	);

	// Strings
	$strings = array(
		'theme-license'             => __( 'Theme License', 'fasheno' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'fasheno' ),
		'license-key'               => __( 'License Key', 'fasheno' ),
		'license-action'            => __( 'License Action', 'fasheno' ),
		'deactivate-license'        => __( 'Deactivate License', 'fasheno' ),
		'activate-license'          => __( 'Activate License', 'fasheno' ),
		'status-unknown'            => __( 'License status is unknown.', 'fasheno' ),
		'renew'                     => __( 'Renew?', 'fasheno' ),
		'unlimited'                 => __( 'unlimited', 'fasheno' ),
		'license-key-is-active'     => __( 'License key is active.', 'fasheno' ),
		'expires%s'                 => __( 'Expires %s.', 'fasheno' ),
		'lifetime-license'          => __( 'License type: lifetime.', 'fasheno' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'fasheno' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'fasheno' ),
		'license-key-expired'       => __( 'License key has expired.', 'fasheno' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'fasheno' ),
		'license-is-inactive'       => __( 'License is inactive.', 'fasheno' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'fasheno' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'fasheno' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'fasheno' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'fasheno' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'fasheno' )
	);

	// Loads the updater classes
	global $fasheno_edd_updater;
	$fasheno_edd_updater = new EDD_Theme_Updater_Admin( $config, $strings );
}
