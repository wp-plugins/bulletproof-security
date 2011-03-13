<?php
// Direct calls to this file are Forbidden when core files are not present
if (!function_exists ('add_action')) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}

// BPS - not used - placeholder
function bulletproof_security_save_options() {
	global $bulletproof_security;
	return $bulletproof_security->save_options();
}

function bulletproof_security_set_error($code = '', $error = '', $data = '') {
	global $bulletproof_security;
	return $bulletproof_security->set_error($code, $error, $data);
}

function bulletproof_security_get_error($code = '') {
	global $bulletproof_security;
	return $bulletproof_security->get_error($code);
}

// BPS Master htaccess File Editing - file checks
function get_secure_htaccess() {
	$secure_htaccess_file = '/wp-content/plugins/bulletproof-security/admin/htaccess/secure.htaccess';
	if (file_exists(ABSPATH . $secure_htaccess_file)) {
	echo file_get_contents(ABSPATH . $secure_htaccess_file);
	} else {
	_e('The secure.htaccess file either does not exist or is not named correctly. Check the /wp-content/plugins/bulletproof-security/admin/htaccess/ folder to make sure the secure.htaccess file exists and is named secure.htaccess.');
	}
}

function get_default_htaccess() {
	$default_htaccess_file = '/wp-content/plugins/bulletproof-security/admin/htaccess/default.htaccess';
	if (file_exists(ABSPATH . $default_htaccess_file)) {
	echo file_get_contents(ABSPATH . $default_htaccess_file);
	} else {
	_e('The default.htaccess file either does not exist or is not named correctly. Check the /wp-content/plugins/bulletproof-security/admin/htaccess/ folder to make sure the default.htaccess file exists and is named default.htaccess.');
	}
}

function get_maintenance_htaccess() {
	$maintenance_htaccess_file = '/wp-content/plugins/bulletproof-security/admin/htaccess/maintenance.htaccess';
	if (file_exists(ABSPATH . $maintenance_htaccess_file)) {
	echo file_get_contents(ABSPATH . $maintenance_htaccess_file);
	} else {
	_e('The maintenance.htaccess file either does not exist or is not named correctly. Check the /wp-content/plugins/bulletproof-security/admin/htaccess/ folder to make sure the maintenance.htaccess file exists and is named maintenance.htaccess.');
	}
}

function get_wpadmin_htaccess() {
	$wpadmin_htaccess_file = '/wp-content/plugins/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess';
	if (file_exists(ABSPATH . $wpadmin_htaccess_file)) {
	echo file_get_contents(ABSPATH . $wpadmin_htaccess_file);
	} else {
	_e('The wpadmin-secure.htaccess file either does not exist or is not named correctly. Check the /wp-content/plugins/bulletproof-security/admin/htaccess/ folder to make sure the wpadmin-secure.htaccess file exists and is named wpadmin-secure.htaccess.');
	}
}

// The current active root htaccess file - file check
function get_root_htaccess() {
	$root_htaccess_file = '/.htaccess';
	if (file_exists(ABSPATH . $root_htaccess_file)) {
	echo file_get_contents(ABSPATH . $root_htaccess_file);
	} else {
	_e('An .htaccess file was not found in your website root folder.');
	}
}

// The current active wp-admin htaccess file - file check
function get_current_wpadmin_htaccess_file() {
	$current_wpadmin_htaccess_file = '/wp-admin/.htaccess';
	if (file_exists(ABSPATH . $current_wpadmin_htaccess_file)) {
	echo file_get_contents(ABSPATH . $current_wpadmin_htaccess_file);
	} else {
	_e('An .htaccess file was not found in your wp-admin folder.');
	}
}

// File write checks for editor
function secure_htaccess_file_check() {
$secure_htaccess_file = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/secure.htaccess';
	if (!is_writable($secure_htaccess_file)) {
 		_e('<font color="red"><strong>Cannot write to the secure.htaccess file. Minimum file permission required is 600.</strong></font><br>');
	    } else {
	_e('');
}
}

