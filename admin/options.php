<?php
// Direct calls to this file are Forbidden when core files are not present
if (!function_exists ('add_action')) {
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
<?php if (isset($_POST['submit'])) { // Form Submit Notifications and Messages
	$selected_radio = $_POST['selection'];
	if ($selected_radio == 'bpsecureroot') {
	$bpsecureroot = 'checked';
	if (!copy($old1, $new1)) {
	_e('<font color="red"><strong>Failed to Activate BulletProof Security Root Folder Protection! Your Website is NOT protected with BulletProof Security!</strong></font><br>');
   	} else {
	_e('BulletProof Security Root Folder Protection <font color="green"><strong>Activated.</strong></font> Your website is Now protected with BulletProof Security.');
	}
	}
	if ($selected_radio == 'bpdefaultroot') {
	$bpdefaultroot = 'checked';
	if (!copy($old, $new)) {
	_e('<font color="red"><strong>Failed to Activate Default .htaccess Mode!</strong></font><br>');
   	} else {
	_e('<font color="red"><strong>Warning: Default .htaccess Mode Is Activated In Your Website Root Folder. Your Website Is Not Protected With BulletProof Security.</strong></font>');
	}
	}
	if ($selected_radio == 'bpsecurewpadmin') {
	$bpsecurewpadmin = 'checked';
	if (!copy($oldadmin1, $newadmin1)) {
	_e('<font color="red"><strong>Failed to Activate BulletProof Security wp-admin Folder Protection! Your wp-admin folder is NOT protected with BulletProof Security!</strong></font><br>');
   	} else {
	_e('BulletProof Security wp-admin Folder Protection <font color="green"><strong>Activated.</strong></font> Your wp-admin folder is Now protected with BulletProof Security.');
	}
	}
	if ($selected_radio == 'bps_rename_htaccess_files') {
	$bps_rename_htaccess_files = 'checked';
	if (!copy($bps_rename_htaccess, $bps_rename_htaccess_renamed)) {
	_e('<font color="red"><strong>Failed to Activate BulletProof Security Deny All Folder Protection! Your BPS Master htaccess folder is NOT Protected with Deny All htaccess folder protection!</strong></font><br>');
   	} else {
	_e('BulletProof Security Deny All Folder Protection <font color="green"><strong>Activated.</strong></font> Your BPS Master htaccess folder is Now Protected with Deny All htaccess folder protection.');
	}
	}
	if ($selected_radio == 'bps_rename_htaccess_files_backup') {
	$bps_rename_htaccess_files_backup = 'checked';
	if (!copy($bps_rename_htaccess_backup, $bps_rename_htaccess_backup_online)) {
	_e('<font color="red"><strong>Failed to Activate BulletProof Security Deny All Folder Protection! Your BPS /wp-content/bps-backup folder is NOT Protected with Deny All htaccess folder protection!</strong></font><br>');
   	} else {
	_e('BulletProof Security Deny All Folder Protection <font color="green"><strong>Activated.</strong></font> Your BPS /wp-content/bps-backup folder is Now Protected with Deny All htaccess folder protection.');
	}
	}
	if ($selected_radio == 'bpmaintenance') {
	$bpmaintenance = 'checked';
	if (!copy($oldmaint, $newmaint)) {
	_e('<font color="red"><strong>Failed to Activate Maintenance Mode! Your Website is NOT in Maintenance Mode!</strong></font><br>');
   	} else {
	_e('<font color="red"><strong>Warning: </strong></font>Maintenance Mode Is Activated. Your website is now displaying the Website Under Maintenance page to all visitors. To switch out of Maintenance mode activate BulletProof Security Mode. You can log in and out of your Dashboard / WordPress website in Maintenance Mode as long as you have added your IP address to the maintenance.htaccess file.');
	}
	}
	if ($selected_radio == 'backup_htaccess') {
	$backup_htaccess = 'checked';
	if (!copy($old_backroot, $new_backroot)) {
	_e('<font color="red"><strong>Failed to Backup Your Root .htaccess File! This is most likely because you DO NOT currently have an active Root .htaccess file.</strong></font><br><br>');
   	} else {
	_e('<font color="green"><strong>Your currently active Root .htaccess file has been backed up successfully!</strong></font><br>Use the Restore feature to restore your .htaccess files if you run into a problem at any time. If you make additional changes or install a plugin that writes to the htaccess files then back them up again. This will overwrite the currently backed up htaccess files. Please read the <font color="red"><strong>CAUTION:</strong></font> Read Me ToolTip on the Backup & Restore Page for more detailed information.<br><br>');
	}
	}
	if ($selected_radio == 'backup_htaccess') {
	$backup_htaccess = 'checked';
	if (!copy($old_backwpadmin, $new_backwpadmin)) {
	_e('<font color="red"><strong>Failed to Backup Your wp-admin .htaccess File! This is most likely because you DO NOT currently have an active wp-admin .htaccess file.</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>Your currently active wp-admin .htaccess file has been backed up successfully!</strong></font><br>');
	}
	}
	if ($selected_radio == 'restore_htaccess') {
	$restore_htaccess = 'checked';
	if (!copy($old_restoreroot, $new_restoreroot)) {
	_e('<font color="red"><strong>Failed to Restore Your Root .htaccess File! This is most likely because you DO NOT currently have a Backed up Root .htaccess file.</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>Your Root .htaccess file has been Restored successfully!</strong></font><br>');
	}
	}
	if ($selected_radio == 'restore_htaccess') {
	$restore_htaccess = 'checked';
	if (!copy($old_restorewpadmin, $new_restorewpadmin)) {
	_e('<font color="red"><strong>Failed to Restore Your wp-admin .htaccess File! This is most likely because you DO NOT currently have a Backed up wp-admin .htaccess file.</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>Your wp-admin .htaccess file has been Restored successfully!</strong></font><br>');
	}
	}
	if ($selected_radio == 'backup_master_htaccess_files') {
	$backup_master_htaccess_files = 'checked';
	if (!copy($default_master, $default_master_backup)) {
	_e('<font color="red"><strong>Failed to Backup Your default.htaccess File!</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>The default.htaccess file has been backed up successfully!</strong></font><br>');
	}
	if (!copy($secure_master, $secure_master_backup)) {
	_e('<font color="red"><strong>Failed to Backup Your secure.htaccess File!</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>The secure.htaccess file has been backed up successfully!</strong></font><br>');
	}
	if (!copy($wpadmin_master, $wpadmin_master_backup)) {
	_e('<font color="red"><strong>Failed to Backup Your wpadmin-secure.htaccess File!</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>The wpadmin-secure.htaccess file has been backed up successfully!</strong></font><br>');
	}
	if (!copy($maintenance_master, $maintenance_master_backup)) {
	_e('<font color="red"><strong>Failed to Backup Your maintenance.htaccess File!</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>The maintenance.htaccess file has been backed up successfully!</strong></font><br>');
	}
	if (!copy($bp_maintenance_master, $bp_maintenance_master_backup)) {
	_e('<font color="red"><strong>Failed to Backup Your bp-maintenance.php File!</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>The bp-maintenance.php file has been backed up successfully!</strong></font><br>');
	}
	}
}
if (isset($_POST['up-down-save-submit'])) {
	if (!copy($uploadify_php_save, $uploadify_php_save_renamed)) {
	_e('<font color="red"><strong>Failed to backup uploadify.php</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>uploadify.php settings saved successfully!</strong></font><br>');
	}
	if (!copy($download_php_save, $download_php_save_renamed)) {
	_e('<font color="red"><strong>Failed to backup download.php</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>download.php settings saved successfully!</strong></font><br>');
	}
	if (!copy($bps_security_js_save, $bps_security_js_save_renamed)) {
    _e('<font color="red"><strong>Failed to backup bulletproof-security-admin.js</strong></font><br>');
	} else {
	_e('<font color="green"><strong>bulletproof-security-admin.js settings saved successfully!</strong></font><br>');
	}
}
if (isset($_POST['up-down-restore-submit'])) {
	if (!copy($uploadify_php_restore, $uploadify_php_restore_renamed)) {
	_e('<font color="red"><strong>Failed to restore uploadify.php</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>uploadify.php settings restored successfully!</strong></font><br>');
	}
	if (!copy($download_php_restore, $download_php_restore_renamed)) {
	_e('<font color="red"><strong>Failed to restore download.php</strong></font><br>');
   	} else {
	_e('<font color="green"><strong>download.php settings restored successfully!</strong></font><br>');
	}
	if (!copy($bps_security_js_restore, $bps_security_js_restore_renamed)) {
    _e('<font color="red"><strong>Failed to restore bulletproof-security-admin.js</strong></font><br>');
	} else {
	_e('<font color="green"><strong>bulletproof-security-admin.js settings restored successfully!</strong></font><br>');
	}
}
?>
</div>

<div id="message" class="updated" style="background: #A9F5A0; border:1px solid #addae6;">
<p><?php _e('<strong>Important! </strong><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#root-or-subfolder-wordpress-installation" target="_blank">Read Me First</a> before activating any BulletProof Security Modes'); ?></p></div>

<div class=wrap>
<?php $bulletproof_ver = '.45.8'; ?>
<?php screen_icon('options-general'); ?>
<h2><?php esc_html_e('BulletProof Security Settings', 'bulletproof-security'); ?></h2>
    
<!-- jQuery UI Tab Menu -->
<div id="bps-container">
	<div id="tabs" class="bps-menu">
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
<?php settings_fields( 'bulletproof_security_save_settings' ); ?>
<table class="form-table">
   <tr>
	<th><label><input name="selection" type="radio" value="bpdefaultroot" class="tog" <?php checked('', $bpdefaultroot); ?> /><?php _e('Default Mode'); ?></label></th>
	<td class="url-path"><?php echo get_site_url(); ?>/.htaccess<br /><?php _e('<font color="green">Copies the file default.htaccess to your root folder and renames the file name to just .htaccess</font>'); ?></td>
   </tr>
   <tr>
	<th><label><input name="selection" type="radio" value="bpsecureroot" class="tog" <?php checked('', $bpsecureroot); ?> /> <?php _e('BulletProof Mode'); ?></label></th>
	<td class="url-path"><?php echo get_site_url(); ?>/.htaccess<br /><?php _e('<font color="green">Copies the file secure.htaccess to your root folder and renames the file name to just .htaccess</font>'); ?></td>
   </tr>
</table>
<p class="submit">
<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Activate') ?>" />
</p></form>

<h3><?php _e('Activate Website wp-admin Folder .htaccess Security Mode'); ?> <a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/" target="_blank"  onmouseover="Tip('Activating BulletProof Mode copies, renames and moves the master .htaccess file wpadmin-secure.htaccess from /plugins/bulletproof-security/admin/htaccess/ to your /wp-admin folder. If you customize or modify the master .htaccess files then be sure to make an online backup and also download backups of these master .htaccess files to your computer using the BPS File Downloader.<br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></h3>

<form name="BulletProof-WPadmin" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-1" method="post">
<?php settings_fields( 'bulletproof_security_save_settings' ); ?>
<table class="form-table">
   <tr>
	<th><label><input name="selection" type="radio" value="bpsecurewpadmin" class="tog" <?php checked('', $bpsecurewpadmin); ?> /> <?php _e('BulletProof Mode'); ?></label></th>
	<td class="url-path"><?php echo get_site_url(); ?>/wp-admin/.htaccess<br /><?php _e('<font color="green"> Copies the file wpadmin-secure.htaccess to your /wp-admin folder and renames the file name to just .htaccess</font>'); ?></td>
   </tr>
</table>
<p class="submit"><input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Activate') ?>" />
</p></form>

<h3><?php _e('Activate Deny All htaccess Folder Protection For The BPS Master htaccess Folder'); ?> <a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/" target="_blank"  onmouseover="Tip('Activating BulletProof Mode for Deny All htaccess Folder Protection copies and renames the deny-all.htaccess file located in the /plugins/bulletproof-security/admin/htaccess/ folder and renames it to just .htaccess. The Deny All htaccess file blocks everyone, except for you, from accessing and viewing the BPS Master htaccess files.<br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></h3>

<form name="BulletProof-deny-all-htaccess" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-1" method="post">
<?php settings_fields( 'bulletproof_security_save_settings' ); ?>
<table class="form-table">
   <tr>
	<th><label><input name="selection" type="radio" value="bps_rename_htaccess_files" class="tog" <?php checked('', $bps_rename_htaccess_files); ?> /> <?php _e('BulletProof Mode'); ?></label></th>
	<td class="url-path"><?php echo get_site_url(); ?>/wp-content/plugins/bulletproof-security/admin/htaccess/<br /><?php _e('<font color="green"> Copies the file deny-all.htaccess to the BPS Master htaccess folder and renames the file name to just .htaccess</font>'); ?></td>
   </tr>
</table>
<p class="submit"><input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Activate') ?>" />
</p></form>

<h3><?php _e('Activate Deny All htaccess Folder Protection For The BPS Backup Folder'); ?> <a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/" target="_blank"  onmouseover="Tip('Activating BulletProof Mode for Deny All BPS Backup Folder Protection copies and renames the deny-all.htaccess file located in the /bulletproof-security/admin/htaccess/ folder to the BPS Backup folder /wp-content/bps-backup and renames it to just .htaccess. The Deny All htaccess file blocks everyone, except for you, from accessing and viewing your backed up htaccess files.<br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></h3>

<form name="BulletProof-deny-all-backup" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-1" method="post">
<?php settings_fields( 'bulletproof_security_save_settings' ); ?>
<table class="form-table">
   <tr>
	<th><label><input name="selection" type="radio" value="bps_rename_htaccess_files_backup" class="tog" <?php checked('', $bps_rename_htaccess_files_backup); ?> /> <?php _e('BulletProof Mode'); ?></label></th>
	<td class="url-path"><?php echo get_site_url(); ?>/wp-content/bps-backup/<br /><?php _e('<font color="green"> Copies and the file deny-all.htaccess to the BPS Backup folder and renames the file name to just .htaccess</font>'); ?></td>
   </tr>
</table>
<p class="submit"><input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Activate') ?>" />
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
   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="file_checks_bottom_table" style="margin-top:35px;">
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
    <td class="table_cell"><?php _e('Browser Compression Supported'); ?> : <strong><?php echo $_SERVER['HTTP_ACCEPT_ENCODING']; ?></strong></td>
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
<?php settings_fields( 'bulletproof_security_save_settings' ); ?>
<h3><?php _e('Backup Your Currently Active .htaccess Files'); ?></h3>
<h3><?php _e('<font color="red"><strong>CAUTION: </strong></font>'); ?><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#bps-backup-restore" target="_blank" onmouseover="Tip('Back up your existing .htaccess files first before activating any BulletProof Security Modes in case of a problem when you first install and activate any BulletProof Security Modes. Once you have backed up your original existing .htaccess files you will see the status listed in the <strong>Current Backed Up .htaccess Files Status</strong> window below. <br><br><strong>Backup files are stored in this folder /wp-content/bps-backup.</strong><br><br>In cases where you install a plugin that writes to your htaccess files you will want to perform another backup of your htaccess files. Each time you perform a backup you are overwriting older backed up htaccess files. Backed up files are stored in the /wp-content/bps-folder.<br><br>You could also use the BPS File Downloader to download any existing .htaccess files, customized .htaccess files or other BPS files that you have personally customized or modified just for an additional local backup.<br><br><strong>The BPS Master .htaccess files are stored in your /plugins/bulletproof-security/admin/htaccess folder and can also be backed up to the /wp-content/bps-backup/master-backups folder. This way they will be available to you online after upgrading to a newer version of BPS if you run into a problem. There is no Restore feature for the BPS Master files because you should be using the latest versions of the BPS master .htaccess files after you upgrade BPS. You can manually download the files from this folder /wp-content/bps-backup/master-backups using FTP or your web host file downloader.</strong><br><br>When upgrading BPS to a new version you can use the built-in BPS File Editor to copy and paste any old htaccess code from your current activated htaccess files to the new BPS htaccess files. There are several different methods you could use between upgrades to update your BPS .htaccess files - the main idea is to have working copies of your htaccess files so that you can just copy and paste using the BPS File Editor. You should always be using the newest BPS .htaccess files for the latest security protection and plugin fixes. Also if something goes wrong in the .htaccess file editing process you can just use the restore working .htaccess files with one click.<br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 550, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()"><strong>Read Me</strong></a></h3>

<table class="form-table">
   <tr>
	<th><label><input name="selection" type="radio" value="backup_htaccess" class="tog" <?php checked('', $backup_htaccess); ?> />
<?php _e('Backup .htaccess Files'); ?></label></th>
	<td><?php _e('<font color="green"><strong>Backs up your currently active .htaccess files in your root and /wp-admin folders.</strong></font><br><strong>Backup your htaccess files for first time installations of BPS or whenever new modifications have been made to your htaccess files. Read the <font color="red"><strong>CAUTION: </strong></font>Read Me ToolTip.</strong>'); ?></td>
	<td>
    </td>
   </tr>
</table>
<p class="submit">
<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Backup Files') ?>" />
</p></form>

<form name="BulletProof-Restore" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-4" method="post">
<?php settings_fields( 'bulletproof_security_save_settings' ); ?>
<h3><?php _e('Restore Your .htaccess Files From Backup'); ?><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#bps-backup-restore" target="_blank" onmouseover="Tip('Restores your backed up .htaccess files that you backed up. Your backed up .htaccess files were renamed to root.htaccess and wpadmin.htaccess and copied to the /wp-content/bps-backup folder. Restoring your backed up .htaccess files will rename them back to .htaccess and copy them back to your root and /wp-admin folders respectively.<br><br><strong>If you did not have any original .htaccess files to begin with and / or you did not back up any files then you will not have any backed up .htaccess files.</strong><br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 550, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()"><strong>Read Me</strong></a></h3>

<table class="form-table">
   <tr>
	<th><label><input name="selection" type="radio" value="restore_htaccess" class="tog" <?php checked('', $restore_htaccess); ?> />
<?php _e('Restore .htaccess Files'); ?></label></th>
	<td><?php _e('<font color="green"><strong>Restores your backed up .htaccess files to your root and /wp-admin folders.</strong></font><br><strong>Restore your backed up .htaccess files if you have any problems or for use between BPS ugrades.</strong>'); ?></td>
	<td>
    </td>
   </tr>
</table>
<p class="submit">
<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Restore Files') ?>" />
</p></form>




<form name="BPS-Master-Htaccess-Backup" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-4" method="post">
<?php settings_fields( 'bulletproof_security_save_settings' ); ?>
<h3><?php _e('Backup Your BPS Master .htaccess Files'); ?><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#bps-backup-restore" target="_blank" onmouseover="Tip('The BPS Master .htaccess files are stored in your /plugins/bulletproof-security/admin/htaccess folder and can also be backed up using this Master Backup feature. The backed up BPS Master .htaccess files are copied to this folder /wp-content/bps-backup/master-backups folder. This way they will be available to you online after upgrading to a newer version of BPS. There is no Restore feature for the BPS Master files because you should be using the latest versions of the BPS master .htaccess files after you upgrade BPS. You can manually download the files from this folder /wp-content/bps-backup/master-backups using FTP or your web host file downloader.<br><br><strong>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()"><strong>Read Me</strong></a></h3>

<table class="form-table">
   <tr>
	<th><label><input name="selection" type="radio" value="backup_master_htaccess_files" class="tog" <?php checked('', $backup_master_htaccess_files); ?> />
<?php _e('Backup BPS Master .htaccess Files'); ?></label></th>
	<td><?php _e('<font color="green"><strong>Backs up your BPS Master .htaccess files to the /wp-content/bps-backup/master-backups folder.</strong></font><br><strong>There is no Restore feature for the BPS Master .htaccess files because you should be using the latest most current BPS Master .htaccess security coding and plugin fixes included in the most current version of the BPS master .htacess files.</strong>'); ?></td>
	<td>
    </td>
   </tr>
</table>
<p class="submit">
<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Backup Master Files') ?>" />
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
    <td width="37%"><h3><a href="http://www.ait-pro.com/aitpro-blog/2185/bulletproof-security-plugin-support/bulletproof-security-file-editing-editing-files-within-the-wordpress-dashboard/" target="_blank" onmouseover="Tip('<strong>WordPress will automatically write the correct RewriteBase and RewriteRule to <strong>Your Current Root htaccess File</strong> for you if you are using a Custom Permalink Structure. For more help info Go to the BPS Help & FAQ page and click on the WP Permalinks link.</strong><br><br>Click this Read Me button link to view the BPS File Editing Help Page. The help and info page will load a new browser window and will not leave your WordPress Dashboard. The BPS File Editing Help page contains info on the File Editors full capabilities, limitations, best usages and error solutions.', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></h3></td>
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
	
	if (isset($_POST['submit1'])) {
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
	if (isset($_POST['submit2'])) {
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
	
	if (isset($_POST['submit3'])) {
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
	if (isset($_POST['submit4'])) {
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
	if (isset($_POST['submit5'])) {
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
	if (isset($_POST['submit6'])) {
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
	<!-- Quick and Easy Premade Upload Solution Using Uploadify for the Free Version of BPS -->
	<p><input id="file_upload" name="file_upload" type="file" /></p>
    <h3><a href="http://www.ait-pro.com/aitpro-blog/2190/bulletproof-security-plugin-support/bulletproof-security-file-uploading-and-file-downloading-uploading-and-downloading-files-within-the-wordpress-dashboard/" target="_blank" onmouseover="Tip('<strong>Refresh your browser after you have completed the Upload setup before testing Uploading. The same applies for setting up Downloading.</strong><br><br><strong>File Upload and File Download is a one time setup</strong><br>Once you have set up both File Uploading and Downloading then click the Save button (bottom of the page) to save your setup settings. When you upgrade BPS you can then just click the Restore button (bottom of the page) to restore your File Upload and Download setup settings.<br><br><strong>If your WordPress installation is in your root folder then File Uploading will automatically work without any set up required.</strong><br><br><strong>File Uploading</strong><br>The file upload location is preset to the /wp-content/plugins/bulletproof-security/admin/htaccess folder and the intended use is just for uploading the BPS Master files: secure.htaccess, default.htaccess, wpadmin-secure.htaccess, maintenance.htaccess and bp-maintenance.php from your computer to the BPS Master htaccess folder. You could of course change that to something else.<br><br><strong>WordPress Subfolder Setup</strong><br>If your WordPress installation is in a subfolder then you will need to make a quick edit to add your WordPress subfolder name to the path for the file uploader to work for you. Click this Read Me button link to view the BPS File Uploading Help Page for setup instructions. The help and info page will load a new browser window and will not leave your WordPress Dashboard.<br><br><strong>Aliased Website Domain Setup</strong><br>An Aliased Website domain is a domain that is not the primary domain that your web hosting account was set up under. If you have several website domains under one web hosting account then you have aliased website domains. Click this Read Me button link to view the BPS File Uploading Help Page for setup instructions. The help and info page will load a new browser window and will not leave your WordPress Dashboard.<br><br><strong>File Downloading</strong><br>You can also open a file to view it if you choose Open instead of Save. File Downloading setup is the same for everyone and is required for everyone - if you want to be able to download files that is. Click the <strong>Set Up File Downloader</strong> link. This launches the regular WordPress Plugin Editor in a new browser window and opens the download.php file. At the very top of the download.php file add your website domain name and document root path. For more detailed instructions click this Read Me button link. The File Downloading help and info page will load a new browser window and will not leave your WordPress Dashboard.<br><br><strong>Remember to click the Save button to save your File Upload and Download settings after you have set both up. Use the Restore button to restore your setup when you upgrade BPS.', WIDTH, 600, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></h3>
   
<a href="<?php echo get_site_url() .'/wp-admin/plugin-editor.php?file=bulletproof-security/admin/js/bulletproof-security-admin.js&plugin=bulletproof-security/bulletproof-security.php'; ?>/" target="_blank" title="WordPress Subfolder Setup is ONLY necessary for people who have WordPress installed in a subfolder">WordPress Subfolder Setup</a><br />
<a href="<?php echo get_site_url() .'/wp-admin/plugin-editor.php?file=bulletproof-security/admin/uploadify/uploadify.php&plugin=bulletproof-security/admin/options.php'; ?>/" target="_blank" title="Aliased Website Domain Setup is ONLY necessary for people who have Aliased Website Domains">Aliased Website Domain Setup</a>
</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    <!-- jQuery UI File Editor Tab Menu -->
<div id="edittabs" class="edittabs-class">
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
    <?php settings_fields( 'bulletproof_security_save_settings' ); ?>
	<div><textarea cols="100" rows="27" name="newcontent1" id="newcontent1" tabindex="1"><?php echo get_secure_htaccess(); ?></textarea>
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
    <?php settings_fields( 'bulletproof_security_save_settings' ); ?>
	<div><textarea cols="100" rows="27" name="newcontent2" id="newcontent2" tabindex="2"><?php echo get_default_htaccess(); ?></textarea>
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
    <?php settings_fields( 'bulletproof_security_save_settings' ); ?>
	<div><textarea cols="100" rows="27" name="newcontent3" id="newcontent3" tabindex="3"><?php echo get_maintenance_htaccess(); ?></textarea>
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
    <?php settings_fields( 'bulletproof_security_save_settings' ); ?>
	<div><textarea cols="100" rows="27" name="newcontent4" id="newcontent4" tabindex="4"><?php echo get_wpadmin_htaccess(); ?></textarea>
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
    <?php settings_fields( 'bulletproof_security_save_settings' ); ?>
	<div><textarea cols="100" rows="27" name="newcontent5" id="newcontent5" tabindex="5"><?php echo get_root_htaccess(); ?></textarea>
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
    <?php settings_fields( 'bulletproof_security_save_settings' ); ?>
	<div><textarea cols="100" rows="27" name="newcontent6" id="newcontent6" tabindex="6"><?php echo get_current_wpadmin_htaccess_file(); ?></textarea>
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
<?php _e("<div class=\"file_download_title\"><strong>File Downloads</strong></div><br>"); ?>

<a href="<?php echo get_site_url() .'/wp-admin/plugin-editor.php?file=bulletproof-security/admin/download/download.php&plugin=bulletproof-security/admin/options.php'; ?>/" target="_blank" title="Read the Read Me hover tool tip above for set up instructions">Set Up File Downloader</a>

<?php 
	_e("<p>To download a file click on the name of the file below that you want to download.</p>");
    _e("<p class=\"download_titles\">BPS Master Files</p>");
?> 

<a href="<?php echo get_site_url() .'/wp-content/plugins/bulletproof-security/admin/download/download.php?f=plugins/bulletproof-security/admin/htaccess/secure.htaccess'; ?>/" title="BulletProof Root Folder htaccess File" class="download_links">secure.htaccess</a>

<a href="<?php echo get_site_url() .'/wp-content/plugins/bulletproof-security/admin/download/download.php?f=plugins/bulletproof-security/admin/htaccess/default.htaccess'; ?>/" title="Default Root Folder htaccess File" class="download_links">default.htaccess</a>

<a href="<?php echo get_site_url() .'/wp-content/plugins/bulletproof-security/admin/download/download.php?f=plugins/bulletproof-security/admin/htaccess/maintenance.htaccess'; ?>/" title="Maintenance Mode htaccess File" class="download_links">maintenance.htaccess</a>

<a href="<?php echo get_site_url() .'/wp-content/plugins/bulletproof-security/admin/download/download.php?f=plugins/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess'; ?>/" title="BulletProof wp-admin Folder htaccess File" class="download_links">wpadmin-secure.htaccess</a>

<a href="<?php echo get_site_url() .'/wp-content/plugins/bulletproof-security/admin/download/download.php?f=plugins/bulletproof-security/admin/htaccess/bp-maintenance.php'; ?>/" title="Website Under Maintenance Page" class="download_links">bp-maintenance.php</a>

<?php _e("<p class=\"download_titles\">Backed Up htaccess Files</p>"); ?>

<a href="<?php echo get_site_url() .'/wp-content/plugins/bulletproof-security/admin/download/download.php?f=bps-backup/root.htaccess'; ?>/" title="Backed Up Root htaccess File" class="download_links">root.htaccess</a>

<a href="<?php echo get_site_url() .'/wp-content/plugins/bulletproof-security/admin/download/download.php?f=bps-backup/wpadmin.htaccess'; ?>/" title="Backed Up wp-admin htaccess File" class="download_links">wpadmin.htaccess</a>

<table width="100%" border="0">
  <tr>
    <td>
    <form name="bps-save-up-down-settings" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-5" method="post">
<?php settings_fields( 'bulletproof_security_save_settings' ); ?>
	<input type="hidden" name="bps-action" value="bps-update" />
<p class="submit"><input type="submit" name="up-down-save-submit" class="button-primary" value="<?php esc_attr_e('Save Settings') ?>" />
</p>
</form>
</td>
    <td>
    <form name="bps-restore-up-down-settings" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-5" method="post">
<?php settings_fields( 'bulletproof_security_save_settings' ); ?>
	<input type="hidden" name="bps-action" value="bps-update" />
<p class="submit"><input type="submit" name="up-down-restore-submit" class="button-primary" value="<?php esc_attr_e('Restore Settings') ?>" />
</p>
</form>
</td>
  </tr>
</table>
    </td>
  </tr>
</table>
</div>

<div id="tabs-6" class="tab-page">
<h2><?php _e('BulletProof Security Maintenance Mode'); ?></h2>

<form name="BulletProof-Maintenance" action="options-general.php?page=bulletproof-security/admin/options.php#tabs-6" method="post">
<?php settings_fields( 'bulletproof_security_save_settings' ); ?>
<h3><?php _e('Activate Website Under Maintenance Mode'); ?></h3>
<h3><?php _e('<font color="red"><strong>CAUTION: </strong></font>'); ?> <a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#maintenance-mode-ip-instructions" target="_blank" onmouseover="Tip('<strong>To switch out of or exit Maintenance Mode just activate BulletProof Security Mode.</strong><br><br>When you activate Maintenance Mode your website will be put in HTTP 503 Service Temporarily Unavailable status and display a Website Under Maintenance page to visitors. You must add your public IP address to the BPS maintenance.htaccess master file FIRST before you activate Maintenance mode in order to view and access (Log In and Out) your website while everyone else sees the Website Under Maintenance page. Use the BPS File Editor to add your Public IP address to the maintenance.htaccess file. Be sure to click the Update File button to save your IP address changes to the maintenance.htaccess file and then activate Maintenance Mode. Your Public IP address is shown in the green box. Your Public IP address may change frequently so be sure to check that the IP address shown here matches the IP address contained in the maintenance.htaccess file before activating Maintenance Mode.<br><br><strong>Your current Public IP address is also displayed on the Website Under Maintenance page itself.</strong><br><br>Your SERPs (website or web page ranking) will not be affected by putting your website in Maintenance Mode for up to several days for existing websites (I have tested up to 30 days without a problem). As long as you add your IP Address to the maintenance.htaccess master file before activating Maintenance Mode you can work on your website as you normally would while everyone else sees your Website Under Maintenance page.<br><br>If you are unable to log back into your Dashboard or you are also seeing the Website Under Maintenance page then you will need to FTP to your website, download the .htaccess file in your root folder and add your correct current Public IP address. Your Public IP address is displayed on your Website Under Maintenance page. If this does not let you back into your website then the RewriteBase and RewriteRule for your website in your BPS master .htaccess files is not correct.<br><br>For more specific information and detailed instructions click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 600, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></h3>

<table class="form-table">
   <tr>
	<th><label><input name="selection" type="radio" value="bpmaintenance" class="tog" <?php checked('', $bpmaintenance); ?> />
	<?php _e('Maintenance Mode'); ?></label></th>
	<td class="url-path"><?php _e('<font color="green">Copies the file maintenance.htaccess to your root folder and renames the file name to just .htaccess<br>The file bp-maintenance.php is also copied to your root folder. This is the actual "Website Under Maintenance" page. To switch out of or exit Maintenance Mode just activate BulletProof Security Mode.</font>'); ?></td>
	<td><?php _e("<tr><td class=\"public-ip\">" .$_SERVER['REMOTE_ADDR'] . "</td><td><strong>This is your CURRENT PUBLIC IP ADDRESS. If you plan on putting your website in website under maintenance mode, then this is your IP address that you will add to the maintenance.htacess master file. Read the <span style=\"color:red\">CAUTION:</span> Read Me ToolTip for more specific information.</strong></td></tr>"); ?></td>
   </tr>
</table>
<p class="submit">
<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Activate') ?>" />
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
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/" target="_blank">BPS .45.8 Guide</a></td>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#maintenance-mode-ip-instructions" target="_blank">Maintenance Mode Help Info</a></td>
  </tr>
  <tr>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#bps-45-new-features" target="_blank">BPS .45.8 Features</a></td>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#bps-advanced-coding-modfications" target="_blank">BPS .45.8 Coding Modifications Help Info</a></td>
  </tr>
  <tr>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/319/bulletproof-security-plugin-support/bulletproof-security-comments-questions-problems-wishlist/" target="_blank">Post Questions and Comments for Assistance</a></td>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#modifying-htaccess-files" target="_blank">Modifying BPS .htaccess Files for WordPress Subfolders</a></td>
  </tr>
  <tr>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1183/bulletproof-security-plugin-support/bulletproof-security-plugin-bps-version-45-screenshots/" target="_blank">BPS .45.8 Screenshots</a></td>
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
<form id="BPS-PRO-Activation-ID" name="BPS-PRO-Activation" class="bps_pro_activation_form" action="http://www.ait-pro.com/aitpro-blog/aitpro-posting-form/activation-key-verification/" method="post"><?php settings_fields( 'bulletproof_security_save_settings' ); ?>
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