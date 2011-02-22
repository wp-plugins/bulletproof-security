<?php
// Direct calls to this file are Forbidden when core files are not present
if (!function_exists ('add_action')) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}

// BPS Pro install transition - not used - placeholder
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

// Form - Backup and rename existing and / or currently active htaccess files from 
// the root and wpadmin folders to /wp-content/bps-backup
$backup_htaccess = 'unchecked';
$old_backroot = ABSPATH . '/.htaccess';
$new_backroot = ABSPATH . '/wp-content/bps-backup/root.htaccess';
$old_backwpadmin = ABSPATH . '/wp-admin/.htaccess';
$new_backwpadmin = ABSPATH . '/wp-content/bps-backup/wpadmin.htaccess';

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
$old_restoreroot = ABSPATH . '/wp-content/bps-backup/root.htaccess';
$new_restoreroot = ABSPATH . '/.htaccess';
$old_restorewpadmin = ABSPATH . '/wp-content/bps-backup/wpadmin.htaccess';
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

// Form - Backup and rename the BPS Master Files to /wp-content/bps-backup/master-backups
$backup_master_htaccess_files = 'unchecked';
$default_master = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/default.htaccess';
$default_master_backup = ABSPATH . '/wp-content/bps-backup/master-backups/backup_default.htaccess';
$secure_master = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/secure.htaccess';
$secure_master_backup = ABSPATH . '/wp-content/bps-backup/master-backups/backup_secure.htaccess';
$wpadmin_master = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess';
$wpadmin_master_backup = ABSPATH . '/wp-content/bps-backup/master-backups/backup_wpadmin-secure.htaccess';
$maintenance_master = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/maintenance.htaccess';
$maintenance_master_backup = ABSPATH . '/wp-content/bps-backup/master-backups/backup_maintenance.htaccess';
$bp_maintenance_master = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/bp-maintenance.php';
$bp_maintenance_master_backup = ABSPATH . '/wp-content/bps-backup/master-backups/backup_bp-maintenance.php';

if (isset($_POST['submit'])) {
	$selected_radio = $_POST['selection'];
	if ($selected_radio == 'backup_master_htaccess_files') {
		$backup_master_htaccess_files = 'checked';
	if (file_exists($default_master)) { 
 		copy($default_master, $default_master_backup);
	if (file_exists($secure_master)) { 	
		copy($secure_master, $secure_master_backup);
	if (file_exists($wpadmin_master)) { 	
		copy($wpadmin_master, $wpadmin_master_backup);
	if (file_exists($maintenance_master)) { 	
		copy($maintenance_master, $maintenance_master_backup);
	if (file_exists($bp_maintenance_master)) { 	
		copy($bp_maintenance_master, $bp_maintenance_master_backup);
	}
	}
	}
	}
	}
	}
}

// Form copy and rename htaccess file to root folder
// BulletProof Security and Default Mode
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
		copy($old1, $new1);
	}
	else if ($selected_radio == 'bpdefaultroot') {
	$bpdefaultroot = 'checked';
		copy($old, $new);
	}
}

// Form copy and rename htaccess file to wp-admin folder
// BulletProof Security wp-admin
$bpsecurewpadmin = 'unchecked';
$bpdefaultwpadmin = 'unchecked';
$oldadmin1 = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess';
$newadmin1 = ABSPATH . '/wp-admin/.htaccess';

if (isset($_POST['submit'])) {
	$selected_radio = $_POST['selection'];
	if ($selected_radio == 'bpsecurewpadmin') {
	$bpsecurewpadmin = 'checked';
		copy($oldadmin1, $newadmin1);
	}
}

// Form rename Deny All htaccess file to .htaccess for the BPS Master htaccess folder
$bps_rename_htaccess_files = 'unchecked';
$bps_rename_htaccess = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/deny-all.htaccess';
$bps_rename_htaccess_renamed = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/.htaccess';

if (isset($_POST['submit'])) {
	$selected_radio = $_POST['selection'];
	if ($selected_radio == 'bps_rename_htaccess_files') {
	$bps_rename_htaccess_files = 'checked';
		copy($bps_rename_htaccess, $bps_rename_htaccess_renamed);
	}
}

// Form copy and rename the Deny All htaccess file to the BPS backup folder
// /wp-content/bps-backup
$bps_rename_htaccess_files_backup = 'unchecked';
$bps_rename_htaccess_backup = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/deny-all.htaccess';
$bps_rename_htaccess_backup_online = ABSPATH . '/wp-content/bps-backup/.htaccess';

if (isset($_POST['submit'])) {
	$selected_radio = $_POST['selection'];
	if ($selected_radio == 'bps_rename_htaccess_files_backup') {
	$bps_rename_htaccess_files_backup = 'checked';
		copy($bps_rename_htaccess_backup, $bps_rename_htaccess_backup_online);
	}
}

// Form copy and rename maintenance htaccess to root and copy bp-maintenance.php to root
$bpmaintenance = 'unchecked';
$oldmaint = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/maintenance.htaccess';
$newmaint = ABSPATH . '/.htaccess';
$oldmaint1 = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/bp-maintenance.php';
$newmaint1 = ABSPATH . '/bp-maintenance.php';

if (isset($_POST['submit'])) {
	$selected_radio = $_POST['selection'];
	if ($selected_radio == 'bpmaintenance') {
	$bpmaintenance = 'checked';
		copy($oldmaint, $newmaint);
		copy($oldmaint1, $newmaint1);
	}
}

