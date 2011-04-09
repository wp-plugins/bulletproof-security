<?php
// Direct calls to this file are Forbidden when core files are not present
if (!function_exists ('add_action')) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}

// WordPress "Settings" Panel menu link
function bulletproof_security_admin_link() {
	add_options_page(__('BulletProof Security', 'bulletproof-security'), __('BulletProof Security', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/options.php');
}

function bulletproof_security_admin_init() {
	// Global 'whitelist_settings' register
	register_setting('bulletproof_security', 'bulletproof_security', 'bulletproof_security_save_settings');
	
	// Register BPS js
	wp_register_script( 'bps-js', WP_PLUGIN_URL . '/bulletproof-security/admin/js/bulletproof-security-admin.js');
	// Register BPS stylesheet
	wp_register_style('bps-css', plugins_url('/bulletproof-security/admin/css/bulletproof-security-admin.css'));

	// Create BPS Backup Folder structure - suppressing errors on activation - errors displayed in HUD
	if( !is_dir (WP_CONTENT_DIR . '/bps-backup')) {
		@mkdir (WP_CONTENT_DIR . '/bps-backup/master-backups', 0755, true);
		@chmod (WP_CONTENT_DIR . '/bps-backup/', 0755);
		@chmod (WP_CONTENT_DIR . '/bps-backup/master-backups/', 0755);
	}
	
	// Hook for main bps options settings page
	add_action('load-bulletproof-security/admin/options.php', 'bulletproof_security_load_settings_page');
}
	
function bulletproof_security_load_settings_page() {
	global $bulletproof_security, $user_ID;
	do_action('bps_settings_page');

	// Enqueue BPS scripts and styles
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-form');
	wp_enqueue_script('swfobject');
	wp_enqueue_script('bps-js');
   	
	// Engueue BPS stylesheet
	wp_enqueue_style('bps-css', plugins_url('/bulletproof-security/admin/css/bulletproof-security-admin.css'));
}

function bulletproof_security_install() {
	global $bulletproof_security;
	$previous_install = get_option('bulletproof_security');
	if ( $previous_install ) {
	if ( version_compare($previous_install['version'], '.46.1', '<') )
	remove_role('denied');
	}
}

function bulletproof_security_uninstall() {
	$options = get_option('bulletproof_security');
	require_once( ABSPATH . 'wp-admin/includes/plugin.php');
}
?>