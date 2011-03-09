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
	
	// Register BPS additional scripts
	wp_register_script( 'jquery-uploadify-142-min', WP_PLUGIN_URL . '/bulletproof-security/admin/uploadify/jquery-1.4.2.min.js' );
	wp_register_script( 'jquery-uploadify-v214-min', WP_PLUGIN_URL . '/bulletproof-security/admin/uploadify/jquery.uploadify.v2.1.4.min.js' );
	//wp_register_script( 'bps-admin-js', WP_PLUGIN_URL . '/bulletproof-security/admin/js/bulletproof-security-admin.js' );
	
	// Create BPS Backup Folder structure
	if(!is_dir(WP_CONTENT_DIR.'/bps-backup/')) {
		mkdir(WP_CONTENT_DIR.'/bps-backup/master-backups',0750,true);
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
	wp_enqueue_script('jquery-uploadify-142-min');
	wp_enqueue_script('jquery-uploadify-v214-min');
	wp_enqueue_script('swfobject');
	//wp_enqueue_script('bps-admin-js');
    
	// Misbehaving figure this one out later - problem with registering the script - enqueue is working fine
	wp_enqueue_script('bulletproof-security-admin', plugins_url('/bulletproof-security/admin/js/bulletproof-security-admin.js'));
   	wp_enqueue_style('bulletproof-security-admin', plugins_url('/bulletproof-security/admin/css/bulletproof-security-admin.css'));

// User based scheme style settings
	if ( function_exists('get_user_meta') )
	$admin_color = get_user_meta($user_ID, 'admin_color');
	else
	$admin_color = get_usermeta($user_ID, 'admin_color');
	if ( 'style1' == $admin_color )
	wp_enqueue_style('bulletproof-security-style1', plugins_url('/bulletproof-security/admin/css/style1.css'));
	else
	wp_enqueue_style('bulletproof-security-style2', plugins_url('/bulletproof-security/admin/css/style2.css'));
}

function bulletproof_security_install() {
	global $bulletproof_security;
	$previous_install = get_option('bulletproof_security');
	if ( $previous_install ) {
	if ( version_compare($previous_install['version'], '.46', '<') )
	remove_role('denied');
	}
}

function bulletproof_security_uninstall() {
	$options = get_option('bulletproof_security');
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
?>