// File write checks for editor
function default_htaccess_file_check() {
$default_htaccess_file = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/default.htaccess';
	if (!is_writable($default_htaccess_file)) {
 		_e('<font color="red"><strong>Cannot write to the default.htaccess file. Minimum file permission required is 600.</strong></font><br>');
	    } else {
	_e('');
}
}
// File write checks for editor
function maintenance_htaccess_file_check() {
$maintenance_htaccess_file = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/maintenance.htaccess';
	if (!is_writable($maintenance_htaccess_file)) {
 		_e('<font color="red"><strong>Cannot write to the maintenance.htaccess file. Minimum file permission required is 600.</strong></font><br>');
	    } else {
	_e('');
}
}
// File write checks for editor
function wpadmin_htaccess_file_check() {
$wpadmin_htaccess_file = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess';
	if (!is_writable($wpadmin_htaccess_file)) {
 		_e('<font color="red"><strong>Cannot write to the wpadmin-secure.htaccess file. Minimum file permission required is 600.</strong></font><br>');
	    } else {
	_e('');
}
}
// File write checks for editor
function root_htaccess_file_check() {
$root_htaccess_file = ABSPATH . '/.htaccess';
	if (!is_writable($root_htaccess_file)) {
 		_e('<font color="red"><strong>Cannot write to the root .htaccess file. Minimum file permission required is 600.</strong></font><br>');
	    } else {
	_e('');
}
}
// File write checks for editor
function current_wpadmin_htaccess_file_check() {
$current_wpadmin_htaccess_file = ABSPATH . '/wp-admin/.htaccess';
	if (!is_writable($current_wpadmin_htaccess_file)) {
 		_e('<font color="red"><strong>Cannot write to the wp-admin .htaccess file. Minimum file permission required is 600.</strong></font><br>');
	    } else {
	_e('');
}
}

// Dump the actual Root .htaccess files contents - dump the first 45 characters of the current existing root .htaccess file
// starting from the 3rd character - strpos checks for the single character "6" (the #6 in version .46) in string position
// 15 to validate the version of the BPS htaccess file in use
// if you modify the first 45 characters of the BPS .htaccess file the strpos must match or errors will be displayed
function root_htaccess_status() {
	$filename = '.htaccess';
	$section = file_get_contents(ABSPATH . $filename, NULL, NULL, 3, 45);
	$check_string = strpos($section, "6");
	if ( !file_exists(ABSPATH . $filename)) {
	_e('<font color="red">NO .htaccess was found in your root folder</font><br><br>');
	_e('<font color="red">wp-config.php is NOT .htaccess protected by BPS</font><br><br>');
	} else {
	if (file_exists(ABSPATH . $filename)) {
	_e('<font color="green"><strong>The .htaccess file that is activated in your root folder is:</strong></font><br>');
		var_dump($section);
	if ($check_string == "15") { 
		_e('<font color="green"><strong><br><br>&radic; wp-config.php is .htaccess protected by BPS<br>&radic; php.ini and php5.ini are .htaccess protected by BPS</strong></font><br><br>');
	} else {
	_e('<font color="red"><br><br>A BPS .htaccess file was NOT found in your root folder or you have not activated BulletProof Security for your Root folder yet, Default Mode is activated or the version of the BPS htaccess file that you are using is not .46. Please read the Read Me hover Tooltip above.</font><br><br>');
	_e('<font color="red">wp-config.php is NOT .htaccess protected by BPS</font><br><br>');
	}
	}
	}
}

// Dump the actual /wp-admin/.htaccess files contents if file exists - dump the first 45 characters of the current existing
// wp-admin .htaccess file starting from the 3rd character
function wpadmin_htaccess_status() {
	$filename = 'wp-admin/.htaccess';
	if (file_exists(ABSPATH . $filename)) {
	$section = file_get_contents(ABSPATH . $filename, NULL, NULL, 3, 45);
	_e('<font color="green"><strong>The .htaccess file that is activated in your /wp-admin folder is:</strong></font><br>');
		var_dump($section);
	} else {
	_e('<font color="red">NO .htaccess file was found in your /wp-admin folder</font><br>');
	}
}

