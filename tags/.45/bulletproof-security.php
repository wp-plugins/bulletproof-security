<?php
/*
Plugin Name: BulletProof Security
Plugin URI: http://www.ait-pro.com/aitpro-blog/297/bulletproof-security-plugin-support/bulletproof-security-wordpress-plugin-support/
Description: Protects your website from ALL XSS & SQL Injection hacking attempts. Protects wp-config.php with .htaccess protection. One-click .htaccess security file activation. One-click website under maintenance mode activation (HTTP 503). Hide your WordPress version - WP Generator META tag removed, Check and ensure WP DB errors are off, Check WordPress file and folder permissions, Extensive system info (PHP, MySQL, OS, Memory Usage, IP, Max file size info, etc.). Security Status checking.  
Version: .45
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

define( 'BULLETPROOF_VERSION', '.45' );

// Global configuration class file - used in BulletProof Security Pro only
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

// Load BulletProof Security Pro modules - used in BulletProof Security Pro only
// bulletproof_security_pro_load_modules();

// Admin install / uninstall - BPS Pro module used in BulletProof Security Pro only
if ( is_admin() ) {
    require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/includes/admin.php' );
    //require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/includes/bps-pro-modules.php' );
	
	register_activation_hook(__FILE__, 'bulletproof_security_install');
    register_uninstall_hook(__FILE__, 'bulletproof_security_uninstall');

	add_action( 'admin_init', 'bulletproof_security_admin_init' );
    add_action( 'admin_menu', 'bulletproof_security_admin_link' );
}

function bps_plugin_actlinks( $links, $file ){
// "Settings" link on Plugins Options Page 
	static $this_plugin;
	if ( ! $this_plugin ) $this_plugin = plugin_basename(__FILE__);
	if ( $file == $this_plugin ){
	$settings_link = '<a href="options-general.php?page=bulletproof-security/admin/options.php">' . __('Settings') . '</a>';
		array_unshift( $links, $settings_link );
	}
	return $links;
}
	add_filter( "plugin_action_links", 'bps_plugin_actlinks', 10, 2 );
?>