// Form - Backup the Upload and Download config files
$uploadify_php_save = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/uploadify/uploadify.php';
$uploadify_php_save_renamed = ABSPATH . '/wp-content/bps-backup/backup_uploadify.php';
$download_php_save = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/download/download.php';
$download_php_save_renamed = ABSPATH . '/wp-content/bps-backup/backup_download.php';
$bps_security_js_save = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/js/bulletproof-security-admin.js';
$bps_security_js_save_renamed = ABSPATH . '/wp-content/bps-backup/backup_bulletproof-security-admin.js';

if (isset($_POST['up-down-save-submit'])) {
	if (file_exists($uploadify_php_save)) { 
 		copy($uploadify_php_save, $uploadify_php_save_renamed);
	if (file_exists($download_php_save)) { 	
		copy($download_php_save, $download_php_save_renamed);
	if (file_exists($bps_security_js_save)) { 	
		copy($bps_security_js_save, $bps_security_js_save_renamed);
	}
	}
	}
}

// Form - Restore the Upload and Download config files
$uploadify_php_restore = ABSPATH . '/wp-content/bps-backup/backup_uploadify.php';
$uploadify_php_restore_renamed = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/uploadify/uploadify.php';
$download_php_restore = ABSPATH . '/wp-content/bps-backup/backup_download.php';
$download_php_restore_renamed = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/download/download.php';
$bps_security_js_restore = ABSPATH . '/wp-content/bps-backup/backup_bulletproof-security-admin.js';
$bps_security_js_restore_renamed = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/js/bulletproof-security-admin.js';

if (isset($_POST['up-down-restore-submit'])) {
	if (file_exists($uploadify_php_restore)) { 
 		copy($uploadify_php_restore, $uploadify_php_restore_renamed);
	if (file_exists($download_php_restore)) { 	
		copy($download_php_restore, $download_php_restore_renamed);
	if (file_exists($bps_security_js_restore)) { 	
		copy($bps_security_js_restore, $bps_security_js_restore_renamed);
	}
	}
	}
}

// BPS Master htaccess File Editing - Bulky code but much more secure
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

// The current active root htaccess file
function get_root_htaccess() {
	$root_htaccess_file = '/.htaccess';
	if (file_exists(ABSPATH . $root_htaccess_file)) {
	echo file_get_contents(ABSPATH . $root_htaccess_file);
	} else {
	_e('An .htaccess file was not found in your website root folder.');
	}
}

// The current active wp-admin htaccess file
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

// Get Root .htaccess content - get first 45 characters of current root .htaccess file starting from the 3rd character
// and display string dump - also checks for single character "5" in .45.9 in string position 15 or 17 to validate the version of BPS // .htaccess file and the wp-config.php status
function root_htaccess_status() {
	$filename = '.htaccess';
	$w3 = ABSPATH . '/wp-content/plugins/w3-total-cache/w3-total-cache.php';
	if ( !file_exists(ABSPATH . $filename)) {
	_e('<font color="red">NO .htaccess was found in your root folder</font><br><br>');
	_e('<font color="red">wp-config.php is NOT .htaccess protected by BPS</font><br><br>');
	} else {
	if (file_exists(ABSPATH . $filename)) {
	$section = file_get_contents(ABSPATH . $filename, NULL, NULL, 3, 45);
	_e('<font color="green"><strong>The .htaccess file that is activated in your root folder is:</strong></font><br>');
		var_dump($section);
		$check_string = strpos($section, "5");
		if ($check_string == "15"||"17") { // if you modify BPS .htaccess files the str pos must match for valid status checks
		$wpconfig_status = '&radic; wp-config.php is .htaccess protected by BPS<br>&radic; php.ini and php5.ini are .htaccess protected by BPS';
		_e('<p style="color:green;font-weight:bold;">' . $wpconfig_status . '</p>');
	} else {
	_e('<font color="red"><br><br>A BPS .htaccess file was NOT found in your root folder or the BPS .htaccess file that you are currently using does NOT include .htaccess protection for wp-config.php. Please read the Read Me hover Tooltip before activating a newer version of a BPS website root folder .htaccess file.</font><br><br>');
	_e('<font color="red">wp-config.php is NOT .htaccess protected by BPS</font><br><br>');
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

	$filename1 = '/wp-content/bps-backup/backup_uploadify.php';
	$filename2 = '/wp-content/bps-backup/backup_download.php';
	$filename3 = '/wp-content/bps-backup/backup_bulletproof-security-admin.js';
	if (file_exists(ABSPATH . $filename1)) {
    _e('<font color="green">&radic; Your File Upload settings are backed up</font><br>');
	} else {
    _e('<font color="red">Your File Upload settings are NOT backed up yet</font><br>');
	}
	
	if (file_exists(ABSPATH . $filename2)) {
    _e('<font color="green">&radic; Your File Download settings are backed up</font><br>');
	} else {
    _e('<font color="red">Your File Download settings are NOT backed up yet</font><br>');
	}
	
	if (file_exists(ABSPATH . $filename3)) {
    _e('');
	} else {
    _e('<font color="red">Your File Upload settings are NOT backed up yet</font><br>');
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

// Check for WP readme.html and /wp-admin/install.php files
// echo success only if valid BPS htaccess file is activated
function bps_filesmatch_check() {
	$htaccess_filename = '.htaccess';
	$filename = ABSPATH . 'readme.html';
	if (file_exists(ABSPATH . $htaccess_filename)) {
	$section = file_get_contents(ABSPATH . $htaccess_filename, NULL, NULL, 3, 45);
		$check_string = strpos($section, "5");
		if ($check_string == "15") { 
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