// Check if BPS Deny ALL htaccess file is activated for the BPS Master htaccess folder
function denyall_htaccess_status_master() {
$filename = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/.htaccess';
	if (file_exists($filename)) {
    _e('<font color="green"><strong>&radic; Deny All protection activated for BPS Master /htaccess folder</strong></font><br>');
	} else {
    _e('<font color="red"><strong>Deny All protection NOT activated for BPS Master /htaccess folder</strong></font><br>');
	}
}
// Check if BPS Deny ALL htaccess file is activated for the /wp-content/bps-backup folder
function denyall_htaccess_status_backup() {
$filename = ABSPATH . '/wp-content/bps-backup/.htaccess';
	if (file_exists($filename)) {
    _e('<font color="green"><strong>&radic; Deny All protection activated for /wp-content/bps-backup folder</strong></font><br><br>');
	} else {
    _e('<font color="red"><strong>Deny All protection NOT activated for /wp-content/bps-backup folder</strong></font><br><br>');
	}
}

// File and Folder Permission Checking - substr error is suppressed @ else fileperms error if file does not exist
function bps_check_perms($name,$path,$perm) {
	clearstatcache();
	$current_perms = @substr(sprintf(".%o.", fileperms($path)), -4);
	echo '<table style="width:100%;background-color:#fff;">';
	echo '<tr>';
    echo '<td style="background-color:#fff;padding:2px;width:150px;">' . $name . '</td>';
    echo '<td style="background-color:#fff;padding:2px;width:170px;">' . $path . '</td>';
    echo '<td style="background-color:#fff;padding:2px;width:85px;">' . $perm . '</td>';
    echo '<td style="background-color:#fff;padding:2px;">' . $current_perms . '</td>';
    echo '</tr>';
	echo '</table>';
}
	
// General BulletProof Security File Status Checking
function general_bps_file_checks() {
	$dir='../';
	$filename = '.htaccess';
	if (file_exists($dir.$filename)) {
    _e('<font color="green">&radic; An .htaccess file was found in your root folder</font><br>');
	} else {
    _e('<font color="red">NO .htaccess file was found in your root folder</font><br>');
	}

	$filename = '.htaccess';
	if (file_exists($filename)) {
    _e('<font color="green">&radic; An .htaccess file was found in your /wp-admin folder</font><br>');
	} else {
    _e('<font color="red">NO .htaccess file was found in your /wp-admin folder</font><br>');
	}

	$filename = '/wp-content/plugins/bulletproof-security/admin/htaccess/default.htaccess';
	if (file_exists(ABSPATH . $filename)) {
    _e('<font color="green">&radic; A default.htaccess file was found in the /htaccess folder</font><br>');
	} else {
    _e('<font color="red">NO default.htaccess file found in the /htaccess folder</font><br>');
	}

	$filename = '/wp-content/plugins/bulletproof-security/admin/htaccess/secure.htaccess';
	if (file_exists(ABSPATH . $filename)) {
    _e('<font color="green">&radic; A secure.htaccess file was found in the /htaccess folder</font><br>');
	} else {
    _e('<font color="red">NO secure.htaccess file found in the /htaccess folder</font><br>');
	}

	$filename = '/wp-content/plugins/bulletproof-security/admin/htaccess/maintenance.htaccess';
	if (file_exists(ABSPATH . $filename)) {
    _e('<font color="green">&radic; A maintenance.htaccess file was found in the /htaccess folder</font><br>');
	} else {
    _e('<font color="red">NO maintenance.htaccess file found in the /htaccess folder</font><br>');
	}

	$filename = '/wp-content/plugins/bulletproof-security/admin/htaccess/bp-maintenance.php';
	if (file_exists(ABSPATH . $filename)) {
    _e('<font color="green">&radic; A bp-maintenance.php file was found in the /htaccess folder</font><br>');
	} else {
    _e('<font color="red">NO bp-maintenance.php file found in the /htaccess folder</font><br>');
	}
	
	$filename = '/wp-content/plugins/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess';
	if (file_exists(ABSPATH . $filename)) {
    _e('<font color="green">&radic; A wpadmin-secure.htaccess file was found in the /htaccess folder</font><br>');
	} else {
    _e('<font color="red">NO wpadmin-secure.htaccess file found in the /htaccess folder</font><br>');
	}
	
	$filename = '/wp-content/bps-backup/root.htaccess';
	if (file_exists(ABSPATH . $filename)) {
    _e('<font color="green">&radic; Your Current Root .htaccess File is backed up</font><br>');
	} else {
    _e('<font color="red">Your Current Root .htaccess file is NOT backed up yet</font><br>');
	}
	
	$filename = '/wp-content/bps-backup/wpadmin.htaccess';
	if (file_exists(ABSPATH . $filename)) {
    _e('<font color="green">&radic; Your Current wp-admin .htaccess File is backed up</font><br>');
	} else {
    _e('<font color="red">Your Current wp-admin .htaccess File is NOT backed up yet</font><br>');
	}
	
	$filename = '/wp-content/bps-backup/master-backups/backup_default.htaccess';
	if (file_exists(ABSPATH . $filename)) {
    _e('<font color="green">&radic; Your BPS Master default.htaccess file is backed up</font><br>');
	} else {
    _e('<font color="red">Your BPS Master default.htaccess file is NOT backed up yet</font><br>');
	}
	
	$filename = '/wp-content/bps-backup/master-backups/backup_secure.htaccess';
	if (file_exists(ABSPATH . $filename)) {
    _e('<font color="green">&radic; Your BPS Master secure.htaccess file is backed up</font><br>');
	} else {
    _e('<font color="red">Your BPS Master secure.htaccess file is NOT backed up yet</font><br>');
	}
	
	$filename = '/wp-content/bps-backup/master-backups/backup_wpadmin-secure.htaccess';
	if (file_exists(ABSPATH . $filename)) {
    _e('<font color="green">&radic; Your BPS Master wpadmin-secure.htaccess file is backed up</font><br>');
	} else {
    _e('<font color="red">Your BPS Master wpadmin-secure.htaccess file is NOT backed up yet</font><br>');
	}

	$filename = '/wp-content/bps-backup/master-backups/backup_maintenance.htaccess';
	if (file_exists(ABSPATH . $filename)) {
    _e('<font color="green">&radic; Your BPS Master maintenance.htaccess file is backed up</font><br>');
	} else {
    _e('<font color="red">Your BPS Master maintenance.htaccess file is NOT backed up yet</font><br>');
	}

	$filename = '/wp-content/bps-backup/master-backups/backup_bp-maintenance.php';
	if (file_exists(ABSPATH . $filename)) {
    _e('<font color="green">&radic; Your BPS Master bp-maintenance.php file is backed up</font><br>');
	} else {
    _e('<font color="red">Your BPS Master bp-maintenance.php file is NOT backed up yet</font><br>');
	}
}

