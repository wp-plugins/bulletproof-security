<?php
// Direct calls to this file are Forbidden when core files are not present
if ( ! function_exists ('add_action') ) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}

// Displays Initial, Peak and Total Memory usage
function bpsPro_memory_resource_usage() {
	
	if ( is_admin() && current_user_can('manage_options') ) {

	$memory_usage_peak = memory_get_peak_usage();
	$mbytes_peak = number_format( $memory_usage_peak / ( 1024 * 1024 ), 2 );
	$kbytes_peak = number_format( $memory_usage_peak / ( 1024 ) );	
	
	$memory_usage = memory_get_usage();
	$mbytes = number_format( $memory_usage / ( 1024 * 1024 ), 2 );
	$kbytes = number_format( $memory_usage / ( 1024 ) );
	
	$mbytes_total = number_format( $memory_usage_peak / ( 1024 * 1024 ) - $memory_usage / ( 1024 * 1024 ), 2 );
	$kbytes_total = number_format( $memory_usage_peak / ( 1024 ) - $memory_usage / ( 1024 ) );	
	
	$usage = '<strong>'.__('Peak Memory Usage: ', 'bulletproof-security').'</strong>'. $mbytes_peak . __('MB|', 'bulletproof-security').$kbytes_peak.__('KB', 'bulletproof-security').'<br><strong>'.__('Initial Memory in Use: ', 'bulletproof-security').'</strong>'. $mbytes . __('MB|', 'bulletproof-security').$kbytes.__('KB', 'bulletproof-security').'<br><strong>'.__('Total Memory Used: ', 'bulletproof-security').'</strong>'. $mbytes_total . __('MB|', 'bulletproof-security').$kbytes_total.__('KB', 'bulletproof-security').'<br>';

	return $usage;
	}
}

// Logs Initial, Peak and Total Memory usage
function bpsPro_memory_resource_usage_logging() {
	
	$memory_usage_peak = memory_get_peak_usage();
	$mbytes_peak = number_format( $memory_usage_peak / ( 1024 * 1024 ), 2 );
	$kbytes_peak = number_format( $memory_usage_peak / ( 1024 ) );	
	
	$memory_usage = memory_get_usage();
	$mbytes = number_format( $memory_usage / ( 1024 * 1024 ), 2 );
	$kbytes = number_format( $memory_usage / ( 1024 ) );
	
	$mbytes_total = number_format( $memory_usage_peak / ( 1024 * 1024 ) - $memory_usage / ( 1024 * 1024 ), 2 );
	$kbytes_total = number_format( $memory_usage_peak / ( 1024 ) - $memory_usage / ( 1024 ) );	
	
	$usage = __('Peak Memory Usage: ', 'bulletproof-security'). $mbytes_peak . __('MB|', 'bulletproof-security').$kbytes_peak.__('KB', 'bulletproof-security')."\r\n".__('Initial Memory in Use: ', 'bulletproof-security'). $mbytes . __('MB|', 'bulletproof-security').$kbytes.__('KB', 'bulletproof-security')."\r\n".__('Total Memory Used: ', 'bulletproof-security'). $mbytes_total . __('MB|', 'bulletproof-security').$kbytes_total.__('KB', 'bulletproof-security');

	return $usage;
}

// BPS Master htaccess File Editing - file checks and get contents for editor
function bps_get_secure_htaccess() {
$secure_htaccess_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/secure.htaccess';

	if ( file_exists($secure_htaccess_file) ) {
		$bpsString = file_get_contents($secure_htaccess_file);
		echo $bpsString;
	} else {
		$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR );
		_e('The secure.htaccess file either does not exist or is not named correctly. Check the /', 'bulletproof-security').$bps_plugin_dir.__('/bulletproof-security/admin/htaccess/ folder to make sure the secure.htaccess file exists and is named secure.htaccess.', 'bulletproof-security');
	}
}

function bps_get_default_htaccess() {
$default_htaccess_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/default.htaccess';

	if ( file_exists($default_htaccess_file) ) {
		$bpsString = file_get_contents($default_htaccess_file);
		echo $bpsString;
	} else {
		$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR );
		_e('The default.htaccess file either does not exist or is not named correctly. Check the /', 'bulletproof-security').$bps_plugin_dir.__('/bulletproof-security/admin/htaccess/ folder to make sure the default.htaccess file exists and is named default.htaccess.', 'bulletproof-security');
	}
}

function bps_get_wpadmin_htaccess() {
$wpadmin_htaccess_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess';

	if ( file_exists($wpadmin_htaccess_file) ) {
		$bpsString = file_get_contents($wpadmin_htaccess_file);
		echo $bpsString;
	} else {
		$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR );
		_e('The wpadmin-secure.htaccess file either does not exist or is not named correctly. Check the /', 'bulletproof-security').$bps_plugin_dir.__('/bulletproof-security/admin/htaccess/ folder to make sure the wpadmin-secure.htaccess file exists and is named wpadmin-secure.htaccess.', 'bulletproof-security');
	}
}

// The current active root htaccess file - file check
function bps_get_root_htaccess() {
$root_htaccess_file = ABSPATH . '.htaccess';
	
	if ( file_exists($root_htaccess_file) ) {
		$bpsString = file_get_contents($root_htaccess_file);
		echo $bpsString;
	} else {
		_e('An htaccess file was not found in your website root folder.', 'bulletproof-security');
	}
}

// The current active wp-admin htaccess file - file check
function bps_get_current_wpadmin_htaccess_file() {
$current_wpadmin_htaccess_file = ABSPATH . 'wp-admin/.htaccess';
	
	if ( file_exists($current_wpadmin_htaccess_file) ) {
		$bpsString = file_get_contents($current_wpadmin_htaccess_file);
		echo $bpsString;
	} else {
		_e('An htaccess file was not found in your wp-admin folder.', 'bulletproof-security');
	}
}

