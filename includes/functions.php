<?php

// BPS Pro install transition
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

// Form - Backup and rename users existing htaccess files
$backup_htaccess = 'unchecked';
$old_backroot = ABSPATH . '/.htaccess';
$new_backroot = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/backup/root.htaccess';
$old_backwpadmin = ABSPATH . '/wp-admin/.htaccess';
$new_backwpadmin = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/backup/wpadmin.htaccess';

if (isset($_POST['submit'])) {
	$selected_radio = $_POST['selection'];
	if ($selected_radio == 'backup_htaccess') {
		$backup_htaccess = 'checked';
	if (file_exists($old_backroot)) { 
 		copy($old_backroot, $new_backroot);
	if (file_exists($old_backwpadmin)) { 	
		copy($old_backwpadmin, $new_backwpadmin);
	}
	}
	}
}

// Form - Restore users backed up htaccess files
$restore_htaccess = 'unchecked';
$old_restoreroot = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/backup/root.htaccess';
$new_restoreroot = ABSPATH . '/.htaccess';
$old_restorewpadmin = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/backup/wpadmin.htaccess';
$new_restorewpadmin = ABSPATH . '/wp-admin/.htaccess';

if (isset($_POST['submit'])) {
	$selected_radio = $_POST['selection'];
	if ($selected_radio == 'restore_htaccess') {
		$restore_htaccess = 'checked';
	if (file_exists($old_restoreroot)) { 
 		copy($old_restoreroot, $new_restoreroot);
	if (file_exists($old_restorewpadmin)) { 	
		copy($old_restorewpadmin, $new_restorewpadmin);
	}
	}
	}
}

// Form copy and rename htaccess file for root
$bpsecureroot = 'unchecked';
$bpdefaultroot = 'unchecked';
$old = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/default.htaccess';
$new = ABSPATH . '/.htaccess';
$old1 = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/secure.htaccess';
$new1 = ABSPATH . '/.htaccess';

if (isset($_POST['submit'])) {
	$selected_radio = $_POST['selection'];
	if ($selected_radio == 'bpsecureroot') {
	$bpsecureroot = 'checked';
		copy($old1, $new1) or die("Unable to copy $old1 to $new1.");
	}
	else if ($selected_radio == 'bpdefaultroot') {
	$bpdefaultroot = 'checked';
		copy($old, $new) or die("Unable to copy $old to $new.");
	}
}

// Form copy and rename htaccess file for wp-admin
$bpsecurewpadmin = 'unchecked';
$bpdefaultwpadmin = 'unchecked';
$oldadmin1 = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess';
$newadmin1 = ABSPATH . '/wp-admin/.htaccess';

if (isset($_POST['submit'])) {
	$selected_radio = $_POST['selection'];
	if ($selected_radio == 'bpsecurewpadmin') {
	$bpsecurewpadmin = 'checked';
		copy($oldadmin1, $newadmin1) or die("Unable to copy $oldadmin1 to $newadmin1.");
	}
}

// Form copy and rename maintenance htaccess for root + copy bp-maintenance.php to root
$bpmaintenance = 'unchecked';
$oldmaint = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/maintenance.htaccess';
$newmaint = ABSPATH . '/.htaccess';
$oldmaint1 = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/bp-maintenance.php';
$newmaint1 = ABSPATH . '/bp-maintenance.php';

if (isset($_POST['submit'])) {
	$selected_radio = $_POST['selection'];
	if ($selected_radio == 'bpmaintenance') {
	$bpmaintenance = 'checked';
		copy($oldmaint, $newmaint) or die("Unable to copy $oldmaint to $newmaint.");
		copy($oldmaint1, $newmaint1) or die("Unable to copy $oldmaint1 to $newmaint1.");
	}
}

// Get Root .htaccess content - get first 45 characters of current root .htaccess file starting from the 3rd character
// and display string dump - also checks for single character "5" in .45.4 in string position 15 to validate the version of BPS //.htaccess file and the wp-config.php status
function root_htaccess_status() {
	$filename = '.htaccess';
	if ( !file_exists(ABSPATH . $filename)) {
	_e('<font color="red">NO .htaccess was found in your root folder</font><br><br>');
	_e('<font color="red">wp-config.php is NOT .htaccess protected by BPS</font><br><br>');
	} else {
	if (file_exists(ABSPATH . $filename)) {
	$section = file_get_contents(ABSPATH . $filename, NULL, NULL, 3, 45);
	_e('<font color="green"><strong>The .htaccess file that is activated in your root folder is:</strong></font><br>');
		var_dump($section);
		$check_string = strpos($section, "5");
		if ($check_string == "15") { // if you modify BPS .htaccess files this str pos must match for valid status checks
		$wpconfig_status = '&radic; wp-config.php is .htaccess protected by BPS<br>&radic; php.ini and php5.ini are .htaccess protected by BPS';
		_e('<p style="color:green;font-weight:bold;">' . $wpconfig_status . '</p>');
	} else {
	if ($check_string == "17") { // W3 Total Cache shift 2 positions to right check
		$wpconfig_status = '&radic; wp-config.php is .htaccess protected by BPS<br>&radic; php.ini and php5.ini are .htaccess protected by BPS<br>&radic; W3 Total Cache fix implemented.<br>You may need to empty all W3 caches and redeploy W3.';
		_e('<p style="color:green;font-weight:bold;">' . $wpconfig_status . '</p>');
	} else {
	_e('<font color="red"><br><br>A BPS .htaccess file was NOT found in your root folder or the BPS .htaccess file that you are currently using does NOT include .htaccess protection for wp-config.php. Please read the Read Me hover Tooltip before activating a newer version of a BPS website root folder .htaccess file.</font><br><br>');
	_e('<font color="red">wp-config.php is NOT .htaccess protected by BPS</font><br><br>');
	}
	}
	}
	}
}