// Backup and Restore page - Backed up Root and wp-admin .htaccess file checks
function backup_restore_checks() {
	$bp_root_back = ABSPATH . '/wp-content/bps-backup/root.htaccess'; 
	if (file_exists($bp_root_back)) { 
	_e('<font color="green"><strong>&radic; Your Root .htaccess file is backed up.</strong></font><br>'); 
	} else { 
	_e('<font color="red"><strong>Your Root .htaccess file is NOT backed up either because you have not done a Backup yet, an .htaccess file did NOT already exist in your root folder or because of a file copy error. Read the "Current Backed Up .htaccess Files Status Read Me" hover ToolTip for more specific information.</strong></font><br><br>');
	} 

	$bp_wpadmin_back = ABSPATH . '/wp-content/bps-backup/wpadmin.htaccess'; 
	if (file_exists($bp_wpadmin_back)) { 
	_e('<font color="green"><strong>&radic; Your wp-admin .htaccess file is backed up.</strong></font><br>'); 
	} else { 
	_e('<font color="red"><strong>Your wp-admin .htaccess file is NOT backed up either because you have not done a Backup yet, an .htaccess file did NOT already exist in your /wp-admin folder or because of a file copy error. Read the "Current Backed Up .htaccess Files Status Read Me" hover ToolTip for more specific information.</strong></font><br>'); 
	} 
}

// Backup and Restore page - General check if existing .htaccess files already exist 
function general_bps_file_checks_backup_restore() {
	$dir='../';
	$filename = '.htaccess';
	if (file_exists($dir.$filename)) {
    _e('<font color="green">&radic; An .htaccess file was found in your root folder</font><br>');
	} else {
    _e('<font color="red">NO .htaccess file was found in your root folder</font><br>');
	}

	$filename = '.htaccess';
	if (file_exists($filename)) {
    _e('<font color="green">&radic; An .htaccess file was found in your /wp-admin folder</font><br>');
	} else {
    _e('<font color="red">NO .htaccess file was found in your /wp-admin folder</font><br>');
	}
}