// File write checks for editor
function bps_secure_htaccess_file_check() {
$secure_htaccess_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/secure.htaccess';
	
	if ( ! is_writable($secure_htaccess_file) ) {
		$text = '<font color="red"><strong>'.__('Cannot write to the secure.htaccess file. Cause: file Permission or file Ownership problem.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
}

// File write checks for editor
function bps_default_htaccess_file_check() {
$default_htaccess_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/default.htaccess';
	
	if ( ! is_writable($default_htaccess_file) ) {
		$text = '<font color="red"><strong>'.__('Cannot write to the default.htaccess file. Cause: file Permission or file Ownership problem.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
}

// File write checks for editor
function bps_wpadmin_htaccess_file_check() {
$wpadmin_htaccess_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess';
	
	if ( ! is_writable($wpadmin_htaccess_file) ) {
		$text = '<font color="red"><strong>'.__('Cannot write to the wpadmin-secure.htaccess file. Cause: file Permission or file Ownership problem.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
}

// File write checks for editor
function bps_root_htaccess_file_check() {
$root_htaccess_file = ABSPATH . '.htaccess';
	
	if ( ! is_writable($root_htaccess_file) ) {
		$text = '<font color="red"><strong>'.__('Cannot write to the Root htaccess file. Cause: file Permission or file Ownership problem.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
}

// File write checks for editor
function bps_current_wpadmin_htaccess_file_check() {
$current_wpadmin_htaccess_file = ABSPATH . 'wp-admin/.htaccess';
	
	if ( ! is_writable($current_wpadmin_htaccess_file) ) {
		$text = '<font color="red"><strong>'.__('Cannot write to the wp-admin htaccess file. Cause: file Permission or file Ownership problem.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
}

// Get Domain Root without prefix
function bpsGetDomainRoot() {

	if ( is_admin() && current_user_can('manage_options') ) {
	if ( isset( $_SERVER['SERVER_NAME'] ) ) {

		$ServerName = str_replace( 'www.', "", esc_html( $_SERVER['SERVER_NAME'] ) );
		return $ServerName;		
	
	} else {
		$ServerName = str_replace( 'www.', "", esc_html( $_SERVER['HTTP_HOST'] ) );
		return $ServerName;	
	}
	}
}

// B-Core Security Status inpage display - Root .htaccess
function bps_root_htaccess_status() {

	$filename = ABSPATH . '.htaccess';
	
	if ( ! file_exists($filename) ) {
		$text = '<font color="red">'.__('ERROR: An htaccess file was NOT found in your root folder', 'bulletproof-security').'</font><br><br>'.__('wp-config.php is NOT htaccess protected by BPS', 'bulletproof-security').'</font><br><br>';
		echo $text;
	
	} else {
	
	global $bps_version, $bps_last_version;	
	$section = @file_get_contents($filename, NULL, NULL, 3, 47);
	$check_string = @file_get_contents($filename);	
	
	if ( file_exists($filename) ) {
		$text = '<font color="green"><strong>'.__('The htaccess file that is activated in your root folder is:', 'bulletproof-security').'</strong></font><br>';
		echo $text;
		echo '<font color="black">';
		print($section);
		echo '</font>';

switch ( $bps_version ) {
    case $bps_last_version: // for Testing
		if ( ! strpos( $check_string, "BULLETPROOF $bps_last_version" ) && strpos( $check_string, "BPSQSE" ) ) {
			$text = '<font color="red"><br><br><strong>'.__('BPS may be in the process of updating the version number in your root htaccess file. Refresh your browser to display your current security status and this message should go away. If the BPS QUERY STRING EXPLOITS code does not exist in your root htaccess file then the version number update will fail and this message will still be displayed after you have refreshed your Browser. You will need to click the AutoMagic buttons and activate all BulletProof Modes again.', 'bulletproof-security').'<br><br>'.__('wp-config.php is NOT htaccess protected by BPS', 'bulletproof-security').'</strong></font><br><br>';
			echo $text;
		}
		if ( strpos( $check_string, "BULLETPROOF $bps_last_version" ) && strpos( $check_string, "BPSQSE" ) ) {
			$text = '<font color="green"><strong><br><br>&radic; '.__('wp-config.php is htaccess protected by BPS', 'bulletproof-security').'<br>&radic; '.__('php.ini and php5.ini are htaccess protected by BPS', 'bulletproof-security').'</strong></font><br><br>';
			echo $text;
		break;
		}
    case $bps_version:
		if ( ! strpos( $check_string, "BULLETPROOF $bps_version" ) && strpos( $check_string, "BPSQSE" ) ) {
			$text = '<font color="red"><br><br><strong>'.__('BPS may be in the process of updating the version number in your root htaccess file. Refresh your browser to display your current security status and this message should go away. If the BPS QUERY STRING EXPLOITS code does not exist in your root htaccess file then the version number update will fail and this message will still be displayed after you have refreshed your Browser. You will need to click the AutoMagic buttons and activate all BulletProof Modes again.', 'bulletproof-security').'<br><br>'.__('wp-config.php is NOT htaccess protected by BPS', 'bulletproof-security').'</strong></font><br><br>';
			echo $text;
		}
		if ( strpos( $check_string, "BULLETPROOF $bps_version") && strpos( $check_string, "BPSQSE" ) ) {		
			$text = '<font color="green"><strong><br><br>&radic; '.__('wp-config.php is htaccess protected by BPS', 'bulletproof-security').'<br>&radic; '.__('php.ini and php5.ini are htaccess protected by BPS', 'bulletproof-security').'</strong></font><br><br>';
			echo $text;
		break;
		}
	default:
		$text = '<font color="red"><br><br><strong>'.__('ERROR: Either a BPS htaccess file was NOT found in your root folder or you have not activated BulletProof Mode for your Root folder yet, Default Mode is activated or the version of the BPS htaccess file that you are using is not the most current version or the BPS QUERY STRING EXPLOITS code does not exist in your root htaccess file. Please view the Read Me Help button above.', 'bulletproof-security').'<br><br>'.__('wp-config.php is NOT htaccess protected by BPS', 'bulletproof-security').'</strong></font><br><br>';
		echo $text;
	}
	}
	}
}

// B-Core Security Status inpage display - wp-admin .htaccess
function bps_wpadmin_htaccess_status() {
	
	$BPS_wpadmin_Options = get_option('bulletproof_security_options_htaccess_res');
	
	if ( $BPS_wpadmin_Options['bps_wpadmin_restriction'] == 'disabled' ) {
		$text = '<font color="blue"><strong>'.__('wp-admin BulletProof Mode is disabled on the Security Modes page or you have a Go Daddy Managed WordPress Hosting account type.', 'bulletproof-security').'</strong></font>';
		echo $text;
	return;
	}

	$filename = ABSPATH . 'wp-admin/.htaccess';	
	
	if ( ! file_exists($filename) ) {
		$text = '<font color="red"><strong>'.__('ERROR: An htaccess file was NOT found in your wp-admin folder.', 'bulletproof-security').'<br>'.__('BulletProof Mode for the wp-admin folder should also be activated when you have BulletProof Mode activated for the Root folder.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	
	} else {
	
	global $bps_version, $bps_last_version;

	$section = @file_get_contents($filename, NULL, NULL, 3, 50);
	$check_string = @file_get_contents($filename);	

	if ( file_exists($filename) ) {

switch ( $bps_version ) {
    case $bps_last_version:
		if ( ! strpos( $check_string, "BULLETPROOF $bps_last_version" ) && strpos( $check_string, "BPSQSE-check" ) ) {
			$text = '<font color="red"><strong><br><br>'.__('BPS may be in the process of updating the version number in your wp-admin htaccess file. Refresh your browser to display your current security status and this message should go away. If the BPS QUERY STRING EXPLOITS code does not exist in your wp-admin htaccess file then the version number update will fail and this message will still be displayed after you have refreshed your Browser. You will need to activate BulletProof Mode for your wp-admin folder again.', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		}
		if ( strpos( $check_string, "BULLETPROOF $bps_last_version" ) && strpos( $check_string, "BPSQSE-check" ) ) {
			$text = '<font color="green"><strong>'.__('The htaccess file that is activated in your wp-admin folder is:', 'bulletproof-security').'</strong></font><br>';
			echo $text;
			echo '<font color="black">';
			print($section);
			echo '</font>';
		break;
		}
    case $bps_version:
		if ( ! strpos( $check_string, "BULLETPROOF $bps_version" ) && strpos( $check_string, "BPSQSE-check" ) ) {
			$text = '<font color="red"><strong><br><br>'.__('BPS may be in the process of updating the version number in your wp-admin htaccess file. Refresh your browser to display your current security status and this message should go away. If the BPS QUERY STRING EXPLOITS code does not exist in your wp-admin htaccess file then the version number update will fail and this message will still be displayed after you have refreshed your Browser. You will need to activate BulletProof Mode for your wp-admin folder again.', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		}
		if ( strpos( $check_string, "BULLETPROOF $bps_version" ) && strpos( $check_string, "BPSQSE-check" ) ) {		
			$text = '<font color="green"><strong>'.__('The htaccess file that is activated in your wp-admin folder is:', 'bulletproof-security').'</strong></font><br>';
			echo $text;
			echo '<font color="black">';
			print($section);
			echo '</font>';
		break;
		}
	default:
		$text = '<font color="red"><strong><br><br>'.__('ERROR: A valid BPS htaccess file was NOT found in your wp-admin folder. Either you have not activated BulletProof Mode for your wp-admin folder yet or the version of the wp-admin htaccess file that you are using is not the most current version. BulletProof Mode for the wp-admin folder should also be activated when you have BulletProof Mode activated for the Root folder.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	}
	}
}

// Check if BPS Deny ALL htaccess file is activated for the BPS Master htaccess folder
function bps_denyall_htaccess_status_master() {
$filename = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/.htaccess';
	
	if ( file_exists($filename) ) {
    	$text = '<font color="green"><strong>&radic; '.__('Deny All protection activated for BPS Master /htaccess folder', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	} else {
    	$text = '<font color="red"><strong>'.__('ERROR: Deny All protection NOT activated for BPS Master /htaccess folder', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
}

// Check if BPS Deny ALL htaccess file is activated for the /wp-content/bps-backup folder
function bps_denyall_htaccess_status_backup() {
$filename = WP_CONTENT_DIR . '/bps-backup/.htaccess';
$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );

	if ( file_exists($filename) ) {
    	$text = '<font color="green"><strong>&radic; '.__('Deny All protection activated for /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup folder', 'bulletproof-security').'</strong></font><br><br>';
		echo $text;
	} else {
    	$text = '<font color="red"><strong>'.__('ERROR: Deny All protection NOT activated for /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup folder', 'bulletproof-security').'</strong></font><br><br>';
		echo $text;
	}
}

// File and Folder Permission Checking
function bps_check_perms($path, $perm) {
clearstatcache();
$current_perms = @substr(sprintf('%o', fileperms($path)), -4);
$stat = stat($path);

	echo '<table style="width:100%;background-color:#fff;">';
	echo '<tr>';
    echo '<td style="color:#000;background-color:#fff;padding:2px;width:40%;">' . $path . '</td>';
    echo '<td style="color:#000;background-color:#fff;padding:2px;width:15%;">' . $perm . '</td>';
    echo '<td style="color:#000;background-color:#fff;padding:2px;width:15%;">' . $current_perms . '</td>';
    echo '<td style="color:#000;background-color:#fff;padding:2px;width:15%;">' . $stat['uid'] . '</td>';
    echo '<td style="color:#000;background-color:#fff;padding:2px;width:15%;">' . @fileowner( $path ) . '</td>';
    echo '</tr>';
	echo '</table>';
}
	
// System Info page only - Check if Permalinks are enabled
function bps_check_permalinks() {
$permalink_structure = get_option('permalink_structure');	
	
	if ( get_option('permalink_structure') == '' ) { 
		$text = __('Custom Permalinks:', 'bulletproof-security').'<font color="red"><strong>'.__('WARNING! Custom Permalinks are NOT in use', 'bulletproof-security').'<br>'.__('It is recommended that you use Custom Permalinks', 'bulletproof-security').'</strong></font>';
		echo $text;
	} else {
		$text = __('Custom Permalinks:', 'bulletproof-security').' <font color="green"><strong>&radic; '.__('Custom Permalinks are in use', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
}

// Check PHP version
function bps_check_php_version() {
	
	if ( version_compare(PHP_VERSION, '5.0.0', '>=') ) {
    	$text = __('PHP Version Check:', 'bulletproof-security').' <font color="green"><strong>&radic; '.__('Running PHP5', 'bulletproof-security').'</strong></font><br>';
		echo $text;
}
	if ( version_compare(PHP_VERSION, '5.0.0', '<') ) {
    	$text = '<font color="red"><strong>'.__('WARNING! BPS requires PHP5 to function correctly. Your PHP version is:', 'bulletproof-security').' '. PHP_VERSION . '</strong></font><br>';
		echo $text;
	}
}

// Heads Up Display - Check PHP version - top error message new activations/installations
function bps_check_php_version_error() {
	
	if ( version_compare( PHP_VERSION, '5.0.0', '>=' ) ) {
		return;
	}
	
	if ( version_compare( PHP_VERSION, '5.0.0', '<' ) ) {
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('WARNING! BPS requires at least PHP5 to function correctly. Your PHP version is: ', 'bulletproof-security').PHP_VERSION.'</font><br><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45#bulletproof-security-issues-problems" target="_blank">'.__('BPS Guide - PHP5 Solution', 'bulletproof-security').'</a><br>'.__('The BPS Guide will open in a new browser window. You will not be directed away from your WordPress Dashboard.', 'bulletproof-security').'</div>';
		echo $text;
	}
}

add_action('admin_notices', 'bps_check_permalinks_error');

// Heads Up Display w/ Dismiss - Check if Permalinks are enabled - top error message new activations/installations
function bps_check_permalinks_error() {

	if ( current_user_can('manage_options') && get_option('permalink_structure') == '' ) {

		global $current_user;
		$user_id = $current_user->ID;
		
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}	
	
		if ( ! get_user_meta($user_id, 'bps_ignore_Permalinks_notice') ) { 
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('HUD Check: Custom Permalinks are NOT being used.', 'bulletproof-security').'</font><br>'.__('It is recommended that you use Custom Permalinks: ', 'bulletproof-security').'<a href="http://www.ait-pro.com/aitpro-blog/2304/wordpress-tips-tricks-fixes/permalinks-wordpress-custom-permalinks-wordpress-best-wordpress-permalinks-structure/" target="_blank" title="Link opens in a new Browser window">'.__('How to setup Custom Permalinks', 'bulletproof-security').'</a><br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the Security Status page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_Permalinks_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;		
		}
	}
}

add_action('admin_init', 'bps_Permalinks_nag_ignore');

function bps_Permalinks_nag_ignore() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset($_GET['bps_Permalinks_nag_ignore']) && '0' == $_GET['bps_Permalinks_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_ignore_Permalinks_notice', 'true', true);
	}
}

add_action('admin_notices', 'bps_check_iis_supports_permalinks');

// Heads Up Display Dashboard - Check if Windows IIS server and if IIS7 supports permalink rewriting
function bps_check_iis_supports_permalinks() {
global $wp_rewrite, $is_IIS, $is_iis7, $current_user;
$user_id = $current_user->ID;	

	if ( current_user_can('manage_options') && $is_IIS && ! iis7_supports_permalinks() ) {
	if ( ! get_user_meta($user_id, 'bps_ignore_iis_notice')) {

	if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
		$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
	} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
		$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
	} else {
		$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
	}

		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('WARNING! BPS has detected that your Server is a Windows IIS Server that does not support htaccess rewriting.', 'bulletproof-security').'</font><br>'.__('Do NOT activate BulletProof Modes unless you know what you are doing.', 'bulletproof-security').'<br>'.__('Your Server Type is: ', 'bulletproof-security').$_SERVER['SERVER_SOFTWARE'].'<br><a href="http://codex.wordpress.org/Using_Permalinks" target="_blank" title="This link will open in a new browser window.">'.__('WordPress Codex - Using Permalinks - see IIS section', 'bulletproof-security').'</a><br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the Security Status page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_iis_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';		
		echo $text;
	}
	}
}

add_action('admin_init', 'bps_iis_nag_ignore');

function bps_iis_nag_ignore() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset( $_GET['bps_iis_nag_ignore'] ) && '0' == $_GET['bps_iis_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_ignore_iis_notice', 'true', true);
	}
}

// Heads Up Display - mkdir and chmod errors are suppressed on activation - check if /bps-backup folder exists
function bps_hud_check_bpsbackup() {
$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );
	
	if ( ! is_dir( WP_CONTENT_DIR . '/bps-backup' ) ) {
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('WARNING! BPS was unable to automatically create the /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup folder.', 'bulletproof-security').'</font><br>'.__('You will need to create the /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup folder manually via FTP. The folder permissions for the bps-backup folder need to be set to 755 in order to successfully perform permanent online backups.', 'bulletproof-security').'<br>'.__('To remove this message permanently click ', 'bulletproof-security').'<a href="http://www.ait-pro.com/aitpro-blog/2566/bulletproof-security-plugin-support/bulletproof-security-error-messages" target="_blank">'.__('here.', 'bulletproof-security').'</a></div>';
		echo $text;
	}
	
	if ( ! is_dir( WP_CONTENT_DIR . '/bps-backup/master-backups' ) ) {
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('WARNING! BPS was unable to automatically create the /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/master-backups folder.', 'bulletproof-security').'</font><br>'.__('You will need to create the /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/master-backups folder manually via FTP. The folder permissions for the master-backups folder need to be set to 755 in order to successfully perform permanent online backups.', 'bulletproof-security').'<br>'.__('To remove this message permanently click ', 'bulletproof-security').'<a href="http://www.ait-pro.com/aitpro-blog/2566/bulletproof-security-plugin-support/bulletproof-security-error-messages" target="_blank">'.__('here.', 'bulletproof-security').'</a></div>';
		echo $text;
	}
}

// Heads Up Display - Check if PHP Safe Mode is On - 1 is On - 0 is Off
function bps_check_safemode() {
	
	if ( ini_get('safe_mode') == 1) {
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('WARNING! BPS has detected that Safe Mode is set to On in your php.ini file.', 'bulletproof-security').'</font><br>'.__('If you see errors that BPS was unable to automatically create the backup folders this is probably the reason why.', 'bulletproof-security').'<br>'.__('To remove this message permanently click ', 'bulletproof-security').'<a href="http://www.ait-pro.com/aitpro-blog/2566/bulletproof-security-plugin-support/bulletproof-security-error-messages" target="_blank">'.__('here.', 'bulletproof-security').'</a></div>';
		echo $text;
	}
}

// Heads Up Display - Check if W3TC is active or not and check root htaccess file for W3TC htaccess code 
function bps_w3tc_htaccess_check($plugin_var) {
	
	$plugin_var = 'w3-total-cache/w3-total-cache.php';
    $return_var = in_array( $plugin_var, apply_filters('active_plugins', get_option('active_plugins')));

	if ( $return_var == 1 || is_plugin_active_for_network( 'w3-total-cache/w3-total-cache.php' )) { // checks if W3TC is active for Single site or Network
		
		if ( ! is_multisite() ) {
			$bpsSiteUrl = get_option('siteurl');
			$bpsHomeUrl = get_option('home');
		} else {
			$bpsSiteUrl = get_site_option('siteurl');
			$bpsHomeUrl = network_site_url();		
		}

		$filename = ABSPATH . '.htaccess';
		$string = file_get_contents($filename);	

		if ( $bpsSiteUrl == $bpsHomeUrl ) {
			if ( ! strpos( $string, "W3TC" ) ) {
				$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('W3 Total Cache is activated, but W3TC htaccess code was NOT found in your root htaccess file.', 'bulletproof-security').'</font><br>'.__('W3TC needs to be redeployed by clicking either the W3TC auto-install or deploy buttons. Your Root htaccess file must be temporarily unlocked so that W3TC can write to your Root htaccess file. Click to ', 'bulletproof-security').'<a href="admin.php?page=w3tc_general">'.__('Redeploy W3TC.', 'bulletproof-security').'</a><br>'.__('You can copy W3TC .htaccess code from your Root .htaccess file to BPS Custom Code to save it permanently so that you will not have to do these steps in the future.', 'bulletproof-security').'<br>'.__('Copy W3TC .htaccess code to this BPS Custom Code text box: CUSTOM CODE TOP PHP/PHP.INI HANDLER/CACHE CODE, click the Save Root Custom Code button, go to the BPS Security Modes page, click the Create secure.htaccess File AutoMagic button and activate Root folder BulletProof Mode again.', 'bulletproof-security').'</div>';
				echo $text;
			}
		}
	}
	elseif ( $return_var != 1 || ! is_plugin_active_for_network( 'w3-total-cache/w3-total-cache.php' )) { // checks if W3TC is active for Single site or Network
		
		if ( ! is_multisite() ) {
			$bpsSiteUrl = get_option('siteurl');
			$bpsHomeUrl = get_option('home');
		} else {
			$bpsSiteUrl = get_site_option('siteurl');
			$bpsHomeUrl = network_site_url();		
		}

		$filename = ABSPATH . '.htaccess';
		$string = file_get_contents($filename);			
		
		if ( $bpsSiteUrl == $bpsHomeUrl ) {
			if ( strpos( $string, "W3TC" ) ) {
				$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('W3 Total Cache is deactivated and W3TC .htaccess code was found in your root htaccess file.', 'bulletproof-security').'</font><br>'.__('If this is just temporary then this warning message will go away when you reactivate W3TC. If you are planning on uninstalling W3TC the W3TC htaccess code will be automatically removed from your root htaccess file when you uninstall W3TC. Your Root htaccess file must be temporarily unlocked so that W3TC can remove the W3TC Root htaccess code. If you manually edit your root htaccess file then refresh your browser to perform a new htaccess file check.', 'bulletproof-security').'</div>';
				echo $text;
			} 
		}
	}
}

// Heads Up Display - Check if WPSC is active or not and check root htaccess file for WPSC htaccess code 
function bps_wpsc_htaccess_check($plugin_var) {
	
	$plugin_var = 'wp-super-cache/wp-cache.php';
    $return_var = in_array( $plugin_var, apply_filters('active_plugins', get_option('active_plugins')));

	if ( $return_var == 1 || is_plugin_active_for_network( 'wp-super-cache/wp-cache.php' ) ) { // checks if WPSC is active for Single site or Network
		
		if ( ! is_multisite() ) {
			$bpsSiteUrl = get_option('siteurl');
			$bpsHomeUrl = get_option('home');
		} else {
			$bpsSiteUrl = get_site_option('siteurl');
			$bpsHomeUrl = network_site_url();		
		}
		
		$filename = ABSPATH . '.htaccess';
		$string = file_get_contents($filename);		
		
		if ( $bpsSiteUrl == $bpsHomeUrl ) {
			if ( ! strpos($string, "WPSuperCache" ) ) { 
				$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('WP Super Cache is activated, but either you are not using WPSC mod_rewrite to serve cache files or the WPSC htaccess code was NOT found in your root htaccess file.', 'bulletproof-security').'</font><br>'.__('If you are not using WPSC mod_rewrite then copy this: # WPSuperCache to this BPS Custom Code text box: CUSTOM CODE TOP PHP/PHP.INI HANDLER/CACHE CODE, click the Save Root Custom Code button, go to the Security Modes page, click the Create secure.htaccess File AutoMagic button and activate Root folder BulletProof Mode again.', 'bulletproof-security').'<br>'.__('If you are using WPSC mod_rewrite and the WPSC htaccess code is not in your root htaccess file then unlock your Root htaccess file temporarily then click this ', 'bulletproof-security').'<a href="options-general.php?page=wpsupercache&tab=settings">'.__('Update WPSC link', 'bulletproof-security').'</a>'.__(' to go to the WPSC Settings page and click the Update Mod_Rewrite Rules button.', 'bulletproof-security').'<br>'.__('If you have put your site in Default Mode then disregard this Alert and DO NOT update your Mod_Rewrite Rules. Refresh your browser to perform a new htaccess file check.', 'bulletproof-security').'<br>'.__('You can copy WPSC .htaccess code from your Root .htaccess file to BPS Custom Code to save it permanently so that you will not have to do these steps in the future.', 'bulletproof-security').'<br>'.__('Copy WPSC .htaccess code to this BPS Custom Code text box: CUSTOM CODE TOP PHP/PHP.INI HANDLER/CACHE CODE, click the Save Root Custom Code button, go to the BPS Security Modes page, click the Create secure.htaccess File AutoMagic button and activate Root folder BulletProof Mode again.', 'bulletproof-security').'</div>';
				echo $text;
			}
		}
	}
	elseif ( $return_var != 1 || ! is_plugin_active_for_network( 'wp-super-cache/wp-cache.php' )) { // checks if WPSC is NOT active for Single or Network
		
		if ( ! is_multisite() ) {
			$bpsSiteUrl = get_option('siteurl');
			$bpsHomeUrl = get_option('home');
		} else {
			$bpsSiteUrl = get_site_option('siteurl');
			$bpsHomeUrl = network_site_url();		
		}
		
		$filename = ABSPATH . '.htaccess';
		$string = file_get_contents($filename);				
		
		if ( $bpsSiteUrl == $bpsHomeUrl ) {
			if ( strpos($string, "WPSuperCache" ) ) {
				$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('WP Super Cache is deactivated and WPSC htaccess code - # BEGIN WPSuperCache # END WPSuperCache - was found in your root htaccess file.', 'bulletproof-security').'</font><br>'.__('If this is just temporary then this warning message will go away when you reactivate WPSC. You will need to set up and reconfigure WPSC again when you reactivate WPSC. Your Root htaccess file must be temporarily unlocked if you are planning on uninstalling WPSC. The WPSC htaccess code will be automatically removed from your root htaccess file when you uninstall WPSC. If you added a commented out line of code in anywhere in your root htaccess file - # WPSuperCache - then delete it and refresh your browser. If you added WPSC code to BPS Custom Code then delete it if you are removing WPSC permanently.', 'bulletproof-security').'</div>';
				echo $text;
			} 
		}
	}
}

// Get WordPress Root Installation Folder 
function bps_wp_get_root_folder() {

	if ( is_admin() && current_user_can('manage_options') ) {
		$site_root = parse_url(get_option('siteurl'));
	if ( isset( $site_root['path'] ) )
		$site_root = trailingslashit($site_root['path']);
	else
		$site_root = '/';
	return $site_root;
	}
}

// Display Root or Subfolder Installation Type
function bps_wp_get_root_folder_display_type() {
$site_root = parse_url(get_option('siteurl'));
	if ( isset( $site_root['path'] ) )
		$site_root = trailingslashit($site_root['path']);
	else
		$site_root = '/';
	if ( preg_match('/[a-zA-Z0-9]/', $site_root) ) {
		echo '<strong>'.__('Subfolder Installation', 'bulletproof-security').'</strong>';
	} else {
		echo '<strong>'.__('Root Folder Installation', 'bulletproof-security').'</strong>';
	}
}

// System Info page - Check for GWIOD
function bps_gwiod_site_type_check() {
$WordPress_Address_url = get_option('home');
$Site_Address_url = get_option('siteurl');
	
	if ( $WordPress_Address_url == $Site_Address_url ) {
		echo '<strong>'.__('Standard WP Site Type', 'bulletproof-security').'</strong>';
	} else {
		echo '<strong>'.__('GWIOD WP Site Type', 'bulletproof-security').'</strong><br>';
		echo '<strong>'.__('WordPress Address (URL): ', 'bulletproof-security').$WordPress_Address_url.'</strong><br>';
		echo '<strong>'.__('Site Address (URL): ', 'bulletproof-security').$Site_Address_url.'</strong>';
	}	
}

// System Info page - Check for BuddyPress
function bps_buddypress_site_type_check() {

	if ( function_exists('bp_is_active') ) {
		echo '<strong>'.__('BuddyPress is installed|enabled', 'bulletproof-security').'</strong>';
	} else {
		echo '<strong>'.__('BuddyPress is not installed|enabled', 'bulletproof-security').'</strong>';
	}
}

// System Info page - Check for bbPress
function bps_bbpress_site_type_check() {

	if ( function_exists('is_bbpress') ) {
		echo '<strong>'.__('bbPress is installed|enabled', 'bulletproof-security').'</strong>';
	} else {
		echo '<strong>'.__('bbPress is not installed|enabled', 'bulletproof-security').'</strong>';
	}
}

// System Info page - Check for Multisite/Subdirectory/Subdomain
function bps_multisite_check() {  
	
	if ( ! is_multisite() ) { 
		$text = ' <strong>'.__('Network|Multisite is not installed|enabled', 'bulletproof-security').'</strong>';
		echo $text;	
	
	} else {
		
		if ( ! is_subdomain_install() ) {
			$text = ' <strong>'.__('Subdirectory Site Type', 'bulletproof-security').'</strong>';
			echo $text;
		} else {
			$text = ' <strong>'.__('Subdomain Site Type', 'bulletproof-security').'</strong>';
			echo $text;			
		}
	}
}

// Check if username Admin is being used as an Administrator User Account/Role
function bps_check_admin_username() {
global $wpdb;
$user_login = 'admin';	
$user = get_user_by( 'login', $user_login );
$username = $wpdb->get_var( $wpdb->prepare( "SELECT user_login FROM $wpdb->users WHERE user_login = %s", $user_login ) );
	
	if ( 'admin' == $username && 'administrator' == $user->roles[0] ) {
		$text = '<font color="red"><strong>'.__('Recommended Security Change: Username '.'"'.'admin'.'"'.' is being used for an Administrator User Account. It is recommended that you create a new unique administrator User Account name and delete the old "admin" User Account.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	} else {
		$text = '<font color="green"><strong>&radic; '.__('The Default Admin username '.'"'.'admin'.'"'.' is not being used for an Administrator User Account.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
}

// Check for WP readme.html file and if valid BPS .htaccess file is activated
// .51+ check - checks the 1 in position 15 - offset 14
function bps_filesmatch_check_readmehtml() {
$htaccess_filename = ABSPATH . '.htaccess';

	if ( file_exists($htaccess_filename) ) {
	
	global $bps_readme_install_ver;		
	$section = @file_get_contents( $htaccess_filename, NULL, NULL, 3, 45 );
	$check_string = @strpos( $section, $bps_readme_install_ver, 14 );

		$filename = ABSPATH . 'readme.html';

		if ( ! file_exists($filename) ) {
			$text = '<font color="green"><strong>&radic; '.__('The WP readme.html file does not exist', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		
		} else {
		
			$check_stringBPSQSE = @file_get_contents($htaccess_filename);

			if ( $check_string == "15" && strpos( $check_stringBPSQSE, "BPSQSE") ) {
				$text = '<font color="green"><strong>&radic; '.__('The WP readme.html file is htaccess protected', 'bulletproof-security').'</strong></font><br>';
				echo $text;
			} else {
				$text = '<font color="red"><strong>'.__('ERROR: The WP readme.html file is not htaccess protected', 'bulletproof-security').'</strong></font><br>';
				echo $text;
			}
		}
	}
}

// Check for WP /wp-admin/install.php file and if valid BPS .htaccess file is activated
// .51+ check - checks the 1 in position 15 - offset 14
function bps_filesmatch_check_installphp() {
$htaccess_filename = ABSPATH . 'wp-admin/.htaccess';

	if ( file_exists($htaccess_filename) ) {
		
	global $bps_readme_install_ver;
	$section = @file_get_contents( $htaccess_filename, NULL, NULL, 3, 45 );
	$check_string = @strpos( $section, $bps_readme_install_ver, 14 );		
	
		$filename = ABSPATH . 'wp-admin/install.php';		
		
		if ( ! file_exists($filename) ) {
			$text = '<font color="green"><strong>&radic; '.__('The WP /wp-admin/install.php file does not exist', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		
		} else {
		
			$check_stringBPSQSE = @file_get_contents($htaccess_filename);
			
			if ( $check_string == "15" && strpos( $check_stringBPSQSE, "BPSQSE-check" ) ) {
				$text = '<font color="green"><strong>&radic; '.__('The WP /wp-admin/install.php file is htaccess protected', 'bulletproof-security').'</strong></font><br>';
				echo $text;
			} else {
				$text = '<font color="red"><strong>'.__('ERROR: The WP /wp-admin/install.php file is not htaccess protected', 'bulletproof-security').'</strong></font><br>';
				echo $text;
			}
		}
	}
}

// Get SQL Mode from WPDB
function bps_get_sql_mode() {
global $wpdb;
$sql_mode_var = 'sql_mode';
$mysqlinfo = $wpdb->get_results( $wpdb->prepare( "SHOW VARIABLES LIKE %s", $sql_mode_var ) );	
	
	if ( is_array( $mysqlinfo ) ) { 
		$sql_mode = $mysqlinfo[0]->Value;
		if ( empty( $sql_mode ) ) { 
			$sql_mode = __('Not Set', 'bulletproof-security');
		} else {
			$sql_mode = __('Off', 'bulletproof-security');
		}
	}
}

// Show DB errors should already be set to false in /includes/wp-db.php
// Extra function insurance show_errors = false
function bps_wpdb_errors_off() {
global $wpdb;
$wpdb->show_errors = false;
	
	if ( $wpdb->show_errors != false ) {
		$text = '<font color="red"><strong>'.__('WARNING! WordPress DB Show Errors Is Set To: true! DB errors will be displayed', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	} else {
		$text = '<font color="green"><strong>&radic; '.__('WordPress DB Show Errors Function Is Set To:', 'bulletproof-security').' </strong></font><font color="black"><strong>'.__('false', 'bulletproof-security').'</strong></font><br><font color="green"><strong>&radic; '.__('WordPress Database Errors Are Turned Off', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}	
}

// Hide / Remove WordPress Version Meta Generator Tag - echo only for remove_action('wp_head', 'wp_generator');
function bps_wp_remove_version() {
global $wp_version;
	$text = '<font color="green"><strong>&radic; '.__('WordPress Meta Generator Tag Removed', 'bulletproof-security').'<br>&radic; '.__('WordPress Version Is Not Displayed|Not Shown', 'bulletproof-security').'</strong></font><br>';
	echo $text;
}

// Return Nothing For WP Version Callback
function bps_wp_generator_meta_removed() {
	if ( !is_admin() ) {
		global $wp_version;
		$wp_version = '';
	}
}

add_action('admin_notices', 'bpsPro_bonus_custom_code_dismiss_notices');

// Heads Up Display - Bonus Custom Code with Dismiss Notices
function bpsPro_bonus_custom_code_dismiss_notices() {
global $current_user;
$user_id = $current_user->ID;	
	
	if ( current_user_can('manage_options') ) { 
		$text = '';
	
	// Setup Wizard DB option is saved by running the Setup Wizard, on BPS Upgrades & manual BPS setup
	if ( ! get_option('bulletproof_security_options_wizard_free') ) { 
		return;
	}

	if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
		$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
	} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
		$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
	} else {
		$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
	}
		
	// BPS Pro 11.2: New Dismiss Notice. Note: add new dismiss notice query strings in both "dismiss all" conditions for new Bonus code
	if ( get_user_meta($user_id, 'bps_bonus_code_dismiss_all_notice') && ! get_user_meta($user_id, 'bps_post_request_attack_notice') ) {

		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Bonus Custom Code:', 'bulletproof-security').'</font><br>'.__('Click the links below to get Bonus Custom Code or click the Dismiss Notice links or click this ', 'bulletproof-security').'<span style=""><a href="'.$bps_base.'bps_bonus_code_dismiss_all_nag_ignore=0&bps_post_request_attack_nag_ignore=0'.'" style="">'.__('Dismiss All Notices', 'bulletproof-security').'</a></span>'.__(' link. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the Security Status page.', 'bulletproof-security').'<br>';


		$text .= '<div id="BC5" style="margin-top:2px;">'.__('Get ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/post-request-protection-post-attack-protection-post-request-blocker/" title="Protects against POST Request Attacks" target="_blank">'.__('POST Request Attack Protection Code', 'bulletproof-security').'</a>'.__(' or ', 'bulletproof-security').'<span style=""><a href="'.$bps_base.'bps_post_request_attack_nag_ignore=0'.'" style="">'.__('Dismiss Notice', 'bulletproof-security').'</a></span></div>';
		echo $text;
		echo '</div>';
	}		
	
	if ( ! get_user_meta($user_id, 'bps_bonus_code_dismiss_all_notice') ) {

	if ( ! get_user_meta($user_id, 'bps_brute_force_login_protection_notice') || ! get_user_meta($user_id, 'bps_speed_boost_cache_notice') || ! get_user_meta($user_id, 'bps_author_enumeration_notice') || ! get_user_meta($user_id, 'bps_xmlrpc_ddos_notice') || ! get_user_meta($user_id, 'bps_post_request_attack_notice') || ! get_user_meta($user_id, 'bps_sniff_driveby_notice') || ! get_user_meta($user_id, 'bps_iframe_clickjack_notice') ) { 		
		
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Bonus Custom Code:', 'bulletproof-security').'</font><br>'.__('Click the links below to get Bonus Custom Code or click the Dismiss Notice links or click this ', 'bulletproof-security').'<span style=""><a href="'.$bps_base.'bps_bonus_code_dismiss_all_nag_ignore=0&bps_post_request_attack_nag_ignore=0'.'" style="">'.__('Dismiss All Notices', 'bulletproof-security').'</a></span>'.__(' link. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the Security Status page.', 'bulletproof-security').'<br>';
		
	}

	if ( ! get_user_meta($user_id, 'bps_brute_force_login_protection_notice') ) { 	
		
		$text .= '<div id="BC1" style="">'.__('Get ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/protect-login-page-from-brute-force-login-attacks/" title="Additional Protection for the Login Page from Brute Force Login Attacks" target="_blank">'.__('Brute Force Login Protection Code', 'bulletproof-security').'</a>'.__(' or ', 'bulletproof-security').'<span style=""><a href="'.$bps_base.'bps_brute_force_login_protection_nag_ignore=0'.'" style="">'.__('Dismiss Notice', 'bulletproof-security').'</a></span></div>';
		
	}
		
	if ( ! get_user_meta($user_id, 'bps_speed_boost_cache_notice') ) { 	

		$text .= '<div id="BC2" style="margin-top:2px;">'.__('Get ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/htaccess-caching-code-speed-boost-cache-code/" title="Speed up your website performance with Browser Cache code" target="_blank">'.__('Speed Boost Cache Code', 'bulletproof-security').'</a>'.__(' or ', 'bulletproof-security').'<span style=""><a href="'.$bps_base.'bps_speed_boost_cache_nag_ignore=0'.'" style="">'.__('Dismiss Notice', 'bulletproof-security').'</a></span></div>';
		
	}
		
	if ( ! get_user_meta($user_id, 'bps_author_enumeration_notice') ) { 

		$text .= '<div id="BC3" style="margin-top:2px;">'.__('Get ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/wordpress-author-enumeration-bot-probe-protection-author-id-user-id/" title="Protects against hacker and spammer bots finding Author names & User names on your website" target="_blank">'.__('Author Enumeration BOT Probe Code', 'bulletproof-security').'</a>'.__(' or ', 'bulletproof-security').'<span style=""><a href="'.$bps_base.'bps_author_enumeration_nag_ignore=0'.'" style="">'.__('Dismiss Notice', 'bulletproof-security').'</a></span></div>';
		
	}
		
	if ( ! get_user_meta($user_id, 'bps_xmlrpc_ddos_notice') ) { 		

		$text .= '<div id="BC4" style="margin-top:2px;">'.__('Get ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/wordpress-xml-rpc-ddos-protection-protect-xmlrpc-php-block-xmlrpc-php-forbid-xmlrpc-php/" title="Protects against the XML Quadratic Blowup Attack, DDoS Attacks as well as other various XML-RPC exploits" target="_blank">'.__('XML-RPC DDoS Protection Code', 'bulletproof-security').'</a>'.__(' or ', 'bulletproof-security').'<span style=""><a href="'.$bps_base.'bps_xmlrpc_ddos_nag_ignore=0'.'" style="">'.__('Dismiss Notice', 'bulletproof-security').'</a></span></div>';
		
	}
	
	/*
	if ( ! get_user_meta($user_id, 'bps_referer_spam_notice') ) {

		$text .= '<div id="BC5" style="margin-top:2px;">'.__('Get ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/block-referer-spammers-semalt-kambasoft-ranksonic-buttons-for-website/" title="Protects against Referer Spamming and Phishing" target="_blank">'.__('Referer Spam|Phishing Protection Code', 'bulletproof-security').'</a>'.__(' or ', 'bulletproof-security').'<span style=""><a href="'.$bps_base.'bps_referer_spam_nag_ignore=0'.'" style="">'.__('Dismiss Notice', 'bulletproof-security').'</a></span></div>';
		
	}
	*/
	
	if ( ! get_user_meta($user_id, 'bps_post_request_attack_notice') ) {

		$text .= '<div id="BC5" style="margin-top:2px;">'.__('Get ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/post-request-protection-post-attack-protection-post-request-blocker/" title="Protects against POST Request Attacks" target="_blank">'.__('POST Request Attack Protection Code', 'bulletproof-security').'</a>'.__(' or ', 'bulletproof-security').'<span style=""><a href="'.$bps_base.'bps_post_request_attack_nag_ignore=0'.'" style="">'.__('Dismiss Notice', 'bulletproof-security').'</a></span></div>';
		
	}

	if ( ! get_user_meta($user_id, 'bps_sniff_driveby_notice') ) {		
		
		$text .= '<div id="BC6" style="margin-top:2px;">'.__('Get ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/mime-sniffing-data-sniffing-content-sniffing-drive-by-download-attack-protection/" title="Protects against Mime Sniffing, Data Sniffing, Content Sniffing and Drive-by Download Attacks" target="_blank">'.__('Mime Sniffing|Drive-by Download Attack Protection Code', 'bulletproof-security').'</a>'.__(' or ', 'bulletproof-security').'<span style=""><a href="'.$bps_base.'bps_sniff_driveby_nag_ignore=0'.'" style="">'.__('Dismiss Notice', 'bulletproof-security').'</a></span></div>';
	}

	if ( ! get_user_meta($user_id, 'bps_iframe_clickjack_notice') ) {		
		
		$text .= '<div id="BC7" style="margin-top:2px;">'.__('Get ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/rssing-com-good-or-bad/" title="Protects against external websites displaying your website pages or Feeds in iFrames and Clickjacking Protection" target="_blank">'.__('External iFrame|Clickjacking Protection Code', 'bulletproof-security').'</a>'.__(' or ', 'bulletproof-security').'<span style=""><a href="'.$bps_base.'bps_iframe_clickjack_nag_ignore=0'.'" style="">'.__('Dismiss Notice', 'bulletproof-security').'</a></span></div>';
	}

		echo $text;
		
		if ( ! get_user_meta($user_id, 'bps_brute_force_login_protection_notice') || ! get_user_meta($user_id, 'bps_speed_boost_cache_notice') || ! get_user_meta($user_id, 'bps_author_enumeration_notice') || ! get_user_meta($user_id, 'bps_xmlrpc_ddos_notice') || ! get_user_meta($user_id, 'bps_post_request_attack_notice') || ! get_user_meta($user_id, 'bps_sniff_driveby_notice') || ! get_user_meta($user_id, 'bps_iframe_clickjack_notice') ) { 	
		echo '</div>';
		}
		}
	}
}

add_action('admin_init', 'bpsPro_bonus_custom_code_nag_ignores');

function bpsPro_bonus_custom_code_nag_ignores() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset($_GET['bps_bonus_code_dismiss_all_nag_ignore']) && '0' == $_GET['bps_bonus_code_dismiss_all_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_bonus_code_dismiss_all_notice', 'true', true);
	}

	if ( isset($_GET['bps_brute_force_login_protection_nag_ignore']) && '0' == $_GET['bps_brute_force_login_protection_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_brute_force_login_protection_notice', 'true', true);
	}

	if ( isset($_GET['bps_speed_boost_cache_nag_ignore']) && '0' == $_GET['bps_speed_boost_cache_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_speed_boost_cache_notice', 'true', true);
	}

	if ( isset($_GET['bps_author_enumeration_nag_ignore']) && '0' == $_GET['bps_author_enumeration_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_author_enumeration_notice', 'true', true);
	}

	if ( isset($_GET['bps_xmlrpc_ddos_nag_ignore']) && '0' == $_GET['bps_xmlrpc_ddos_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_xmlrpc_ddos_notice', 'true', true);
	}

	/*
	if ( isset($_GET['bps_referer_spam_nag_ignore']) && '0' == $_GET['bps_referer_spam_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_referer_spam_notice', 'true', true);
	}
	*/
	
	if ( isset($_GET['bps_post_request_attack_nag_ignore']) && '0' == $_GET['bps_post_request_attack_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_post_request_attack_notice', 'true', true);
	}

	if ( isset($_GET['bps_sniff_driveby_nag_ignore']) && '0' == $_GET['bps_sniff_driveby_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_sniff_driveby_notice', 'true', true);
	}

	if ( isset($_GET['bps_iframe_clickjack_nag_ignore']) && '0' == $_GET['bps_iframe_clickjack_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_iframe_clickjack_notice', 'true', true);
	}
}

add_action('admin_notices', 'bps_hud_PhpiniHandlerCheck');

// Heads Up Display w/ Dismiss - Check if php.ini handler code exists in root .htaccess file, but not in Custom Code
function bps_hud_PhpiniHandlerCheck() {
global $current_user;
$user_id = $current_user->ID;
$file = ABSPATH . '.htaccess';	

	if ( ! get_user_meta($user_id, 'bps_ignore_PhpiniHandler_notice') ) {	

		if ( file_exists($file) ) {		

			$file_contents = @file_get_contents($file);
			$CustomCodeoptions = get_option('bulletproof_security_options_customcode');
			
			preg_match_all('/AddHandler|SetEnv PHPRC|suPHP_ConfigPath|Action application/', $file_contents, $matches);
			preg_match_all('/AddHandler|SetEnv PHPRC|suPHP_ConfigPath|Action application/', $CustomCodeoptions['bps_customcode_one'], $DBmatches);
		
			if ( $matches[0] && ! $DBmatches[0] ) {
			
			if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
				$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
			} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
				$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
			} else {
				$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
			}		
			
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('HUD Check: PHP/php.ini handler htaccess code check', 'bulletproof-security').'</font><br>'.__('PHP/php.ini handler htaccess code was found in your root .htaccess file, but was NOT found in BPS Custom Code.', 'bulletproof-security').'<br>'.__('To automatically fix this click here: ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/wizard/wizard.php">'.__('Setup Wizard Pre-Installation Checks', 'bulletproof-security').'</a><br>'.__('The Setup Wizard Pre-Installation Checks feature will automatically fix this just by visiting the Setup Wizard page.', 'bulletproof-security').'<br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the Security Status page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_PhpiniHandler_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
				echo $text;			
			}
		}
	}
}

add_action('admin_init', 'bps_PhpiniHandler_nag_ignore');

function bps_PhpiniHandler_nag_ignore() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset( $_GET['bps_PhpiniHandler_nag_ignore'] ) && '0' == $_GET['bps_PhpiniHandler_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_ignore_PhpiniHandler_notice', 'true', true);
	}
}

add_action('admin_notices', 'bps_hud_check_sucuri');

// Heads Up Display w/ Dismiss - Sucuri 1-click Hardening wp-content .htaccess file problem - breaks BPS and lots of other stuff
function bps_hud_check_sucuri() {
$filename = WP_CONTENT_DIR . '/.htaccess';
$plugin_var = 'sucuri-scanner/sucuri.php';
$return_var = in_array( $plugin_var, apply_filters('active_plugins', get_option('active_plugins') ) );

	if ( $return_var == 1 && ! file_exists($filename) ) { // 1 equals active
		return;	
	}
	
	$check_string = @file_get_contents($filename);

	if ( $return_var == 1 && file_exists($filename) && strpos( $check_string, "deny from all" ) ) { // 1 equals active	
	
		global $current_user;
		$user_id = $current_user->ID;

		if ( ! get_user_meta($user_id, 'bps_ignore_sucuri_notice') ) {
			
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}		
			
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Sucuri 1-click Hardening wp-content .htaccess file problem detected', 'bulletproof-security').'</font><br>'.__('Using the Sucuri 1-click Hardening wp-content .htaccess file will cause several BPS Pro features not to work correctly.', 'bulletproof-security').'<br>'.__('To fix this issue delete the Sucuri .htaccess file in your wp-content folder.', 'bulletproof-security').'<br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the Security Status page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_sucuri_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;
		}
	}
}

add_action('admin_init', 'bps_sucuri_nag_ignore');

function bps_sucuri_nag_ignore() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset( $_GET['bps_sucuri_nag_ignore'] ) && '0' == $_GET['bps_sucuri_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_ignore_sucuri_notice', 'true', true);
	}
}

add_action('admin_notices', 'bps_hud_check_wordpress_firewall2');

// Heads Up Display w/ Dismiss - WordPress Firewall 2 plugin - breaks BPS and lots of other stuff
function bps_hud_check_wordpress_firewall2() {
$plugin_var = 'wordpress-firewall-2/wordpress-firewall-2.php';
$return_var = in_array( $plugin_var, apply_filters('active_plugins', get_option('active_plugins')));

	if ( $return_var != 1 ) { // 1 equals active
		return;	
	}
	
	if ( $return_var == 1 ) { // 1 equals active	
	
		global $current_user;
		$user_id = $current_user->ID;			
		
		if ( ! get_user_meta($user_id, 'bps_ignore_wpfirewall2_notice') ) {
			
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}			
			
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('The WordPress Firewall 2 plugin is installed and activated', 'bulletproof-security').'</font><br>'.__('It is recommended that you delete the WordPress Firewall 2 plugin.', 'bulletproof-security').'<br><a href="http://forum.ait-pro.com/forums/topic/wordpress-firewall-2-plugin-unable-to-save-custom-code/" target="_blank" title="Link opens in a new Browser window">'.__('Click Here', 'bulletproof-security').'</a>'.__(' for more information.', 'bulletproof-security').'<br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the Security Status page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_wpfirewall2_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;
		}
	}
}

add_action('admin_init', 'bps_wpfirewall2_nag_ignore');

function bps_wpfirewall2_nag_ignore() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset( $_GET['bps_wpfirewall2_nag_ignore'] ) && '0' == $_GET['bps_wpfirewall2_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_ignore_wpfirewall2_notice', 'true', true);
	}
}

add_action('admin_notices', 'bps_hud_broken_link_checker');

// Heads Up Display w/ Dismiss - Broken Link Checker plugin - HEAD Request Method filter check
function bps_hud_broken_link_checker() {
$filename = ABSPATH . '.htaccess';
$check_string = @file_get_contents($filename);
$plugin_var = 'broken-link-checker/broken-link-checker.php';
$return_var = in_array( $plugin_var, apply_filters('active_plugins', get_option('active_plugins')));

    if ( $return_var == 1 && ! strpos( $check_string, "HEAD|TRACE|DELETE|TRACK|DEBUG" ) ) { // 1 equals active
		return;
	}
	
	if ( $return_var == 1 && strpos( $check_string, "HEAD|TRACE|DELETE|TRACK|DEBUG" ) ) {
		
		global $current_user;
		$user_id = $current_user->ID;

		if ( ! get_user_meta($user_id, 'bps_ignore_BLC_notice') ) {
			
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}			
			
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Broken Link Checker plugin HEAD Request Method filter problem detected.', 'bulletproof-security').'</font><br>'.__('To fix this problem ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/broken-link-checker-plugin-403-error/" target="_blank" title="Link opens in a new Browser window">'.__('Click Here', 'bulletproof-security').'</a><br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the Security Status page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_BLC_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;
		}
	}
}

add_action('admin_init', 'bps_BLC_nag_ignore');

function bps_BLC_nag_ignore() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset( $_GET['bps_BLC_nag_ignore'] ) && '0' == $_GET['bps_BLC_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_ignore_BLC_notice', 'true', true);
	}
}

/***********************************************/
// BPS Free - Zip, Email, Delete Log File Cron //
/***********************************************/
// 262144 bytes = 256KB = .25MB
// 524288 bytes = 512KB = .5MB
// 1048576 bytes = 1024KB = 1MB
// 2097152 bytes = 2048KB = 2MB
// FailSafe - if log file is larger than 2MB zip, email and delete or just delete

// Pre-save Email Alerting & Log file zip, email and delete DB options
// or pre-save DB options for BPS upgraders
function bps_email_alerts_log_file_options() {
$SecurityLogEmailOptions = get_option('bulletproof_security_options_email');
$admin_email = get_option('admin_email');

	$bps_option_name = 'bulletproof_security_options_email';
	$bps_new_value_1 = $admin_email;
	$bps_new_value_2 = $admin_email;	
	$bps_new_value_3 = '';
	$bps_new_value_4 = '';
	$bps_new_value_5 = 'lockoutOnly';
	$bps_new_value_6 = '500KB';
	$bps_new_value_7 = 'email';
	$bps_new_value_8 = '500KB';
	$bps_new_value_9 = 'email';

	$BPS_Options = array(
	'bps_send_email_to' => $bps_new_value_1, 
	'bps_send_email_from' => $bps_new_value_2, 
	'bps_send_email_cc' => $bps_new_value_3, 
	'bps_send_email_bcc' => $bps_new_value_4, 
	'bps_login_security_email' => $bps_new_value_5, 
	'bps_security_log_size' => $bps_new_value_6, 
	'bps_security_log_emailL' => $bps_new_value_7, 
	'bps_dbb_log_size' => $bps_new_value_8, 
	'bps_dbb_log_email' => $bps_new_value_9 
	);

	if ( !get_option( $bps_option_name ) ) {	
		
		foreach( $BPS_Options as $key => $value ) {
			update_option('bulletproof_security_options_email', $BPS_Options);
		}
	
	} else {

		if ( !$SecurityLogEmailOptions['bps_dbb_log_size'] && !$SecurityLogEmailOptions['bps_dbb_log_email'] ) {

			$BPS_Options = array(
			'bps_send_email_to' => $SecurityLogEmailOptions['bps_send_email_to'], 
			'bps_send_email_from' => $SecurityLogEmailOptions['bps_send_email_from'], 
			'bps_send_email_cc' => $SecurityLogEmailOptions['bps_send_email_cc'], 
			'bps_send_email_bcc' => $SecurityLogEmailOptions['bps_send_email_bcc'], 
			'bps_login_security_email' => $SecurityLogEmailOptions['bps_login_security_email'], 
			'bps_security_log_size' => $SecurityLogEmailOptions['bps_security_log_size'], 
			'bps_security_log_emailL' => $SecurityLogEmailOptions['bps_security_log_emailL'], 
			'bps_dbb_log_size' => '500KB', 
			'bps_dbb_log_email' => 'email' 
			);

			foreach( $BPS_Options as $key => $value ) {
				update_option('bulletproof_security_options_email', $BPS_Options);
			}
		}		
	}

	$bps_option_name_dbb = 'bulletproof_security_options_DBB_log';
	$bps_new_value_dbb = bpsPro_DBB_LogLastMod_wp_secs();
	$BPS_Options_dbb = array( 'bps_dbb_log_date_mod' => $bps_new_value_dbb );

	if ( !get_option( $bps_option_name_dbb ) ) {	
		
		foreach( $BPS_Options_dbb as $key => $value ) {
			update_option('bulletproof_security_options_DBB_log', $BPS_Options_dbb);
		}
	}
}
add_action('admin_notices', 'bps_email_alerts_log_file_options');

add_action('bpsPro_email_log_files', 'bps_Log_File_Processing');

function bpsPro_schedule_Email_Log_Files() {
	if ( !wp_next_scheduled( 'bpsPro_email_log_files' ) ) {
		wp_schedule_event(time(), 'hourly', 'bpsPro_email_log_files');
	}
}
add_action('init', 'bpsPro_schedule_Email_Log_Files');

function bpsPro_add_hourly_email_log_cron( $schedules ) {
	$schedules['hourly'] = array('interval' => 3600, 'display' => __('Once Hourly'));
	return $schedules;
}
add_filter('cron_schedules', 'bpsPro_add_hourly_email_log_cron');

function bps_Log_File_Processing() {
$options = get_option('bulletproof_security_options_email');
$SecurityLog = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';
$SecurityLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/http_error_log.txt';
$DBBLog = WP_CONTENT_DIR . '/bps-backup/logs/db_backup_log.txt';
$DBBLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/db_backup_log.txt';

switch ( $options['bps_security_log_size'] ) {
    case "256KB":
		if ( filesize($SecurityLog) >= 262144 && filesize($SecurityLog) < 524288 || filesize($SecurityLog) > 2097152) {
		if ( $options['bps_security_log_emailL'] == 'email') {
			if ( bps_Zip_Security_Log_File()==TRUE ) {
				bps_Email_Security_Log_File();
			}
		} elseif ( $options['bps_security_log_emailL'] == 'delete') {
			copy($SecurityLogMaster, $SecurityLog);	
		}
		break;
		}
    case "500KB":
		if ( filesize($SecurityLog) >= 524288 && filesize($SecurityLog) < 1048576 || filesize($SecurityLog) > 2097152) {
		if ( $options['bps_security_log_emailL'] == 'email') {
			if ( bps_Zip_Security_Log_File()==TRUE ) {
				bps_Email_Security_Log_File();
			}
		} elseif ( $options['bps_security_log_emailL'] == 'delete') {
			copy($SecurityLogMaster, $SecurityLog);	
		}		
		break;
		}
    case "1MB":
		if ( filesize($SecurityLog) >= 1048576 && filesize($SecurityLog) < 2097152 || filesize($SecurityLog) > 2097152) {
		if ( $options['bps_security_log_emailL'] == 'email') {
			if ( bps_Zip_Security_Log_File()==TRUE ) {
				bps_Email_Security_Log_File();
			}
		} elseif ( $options['bps_security_log_emailL'] == 'delete') {
			copy($SecurityLogMaster, $SecurityLog);	
		}		
		break;
		}
	}

switch ( $options['bps_dbb_log_size'] ) {
    case "256KB":
		if ( filesize($DBBLog) >= 262144 && filesize($DBBLog) < 524288 || filesize($DBBLog) > 2097152) {
		if ( $options['bps_dbb_log_email'] == 'email') {
			if ( bps_Zip_DBB_Log_File()==TRUE ) {
				bps_Email_DBB_Log_File();
			}
		} elseif ( $options['bps_dbb_log_email'] == 'delete') {
			copy($DBBLogMaster, $DBBLog);	
		}
		break;
		}
    case "500KB":
		if ( filesize($DBBLog) >= 524288 && filesize($DBBLog) < 1048576 || filesize($DBBLog) > 2097152) {
		if ( $options['bps_dbb_log_email'] == 'email') {
			if ( bps_Zip_DBB_Log_File()==TRUE ) {
				bps_Email_DBB_Log_File();
			}
		} elseif ( $options['bps_dbb_log_email'] == 'delete') {
			copy($DBBLogMaster, $DBBLog);	
		}		
		break;
		}
    case "1MB":
		if ( filesize($DBBLog) >= 1048576 && filesize($DBBLog) < 2097152 || filesize($DBBLog) > 2097152) {
		if ( $options['bps_dbb_log_email'] == 'email') {
			if ( bps_Zip_DBB_Log_File()==TRUE ) {
				bps_Email_DBB_Log_File();
			}
		} elseif ( $options['bps_dbb_log_email'] == 'delete') {
			copy($DBBLogMaster, $DBBLog);	
		}		
		break;
		}
	}
}

// EMAIL NOTES: You cannot fake a zip file by renaming a file extension 
// The zip file must be a real zip archive or it will not be successfully attached to an email.
// A plain txt file cannot be attached to an email.
// Email Security Log File
function bps_Email_Security_Log_File() {
$options = get_option('bulletproof_security_options_email');
$bps_email_to = $options['bps_send_email_to'];
$bps_email_from = $options['bps_send_email_from'];
$bps_email_cc = $options['bps_send_email_cc'];
$bps_email_bcc = $options['bps_send_email_bcc'];
$justUrl = get_site_url();
$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), strtotime($date));
$SecurityLog = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';
$SecurityLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/http_error_log.txt';
$SecurityLogZip = WP_CONTENT_DIR . '/bps-backup/logs/security-log.zip';
	
	$attachments = array( $SecurityLogZip );
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "From: $bps_email_from" . "\r\n";
	$headers .= "Cc: $bps_email_cc" . "\r\n";
	$headers .= "Bcc: $bps_email_bcc" . "\r\n";	
	$subject = " BPS Security Log - $timestamp ";
	$message = '<p><font color="blue"><strong>Security Log File For:</strong></font></p>';
	$message .= '<p>Site: '."$justUrl".'</p>'; 
		
	$mailed = wp_mail($bps_email_to, $subject, $message, $headers, $attachments);

	if ( $mailed && file_exists($SecurityLogZip) ) {
		unlink($SecurityLogZip);
		copy($SecurityLogMaster, $SecurityLog);
	}
}

// Email DB Backup log file
function bps_Email_DBB_Log_File() {
$options = get_option('bulletproof_security_options_email');
$bps_email_to = $options['bps_send_email_to'];
$bps_email_from = $options['bps_send_email_from'];
$bps_email_cc = $options['bps_send_email_cc'];
$bps_email_bcc = $options['bps_send_email_bcc'];
$justUrl = get_site_url();
$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), strtotime($date));
$DBBLog = WP_CONTENT_DIR . '/bps-backup/logs/db_backup_log.txt';
$DBBLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/db_backup_log.txt';
$DBBLogZip = WP_CONTENT_DIR . '/bps-backup/logs/db-backup-log.zip';
	
	$attachments = array( $DBBLogZip );
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "From: $bps_email_from" . "\r\n";
	$headers .= "Cc: $bps_email_cc" . "\r\n";
	$headers .= "Bcc: $bps_email_bcc" . "\r\n";	
	$subject = " BPS DB Backup Log - $timestamp ";
	$message = '<p>This is a regular scheduled automatic log file zip email and is NOT an alert.</p>';	
	$message .= '<p><font color="blue"><strong>DB Backup Log File is Attached For:</strong></font></p>';
	$message .= '<p>Site: '.$justUrl.'</p>'; 
		
	$mailed = wp_mail($bps_email_to, $subject, $message, $headers, $attachments);

	if ( $mailed && file_exists($DBBLogZip) ) {
		unlink($DBBLogZip);
	
	if ( copy( $DBBLogMaster, $DBBLog ) ) {
		$DBBLogLastModifiedTime = get_option('bulletproof_security_options_DBB_log');
		$time = strtotime( $DBBLogLastModifiedTime['bps_dbb_log_date_mod'] );
		touch( $DBBLog, $time );	
	}
	}
}

// Zip Security Log File - If ZipArchive Class is not available use PCLZip
function bps_Zip_Security_Log_File() {
	// Use ZipArchive
	if ( class_exists('ZipArchive') ) {

	$zip = new ZipArchive();
	$filename = WP_CONTENT_DIR . '/bps-backup/logs/security-log.zip';
	
	if ( $zip->open( $filename, ZIPARCHIVE::CREATE )!==TRUE ) {
    	exit("Error: Cannot Open $filename\n");
	}

	$zip->addFile( WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt', "http_error_log.txt" );
	$zip->close();

	return true;

	} else {

// Use PCLZip
define( 'PCLZIP_TEMPORARY_DIR', WP_CONTENT_DIR . '/bps-backup/logs/' );
require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php');
	
	if ( ini_get( 'mbstring.func_overload' ) && function_exists( 'mb_internal_encoding' ) ) {
		$previous_encoding = mb_internal_encoding();
		mb_internal_encoding( 'ISO-8859-1' );
	}
  		$archive = new PclZip( WP_CONTENT_DIR . '/bps-backup/logs/security-log.zip' );
  		$v_list = $archive->create( WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt', PCLZIP_OPT_REMOVE_PATH, WP_CONTENT_DIR . '/bps-backup/logs/' );
  	
	return true;

	if ( $v_list == 0 ) {
		die("Error : ".$archive->errorInfo(true) );
		return false;	
	}
	}
}

// Zip the DB Backup Log File - If ZipArchive Class is not available use PCLZip
function bps_Zip_DBB_Log_File() {
	// Use ZipArchive
	if ( class_exists('ZipArchive') ) {

	$zip = new ZipArchive();
	$filename = WP_CONTENT_DIR . '/bps-backup/logs/db-backup-log.zip';
	
	if ( $zip->open( $filename, ZIPARCHIVE::CREATE )!==TRUE ) {
    	exit("Error: Cannot Open $filename\n");
	}

	$zip->addFile( WP_CONTENT_DIR . '/bps-backup/logs/db_backup_log.txt', "db_backup_log.txt" );
	$zip->close();

	return true;

	} else {

// Use PCLZip
define( 'PCLZIP_TEMPORARY_DIR', WP_CONTENT_DIR . '/bps-backup/logs/' );
require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php' );
	
	if ( ini_get( 'mbstring.func_overload' ) && function_exists( 'mb_internal_encoding' ) ) {
		$previous_encoding = mb_internal_encoding();
		mb_internal_encoding( 'ISO-8859-1' );
	}
  		$archive = new PclZip( WP_CONTENT_DIR . '/bps-backup/logs/db-backup-log.zip' );
  		$v_list = $archive->create( WP_CONTENT_DIR . '/bps-backup/logs/db_backup_log.txt', PCLZIP_OPT_REMOVE_PATH, WP_CONTENT_DIR . '/bps-backup/logs/' );
  	
	return true;

	if ( $v_list == 0) {
		die( "Error : ".$archive->errorInfo(true) );
		return false;	
	}
	}
}

add_action('admin_notices', 'bps_hud_BPSQSE_old_code_check');

// Check for older BPS Query String Exploits code saved to BPS Custom Code
function bps_hud_BPSQSE_old_code_check() {
$CustomCodeoptions = get_option('bulletproof_security_options_customcode');	

	if ( $CustomCodeoptions['bps_customcode_bpsqse'] == '' ) {
		return;
	}
	
	$subject = $CustomCodeoptions['bps_customcode_bpsqse'];	
	$pattern1 = '/RewriteCond\s%{QUERY_STRING}\s\(\\\.\/\|\\\.\.\/\|\\\.\.\.\/\)\+\(motd\|etc\|bin\)\s\[NC,OR\]/';
	$pattern2 = '/RewriteCond\s%\{THE_REQUEST\}\s(.*)\?(.*)\sHTTP\/\s\[NC,OR\]\s*RewriteCond\s%\{THE_REQUEST\}\s(.*)\*(.*)\sHTTP\/\s\[NC,OR\]/';
	$pattern3 = '/RewriteCond\s%\{THE_REQUEST\}\s.*\?\+\(%20\{1,\}.*\s*RewriteCond\s%\{THE_REQUEST\}\s.*\+\(.*\*\|%2a.*\s\[NC,OR\]/';

	if ( $CustomCodeoptions['bps_customcode_bpsqse'] != '' && preg_match($pattern1, $subject, $matches) || preg_match($pattern2, $subject, $matches) || preg_match($pattern3, $subject, $matches) ) {

		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Notice: BPS Query String Exploits Code Changes', 'bulletproof-security').'</font><br>'.__('Older BPS Query String Exploits code was found in BPS Custom Code. Several Query String Exploits rules were changed/added/modified in the root .htaccess file in BPS .49.6, .50.2 & .50.3.', 'bulletproof-security').'<br>'.__('Copy the new Query String Exploits section of code from your root .htaccess file and paste it into this BPS Custom Code text box: CUSTOM CODE BPSQSE BPS QUERY STRING EXPLOITS and click the Save Root Custom Code button.', 'bulletproof-security').'<br>'.__('This Notice will go away once you have copied the new Query String Exploits code to BPS Custom Code and clicked the Save Root Custom Code button.', 'bulletproof-security').'</div>';
		echo $text;
	}
}

// Maintenance Mode On Dashboard Alert
function bpsPro_mmode_dashboard_alert() {

if ( current_user_can('manage_options') ) {

	$MMoptions = get_option('bulletproof_security_options_maint_mode');

	if ( ! is_multisite() ) {
		
	if ( ! get_option('bulletproof_security_options_maint_mode') || $MMoptions['bps_maint_on_off'] == 'Off' ) {
	return;
	}	
	
		$indexPHP = ABSPATH . 'index.php';
		$wpadminHtaccess = ABSPATH . 'wp-admin/.htaccess';
		$check_string_index = @file_get_contents($indexPHP);
		$check_string_wpadmin = @file_get_contents($wpadminHtaccess);

		if ( $MMoptions['bps_maint_on_off'] == 'On' && $MMoptions['bps_maint_dashboard_reminder'] == '1' ) {	
	
			if ( strpos( $check_string_index, "BEGIN BPS MAINTENANCE MODE IP" ) && ! strpos( $check_string_wpadmin, "BEGIN BPS MAINTENANCE MODE IP" ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend Maintenance Mode is Turned On.', 'bulletproof-security').'</font></div>';
				echo $text;				
			} elseif ( ! strpos( $check_string_index, "BEGIN BPS MAINTENANCE MODE IP" ) && strpos( $check_string_wpadmin, "BEGIN BPS MAINTENANCE MODE IP" ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Backend Maintenance Mode is Turned On.', 'bulletproof-security').'</font></div>';
				echo $text;	
			} elseif ( strpos( $check_string_index, "BEGIN BPS MAINTENANCE MODE IP" ) && strpos( $check_string_wpadmin, "BEGIN BPS MAINTENANCE MODE IP" ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend & Backend Maintenance Modes are Turned On.', 'bulletproof-security').'</font></div>';
				echo $text;				
			}
		}
	}
	
	if ( is_multisite() ) {
		global $current_blog, $blog_id;
		$root_folder_maintenance_values = ABSPATH . 'bps-maintenance-values.php';
		$check_string_values = @file_get_contents($root_folder_maintenance_values);			
		$indexPHP = ABSPATH . 'index.php';
		$wpadminHtaccess = ABSPATH . 'wp-admin/.htaccess';
		$check_string_index = @file_get_contents($indexPHP);
		$check_string_wpadmin = @file_get_contents($wpadminHtaccess);
	
		if ( $blog_id == 1 && $MMoptions['bps_maint_dashboard_reminder'] == '1' ) {

			if ( strpos( $check_string_values, '$all_sites = \'1\';' ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend Maintenance Mode is Turned On for The Primary Site and All Subsites.', 'bulletproof-security').'</font></div>';
				echo $text;	
			}
		
			if ( strpos( $check_string_values, '$all_subsites = \'1\';' ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend Maintenance Mode is Turned On for All Subsites, but Not The Primary Site.', 'bulletproof-security').'</font></div>';
				echo $text;	
			}	
	
		if ( $MMoptions['bps_maint_on_off'] == 'On' ) {

			if ( strpos( $check_string_index, '$primary_site_status = \'On\';' ) && ! strpos( $check_string_wpadmin, "BEGIN BPS MAINTENANCE MODE IP" ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend Maintenance Mode is Turned On.', 'bulletproof-security').'</font></div>';
				echo $text;				
			} elseif ( !strpos($check_string_index, '$primary_site_status = \'On\';') && strpos($check_string_wpadmin, "BEGIN BPS MAINTENANCE MODE IP") ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Backend Maintenance Mode is Turned On.', 'bulletproof-security').'</font></div>';
				echo $text;	
			} elseif ( strpos($check_string_index, '$primary_site_status = \'On\';') && strpos($check_string_wpadmin, "BEGIN BPS MAINTENANCE MODE IP") ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend & Backend Maintenance Modes are Turned On.', 'bulletproof-security').'</font></div>';
				echo $text;				
			}
		}
		}
	
		if ( $blog_id != 1 ) {
		
			if ( is_subdomain_install() ) {
		
				$subsite_remove_slashes = str_replace( '.', "-", $current_blog->domain );	
	
			} else {
	
				$subsite_remove_slashes = str_replace( '/', "", $current_blog->path );
			}			
			
			$subsite_maintenance_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/bps-maintenance-'.$subsite_remove_slashes.'.php';		

			if ( strpos( $check_string_values, '$all_sites = \'1\';' ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend Maintenance Mode is Turned On for The Primary Site and All Subsites.', 'bulletproof-security').'</font></div>';
				echo $text;	
			}
		
			if ( strpos( $check_string_values, '$all_subsites = \'1\';' ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend Maintenance Mode is Turned On for All Subsites, but Not The Primary Site.', 'bulletproof-security').'</font></div>';
				echo $text;	
			}		
		
		if ( $MMoptions['bps_maint_on_off'] == 'On' && $MMoptions['bps_maint_dashboard_reminder'] == '1' ) {

			if ( file_exists($subsite_maintenance_file) && ! strpos( $check_string_wpadmin, "BEGIN BPS MAINTENANCE MODE IP" ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend Maintenance Mode is Turned On.', 'bulletproof-security').'</font></div>';
				echo $text;				
			} elseif ( ! file_exists($subsite_maintenance_file) && strpos( $check_string_wpadmin, "BEGIN BPS MAINTENANCE MODE IP" ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Backend Maintenance Mode is Turned On.', 'bulletproof-security').'</font></div>';
				echo $text;	
			} elseif ( file_exists($subsite_maintenance_file) && strpos( $check_string_wpadmin, "BEGIN BPS MAINTENANCE MODE IP" ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend & Backend Maintenance Modes are Turned On.', 'bulletproof-security').'</font></div>';
				echo $text;				
			}		
		}
		}
	} // end is multisite
}
}

add_action('admin_notices', 'bpsPro_mmode_dashboard_alert');

// Login Security Disable Password Reset notice: Displays a message that backend password reset has been disabled
function bpsPro_login_security_password_reset_disabled_notice() {

	if ( current_user_can( 'update_core' ) )
	
	global $pagenow;

	if ( 'profile.php' == $pagenow || 'user-edit.php' == $pagenow || 'user-new.php' == $pagenow ) {
		$BPSoptions = get_option('bulletproof_security_options_login_security');		
		
		if ( $BPSoptions['bps_login_security_OnOff'] == 'On' && $BPSoptions['bps_login_security_pw_reset'] == 'disable' ) {
		
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('BPS Login Security Disable Password Reset Frontend & Backend is turned On.', 'bulletproof-security').'</font><br>'.__('Backend Password Reset has been disabled. To enable Backend Password Reset click ', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/login/login.php">'.__('here', 'bulletproof-security').'</a></div>';
			echo $text;
		}
	}
}

add_action('admin_notices', 'bpsPro_login_security_password_reset_disabled_notice');

// One time manual htaccess code update added in BPS Pro .51.2
// NOTE: Instead of automating this, this needs to be done manually by users
// "Always On" flush_rewrite_rules code correction: Unfortunately this needs to be an "Always On" check in order for it to be 100% effective
function bpsPro_htaccess_manual_update_notice() {
	
	if ( current_user_can('manage_options') ) {
		
		$filename = ABSPATH . '.htaccess';
		
		if ( file_exists($filename) ) {
		
			global $pagenow;
			$check_string = @file_get_contents($filename);
			$pattern = '/#\sBEGIN\sWordPress\s*<IfModule\smod_rewrite\.c>\s*RewriteEngine\sOn\s*RewriteBase(.*)\s*RewriteRule(.*)\s*RewriteCond((.*)\s*){2}RewriteRule(.*)\s*<\/IfModule>\s*#\sEND\sWordPress/';

			if ( preg_match( $pattern, $check_string, $flush_matches ) ) {
				$stringReplace = preg_replace('/\n#\sBEGIN\sWordPress\s*<IfModule\smod_rewrite\.c>\s*RewriteEngine\sOn\s*RewriteBase(.*)\s*RewriteRule(.*)\s*RewriteCond((.*)\s*){2}RewriteRule(.*)\s*<\/IfModule>\s*#\sEND\sWordPress\n/s', "", $check_string);
				file_put_contents($filename, $stringReplace);
			}				
		
			if ( 'plugins.php' == $pagenow || preg_match( '/page=bulletproof-security\/admin\/core\/core\.php/', $_SERVER['REQUEST_URI'], $matches ) ) {

				$pos = strpos( $check_string, 'IMPORTANT!!! DO NOT DELETE!!! - B E G I N Wordpress' );
			
				if ( $pos === false ) {
    		
					return;
			
				} else {
    		
					echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
					$text = '<strong><font color="blue">'.__('BPS Notice: One-time Update Steps Required', 'bulletproof-security').'</font><br>'.__('Significant changes were made to the root and wp-admin htaccess files that require doing the one-time Update Steps below.', 'bulletproof-security').'<br>'.__('All future BPS upgrades will not require these one-time Update Steps to be performed.', 'bulletproof-security').'<br><a href="http://forum.ait-pro.com/forums/topic/root-and-wp-admin-htaccess-file-significant-changes/" target="_blank" title="Link opens in a new Browser window" style="text-decoration:underline;">'.__('Click Here', 'bulletproof-security').'</a>'.__(' If you would like to know what changes were made to the root and wp-admin htaccess files.', 'bulletproof-security').'<br>'.__('This Notice will go away automatically after doing all of the steps below.', 'bulletproof-security').'<br><br><a href="admin.php?page=bulletproof-security/admin/core/core.php" style="text-decoration:underline;">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the BPS Security Modes page.', 'bulletproof-security').'<br>'.__('1. Click the "Create secure.htaccess File" AutoMagic button.', 'bulletproof-security').'<br>'.__('2. Activate Root Folder BulletProof Mode.', 'bulletproof-security').'<br>'.__('3. Activate wp-admin Folder BulletProof Mode.', 'bulletproof-security').'</strong>';
					echo $text;
					echo '</p></div>';	
				}
			}
		}
	}
}

add_action('admin_notices', 'bpsPro_htaccess_manual_update_notice');

function bpsPro_presave_ui_theme_skin_options() {
	
	$ui_theme_skin_options = 'bulletproof_security_options_theme_skin';	
	$bps_ui_theme_skin = array( 'bps_ui_theme_skin' => 'blue' );
			
	if ( ! get_option( $ui_theme_skin_options ) ) {			
		
		foreach( $bps_ui_theme_skin as $key => $value ) {
			update_option('bulletproof_security_options_theme_skin', $bps_ui_theme_skin);
		}
	}	
}

?>