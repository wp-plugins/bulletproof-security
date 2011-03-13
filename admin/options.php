<?php
// Direct calls to this file are Forbidden when core files are not present
if ( !function_exists('add_action') ){
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}
 
if ( !current_user_can('manage_options') ){ 
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}

// BulletProof Security Menu
function bulletproof_security_admin_menu() {
bulletproof_security_add_menu_page(__('Options', 'bulletproof-security'), 'bulletproof-security/admin/options.php');

// Allow plugins to add to menu
do_action('bps_admin_menu');
}
?>

<div id="message" class="updated" style="border:1px solid #999999;">
<?php	
// Form copy and rename htaccess file to root folder
// BulletProof Security and Default Mode
$bpsecureroot = 'unchecked';
$bpdefaultroot = 'unchecked';
$old = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/default.htaccess';
$new = ABSPATH . '/.htaccess';
$old1 = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/secure.htaccess';
$new1 = ABSPATH . '/.htaccess';

if (isset($_POST['submit12']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_root_copy' );
	$selected_radio = $_POST['selection12'];
	if ($selected_radio == 'bpsecureroot') {
	$bpsecureroot = 'checked';
		copy($old1, $new1);
		if (!copy($old1, $new1)) {
	_e('<font color="red"><strong>Failed to Activate BulletProof Security Root Folder Protection! Your Website is NOT protected with BulletProof Security!</strong></font><br>');
   	} else {
	_e('BulletProof Security Root Folder Protection <font color="green"><strong>Activated.</strong></font> Your website is Now protected with BulletProof Security.');
    }
	}
	elseif ($selected_radio == 'bpdefaultroot') {
	$bpdefaultroot = 'checked';
		copy($old, $new);
		if (!copy($old, $new)) {
	_e('<font color="red"><strong>Failed to Activate Default .htaccess Mode!</strong></font><br>');
   	} else {
	_e('<font color="red"><strong>Warning: Default .htaccess Mode Is Activated In Your Website Root Folder. Your Website Is Not Protected With BulletProof Security.</strong></font>');
	}
	}
}

// Form copy and rename htaccess file to wp-admin folder
// BulletProof Security wp-admin
$bpsecurewpadmin = 'unchecked';
$bpdefaultwpadmin = 'unchecked';
$oldadmin1 = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess';
$newadmin1 = ABSPATH . '/wp-admin/.htaccess';

if (isset($_POST['submit13']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_wpadmin_copy' );
	$selected_radio = $_POST['selection13'];
	if ($selected_radio == 'bpsecurewpadmin') {
	$bpsecurewpadmin = 'checked';
		copy($oldadmin1, $newadmin1);
		if (!copy($oldadmin1, $newadmin1)) {
	_e('<font color="red"><strong>Failed to Activate BulletProof Security wp-admin Folder Protection! Your wp-admin folder is NOT protected with BulletProof Security!</strong></font><br>');
   	} else {
	_e('BulletProof Security wp-admin Folder Protection <font color="green"><strong>Activated.</strong></font> Your wp-admin folder is Now protected with BulletProof Security.');
	}
	}
}

// Form rename Deny All htaccess file to .htaccess for the BPS Master htaccess folder
$bps_rename_htaccess_files = 'unchecked';
$bps_rename_htaccess = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/deny-all.htaccess';
$bps_rename_htaccess_renamed = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/.htaccess';

if (isset($_POST['submit8']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_denyall_master' );
	$selected_radio = $_POST['selection8'];
	if ($selected_radio == 'bps_rename_htaccess_files') {
	$bps_rename_htaccess_files = 'checked';
		copy($bps_rename_htaccess, $bps_rename_htaccess_renamed);
		if (!copy($bps_rename_htaccess, $bps_rename_htaccess_renamed)) {
	_e('<font color="red"><strong>Failed to Activate BulletProof Security Deny All Folder Protection! Your BPS Master htaccess folder is NOT Protected with Deny All htaccess folder protection!</strong></font><br>');
   	} else {
	_e('BulletProof Security Deny All Folder Protection <font color="green"><strong>Activated.</strong></font> Your BPS Master htaccess folder is Now Protected with Deny All htaccess folder protection.');
	}
}
}

// Form copy and rename the Deny All htaccess file to the BPS backup folder
// /wp-content/bps-backup
$bps_rename_htaccess_files_backup = 'unchecked';
$bps_rename_htaccess_backup = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/deny-all.htaccess';
$bps_rename_htaccess_backup_online = ABSPATH . '/wp-content/bps-backup/.htaccess';

if (isset($_POST['submit14']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_denyall_bpsbackup' );
	$selected_radio = $_POST['selection14'];
	if ($selected_radio == 'bps_rename_htaccess_files_backup') {
	$bps_rename_htaccess_files_backup = 'checked';
		copy($bps_rename_htaccess_backup, $bps_rename_htaccess_backup_online);
		if (!copy($bps_rename_htaccess_backup, $bps_rename_htaccess_backup_online)) {
	_e('<font color="red"><strong>Failed to Activate BulletProof Security Deny All Folder Protection! Your BPS /wp-content/bps-backup folder is NOT Protected with Deny All htaccess folder protection!</strong></font><br>');
   	} else {
	_e('BulletProof Security Deny All Folder Protection <font color="green"><strong>Activated.</strong></font> Your BPS /wp-content/bps-backup folder is Now Protected with Deny All htaccess folder protection.');
	}
	}
}

// Form - Backup and rename existing and / or currently active htaccess files from 
// the root and wpadmin folders to /wp-content/bps-backup
$backup_htaccess = 'unchecked';
$old_backroot = ABSPATH . '/.htaccess';
$new_backroot = ABSPATH . '/wp-content/bps-backup/root.htaccess';
$old_backwpadmin = ABSPATH . '/wp-admin/.htaccess';
$new_backwpadmin = ABSPATH . '/wp-content/bps-backup/wpadmin.htaccess';

if (isset($_POST['submit9']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_backup_active_htaccess_files' );
		$selected_radio = $_POST['selection9'];
	if ($selected_radio == 'backup_htaccess') {
		$backup_htaccess = 'checked';
	if (file_exists($old_backroot)) { 
 		copy($old_backroot, $new_backroot);
		if (!copy($old_backroot, $new_backroot)) {
	_e('<font color="red"><strong>Failed to Backup Your Root .htaccess File! This is most likely because you DO NOT currently have an active Root .htaccess file.</strong></font><br><br>');
	} else {
	_e('<font color="green"><strong>Your currently active Root .htaccess file has been backed up successfully!</strong></font><br>Use the Restore feature to restore your .htaccess files if you run into a problem at any time. If you make additional changes or install a plugin that writes to the htaccess files then back them up again. This will overwrite the currently backed up htaccess files. Please read the <font color="red"><strong>CAUTION:</strong></font> Read Me ToolTip on the Backup & Restore Page for more detailed information.<br><br>');
	if (file_exists($old_backwpadmin)) { 	
		copy($old_backwpadmin, $new_backwpadmin);
		if (!copy($old_backwpadmin, $new_backwpadmin)) {
	_e('<font color="red"><strong>Failed to Backup Your wp-admin .htaccess File! This is most likely because you DO NOT currently have an active wp-admin .htaccess file.</strong></font><br>');
	} else {
	_e('<font color="green"><strong>Your currently active wp-admin .htaccess file has been backed up successfully!</strong></font><br>');
	}
	}
	}
	}
	}
}

// Form - Restore backed up htaccess files
$restore_htaccess = 'unchecked';
$old_restoreroot = ABSPATH . '/wp-content/bps-backup/root.htaccess';
$new_restoreroot = ABSPATH . '/.htaccess';
$old_restorewpadmin = ABSPATH . '/wp-content/bps-backup/wpadmin.htaccess';
$new_restorewpadmin = ABSPATH . '/wp-admin/.htaccess';

if (isset($_POST['submit10']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_restore_active_htaccess_files' );
	$selected_radio = $_POST['selection10'];
	if ($selected_radio == 'restore_htaccess') {
		$restore_htaccess = 'checked';
	if (file_exists($old_restoreroot)) { 
 		copy($old_restoreroot, $new_restoreroot);
		if (!copy($old_restoreroot, $new_restoreroot)) {
	_e('<font color="red"><strong>Failed to Restore Your Root .htaccess File! This is most likely because you DO NOT currently have a Backed up Root .htaccess file.</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>Your Root .htaccess file has been Restored successfully!</strong></font><br>');
	if (file_exists($old_restorewpadmin)) { 	
		copy($old_restorewpadmin, $new_restorewpadmin);
		if (!copy($old_restorewpadmin, $new_restorewpadmin)) {
	_e('<font color="red"><strong>Failed to Restore Your wp-admin .htaccess File! This is most likely because you DO NOT currently have a Backed up wp-admin .htaccess file.</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>Your wp-admin .htaccess file has been Restored successfully!</strong></font><br>');
	}
	}
	}
	}
	}
}

// Form - Backup the BPS Master Files to /wp-content/bps-backup/master-backups
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

if (isset($_POST['submit11']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_backup_master_htaccess_files' );
	$selected_radio = $_POST['selection11'];
	if ($selected_radio == 'backup_master_htaccess_files') {
		$backup_master_htaccess_files = 'checked';
	if (file_exists($default_master)) { 
 		copy($default_master, $default_master_backup);
		if (!copy($default_master, $default_master_backup)) {
	_e('<font color="red"><strong>Failed to Backup Your default.htaccess File!</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>The default.htaccess file has been backed up successfully!</strong></font><br>');
	}
	if (file_exists($secure_master)) { 	
		copy($secure_master, $secure_master_backup);
		if (!copy($secure_master, $secure_master_backup)) {
	_e('<font color="red"><strong>Failed to Backup Your secure.htaccess File!</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>The secure.htaccess file has been backed up successfully!</strong></font><br>');
	}
	if (file_exists($wpadmin_master)) { 	
		copy($wpadmin_master, $wpadmin_master_backup);
		if (!copy($wpadmin_master, $wpadmin_master_backup)) {
	_e('<font color="red"><strong>Failed to Backup Your wpadmin-secure.htaccess File!</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>The wpadmin-secure.htaccess file has been backed up successfully!</strong></font><br>');
	}
	if (file_exists($maintenance_master)) { 	
		copy($maintenance_master, $maintenance_master_backup);
		if (!copy($maintenance_master, $maintenance_master_backup)) {
	_e('<font color="red"><strong>Failed to Backup Your maintenance.htaccess File!</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>The maintenance.htaccess file has been backed up successfully!</strong></font><br>');
	}
	if (file_exists($bp_maintenance_master)) { 	
		copy($bp_maintenance_master, $bp_maintenance_master_backup);
		if (!copy($bp_maintenance_master, $bp_maintenance_master_backup)) {
	_e('<font color="red"><strong>Failed to Backup Your bp-maintenance.php File!</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>The bp-maintenance.php file has been backed up successfully!</strong></font><br>');
	}
}}}}}}}

// Form copy and rename maintenance htaccess to root and copy bp-maintenance.php to root
$bpmaintenance = 'unchecked';
$oldmaint = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/maintenance.htaccess';
$newmaint = ABSPATH . '/.htaccess';
$oldmaint1 = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/bp-maintenance.php';
$newmaint1 = ABSPATH . '/bp-maintenance.php';

if (isset($_POST['submit15']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_maintenance_copy' );
	$selected_radio = $_POST['selection15'];
	if ($selected_radio == 'bpmaintenance') {
	$bpmaintenance = 'checked';
		copy($oldmaint, $newmaint);
		copy($oldmaint1, $newmaint1);
		if (!copy($oldmaint, $newmaint)) {
	_e('<font color="red"><strong>Failed to Activate Maintenance Mode! Your Website is NOT in Maintenance Mode!</strong></font><br>');
   	} else {
	_e('<font color="red"><strong>Warning: </strong></font>Maintenance Mode Is Activated. Your website is now displaying the Website Under Maintenance page to all visitors. To switch out of Maintenance mode activate BulletProof Security Mode. You can log in and out of your Dashboard / WordPress website in Maintenance Mode as long as you have added your IP address to the maintenance.htaccess file.');
	}
	}
}	

// Simple Secure old School PHP file upload
$tmp_file = $_FILES['bps_file_upload']['tmp_name'];
$folder_path = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/';
$bps_uploaded_file =  str_replace('//','/',$folder_path) . $_FILES['bps_file_upload']['name'];

if (isset($_POST['submit-bps-upload']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_upload' ); 
	if (!empty($_FILES)) {
	move_uploaded_file($tmp_file,$bps_uploaded_file);
		_e('<font color="green"><strong>File upload successful!</strong></font><br>');
		_e("$bps_uploaded_file");
	} else {
		_e('File upload error. File was not successfully uploaded.');
	}
}

// Enable File Downloading for Master Files - writes a new denyall htaccess file with the current IP address
$bps_get_IP = $_SERVER['REMOTE_ADDR'];
$denyall_htaccess_file = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/.htaccess';
$bps_denyall_content = "order deny,allow\ndeny from all\nallow from $bps_get_IP";
if (isset($_POST['bps-enable-download']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_enable_download' );
	if (is_writable($denyall_htaccess_file)) {
	if (!$handle = fopen($denyall_htaccess_file, 'w+b')) {
         _e('<font color="red"><strong>Cannot open file' . "$denyall_htaccess_file" . '</strong></font>');
         exit;
    }
    if (fwrite($handle, $bps_denyall_content) === FALSE) {
        _e('<font color="red"><strong>Cannot write to file' . "$denyall_htaccess_file" . '</strong></font>');
        exit;
    }
    _e('<font color="green"><strong>Success! File downloading is enabled for your IP address only ===' . "$bps_get_IP." .'</strong></font>');
    fclose($handle);
	} else {
    _e('<font color="red"><strong>The file' . "$denyall_htaccess_file" . ' is not writable</strong></font>');
	}
}

// Enable File Downloading for BPS Backup Folder - writes a new denyall htaccess file with the current IP address
$bps_get_IP2 = $_SERVER['REMOTE_ADDR'];
$denyall_htaccess_file_backup = ABSPATH . '/wp-content/bps-backup/.htaccess';
$bps_denyall_content_backup = "order deny,allow\ndeny from all\nallow from $bps_get_IP2";
if (isset($_POST['bps-enable-download-backup']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_enable_download-backup' );
	if (is_writable($denyall_htaccess_file_backup)) {
	if (!$handle = fopen($denyall_htaccess_file_backup, 'w+b')) {
         _e('<font color="red"><strong>Cannot open file' . "$denyall_htaccess_file_backup" . '</strong></font>');
         exit;
    }
    if (fwrite($handle, $bps_denyall_content_backup) === FALSE) {
        _e('<font color="red"><strong>Cannot write to file' . "$denyall_htaccess_file_backup" . '</strong></font>');
        exit;
    }
    _e('<font color="green"><strong>Success! File downloading for your Backed Up files is enabled for your IP address only ===' . "$bps_get_IP2." .'</strong></font>');
    fclose($handle);
	} else {
    _e('<font color="red"><strong>The file' . "$denyall_htaccess_file_backup" . ' is not writable</strong></font>');
	}
}

?>

</div>

<div id="message" class="updated" style="background: #A9F5A0; border:1px solid #addae6;">
<p><?php _e('<strong>Important! </strong><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#root-or-subfolder-wordpress-installation" target="_blank">Read Me First</a> before activating any BulletProof Security Modes'); ?></p></div>

<div class=wrap>
<?php $bulletproof_ver = '.46'; ?>
<?php screen_icon('options-general'); ?>
<h2><?php esc_html_e('BulletProof Security Settings', 'bulletproof-security'); ?></h2>
    
<!-- jQuery UI Tab Menu -->
<div id="bps-container">
	<div id="bps-tabs" class="bps-menu">
		<ul>
			<li><a href="#tabs-1">Security Modes</a></li>
			<li><a href="#tabs-2">Status</a></li>
			<li><a href="#tabs-3">System Info</a></li>
			<li><a href="#tabs-4">Backup &amp; Restore</a></li>
            <li><a href="#tabs-5">Upload/Download/Edit</a></li>
			<li><a href="#tabs-6">Maintenance Mode</a></li>
			<li><a href="#tabs-7">Help &amp; FAQ</a></li>
			<li><a href="#tabs-8">BPS Pro Modules</a></li>
		</ul>
            
<div id="tabs-1" class="tab-page">
<h2><?php _e('BulletProof Security Modes'); ?></h2>

<h3><?php _e('Activate Website Root Folder .htaccess Security Mode'); ?> <a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/" target="_blank"  onmouseover="Tip('Installing BPS does not activate any security modes. Perform a backup first before activating any BulletProof Security modes (backs up both currently active root and wp-admin htaccess files at the same time). I also recommend using the BPS File Downloader to backup your backed up files to your computer. Activating Default Mode or BulletProof Mode copies, renames and moves the master .htaccess files default.htaccess or secure.htaccess, depending on what radio button option you choose, from /plugins/bulletproof-security/admin/htaccess/ to your root folder. Default Mode does not have any security protection - it is just a generic htaccess file that you should only use for testing purposes.<br><br><strong>If you are installing BPS for the first time</strong> be sure to read the Important! Read Me First link in the green top area before activating any security modes.<br><br><strong>Info for people who are upgrading BPS</strong><br>Before upgrading BPS versions be sure to use Backup to make an online backup of your current htaccess files and for an additional backup you can use the BPS File Downloader to download any BPS files to your computer. The online backup will be available to you to restore from if you run into problems at any point. You should always be using the newest BPS htaccess files for the latest security protection updates and plugin conflict fixes. Before activating new BPS master files you can use the BPS File Editor to copy and paste any old existing htaccess from your current active htaccess files to the new BPS htaccess files and save your changes before activating the new BPS htaccess files.<br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></h3>

<form name="BulletProof-Root" action="options-general.php?page=bulletproof-security/admin/options.php" method="post">
<?php wp_nonce_field('bulletproof_security_root_copy'); ?>
<table class="form-table">
   <tr>
	<th><label><input name="selection12" type="radio" value="bpdefaultroot" class="tog" <?php checked('', $bpdefaultroot); ?> /><?php _e('Default Mode'); ?></label></th>
	<td class="url-path"><?php echo get_site_url(); ?>/.htaccess<br /><?php _e('<font color="green">Copies the file default.htaccess to your root folder and renames the file name to just .htaccess</font>'); ?></td>
   </tr>
   <tr>
	<th><label><input name="selection12" type="radio" value="bpsecureroot" class="tog" <?php checked('', $bpsecureroot); ?> /> <?php _e('BulletProof Mode'); ?></label></th>
	<td class="url-path"><?php echo get_site_url(); ?>/.htaccess<br /><?php _e('<font color="green">Copies the file secure.htaccess to your root folder and renames the file name to just .htaccess</font>'); ?></td>
   </tr>
</table>
<p class="submit">
<input type="submit" name="submit12" class="button-primary" value="<?php esc_attr_e('Activate') ?>" />
</p></form>

<h3><?php _e('Activate Website wp-admin Folder .htaccess Security Mode'); ?> <a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/" target="_blank"  onmouseover="Tip('Activating BulletProof Mode copies, renames and moves the master .htaccess file wpadmin-secure.htaccess from /plugins/bulletproof-security/admin/htaccess/ to your /wp-admin folder. If you customize or modify the master .htaccess files then be sure to make an online backup and also download backups of these master .htaccess files to your computer using the BPS File Downloader.<br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></h3>

<form name="BulletProof-WPadmin" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-1" method="post">
<?php wp_nonce_field('bulletproof_security_wpadmin_copy'); ?>
<table class="form-table">
   <tr>
	<th><label><input name="selection13" type="radio" value="bpsecurewpadmin" class="tog" <?php checked('', $bpsecurewpadmin); ?> /> <?php _e('BulletProof Mode'); ?></label></th>
	<td class="url-path"><?php echo get_site_url(); ?>/wp-admin/.htaccess<br /><?php _e('<font color="green"> Copies the file wpadmin-secure.htaccess to your /wp-admin folder and renames the file name to just .htaccess</font>'); ?></td>
   </tr>
</table>
<p class="submit"><input type="submit" name="submit13" class="button-primary" value="<?php esc_attr_e('Activate') ?>" />
</p></form>

<h3><?php _e('Activate Deny All htaccess Folder Protection For The BPS Master htaccess Folder'); ?> <a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/" target="_blank"  onmouseover="Tip('Activating BulletProof Mode for Deny All htaccess Folder Protection copies and renames the deny-all.htaccess file located in the /plugins/bulletproof-security/admin/htaccess/ folder and renames it to just .htaccess. The Deny All htaccess file blocks everyone, except for you, from accessing and viewing the BPS Master htaccess files.<br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></h3>

<form name="BulletProof-deny-all-htaccess" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-1" method="post">
<?php wp_nonce_field('bulletproof_security_denyall_master'); ?>
<table class="form-table">
   <tr>
	<th><label><input name="selection8" type="radio" value="bps_rename_htaccess_files" class="tog" <?php checked('', $bps_rename_htaccess_files); ?> /> <?php _e('BulletProof Mode'); ?></label></th>
	<td class="url-path"><?php echo get_site_url(); ?>/wp-content/plugins/bulletproof-security/admin/htaccess/<br /><?php _e('<font color="green"> Copies the file deny-all.htaccess to the BPS Master htaccess folder and renames the file name to just .htaccess</font>'); ?></td>
   </tr>
</table>
<p class="submit"><input type="submit" name="submit8" class="button-primary" value="<?php esc_attr_e('Activate') ?>" />
</p></form>

<h3><?php _e('Activate Deny All htaccess Folder Protection For The BPS Backup Folder'); ?> <a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/" target="_blank"  onmouseover="Tip('Activating BulletProof Mode for Deny All BPS Backup Folder Protection copies and renames the deny-all.htaccess file located in the /bulletproof-security/admin/htaccess/ folder to the BPS Backup folder /wp-content/bps-backup and renames it to just .htaccess. The Deny All htaccess file blocks everyone, except for you, from accessing and viewing your backed up htaccess files.<br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></h3>

<form name="BulletProof-deny-all-backup" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-1" method="post">
<?php wp_nonce_field('bulletproof_security_denyall_bpsbackup'); ?>
<table class="form-table">
   <tr>
	<th><label><input name="selection14" type="radio" value="bps_rename_htaccess_files_backup" class="tog" <?php checked('', $bps_rename_htaccess_files_backup); ?> /> <?php _e('BulletProof Mode'); ?></label></th>
	<td class="url-path"><?php echo get_site_url(); ?>/wp-content/bps-backup/<br /><?php _e('<font color="green"> Copies and the file deny-all.htaccess to the BPS Backup folder and renames the file name to just .htaccess</font>'); ?></td>
   </tr>
</table>
<p class="submit"><input type="submit" name="submit14" class="button-primary" value="<?php esc_attr_e('Activate') ?>" />
</p></form>
</div>
            
<div id="tabs-2" class="tab-page">
<h2><?php _e('BulletProof Security Status'); ?></h2>

<table width="100%" border="2" cellspacing="0" cellpadding="0" class="status_table">
  <tr>
    <td width="49%" class="table_title"><?php _e('Activated BulletProof Security .htaccess Files'); ?> <a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#bps-advanced-coding-modfications" target="_blank"  onmouseover="Tip('<strong>Info for people installing BPS for the first time</strong><br>If you are installing BPS for the first time</strong> be sure to read the Important! Read Me First link in the top green area before activating any security modes.<br><br><strong>Info for people who are upgrading BPS</strong><br>If you are upgrading BPS and activating a newer version of a BPS .htaccess files then be sure to make a backup first. Performing a backup will keep a copy of your current existing active .htaccess files that you can restore at any time if something goes wrong. Between upgrades you can use the built-in BPS File Editor to copy and paste any old .htaccess you want to add to the new BPS htaccess files. You should always be using the newest BPS htaccess files for the latest security protection updates and plugin conflict fixes.<br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong><br><br>The Text Strings you see listed in the Activated BulletProof Security Status window if you have an active BulletProof .htaccess file (or an existing .htaccess file) is reading and displaying the actual contents of any existing .htaccess files here. <strong>This is not just a displayed message - this is the actual first 45 string characters (text) of the contents of your .htaccess files.</strong><br><br>To change or modify the Text String that you see displayed here you would use the BPS built in Text Editor to change the actual text content of the BulletProof Security master .htaccess files. If the change the BULLETPROOF SECURITY title shown here then you must also change the coding contained in the /wp-content/plugins/bulletproof-security/includes/functions.php file to match your changes or you will get some error messages. The rest of the text content in the .htaccess files can be modified just like a normal post. Just this top line ot text in the .htaccess files contains version information that BPS checks to do verifications and other file checking. For detailed instructions on modifying what text is displayed here click this Read Me button link.', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 500, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></td>
    <td width="2%">&nbsp;</td>
    <td width="49%" class="table_title"><?php _e('Additional Website Security Measures'); ?></td>
  </tr>
  <tr>
    <td class="table_cell">&nbsp;</td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell">
<?php 
	echo root_htaccess_status();
	echo denyall_htaccess_status_master();
	echo denyall_htaccess_status_backup();
	echo wpadmin_htaccess_status();
?>
    <td>&nbsp;</td>
    <td class="table_cell">
<?php 
	echo bps_wpdb_errors_off();
	echo bps_wp_remove_version();
	echo check_admin_username();
	echo bps_filesmatch_check();
	echo check_bps_pro_mod();
?>
  </tr>
  <tr>
    <td class="table_cell">&nbsp;</td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
</table>

<table width="100%" border="1" cellspacing="0" cellpadding="0" class="perms_table">
  <tr>
    <td colspan="4" class="table_title"><?php _e('File and Folder Permissions'); ?> <a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/" target="_blank" onmouseover="Tip('Your current file and folder permissions are shown below with suggested file and folder permission settings that you should use for the best website security and functionality.<br><br>I recommend using FileZilla to change your file and folder permissions. FileZilla is a free FTP software that makes changing your file and folder permissions very simple and easy as well as many other very nice FTP features. With FileZilla you can right mouse click on your files or folders and set the permissions with a Numeric value like 755, 644, etc. Takes the confusion out of which attributes to check or uncheck.<br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></td>
    <td width="2%">&nbsp;</td>
    <td width="49%" class="table_title"><?php _e('General BulletProof Security File Checks'); ?> <a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/" target="_blank" onmouseover="Tip('This is a quick visual check to verify that you have active .htaccess files in your root and /wp-admin folders and that all the required BPS files are in your BulletProof Security plugin folder. The BulletProof Security .htaccess master files (default.htaccess, secure.htaccess, wpadmin-secure.htaccess, maintenance.htaccess and bp-maintenance.php) are located in this folder /wp-content/plugins/bulletproof-security/admin/htaccess/<br><br>For new installations and upgrades of BulletProof Security you will see red warning messages. This is completely normal. These warnings are there to remind you to perform backups if they have not been performed yet. Also you may see warning messages if files do not exist yet.<br><br>You can also download backups of any existing .htaccess files using the BPS File Downloader.<br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></td>
  </tr>
  <tr>
    <td width="16%" class="table_cell_perms_head_left">File Name -<br />
      Folder Name</td>
    <td width="13%" class="table_cell_perms_head_middle">File Path -<br />
      Folder Path</td>
    <td width="10%" class="table_cell_perms_head_middle">Suggested<br />
      Permissions</td>
    <td width="10%" class="table_cell_perms_head_right">Current<br />
      Permissions</td>
    <td>&nbsp;</td>
    <td rowspan="4" class="table_cell_file_checks">
<?php echo general_bps_file_checks(); ?>
   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="file_checks_bottom_table" style="margin-top:70px;">
      <tr>
        <td class="file_checks_bottom_table_cell">&nbsp;</td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td height="100%" colspan="4" class="table_cell_perms_blank">
	<?php  
	bps_check_perms("root folder","../","755");
	bps_check_perms("wp-includes/","../wp-includes","755");
	bps_check_perms(".htaccess","../.htaccess","644");
	bps_check_perms("wp-admin/.htaccess","../wp-admin/.htaccess","644");
	bps_check_perms("index.php","../index.php","644");
	bps_check_perms("wp-admin/index.php","../wp-admin/index.php","644");
	bps_check_perms("wp-admin/js/","../wp-admin/js/","755");
	bps_check_perms("wp-content/themes/","../wp-content/themes","755");
	bps_check_perms("wp-content/plugins/","../wp-content/plugins","755");
	bps_check_perms("wp-admin/","../wp-admin","755");
	bps_check_perms("wp-content/","../wp-content","755");
?></td>
    <td>&nbsp;</td>
    </tr>
 <tr>
    <td colspan="4">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="file_checks_bottom_table_special">
      <tr>
        <td class="file_checks_bottom_table_cell">&nbsp;</td>
      </tr>
    </table>
    </td>
    <td>&nbsp;</td>
    </tr>
</table>
</div>
            
<div id="tabs-3">
<h2><?php _e('System Information'); ?></h2>

<table width="100%" border="2" cellspacing="0" cellpadding="0" class="system_info_table">
  <tr>
    <td width="49%" class="table_title">Website / Server / IP Info</td>
    <td width="2%">&nbsp;</td>
    <td width="49%" class="table_title">SQL Database Info</td>
  </tr>
  <tr>
    <td class="table_cell">&nbsp;</td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('Website Root Folder'); ?>: <strong><?php echo get_site_url(); ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell"><?php _e('MySQL Database Version'); ?>: <?php $sqlversion = $wpdb->get_var("SELECT VERSION() AS version"); ?><strong><?php echo $sqlversion; ?></strong></td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('Document Root Path'); ?>: <strong><?php echo $_SERVER['DOCUMENT_ROOT']; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell"><?php _e('MySQL Client Version'); ?>: <strong><?php echo mysql_get_client_info(); ?></strong></td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('Server / Website IP Address'); ?>: <strong><?php echo $_SERVER['SERVER_ADDR']; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell"><?php _e('Database Host'); ?>: <strong><?php echo DB_HOST; ?></strong></td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('Your Computer IP Address'); ?>: <strong><?php echo $_SERVER['REMOTE_ADDR']; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell"><?php _e('Database Name'); ?>: <strong><?php echo DB_NAME; ?></strong></td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('Server Type'); ?>: <strong><?php echo $_SERVER['SERVER_SOFTWARE']; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell"><?php _e('Database User'); ?>: <strong><?php echo DB_USER; ?></strong></td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('Operating System'); ?>: <strong><?php echo PHP_OS; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell"><?php _e('SQL Mode'); ?>: <?php $mysqlinfo = $wpdb->get_results("SHOW VARIABLES LIKE 'sql_mode'");
	if (is_array($mysqlinfo)) $sql_mode = $mysqlinfo[0]->Value;
    if (empty($sql_mode)) $sql_mode = __('Not Set');
	else $sql_mode = __('Off'); ?><strong><?php echo $sql_mode; ?></strong></td>
  </tr>
  <tr>
    <td class="table_cell"><?php echo bps_multsite_check(); ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('Browser Compression Supported'); ?> : <strong><?php echo $_SERVER['HTTP_ACCEPT_ENCODING']; ?></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php echo bps_check_permalinks(); ?></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
   <tr>
    <td class="table_cell"><?php echo bps_check_php_version (); ?></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
   <tr>
    <td class="table_cell">&nbsp;</td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_title">PHP Info</td>
    <td>&nbsp;</td>
    <td class="table_title">BPS Pro Info</td>
  </tr>
  <tr>
    <td class="table_cell">&nbsp;</td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('PHP Version'); ?>: <strong><?php echo PHP_VERSION; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">BPS Pro Modules are not installed</td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('PHP Memory Usage'); ?>: <strong><?php echo round(memory_get_usage() / 1024 / 1024, 2) . __(' MB'); ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('PHP Memory Limit'); ?>: <?php if(ini_get('memory_limit')) $memory_limit = ini_get('memory_limit');
        else $memory_limit = __('N/A'); ?><strong><?php echo $memory_limit; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('PHP Max Upload Size'); ?>: <?php if(ini_get('upload_max_filesize')) $upload_max = ini_get('upload_max_filesize');
        else $upload_max = __('N/A'); ?><strong><?php echo $upload_max; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('PHP Max Post Size'); ?>: <?php if(ini_get('post_max_size')) $post_max = ini_get('post_max_size');
        else $post_max = __('N/A'); ?><strong><?php echo $post_max; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('PHP Safe Mode'); ?>: <?php if(ini_get('safe_mode')) $safe_mode = __('On');
        else $safe_mode = __('Off'); ?><strong><?php echo $safe_mode; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('PHP Allow URL fopen'); ?>: <?php if(ini_get('allow_url_fopen')) $allow_url_fopen = __('On');
        else $allow_url_fopen = __('Off'); ?><strong><?php echo $allow_url_fopen; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
   <tr>
    <td class="table_cell"><?php _e('PHP Allow URL Include'); ?>: <?php if(ini_get('allow_url_include')) $allow_url_include = __('On');
        else $allow_url_include = __('Off'); ?><strong><?php echo $allow_url_include; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('PHP Display Errors'); ?>: <?php if(ini_get('display_errors')) $display_errors = __('On');
        else $display_errors = __('Off'); ?><strong><?php echo $display_errors; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('PHP Display Startup Errors'); ?>: <?php if(ini_get('display_startup_errors')) $display_startup_errors = __('On');
        else $display_startup_errors = __('Off'); ?><strong><?php echo $display_startup_errors; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
   <tr>
    <td class="table_cell"><?php _e('PHP Expose PHP'); ?>: <?php if(ini_get('expose_php')) $expose_php = __('On');
        else $expose_php = __('Off'); ?><strong><?php echo $expose_php; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('PHP Register Globals'); ?>: <?php if(ini_get('register_globals')) $register_globals = __('On');
        else $register_globals = __('Off'); ?><strong><?php echo $register_globals; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('PHP Max Script Execution Time'); ?>: <?php if(ini_get('max_execution_time')) $max_execute = ini_get('max_execution_time');
        else $max_execute = __('N/A'); ?><strong><?php echo $max_execute; ?> Seconds</strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('PHP Magic Quotes GPC'); ?>: <?php if(ini_get('magic_quotes_gpc')) $magic_quotes_gpc = __('On');
        else $magic_quotes_gpc = __('Off'); ?><strong><?php echo $magic_quotes_gpc; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('PHP open_basedir'); ?>: <?php if(ini_get('open_basedir')) $open_basedir = __('On');
        else $open_basedir = __('Off'); ?><strong><?php echo $open_basedir; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('PHP XML Support'); ?>: <?php if (is_callable('xml_parser_create')) $xml = __('Yes');
        else $xml = __('No'); ?><strong><?php echo $xml; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('PHP IPTC Support'); ?>: <?php if (is_callable('iptcparse')) $iptc = __('Yes');
        else $iptc = __('No'); ?><strong><?php echo $iptc; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php _e('PHP Exif Support'); ?>: <?php if (is_callable('exif_read_data')) $exif = __('Yes'). " ( V" . substr(phpversion('exif'),0,4) . ")" ;
        else $exif = __('No'); ?><strong><?php echo $exif; ?></strong></td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell">&nbsp;</td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell_bottom">&nbsp;</td>
    <td>&nbsp;</td>
    <td class="table_cell_bottom">&nbsp;</td>
  </tr>
</table>
</div>
            
<div id="tabs-4" class="tab-page">
<h2><?php _e('BulletProof Security Backup &amp; Restore'); ?></h2>
<form name="BulletProof-Backup" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-4" method="post">

<?php wp_nonce_field('bulletproof_security_backup_active_htaccess_files'); ?>
<h3><?php _e('Backup Your Currently Active .htaccess Files'); ?></h3>
<h3><?php _e('<font color="red"><strong>CAUTION: </strong></font>'); ?><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#bps-backup-restore" target="_blank" onmouseover="Tip('Back up your existing .htaccess files first before activating any BulletProof Security Modes in case of a problem when you first install and activate any BulletProof Security Modes. Once you have backed up your original existing .htaccess files you will see the status listed in the <strong>Current Backed Up .htaccess Files Status</strong> window below. <br><br><strong>Backup files are stored in this folder /wp-content/bps-backup.</strong><br><br>In cases where you install a plugin that writes to your htaccess files you will want to perform another backup of your htaccess files. Each time you perform a backup you are overwriting older backed up htaccess files. Backed up files are stored in the /wp-content/bps-folder.<br><br>You could also use the BPS File Downloader to download any existing .htaccess files, customized .htaccess files or other BPS files that you have personally customized or modified just for an additional local backup.<br><br><strong>The BPS Master .htaccess files are stored in your /plugins/bulletproof-security/admin/htaccess folder and can also be backed up to the /wp-content/bps-backup/master-backups folder. This way they will be available to you online after upgrading to a newer version of BPS if you run into a problem. There is no Restore feature for the BPS Master files because you should be using the latest versions of the BPS master .htaccess files after you upgrade BPS. You can manually download the files from this folder /wp-content/bps-backup/master-backups using FTP or your web host file downloader.</strong><br><br>When upgrading BPS to a new version you can use the built-in BPS File Editor to copy and paste any old htaccess code from your current activated htaccess files to the new BPS htaccess files. There are several different methods you could use between upgrades to update your BPS .htaccess files - the main idea is to have working copies of your htaccess files so that you can just copy and paste using the BPS File Editor. You should always be using the newest BPS .htaccess files for the latest security protection and plugin fixes. Also if something goes wrong in the .htaccess file editing process you can just use the restore working .htaccess files with one click.<br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 550, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()"><strong>Read Me</strong></a></h3>

<table class="form-table">
   <tr>
	<th><label><input name="selection9" type="radio" value="backup_htaccess" class="tog" <?php echo checked('', $backup_htaccess); ?> />
<?php _e('Backup .htaccess Files'); ?></label></th>
	<td><?php _e('<font color="green"><strong>Backs up your currently active .htaccess files in your root and /wp-admin folders.</strong></font><br><strong>Backup your htaccess files for first time installations of BPS or whenever new modifications have been made to your htaccess files. Read the <font color="red"><strong>CAUTION: </strong></font>Read Me ToolTip.</strong>'); ?></td>
	<td>
    </td>
   </tr>
</table>
<p class="submit">
<input type="submit" name="submit9" class="button-primary" value="<?php esc_attr_e('Backup Files') ?>" />
</p></form>

<form name="BulletProof-Restore" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-4" method="post">
<?php wp_nonce_field('bulletproof_security_restore_active_htaccess_files'); ?>
<h3><?php _e('Restore Your .htaccess Files From Backup'); ?><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#bps-backup-restore" target="_blank" onmouseover="Tip('Restores your backed up .htaccess files that you backed up. Your backed up .htaccess files were renamed to root.htaccess and wpadmin.htaccess and copied to the /wp-content/bps-backup folder. Restoring your backed up .htaccess files will rename them back to .htaccess and copy them back to your root and /wp-admin folders respectively.<br><br><strong>If you did not have any original .htaccess files to begin with and / or you did not back up any files then you will not have any backed up .htaccess files.</strong><br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 550, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()"><strong>Read Me</strong></a></h3>

<table class="form-table">
   <tr>
	<th><label><input name="selection10" type="radio" value="restore_htaccess" class="tog" <?php checked('', $restore_htaccess); ?> />
<?php _e('Restore .htaccess Files'); ?></label></th>
	<td><?php _e('<font color="green"><strong>Restores your backed up .htaccess files to your root and /wp-admin folders.</strong></font><br><strong>Restore your backed up .htaccess files if you have any problems or for use between BPS ugrades.</strong>'); ?></td>
	<td>
    </td>
   </tr>
</table>
<p class="submit">
<input type="submit" name="submit10" class="button-primary" value="<?php esc_attr_e('Restore Files') ?>" />
</p></form>

<form name="BPS-Master-Htaccess-Backup" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-4" method="post">
<?php wp_nonce_field('bulletproof_security_backup_master_htaccess_files'); ?>
<h3><?php _e('Backup Your BPS Master .htaccess Files'); ?><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#bps-backup-restore" target="_blank" onmouseover="Tip('The BPS Master .htaccess files are stored in your /plugins/bulletproof-security/admin/htaccess folder and can also be backed up using this Master Backup feature. The backed up BPS Master .htaccess files are copied to this folder /wp-content/bps-backup/master-backups folder. This way they will be available to you online after upgrading to a newer version of BPS. There is no Restore feature for the BPS Master files because you should be using the latest versions of the BPS master .htaccess files after you upgrade BPS. You can manually download the files from this folder /wp-content/bps-backup/master-backups using FTP or your web host file downloader.<br><br><strong>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()"><strong>Read Me</strong></a></h3>

<table class="form-table">
   <tr>
	<th><label><input name="selection11" type="radio" value="backup_master_htaccess_files" class="tog" <?php checked('', $backup_master_htaccess_files); ?> />
<?php _e('Backup BPS Master .htaccess Files'); ?></label></th>
	<td><?php _e('<font color="green"><strong>Backs up your BPS Master .htaccess files to the /wp-content/bps-backup/master-backups folder.</strong></font><br><strong>There is no Restore feature for the BPS Master .htaccess files because you should be using the latest most current BPS Master .htaccess security coding and plugin fixes included in the most current version of the BPS master .htacess files.</strong>'); ?></td>
	<td>
    </td>
   </tr>
</table>
<p class="submit">
<input type="submit" name="submit11" class="button-primary" value="<?php esc_attr_e('Backup Master Files') ?>" />
</p></form>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="backup_restore_table">
  <tr>
    <td class="table_title"><?php _e('Current Backed Up .htaccess Files Status'); ?> <a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#bps-backup-restore" target="_blank" onmouseover="Tip('Help info has been moved to the <strong>BulletProof Security Guide.</strong><br><br>If you see error messages here and / or would like to see more specific info on BulletProof Security then click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></td>
  </tr>
  <tr>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><strong><?php general_bps_file_checks_backup_restore(); ?></strong></td>
  </tr>
  <tr>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php echo backup_restore_checks(); ?></td>
  </tr>
  <tr>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell"><?php echo bps_master_file_backups(); ?></td>
  </tr>
  <tr>
    <td class="table_cell">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell_bottom">&nbsp;</td>
  </tr>
</table>
<br /><br /> 
</div>
        
<div id="tabs-5" class="tab-page">
<table width="100%" border="0">
  <tr>
    <td width="36%"><h2><?php _e('BulletProof Security File Editing'); ?></h2></td>
    <td width="18%"><h3><a href="http://www.ait-pro.com/aitpro-blog/2185/bulletproof-security-plugin-support/bulletproof-security-file-editing-editing-files-within-the-wordpress-dashboard/" target="_blank" onmouseover="Tip('<strong>WordPress will automatically write the correct RewriteBase and RewriteRule to <strong>Your Current Root htaccess File</strong> for you if you are using a Custom Permalink Structure. For more help info Go to the BPS Help & FAQ page and click on the WP Permalinks link.</strong><br><br>Click this Read Me button link to view the BPS File Editing Help Page. The help and info page will load a new browser window and will not leave your WordPress Dashboard. The BPS File Editing Help page contains info on the File Editors full capabilities, limitations, best usages and error solutions.', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></h3></td>
    <td width="19%" align="right">
    <h3 style="margin-right:25px;"><a href="http://www.ait-pro.com/aitpro-blog/2190/bulletproof-security-plugin-support/bulletproof-security-file-uploading-and-file-downloading-uploading-and-downloading-files-within-the-wordpress-dashboard/" target="_blank" onmouseover="Tip('<strong>File Uploading</strong><br>The file upload location is preset to the /wp-content/plugins/bulletproof-security/admin/htaccess folder and the intended use is just for uploading the BPS Master files: secure.htaccess, default.htaccess, wpadmin-secure.htaccess, maintenance.htaccess and bp-maintenance.php from your computer to the BPS Master htaccess folder.<br><br><strong>File Downloading</strong><br><strong>Folder permissions must be set to a minimum of 705 for the /htaccess and /bps-backup folders in order to open and download files.</strong><br>Click the Enable Master File Downloading button to enable file downloading. This will write your current IP address to the deny all htaccess file and allow ONLY you access to the /plugins/bulletproof-security/admin/htaccess folder to open and download files. To open and download your Backed up files click the Enable Backed Up File Downloading button. After clicking the Enable File Downloading buttons you can click the download buttons below to open or download files. If your IP address changes which it will do frequently then click the Enable File Downloading buttons again to write a new IP address to the deny all htaccess files.<br><br><strong>Current Active Htaccess File Downloading</strong><br>You will need to add your current IP address to Your Current Root htaccess file in order to download active htaccess files. Click on the Your Current Root htaccess File tab menu in the BPS File Editor and scroll to the very bottom of that htaccess file. You will see Allow from 69.40.120.88. You need to add your current IP address in order to allow ONLY yourself access to your current active htaccess files. Your current IP address can be found under the System Info tab menu. Your Computer IP Address is the IP address you will add to the htaccess file.<br><br>For more detailed instructions click this Read Me button link. The File Downloading help and info page will load a new browser window and will not leave your WordPress Dashboard.', WIDTH, 600, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></h3>
    </td>
    <td width="27%" align="center"><h2><?php _e('Uploads - Downloads'); ?></h2></td>
  </tr>
</table>


<table width="100%" border="0">
  <tr>
    <td width="72%"><div id="bps_file_editor" class="bps_file_editor_update">
<?php
echo secure_htaccess_file_check();
echo default_htaccess_file_check();
echo maintenance_htaccess_file_check();
echo wpadmin_htaccess_file_check();
    
// Perform File Open and Write test first by appending a literal blank space
// or nothing at all to end of the htaccess files.
// If append write test is successful file is writable on submit
$secure_htaccess_file = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/secure.htaccess';
$write_test = "";
	if (is_writable($secure_htaccess_file)) {
    if (!$handle = fopen($secure_htaccess_file, 'a+b')) {
    exit;
    }
    if (fwrite($handle, $write_test) === FALSE) {
    exit;
    }
	_e('<font color="green"><strong>File Open and Write test successful! The secure.htaccess file is writable.</strong></font><br>');
	
	if (isset($_POST['submit1']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_save_settings_1' );
	$newcontent1 = stripslashes($_POST['newcontent1']);
	if ( is_writable($secure_htaccess_file) ) {
		$handle = fopen($secure_htaccess_file, 'w+b');
		fwrite($handle, $newcontent1);
	_e('<font color="green"><strong>Success! The secure.htaccess file has been updated.</strong></font><br>');	
    fclose($handle);
	}
	}
}
$default_htaccess_file = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/default.htaccess';
$write_test = "";
	if (is_writable($default_htaccess_file)) {
    if (!$handle = fopen($default_htaccess_file, 'a+b')) {
    exit;
    }
    if (fwrite($handle, $write_test) === FALSE) {
    exit;
    }
	_e('<font color="green"><strong>File Open and Write test successful! The default.htaccess file is writable.</strong></font><br>');
	
	if (isset($_POST['submit2']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_save_settings_2' );
	$newcontent2 = stripslashes($_POST['newcontent2']);
	if ( is_writable($default_htaccess_file) ) {
		$handle = fopen($default_htaccess_file, 'w+b');
		fwrite($handle, $newcontent2);
	_e('<font color="green"><strong>Success! The default.htaccess file has been updated.</strong></font><br>');	
    fclose($handle);
	}
	}
}
$maintenance_htaccess_file = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/maintenance.htaccess';
$write_test = "";
	if (is_writable($maintenance_htaccess_file)) {
    if (!$handle = fopen($maintenance_htaccess_file, 'a+b')) {
    exit;
    }
    if (fwrite($handle, $write_test) === FALSE) {
    exit;
    }
	_e('<font color="green"><strong>File Open and Write test successful! The maintenance.htaccess file is writable.</strong></font><br>');
	
	if (isset($_POST['submit3']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_save_settings_3' );
	$newcontent3 = stripslashes($_POST['newcontent3']);
	if ( is_writable($maintenance_htaccess_file) ) {
		$handle = fopen($maintenance_htaccess_file, 'w+b');
		fwrite($handle, $newcontent3);
	_e('<font color="green"><strong>Success! The maintenance.htaccess file has been updated.</strong></font><br>');	
    fclose($handle);
	}
	}
}
$wpadmin_htaccess_file = ABSPATH . '/wp-content/plugins/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess';
$write_test = "";
	if (is_writable($wpadmin_htaccess_file)) {
    if (!$handle = fopen($wpadmin_htaccess_file, 'a+b')) {
    exit;
    }
    if (fwrite($handle, $write_test) === FALSE) {
    exit;
    }
	_e('<font color="green"><strong>File Open and Write test successful! The wpadmin-secure.htaccess file is writable.</strong></font><br>');
	
	if (isset($_POST['submit4']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_save_settings_4' );
	$newcontent4 = stripslashes($_POST['newcontent4']);
	if ( is_writable($wpadmin_htaccess_file) ) {
		$handle = fopen($wpadmin_htaccess_file, 'w+b');
		fwrite($handle, $newcontent4);
	_e('<font color="green"><strong>Success! The wpadmin-secure.htaccess file has been updated.</strong></font><br>');	
    fclose($handle);
	}
	}
}
$root_htaccess_file = ABSPATH . '/.htaccess';
$write_test = "";
	if (is_writable($root_htaccess_file)) {
    if (!$handle = fopen($root_htaccess_file, 'a+b')) {
    exit;
    }
    if (fwrite($handle, $write_test) === FALSE) {
    exit;
    }
	_e('<font color="green"><strong>File Open and Write test successful! Your currently active root .htaccess file is writable.</strong></font><br>');
	
	if (isset($_POST['submit5']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_save_settings_5' );
	$newcontent5 = stripslashes($_POST['newcontent5']);
	if ( is_writable($root_htaccess_file) ) {
		$handle = fopen($root_htaccess_file, 'w+b');
		fwrite($handle, $newcontent5);
	_e('<font color="green"><strong>Success! Your currently active root .htaccess file has been updated.</strong></font><br>');	
    fclose($handle);
	}
	}
}

$current_wpadmin_htaccess_file = ABSPATH . '/wp-admin/.htaccess';
$write_test = "";
	if (is_writable($current_wpadmin_htaccess_file)) {
    if (!$handle = fopen($current_wpadmin_htaccess_file, 'a+b')) {
    exit;
    }
    if (fwrite($handle, $write_test) === FALSE) {
    exit;
    }
	_e('<font color="green"><strong>File Open and Write test successful! Your currently active wp-admin .htaccess file is writable.</strong></font><br>');
	
	if (isset($_POST['submit6']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_save_settings_6' );
	$newcontent6 = stripslashes($_POST['newcontent6']);
	if ( is_writable($current_wpadmin_htaccess_file) ) {
		$handle = fopen($current_wpadmin_htaccess_file, 'w+b');
		fwrite($handle, $newcontent6);
	_e('<font color="green"><strong>Success! Your currently active wp-admin .htaccess file has been updated.</strong></font><br>');	
    fclose($handle);
	}
	}
}
?>
</div>
</td>
    
    <td width="28%" align="center" valign="top">
   
    
	<?php _e("<div class=\"file_upload_title\"><strong>File Uploads<br></strong></div>"); ?>
	
	<form name="BPS-upload" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-5" method="post" enctype="multipart/form-data">
<?php wp_nonce_field('bulletproof_security_upload'); ?>
    <p class="submit"><input id="bps_file_upload" name="bps_file_upload" type="file" /><br /><br />
    
<input type="submit" name="submit-bps-upload" class="button-primary" value="<?php esc_attr_e('Upload File') ?>" />
</p></form>
 
</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    <!-- jQuery UI File Editor Tab Menu -->
<div id="bps-edittabs" class="edittabs-class">
		<ul>
			<li><a href="#edittabs-1">secure.htaccess</a></li>
			<li><a href="#edittabs-2">default.htaccess</a></li>
			<li><a href="#edittabs-3">maintenance.htaccess</a></li>
			<li><a href="#edittabs-4">wpadmin-secure.htaccess</a></li>
            <li><a href="#edittabs-5">Your Current Root htaccess File</a></li>
            <li><a href="#edittabs-6">Your Current wp-admin htaccess File</a></li>
        </ul>
       
<div id="edittabs-1" class="edittabs-page-class">
<form name="template1" id="template1" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-5" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings_1'); ?>
    <div>
    <textarea cols="100" rows="27" name="newcontent1" id="newcontent1" tabindex="1"><?php echo get_secure_htaccess(); ?></textarea>
	<input type="hidden" name="action" value="update" />
    <input type="hidden" name="filename" value="<?php echo esc_attr($secure_htaccess_file) ?>" />
	<input type="hidden" name="scrollto1" id="scrollto1" value="<?php echo $scrollto; ?>" />
    <p class="submit">
	<input type="submit" name="submit1" class="button-primary" value="<?php esc_attr_e('Update File') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#template1').submit(function(){ $('#scrollto1').val( $('#newcontent1').scrollTop() ); });
	$('#newcontent1').scrollTop( $('#scrollto1').val() ); 
});
/* ]]> */
</script>     
</div>

<div id="edittabs-2" class="edittabs-page-class">
<form name="template2" id="template2" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-5" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings_2'); ?>
	<div>
    <textarea cols="100" rows="27" name="newcontent2" id="newcontent2" tabindex="2"><?php echo get_default_htaccess(); ?></textarea>
	<input type="hidden" name="action" value="update" />
    <input type="hidden" name="filename" value="<?php echo esc_attr($default_htaccess_file) ?>" />
	<input type="hidden" name="scrollto2" id="scrollto2" value="<?php echo $scrollto; ?>" />
    <p class="submit">
	<input type="submit" name="submit2" class="button-primary" value="<?php esc_attr_e('Update File') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#template2').submit(function(){ $('#scrollto2').val( $('#newcontent2').scrollTop() ); });
	$('#newcontent2').scrollTop( $('#scrollto2').val() );
});
/* ]]> */
</script>     
</div>

<div id="edittabs-3" class="edittabs-page-class">
<form name="template3" id="template3" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-5" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings_3'); ?>
	<div>
    <textarea cols="100" rows="27" name="newcontent3" id="newcontent3" tabindex="3"><?php echo get_maintenance_htaccess(); ?></textarea>
	<input type="hidden" name="action" value="update" />
    <input type="hidden" name="filename" value="<?php echo esc_attr($maintenance_htaccess_file) ?>" />
	<input type="hidden" name="scrollto3" id="scrollto3" value="<?php echo $scrollto; ?>" />
    <p class="submit">
	<input type="submit" name="submit3" class="button-primary" value="<?php esc_attr_e('Update File') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#template3').submit(function(){ $('#scrollto3').val( $('#newcontent3').scrollTop() ); });
	$('#newcontent3').scrollTop( $('#scrollto3').val() );
});
/* ]]> */
</script>     
</div>

<div id="edittabs-4" class="edittabs-page-class">
<form name="template4" id="template4" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-5" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings_4'); ?>
	<div>
    <textarea cols="100" rows="27" name="newcontent4" id="newcontent4" tabindex="4"><?php echo get_wpadmin_htaccess(); ?></textarea>
	<input type="hidden" name="action" value="update" />
    <input type="hidden" name="filename" value="<?php echo esc_attr($wpadmin_htaccess_file) ?>" />
	<input type="hidden" name="scrollto4" id="scrollto4" value="<?php echo $scrollto; ?>" />
    <p class="submit">
	<input type="submit" name="submit4" class="button-primary" value="<?php esc_attr_e('Update File') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#template4').submit(function(){ $('#scrollto4').val( $('#newcontent4').scrollTop() ); });
	$('#newcontent4').scrollTop( $('#scrollto4').val() );
});
/* ]]> */
</script>     
</div>

<div id="edittabs-5" class="edittabs-page-class">
<form name="template5" id="template5" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-5" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings_5'); ?>
	<div>
    <textarea cols="100" rows="27" name="newcontent5" id="newcontent5" tabindex="5"><?php echo get_root_htaccess(); ?></textarea>
	<input type="hidden" name="action" value="update" />
    <input type="hidden" name="filename" value="<?php echo esc_attr($root_htaccess_file) ?>" />
	<input type="hidden" name="scrollto5" id="scrollto5" value="<?php echo $scrollto; ?>" />
    <p class="submit">
	<input type="submit" name="submit5" class="button-primary" value="<?php esc_attr_e('Update File') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#template5').submit(function(){ $('#scrollto5').val( $('#newcontent5').scrollTop() ); });
	$('#newcontent5').scrollTop( $('#scrollto5').val() );
});
/* ]]> */
</script>     
</div>

<div id="edittabs-6" class="edittabs-page-class">
<form name="template6" id="template6" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-5" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings_6'); ?>
	<div>
    <textarea cols="100" rows="27" name="newcontent6" id="newcontent6" tabindex="6"><?php echo get_current_wpadmin_htaccess_file(); ?></textarea>
	<input type="hidden" name="action" value="update" />
    <input type="hidden" name="filename" value="<?php echo esc_attr($current_wpadmin_htaccess_file) ?>" />
	<input type="hidden" name="scrollto6" id="scrollto6" value="<?php echo $scrollto; ?>" />
    <p class="submit">
	<input type="submit" name="submit6" class="button-primary" value="<?php esc_attr_e('Update File') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#template6').submit(function(){ $('#scrollto6').val( $('#newcontent6').scrollTop() ); });
	$('#newcontent6').scrollTop( $('#scrollto6').val() );
});
/* ]]> */
</script>     
</div>
</div>
</td>
    <td align="center" valign="top">
<?php _e("<div class=\"file_download_title\"><strong>File Downloads</strong></div>"); ?>

<form name="bps-enable-download" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-5" method="post">
<?php wp_nonce_field('bulletproof_security_enable_download'); ?>
<input type="hidden" name="filename" value="bps-enable-download-edit" />
<p class="submit">
<input type="submit" name="bps-enable-download" class="button-primary" value="<?php esc_attr_e('Enable Master File Downloading') ?>" /></p>
</form>

<?php _e("<p class=\"download_titles\">BPS Master Files</p>");
	
if (isset($_POST['bps-master-secure-download']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_download_secure' );	
	header("Content-Description: File Transfer");
	header("Content-type: application/force-download");
	header("Content-Disposition: attachment; filename=secure.htaccess");
	}
if (isset($_POST['bps-master-default-download']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_download_default' );	
	header("Content-Description: File Transfer");
	header("Content-type: application/force-download");
	header("Content-Disposition: attachment; filename=default.htaccess");
	}	
if (isset($_POST['bps-master-maintenance-download']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_download_maintenance' );	
	header("Content-Description: File Transfer");
	header("Content-type: application/force-download");
	header("Content-Disposition: attachment; filename=maintenance.htaccess");
	}
// pending - loads file instead of forcing download 
// if (isset($_POST['bps-master-bp-maintenance-download']) && current_user_can('manage_options')) {
//	check_admin_referer( 'bulletproof_security_download_bp-maintenance' );	
//	header("Content-Description: File Transfer");
//	header("Content-type: application/force-download");
//	header("Content-Disposition: attachment; filename=bp-maintenance.php");
//	}	
if (isset($_POST['bps-master-wpadmin-secure-download']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_download_wpadmin-secure' );	
	header("Content-Description: File Transfer");
	header("Content-type: application/force-download");
	header("Content-Disposition: attachment; filename=wpadmin-secure.htaccess");
	}
if (isset($_POST['bps-master-current-root-htaccess-download']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_download_current-root-htaccess' );	
	header("Content-Description: File Transfer");
	header("Content-type: application/force-download");
	header("Content-Disposition: attachment; filename=root.htaccess");
	}
if (isset($_POST['bps-master-current-wp-admin-htaccess-download']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_download_current-wp-admin-htaccess' );	
	header("Content-Description: File Transfer");
	header("Content-type: application/force-download");
	header("Content-Disposition: attachment; filename=wpadmin.htaccess");
	}	
if (isset($_POST['bps-master-root-backup-htaccess-download']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_download_root-backup-htaccess' );	
	header("Content-Description: File Transfer");
	header("Content-type: application/force-download");
	header("Content-Disposition: attachment; filename=root.htaccess_backup");
	}	
if (isset($_POST['bps-master-wpadmin-backup-htaccess-download']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_download_wpadmin-backup-htaccess' );	
	header("Content-Description: File Transfer");
	header("Content-type: application/force-download");
	header("Content-Disposition: attachment; filename=wpadmin.htaccess_backup");
	}	
?> 

<form name="bps-master-secure-download" action="<?php echo get_site_url() .'/wp-content/plugins/bulletproof-security/admin/htaccess/secure.htaccess'; ?>" method="post">
<?php wp_nonce_field('bulletproof_security_download_secure'); ?>
<input type="hidden" name="filename" value="bps-secure-download" />
<input type="submit" name="bps-master-secure-download" class="button-primary" value="<?php esc_attr_e('secure.htaccess') ?>" /></p>
</form>

<form name="bps-master-default-download" action="<?php echo get_site_url() .'/wp-content/plugins/bulletproof-security/admin/htaccess/default.htaccess'; ?>" method="post">
<?php wp_nonce_field('bulletproof_security_download_default'); ?>
<input type="hidden" name="filename" value="bps-default-download" />
<input type="submit" name="bps-master-default-download" class="button-primary" value="<?php esc_attr_e('default.htaccess') ?>" /></p>
</form>

<form name="bps-master-maintenance-download" action="<?php echo get_site_url() .'/wp-content/plugins/bulletproof-security/admin/htaccess/maintenance.htaccess'; ?>" method="post">
<?php wp_nonce_field('bulletproof_security_download_maintenance'); ?>
<input type="hidden" name="filename" value="bps-maintenance-download" />
<input type="submit" name="bps-master-maintenance-download" class="button-primary" value="<?php esc_attr_e('maintenance.htaccess') ?>" /></p>
</form>

<!-- pending - loads file instead of forcing download -->
<!-- <form name="bps-master-bp-maintenance-download" action="<?php echo get_site_url() .'/wp-content/plugins/bulletproof-security/admin/htaccess/bp-maintenance.php'; ?>" method="post">
<?php wp_nonce_field('bulletproof_security_download_bp-maintenance'); ?>
<input type="hidden" name="filename" value="bps-bp-maintenance-download" />
<input type="submit" name="bps-master-bp-maintenance-download" class="button-primary" value="<?php esc_attr_e('bp-maintenance.php') ?>" /></p>
</form> -->

<form name="bps-master-wpadmin-secure-download" action="<?php echo get_site_url() .'/wp-content/plugins/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess'; ?>" method="post">
<?php wp_nonce_field('bulletproof_security_download_wpadmin-secure'); ?>
<input type="hidden" name="filename" value="bps-wpadmin-secure-download" />
<input type="submit" name="bps-master-wpadmin-secure-download" class="button-primary" value="<?php esc_attr_e('wpadmin-secure.htaccess') ?>" /></p>
</form>
	
	<?php _e("<p class=\"download_titles\">Current Active htaccess Files</p>"); ?>
    
<form name="bps-master-current-root-htaccess-download" action="<?php echo get_site_url() .'/.htaccess'; ?>" method="post">
<?php wp_nonce_field('bulletproof_security_download_current-root-htaccess'); ?>
<input type="hidden" name="filename" value="bps-current-root-htaccess-download" />
<input type="submit" name="bps-master-current-root-htaccess-download" class="button-primary" value="<?php esc_attr_e('Current Root htaccess File') ?>" /></p>
</form>

<form name="bps-master-current-wp-admin-htaccess-download" action="<?php echo get_site_url() .'/wp-admin/.htaccess'; ?>" method="post">
<?php wp_nonce_field('bulletproof_security_download_current-wp-admin-htaccess'); ?>
<input type="hidden" name="filename" value="bps-current-wp-admin-htaccess-download" />
<input type="submit" name="bps-master-current-wp-admin-htaccess-download" class="button-primary" value="<?php esc_attr_e('Current wp-admin htaccess File') ?>" /></p>
</form>

	<?php _e("<p class=\"download_titles\">Backed Up htaccess Files</p>"); ?>
    
<form name="bps-master-root-backup-htaccess-download" action="<?php echo get_site_url() . '/wp-content/bps-backup/root.htaccess'; ?>" method="post">
<?php wp_nonce_field('bulletproof_security_download_root-backup-htaccess'); ?>
<input type="hidden" name="filename" value="bps-root-backup-htaccess-download" />
<input type="submit" name="bps-master-root-backup-htaccess-download" class="button-primary" value="<?php esc_attr_e('root.htaccess Backup File') ?>" /></p>
</form>

<form name="bps-master-wpadmin-backup-htaccess-download" action="<?php echo get_site_url() . '/wp-content/bps-backup/wpadmin.htaccess'; ?>" method="post">
<?php wp_nonce_field('bulletproof_security_download_wpadmin-backup-htaccess'); ?>
<input type="hidden" name="filename" value="bps-wpadmin-backup-htaccess-download" />
<input type="submit" name="bps-master-wpadmin-backup-htaccess-download" class="button-primary" value="<?php esc_attr_e('wpadmin.htaccess Backup File') ?>" /></p>
</form>

<form name="bps-enable-download-backup" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-5" method="post">
<?php wp_nonce_field('bulletproof_security_enable_download-backup'); ?>
<input type="hidden" name="filename" value="bps-enable-download-edit-backup" />
<p class="submit">
<input type="submit" name="bps-enable-download-backup" class="button-primary" value="<?php esc_attr_e('Enable Backed Up File Downloading') ?>" /></p>
</form>
    </td>
  </tr>
</table>
</div>

<div id="tabs-6" class="tab-page">
<h2><?php _e('BulletProof Security Maintenance Mode'); ?></h2>

<form name="BulletProof-Maintenance" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-6" method="post">
<?php wp_nonce_field('bulletproof_security_maintenance_copy'); ?>
<h3><?php _e('Activate Website Under Maintenance Mode'); ?></h3>
<h3><?php _e('<font color="red"><strong>CAUTION: </strong></font>'); ?> <a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#maintenance-mode-ip-instructions" target="_blank" onmouseover="Tip('<strong>To switch out of or exit Maintenance Mode just activate BulletProof Security Mode.</strong><br><br>When you activate Maintenance Mode your website will be put in HTTP 503 Service Temporarily Unavailable status and display a Website Under Maintenance page to visitors. You must add your public IP address to the BPS maintenance.htaccess master file FIRST before you activate Maintenance mode in order to view and access (Log In and Out) your website while everyone else sees the Website Under Maintenance page. Use the BPS File Editor to add your Public IP address to the maintenance.htaccess file. Be sure to click the Update File button to save your IP address changes to the maintenance.htaccess file and then activate Maintenance Mode. Your Public IP address is shown in the green box. Your Public IP address may change frequently so be sure to check that the IP address shown here matches the IP address contained in the maintenance.htaccess file before activating Maintenance Mode.<br><br><strong>Your current Public IP address is also displayed on the Website Under Maintenance page itself.</strong><br><br>Your SERPs (website or web page ranking) will not be affected by putting your website in Maintenance Mode for up to several days for existing websites (I have tested up to 30 days without a problem). As long as you add your IP Address to the maintenance.htaccess master file before activating Maintenance Mode you can work on your website as you normally would while everyone else sees your Website Under Maintenance page.<br><br>If you are unable to log back into your Dashboard or you are also seeing the Website Under Maintenance page then you will need to FTP to your website, download the .htaccess file in your root folder and add your correct current Public IP address. Your Public IP address is displayed on your Website Under Maintenance page. If this does not let you back into your website then the RewriteBase and RewriteRule for your website in your BPS master .htaccess files is not correct.<br><br>For more specific information and detailed instructions click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 600, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></h3>

<table class="form-table">
   <tr>
	<th><label><input name="selection15" type="radio" value="bpmaintenance" class="tog" <?php checked('', $bpmaintenance); ?> />
	<?php _e('Maintenance Mode'); ?></label></th>
	<td class="url-path"><?php _e('<font color="green">Copies the file maintenance.htaccess to your root folder and renames the file name to just .htaccess<br>The file bp-maintenance.php is also copied to your root folder. This is the actual "Website Under Maintenance" page. To switch out of or exit Maintenance Mode just activate BulletProof Security Mode.</font>'); ?></td>
	<td><?php _e("<tr><td class=\"public-ip\">" .$_SERVER['REMOTE_ADDR'] . "</td><td><strong>This is your CURRENT PUBLIC IP ADDRESS. If you plan on putting your website in website under maintenance mode, then this is your IP address that you will add to the maintenance.htacess master file. Read the <span style=\"color:red\">CAUTION:</span> Read Me ToolTip for more specific information.</strong></td></tr>"); ?></td>
   </tr>
</table>
<p class="submit">
<input type="submit" name="submit15" class="button-primary" value="<?php esc_attr_e('Activate') ?>" />
</p></form>
</div>

<div id="tabs-7">
<h2><?php _e('BulletProof Security Help &amp; FAQ'); ?></h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="help_faq_table">
  <tr>
    <td width="50%" class="table_title">&nbsp;</td>
    <td width="50%" class="table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/category/bulletproof-security-contributors/" target="_blank">Contributors Page</a></td>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#root-or-subfolder-wordpress-installation" target="_blank">Website Domain Root Help Info</a></td>
  </tr>
  <tr>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/331/bulletproof-security-plugin-support/bulletproof-security-donations-page/" target="_blank">Donations</a></td>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#bps-backup-restore" target="_blank">Backup & Restore Help Info</a></td>
  </tr>
  <tr>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/" target="_blank">BPS .46 Guide</a></td>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#maintenance-mode-ip-instructions" target="_blank">Maintenance Mode Help Info</a></td>
  </tr>
  <tr>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#bps-45-new-features" target="_blank">BPS .46 Features</a></td>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#bps-advanced-coding-modfications" target="_blank">BPS .46 Coding Modifications Help Info</a></td>
  </tr>
  <tr>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/319/bulletproof-security-plugin-support/bulletproof-security-comments-questions-problems-wishlist/" target="_blank">Post Questions and Comments for Assistance</a></td>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#modifying-htaccess-files" target="_blank">Modifying BPS .htaccess Files for WordPress Subfolders</a></td>
  </tr>
  <tr>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1183/bulletproof-security-plugin-support/bulletproof-security-plugin-bps-version-45-screenshots/" target="_blank">BPS .46 Screenshots</a></td>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/2185/bulletproof-security-plugin-support/bulletproof-security-file-editing-editing-files-within-the-wordpress-dashboard/" target="_blank">File Editing Within The Dashboard Help Info</a></td>
  </tr>
  <tr>
    <td width="50%" class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/2330/bulletproof-security-plugin-support/bps-future-features-that-will-be-included-in-future-releases-of-bps" target="_blank">BPS Future -  New Features in Future Releases</a></td>
    <td width="50%" class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/2190/bulletproof-security-plugin-support/bulletproof-security-file-uploading-and-file-downloading-uploading-and-downloading-files-within-the-wordpress-dashboard/" target="_blank">File Uploading &amp; Downloading Within The Dashboard Help Info</a></td>
  </tr>
  <tr>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/2252/bulletproof-security-plugin-support/checking-plugin-compatibility-with-bps-plugin-testing-to-do-list/" target="_blank">Plugin Compatibility Testing - Recent New Permanent Fixes</a></td>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/2304/wordpress-tips-tricks-fixes/permalinks-wordpress-custom-permalinks-wordpress-best-wordpress-permalinks-structure/" target="_blank">WP Permalinks - Custom Permalink Structure Help Info</a></td>
  </tr>
  <tr>
    <td class="table_cell_help">&nbsp;</td>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/2239/bulletproof-security-plugin-support/adding-a-custom-403-forbidden-page-htaccess-403-errordocument-directive-examples/" target="_blank">Adding a Custom 403 Forbidden Page For Your Website</a></td>
  </tr>
  <tr>
    <td class="table_cell_help">&nbsp;</td>
    <td class="table_cell_help">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell_bottom">&nbsp;</td>
    <td class="table_cell_bottom">&nbsp;</td>
  </tr>
</table>
</div>

<div id="tabs-8" class="tab-page">
<h2><?php _e('BulletProof Security Pro Modules'); ?></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps_pro_activation_table">
  <tr>
    <td width="50%" class="table_title">BulletProof Security Pro Activation</td>
    <td width="50%" class="table_title">BPS Pro Modules / Features</td>
  </tr>
  <tr>
    <td class="table_cell">
<form id="BPS-PRO-Activation-ID" name="BPS-PRO-Activation" class="bps_pro_activation_form" action="http://www.ait-pro.com/aitpro-blog/aitpro-posting-form/activation-key-verification/" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings'); ?>
      <label>
	<input name="bps_pro_activation" type="text" class="bps_pro_activate_text_field" id="bps_pro_activation-ID" style="background-color:#A9F5A0; border:2px; border-style:inset; margin-left:17px;" value="bps-0004319" size="22" /> Enter Your BPS Pro Activation Key</label>
    <input type="hidden" name="key_validator" value="check_key_ID" />
<p class="submit">
	<input type="submit" name="submit_activate" class="button-primary" value="<?php esc_attr_e('Activate BPS Pro') ?>" />
</p>
</form>
	</td>
    <td rowspan="2" valign="top" class="bps_pro_modules_info">
    <strong>Website Attack Alerts:</strong> Displayed Warnings &amp; Email  Notifications<br />
    <strong>Attack Method Detection:</strong> Logging &amp; Tracking<br />
    <strong>Blocked Threats:</strong> Displayed Warnings & Email Notifications<br />
    <strong>Website Hack Testing Utilities:</strong> Hack Self Tests<br />
    <strong>Vulnerability Scanner:</strong> Scan Your Website For Vulnerabilities<br />
    <strong>Malicious Code / Script Removal Utilities:</strong> A large number of people find BPS after their websites have already been hacked. BPS Pro is a complete website security solution: Prevention, Detection and Disaster Recovery if needed.<br />
    <br />
      </td>
  </tr>
  <tr>
    <td valign="top" class="table_cell_activation_details">Entering your Activation Key starts the installation process of Both BPS Pro<br />
      Modules and the additional BPS Pro features.</td>
  </tr>
  <tr>
    <td class="table_cell_bottom">&nbsp;</td>
    <td class="table_cell_bottom">&nbsp;</td>
  </tr>
</table>
</div>
        
<div id="AITpro-link">BulletProof Security Plugin by <a href="http://www.ait-pro.com/" target="_blank" title="AITpro Website Design">AITpro Website Design</a>
</div>
</div>
<!-- this script needs to be on the options.php page or will not register or enqueue correctly due to tt_aElt.0.style issue -->
<script type="text/javascript" src="<?php echo WP_PLUGIN_URL; ?>/bulletproof-security/admin/js/wz_tooltip.js"></script>
</div>