// Backup and Restore page - BPS Master .htaccess backup file checks
function bps_master_file_backups() {
	$bps_default_master = ABSPATH . '/wp-content/bps-backup/master-backups/backup_default.htaccess'; 
	if (file_exists($bps_default_master)) {
    _e('<font color="green"><strong>&radic; The default.htaccess Master file is backed up.</strong></font><br>');
	} else {
    _e('<font color="red"><strong>Your default.htaccess Master file has NOT been backed up yet!</strong></font><br>');
	}

	$bps_secure_master = ABSPATH . '/wp-content/bps-backup/master-backups/backup_secure.htaccess'; 
	if (file_exists($bps_secure_master)) {
    _e('<font color="green"><strong>&radic; The secure.htaccess Master file is backed up.</strong></font><br>');
	} else {
    _e('<font color="red"><strong>Your secure.htaccess Master file has NOT been backed up yet!</strong></font><br>');
	}
	
	$bps_wpadmin_master = ABSPATH . '/wp-content/bps-backup/master-backups/backup_wpadmin-secure.htaccess'; 
	if (file_exists($bps_wpadmin_master)) {
    _e('<font color="green"><strong>&radic; The wpadmin-secure.htaccess Master file is backed up.</strong></font><br>');
	} else {
    _e('<font color="red"><strong>Your wpadmin-secure.htaccess Master file has NOT been backed up yet!</strong></font><br>');
	}
	
	$bps_maintenance_master = ABSPATH . '/wp-content/bps-backup/master-backups/backup_maintenance.htaccess'; 
	if (file_exists($bps_maintenance_master)) {
    _e('<font color="green"><strong>&radic; The maintenance.htaccess Master file is backed up.<strong</font><br>');
	} else {
    _e('<font color="red"><strong>Your maintenance.htaccess Master file has NOT been backed up yet!</strong></font><br>');
	}
	
	$bps_bp_maintenance_master = ABSPATH . '/wp-content/bps-backup/master-backups/backup_bp-maintenance.php'; 
	if (file_exists($bps_bp_maintenance_master)) {
    _e('<font color="green"><strong>&radic; The bp-maintenance.php Master file is backed up.</strong></font><br>');
	} else {
    _e('<font color="red"><strong>Your bp-maintenance.php Master file has NOT been backed up yet!</strong></font><br>');
	}
}

// Check for Apache or IIS Server OS - not necessary
//$bps_check_server_os_string = $_SERVER['SERVER_SOFTWARE'];
//$bps_check_server_os_pattern = "/apache/i";
//function bps_check_server_os() {
//	if( preg_match($bps_check_server_os_pattern, $bps_check_server_os_string))
//	_e("Apache Server");
//	} else {
//    _e("This is not an Apache Server");
//}

// Check if Permalinks are enabled
$permalink_structure = get_option('permalink_structure');
function bps_check_permalinks() {
	if ( get_option('permalink_structure') != '' ) { 
	_e('Permalinks Enabled: <font color="green"><strong>&radic; Permalinks are Enabled</strong></font>'); 
	} else {
	_e('Permalinks Enabled: <font color="red"><strong>WARNING! Permalinks are NOT Enabled<br>Permalinks MUST be enabled for BPS to function correctly</strong></font>'); 
	}
}

// Check PHP version
function bps_check_php_version() {
	if (version_compare(PHP_VERSION, '5.0.0', '>=')) {
    _e('PHP Version Check: <font color="green"><strong>&radic; Running PHP5</strong></font><br>');
}
	if (version_compare(PHP_VERSION, '5.0.0', '<')) {
    _e('<font color="red"><strong>WARNING! BPS requires PHP5 to function correctly. You are currently running PHP4. Your PHP version is: ' . PHP_VERSION . '</strong></font><br>');
	}
}

// Check for Multisite
function bps_multsite_check() {  
	if ( is_multisite() ) { 
	_e('Multisite: <strong>Multisite is enabled</strong><br>');
	} else {
	_e('Multisite: <strong>Multisite is not enabled</strong><br>');
	}
}