// Get wp-admin .htaccess content - get first 45 characters of current
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

// File and Folder Permission Checking - substr error is suppressed @ else fileperms error if file does not exist
function bps_check_perms($name,$path,$perm) {
	clearstatcache();
	$current_perms = @substr(sprintf(".%o.", fileperms($path)), -4);
	echo '<tr>';
    echo '<td style="background-color:#fff;padding:2px;border-left:1px solid black;">' . $name . '</td>';
    echo '<td style="background-color:#fff;padding:2px;">' . $path . '</td>';
    echo '<td style="background-color:#fff;padding:2px;">' . $perm . '</td>';
    echo '<td style="background-color:#fff;padding:2px;border-right:1px solid black;">' . $current_perms . '</td>';
    echo '</tr>';
}
	
// General BulletProof Security Files Checking
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
}

// Backup and Restore .htaccess file checks
function backup_restore_checks() {
	$bp_root_back = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/backup/root.htaccess'; 
	if (file_exists($bp_root_back)) { 
	_e('<font color="green"><strong>Your original root .htaccess file is backed up.</strong></font><br>'); 
	} else { 
	_e('<font color="red"><strong>Your original root .htaccess file is NOT backed up either because you have not done a One Time Backup yet, an .htaccess file did NOT already exist in your root folder or because of a file copy error. Read the "Current Backed Up .htaccess Files Status Read Me" hover ToolTip for more specific information.</strong></font><br><br>');
	} 

	$bp_wpadmin_back = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/backup/wpadmin.htaccess'; 
	if (file_exists($bp_wpadmin_back)) { 
	_e('<font color="green"><strong>Your original /wp-admin .htaccess file is backed up.</strong></font><br>'); 
	} else { 
	_e('<font color="red"><strong>Your original /wp-admin .htaccess file is NOT backed up either because you have not done a One Time Backup yet, an .htaccess file did NOT already exist in your /wp-admin folder or because of a file copy error. Read the "Current Backed Up .htaccess Files Status Read Me" hover ToolTip for more specific information.</strong></font><br>'); 
	} 
}

// Backup and Restore .htaccess file checks
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

// Check if username Admin exists
function check_admin_username() {
	global $wpdb;
	$name = $wpdb->get_var("SELECT user_login FROM $wpdb->users WHERE user_login='admin'");
	if ($name=="admin"){
	echo '<font color="red"><strong>Recommended Security Changes: Username "admin" is being used. It is recommended that you change the administrator username to a new unique username.</strong></font><br><br></a>';
	}
	else{
	echo '<font color="green"><strong>&radic; The Administrator username "admin" is not being used</strong></font><br>';
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
	_e('<font color="black"><br><br>*BPS Pro Modules are not installed</font><br>');
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

// PHP ini get display errors 1 = ON or 0 = OFF - not valid for php.ini - On or Off)
// Does not display accurate info in all cases
//function bps_php_display_errors() {
//	echo '' . ini_get('display_errors');
//	}
//	$bps_php_display_errors_output = str_replace('1', 'On', '1');

//function bps_php_display_errors_output($bps_php_display_errors_output = '') {
//	if ($bps_php_display_errors_output == '1') {
//	return $bps_php_display_errors_output($bps_php_display_errors_output = '');
//	}
//	else if ($bps_php_display_errors_output == '0') {
//	echo 'Off';
//	}
//}

// Show DB errors should already be set to false in /includes/wp-db.php
// Extra insurance sho_errors = false function re-applied - this function will be expanded in the future to allow DB errors to be turned on and off from the Dashboard - DB errors will display in this window
function bps_wpdb_errors_off() {
	global $wpdb;
	$wpdb->show_errors = false;
	echo '<font color="green"><strong>&radic; WordPress DB Show Errors Function Is Set To: </strong></font>';
	echo $show_errors ? '<font color="red"><strong>true</strong></font>': '<font color="black"><strong>false</strong></font><br>';
	echo '<font color="green"><strong>&radic; WordPress Database Errors Are Turned Off</strong></font><br>';
	
}

// Hide / Remove WordPress Version Meta Generator Tag - echo only for remove_action('wp_head', 'wp_generator');
function bps_wp_remove_version() {
	global $wp_version;
	echo '<font color="green"><strong>&radic; WordPress Meta Generator Tag Removed<br>&radic; WordPress Version Is Not Displayed / Not Shown</strong></font><br>';
}

// Return Nothing For WP Version Callback
function bps_wp_generator_meta_removed() {
	if ( !is_admin()) {
	global $wp_version;
	$wp_version = '';
	}
}
?>