<?php

// WordPress "Settings" Panel menu link
function bulletproof_security_admin_link() {
	add_options_page(__('BulletProof Security', 'bulletproof-security'), __('BulletProof Security', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/options.php');
}

function bulletproof_security_admin_init() {
// Global 'whitelist_settings' register
register_setting('bulletproof_security', 'bulletproof_security', 'bulletproof_security_save_settings');

// Hook for main bps options settings page
	add_action('load-bulletproof-security/admin/options.php', 'bulletproof_security_load_settings_page');
		
// Hook for BulletProof Security Pro modules - used in BulletProof Security Pro only
// do_action('bps_pro_admin_init');
}

function bulletproof_security_load_settings_page() {
	global $bulletproof_security, $user_ID;
	do_action('bps_settings_page');

	// Enqueue BPS scripts and styles
    wp_enqueue_script('bulletproof-security-admin', plugins_url('/bulletproof-security/admin/js/bulletproof-security-admin.js'));
    wp_enqueue_script('jquery-ui-tabs');
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
	if ( version_compare($previous_install['version'], '.44.1', '<') )
	remove_role('denied');
	}
}

function bulletproof_security_uninstall() {
	$options = get_option('bulletproof_security');
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
?>