// Check if username Admin exists
function check_admin_username() {
	global $wpdb;
	$name = $wpdb->get_var("SELECT user_login FROM $wpdb->users WHERE user_login='admin'");
	if ($name=="admin"){
	_e('<font color="red"><strong>Recommended Security Changes: Username "admin" is being used. It is recommended that you change the default administrator username "admin" to a new unique username.</strong></font><br><br></a>');
	} else {
	_e('<font color="green"><strong>&radic; The Administrator username "admin" is not being used</strong></font><br>');
	}
}

// Check for WP readme.html and /wp-admin/install.php files
// echo success only if valid BPS htaccess file is activated
function bps_filesmatch_check() {
	$htaccess_filename = '.htaccess';
	$filename = ABSPATH . 'readme.html';
	if (file_exists(ABSPATH . $htaccess_filename)) {
	$section = file_get_contents(ABSPATH . $htaccess_filename, NULL, NULL, 3, 45);
		$check_string = strpos($section, "6");
		if ($check_string == "15"||"17") { 
		_e('');
		if (file_exists($filename)&&($check_string == "15"||"17")) {
		_e('<font color="green"><strong>&radic; The WP /readme.html file is .htaccess protected</strong></font><br>');
		} else {
		_e('<font color="green"><strong>&radic; The WP /readme.html file does not exist</strong></font><br>');
		}
		}
		}
	$filename = ABSPATH . 'wp-admin/install.php';
	if (file_exists($filename)&&($check_string == "15"||"17")) {
    _e('<font color="green"><strong>&radic; The /wp-admin/install.php file is .htaccess protected</strong></font><br><br>');
	} else {
    _e('<font color="green"><strong>&radic; The /wp-admin/install.php file does not exist</strong></font><br><br>');
	}
}

// Check BPS Pro Modules Status
function check_bps_pro_mod () {
	global $bulletproof_security;
	$filename_pro = 'wp-content/plugins/bulletproof-security/admin/options-bps-pro-modules.php';
	if (file_exists(ABSPATH . $filename_pro)) {
	$section_pro = file_get_contents(ABSPATH . $filename, NULL, NULL, 5, 10);
	_e('<font color="green"><strong>&radic; BulletProof Security Pro Modules are installed and activated.</strong></font><br>');
	var_dump($section_pro);
	} else {
	_e('<font color="black"><br>*BPS Pro Modules are not installed</font><br>');
	}
}

// Get SQL Mode from WPDB
function bps_get_sql_mode() {
	global $wpdb;
	$mysqlinfo = $wpdb->get_results("SHOW VARIABLES LIKE 'sql_mode'");
        if (is_array($mysqlinfo)) $sql_mode = $mysqlinfo[0]->Value;
        if (empty($sql_mode)) $sql_mode = __('Not Set');
		else $sql_mode = __('Off');
} 

// Show DB errors should already be set to false in /includes/wp-db.php
// Extra function insurance show_errors = false
function bps_wpdb_errors_off() {
	global $wpdb;
	$wpdb->show_errors = false;
	if ($wpdb->show_errors != false) {
	_e('<font color="red"><strong>WARNING! WordPress DB Show Errors Is Set To: true! DB errors will be displayed</strong></font><br>');
	} else {
	_e('<font color="green"><strong>&radic; WordPress DB Show Errors Function Is Set To: </strong></font>');
	_e('<font color="black"><strong>false</strong></font><br>');
	_e('<font color="green"><strong>&radic; WordPress Database Errors Are Turned Off</strong></font><br>');
	}	
}

// Hide / Remove WordPress Version Meta Generator Tag - echo only for remove_action('wp_head', 'wp_generator');
function bps_wp_remove_version() {
	global $wp_version;
	_e('<font color="green"><strong>&radic; WordPress Meta Generator Tag Removed<br>&radic; WordPress Version Is Not Displayed / Not Shown</strong></font><br>');
}

// Return Nothing For WP Version Callback
function bps_wp_generator_meta_removed() {
	if ( !is_admin()) {
	global $wp_version;
	$wp_version = '';
	}
}
?>