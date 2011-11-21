<?php
/*
Plugin Name: BulletProof Security
Plugin URI: http://www.ait-pro.com/aitpro-blog/297/bulletproof-security-plugin-support/bulletproof-security-wordpress-plugin-support/
Description: Website Security Protection: BulletProof Security protects your website from XSS, RFI, CSRF, Base64, Code Injection and SQL Injection hacking attempts. One-click .htaccess WordPress security protection. Protects wp-config.php, bb-config.php, php.ini, php5.ini, install.php and readme.html with .htaccess security protection. One-click Website Maintenance Mode (HTTP 503). Additional website security checks: DB errors off, file and folder permissions check... System Info: PHP, MySQL, OS, Memory Usage, IP, Max file sizes... Built-in .htaccess file editing, uploading and downloading.
Version: .46.5
Author: Edward Alexander
Author URI: http://www.ait-pro.com/
*/

/*  Copyright (C) 2010 Edward Alexander @ AITpro.com (email : edward @ ait-pro.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

define( 'BULLETPROOF_VERSION', '.46.5' );

// Global configuration class file - pending development
require_once( WP_PLUGIN_DIR . '/bulletproof-security/includes/class.php' );

// Declare $bulletproof_security_pro as global for functions
global $bulletproof_security;

// Global configuration class initialization
$bulletproof_security = new Bulletproof_Security();

// BPS functions
require_once( WP_PLUGIN_DIR . '/bulletproof-security/includes/functions.php' );
	remove_action('wp_head', 'wp_generator');
	
// Load BPS plugin textdomain - pending language translations
// load_plugin_textdomain('bulletproof-security', '', 'bulletproof-security/language');

// Load BulletProof Security Pro modules - pending
// bulletproof_security_pro_load_modules();

// If in WP Dashboard or Admin Panels
if ( is_admin() ) {
    require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/includes/admin.php' );
	register_activation_hook(__FILE__, 'bulletproof_security_install');
    register_uninstall_hook(__FILE__, 'bulletproof_security_uninstall');

	add_action( 'admin_init', 'bulletproof_security_admin_init' );
    add_action( 'admin_menu', 'bulletproof_security_admin_menu' );
}

function bps_plugin_actlinks( $links, $file ){
// "Settings" link on Plugins Options Page 
	static $this_plugin;
	if ( ! $this_plugin ) $this_plugin = plugin_basename(__FILE__);
	if ( $file == $this_plugin ){
	$settings_link = '<a href="admin.php?page=bulletproof-security/admin/options.php">' . __('Settings') . '</a>';
		array_unshift( $links, $settings_link );
	}
	return $links;
}
	add_filter( "plugin_action_links", 'bps_plugin_actlinks', 10, 2 );
?>