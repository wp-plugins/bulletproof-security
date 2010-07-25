<?php

// BulletProof Security Menu
function bulletproof_security_admin_menu() {
bulletproof_security_add_menu_page(__('Options', 'bulletproof-security'), 'bulletproof-security/admin/options.php');
// Simplified Options page for BPS - BPS Pro uses submenu individual option pages
//bulletproof_security_add_submenu_page('bulletproof-security/admin/options.php', __('Security Modes', 'bulletproof-security'), 'bulletproof-security/admin/options-security.php');
//bulletproof_security_add_submenu_page('bulletproof-security/admin/options.php', __('Status', 'bulletproof-security'), 'bulletproof-security/admin/options-status.php');
//bulletproof_security_add_submenu_page('bulletproof-security/admin/options.php', __('System Info', 'bulletproof-security'), 'bulletproof-security/admin/options-system-info.php');
//bulletproof_security_add_submenu_page('bulletproof-security/admin/options.php', __('Backup and Restore', 'bulletproof-security'), 'bulletproof-security/admin/options-backup-restore.php');
//bulletproof_security_add_submenu_page('bulletproof-security/admin/options.php', __('Maintenance Mode', 'bulletproof-security'), 'bulletproof-security/admin/options-maintenance.php');
//bulletproof_security_add_submenu_page('bulletproof-security/admin/options.php', __('Help and FAQ', 'bulletproof-security'), 'bulletproof-security/admin/options-help-faq.php');
//bulletproof_security_add_submenu_page('bulletproof-security/admin/options.php', __('BPS Pro Modules', 'bulletproof-security'), 'bulletproof-security/admin/options-bps-pro-modules.php');

// Allow plugins to add to menu
do_action('bps_admin_menu');
}
?>

<div id="message" class="updated" style="border:1px solid #999999;">
<?php if (isset($_POST['submit'])) { // Form Submit Notifications and Messages
	$selected_radio = $_POST['selection'];
	if ($selected_radio == 'bpsecureroot') {
	$bpsecureroot = 'checked';
	_e('BulletProof Security Root Folder Protection Activated. Your Website Is Now Protected with BulletProof Security.');
	}
	if ($selected_radio == 'bpdefaultroot') {
	$bpdefaultroot = 'checked';
	_e('<font color="red"><strong>Warning: </strong></font>Default .htaccess Mode Is Activated In Your Website Root Folder. Your Website Is Not Protected With BulletProof Security.');
	}	
	if ($selected_radio == 'bpsecurewpadmin') {
	$bpsecurewpadmin = 'checked';
	_e('BulletProof Security wp-admin Folder Protection Activated. Your wp-admin Folder Is Now Protected with BulletProof Security.');	
	}
	if ($selected_radio == 'bpdefaultwpadmin') {
	$bpdefaultwpadmin = 'checked';
	_e('<font color="red"><strong>Warning: </strong></font>Default .htaccess Mode Is Activated In Your Website wp-admin Folder - Your wp-admin Folder Is Not Protected With BulletProof Security.');
	}
	if ($selected_radio == 'bpmaintenance') {
	$bpmaintenance = 'checked';
	_e('<font color="red"><strong>Warning: </strong></font>Maintenance Mode Is Activated. Your website is now displaying the Website Under Maintenance page to visitors. To exit or turn off Maintenance mode just activate either the Root Folder Default or BulletProof Security Mode. To check Maintenance Mode open ANOTHER browser window - DO NOT log out or close your WordPress Dashboard browser window. If you have not read the CAUTION: Read Me ToolTip on the Maintenance Mode page yet, then please read it now before doing anything else. The BPS Pro version does allow you to log in and out of your WordPress Dashboard while in Maintenance Mode.');	
	}
	if ($selected_radio == 'backup_htaccess') {
	$backup_htaccess = 'checked';
	_e('Your Orginal .htaccess files have been backed up successfully. <font color="red"><strong>Warning: </strong></font>This is a one time backup feature intended for new installations of BPS only. Please read the CAUTION: Read Me ToolTip on the Backup & Restore Page for more detailed information. The BPS Pro version has multiple backup and permanent backup capabilities.');
	}
	if ($selected_radio == 'restore_htaccess') {
	$restore_htaccess = 'checked';
	_e('Your Original .htaccess files have been restored successfully. <font color="red"><strong>Warning: </strong></font>This is a one time restore feature intended for new installations of BPS only. Please read the Read Me ToolTips on the Backup & Restore page for more detailed information. The BPS Pro version has additional permanent backup and restore capabilities.');
	}
}
?>
</div>

<div id="message" class="updated" style="background: #A9F5A0; border:1px solid #addae6;">
<p><?php _e('<strong>Important! </strong><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#root-or-subfolder-wordpress-installation" target="_blank">Read Me First</a> before activating any BulletProof Security Modes'); ?></p></div>

<div class=wrap>
<script type="text/javascript" src="<?php echo WP_PLUGIN_URL; ?>/bulletproof-security/admin/js/wz_tooltip.js"></script>
<?php $bulletproof_ver = '.45.1'; ?>
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
			<li><a href="#tabs-5">Maintenance Mode</a></li>
			<li><a href="#tabs-6">Help &amp; FAQ</a></li>
			<li><a href="#tabs-7">BPS Pro Modules</a></li>
		</ul>
            
<div id="tabs-1" class="tab-page">
<h2><?php _e('BulletProof Security Modes'); ?></h2>

<h3><?php _e('Activate Website Root Folder .htaccess Security Mode'); ?> <a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/" target="_blank"  onmouseover="Tip('Activating Default Mode or BulletProof Mode copies, renames and moves the master .htaccess files default.htaccess or secure.htaccess, depending on what radio button option you choose, from /plugins/bulletproof-security/admin/htaccess/ to your root folder. If you want to customize the master .htaccess files then be sure to also download backups of these master .htaccess files.<br><br>If you are activating a newer version of a BPS website root folder .htaccess file and have not made any customizations or modifications at any point to any of the .htaccess master files (like subfolder path modifications for example) for older versions of BPS then you do not need to do anything more and can go ahead and activate any modes that you want to right now. If you have made modifications or customizations to any of the .htaccess master files (like subfolder path modifications for example) to older versions of BPS .htaccess master files then be sure to make those same changes to the new BPS .htaccess master files before activating any security modes.<br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></h3>

<form name="BulletProof-Root" action="options-general.php?page=bulletproof-security/admin/options.php" method="post">
<?php settings_fields( 'bulletproof_security_save_settings' ); ?>
<table class="form-table">
   <tr>
	<th><label><input name="selection" type="radio" value="bpdefaultroot" class="tog" <?php checked('', $bpdefaultroot); ?> /><?php _e('Default Mode'); ?></label></th>
	<td class="url-path"><?php echo get_option('home'); ?>/.htaccess<br /><?php _e('<font color="green">Copies the file default.htaccess to your root folder and renames the file name to just .htaccess</font>'); ?></td>
   </tr>
   <tr>
	<th><label><input name="selection" type="radio" value="bpsecureroot" class="tog" <?php checked('', $bpsecureroot); ?> /> <?php _e('BulletProof Mode'); ?></label></th>
	<td class="url-path"><?php echo get_option('home'); ?>/.htaccess<br /><?php _e('<font color="green">Copies the file secure.htaccess to your root folder and renames the file name to just .htaccess</font>'); ?></td>
   </tr>
</table>
<p class="submit">
<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Activate') ?>" />
</p></form>

<h3><?php _e('Activate Website wp-admin Folder .htaccess Security Mode'); ?> <a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/" target="_blank" onmouseover="Tip('Activating Default Mode or BulletProof Mode copies, renames and moves the master .htaccess files default.htaccess or secure.htaccess, depending on what radio button option you choose, from /plugins/bulletproof-security/admin/htaccess/ to your /wp-admin folder. If you want to customize the master .htaccess files then be sure to also download backups of these master .htaccess files.<br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></h3>

<form name="BulletProof-WPadmin" action="options-general.php?page=bulletproof-security/admin/options.php" method="post">
<?php settings_fields( 'bulletproof_security_save_settings' ); ?>
<table class="form-table">
   <tr>
	<th><label><input name="selection" type="radio" value="bpdefaultwpadmin" class="tog" <?php checked('', $bpdefaultwpadmin); ?> /> <?php _e('Default Mode'); ?></label></th>
	<td class="url-path"><?php echo get_option('home'); ?>/wp-admin/.htaccess<br /><?php _e('<font color="green"> Copies the file default.htaccess to your /wp-admin folder and renames the file name to just .htaccess</font>'); ?></td>
   </tr>
   <tr>
	<th><label><input name="selection" type="radio" value="bpsecurewpadmin" class="tog" <?php checked('', $bpsecurewpadmin); ?> /> <?php _e('BulletProof Mode'); ?></label></th>
	<td class="url-path"><?php echo get_option('home'); ?>/wp-admin/.htaccess<br /><?php _e('<font color="green"> Copies the file secure.htaccess to your /wp-admin folder and renames the file name to just .htaccess</font>'); ?></td>
   </tr>
</table>
<p class="submit"><input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Activate') ?>" />
</p></form>
</div>
            
<div id="tabs-2" class="tab-page">
<h2><?php _e('BulletProof Security Status'); ?></h2>

<table width="100%" border="2" cellspacing="0" cellpadding="0" class="status_table">
  <tr>
    <td width="49%" class="table_title"><?php _e('Activated BulletProof Security .htaccess Files'); ?> <a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#bps-advanced-coding-modfications" target="_blank" onmouseover="Tip('The Text String you see listed below, if you have an active BulletProof .htaccess file (or an existing .htaccess file), is reading and displaying the actual contents of any existing .htaccess files here. <strong>This is not just a displayed message - this is the actual first 44 string characters (text) of the contents of your .htaccess files.</strong><br><br>To change or modify the Text String that you see displayed here you would change the actual text content of the BulletProof Security Master .htaccess files and also the coding contained in the /wp-content/plugins/bulletproof-security/includes/functions.php file. For detailed instructions on modifying what text is displayed here click this Read Me button link.', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></td>
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
<?php echo root_htaccess_status();
		echo wpadmin_htaccess_status();
?>
    <td>&nbsp;</td>
    <td class="table_cell">
<?php echo bps_wpdb_errors_off();
		echo bps_wp_remove_version();
		echo check_admin_username();
		echo check_bps_pro_mod();
?>
  </tr>
  <tr>
    <td class="table_cell">&nbsp;</td>
    <td>&nbsp;</td>
    <td class="table_cell">&nbsp;</td>
  </tr>
</table>

<div style="perms_table_div">
<table width="100%" border="1" cellspacing="0" cellpadding="0" class="perms_table">
  <tr>
    <td colspan="4" class="table_title"><?php _e('File and Folder Permissions'); ?> <a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/" target="_blank" onmouseover="Tip('Your current file and folder permissions are shown below with suggested file and folder permission settings that you should use for the best website security and functionality.<br><br>I recommend using FileZilla to change your file and folder permissions. FileZilla is a free FTP software that makes changing your file and folder permissions very simple and easy as well as many other very nice FTP features. With FileZilla you can right mouse click on your files or folders and set the permissions with a Numeric value like 755, 644, etc. Takes the confusion out of which attributes to check or uncheck.<br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></td>
    <td width="2%">&nbsp;</td>
    <td width="49%" class="table_title"><?php _e('General BulletProof Security File Checks'); ?> <a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/" target="_blank" onmouseover="Tip('This is a quick visual check to verify that you have active .htaccess files in your root and /wp-admin folders and that all the required BPS files are in your BulletProof Security plugin folder. The BulletProof Security .htaccess master files (default.htaccess, secure.htaccess, maintenance.htaccess and bp-maintenance.php) are located in this folder /wp-content/plugins/bulletproof-security/admin/htaccess/<br><br>For new installations of BulletProof Security you may see red warning messages when you first install BPS if you are not currently using any .htaccess files for your website. The warning messages will all go away once you have performed the One Time Backup located on the Backup and Restore page (Do this first before activating any BulletProof Security Modes) and activated BulletProof Security Modes in both the website root and /wp-admin folders.<br><br>I recommend that you also download backups of any original existing .htaccess files, via FTP, as an additional backup safety precaution. If you have customized your current .htaccess file with your own custom .htaccess coding then you can add your custom .htaccess code to your BulletProof .htaccess master files. The BulletProof Security .htaccess master files (default.htaccess, secure.htaccess, maintenance.htaccess and bp-maintenance.php) are located in this folder /wp-content/plugins/bulletproof-security/admin/htaccess/<br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me</a></td>
  </tr>
  <tr>
    <td width="16%" class="table_cell_perms_head_left">File Name -<br />Folder Name</td>
    <td width="17%" class="table_cell_perms_head_middle">File Path -<br />
      Folder Path</td>
    <td width="8%" class="table_cell_perms_head_middle">Suggested<br />
      Permissions</td>
    <td width="8%" class="table_cell_perms_head_right">Current<br />
      Permissions</td>
    <td>&nbsp;</td>
    <td rowspan="4" class="table_cell_file_checks">
<?php echo general_bps_file_checks(); ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="file_checks_bottom_table">
      <tr>
        <td class="file_checks_bottom_table_cell">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="4" class="table_cell_perms_blank">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
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
?>
  <tr>
    <td colspan="4" class="table_cell_perms_blank">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
 <tr>
    <td colspan="4" class="table_cell_perms_bottom">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
</div><br />
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
    <td class="table_cell"><?php _e('Website Root Folder'); ?>: <strong><?php echo get_option('home'); ?></strong></td>
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
    <td class="table_cell"><?php _e('PHP Display Errors'); ?>: <strong><?php echo $bps_php_display_errors_output; ?></strong></td>
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

<form name="BulletProof-Backup" action="options-general.php?page=bulletproof-security/admin/options.php" method="post">
<?php settings_fields( 'bulletproof_security_save_settings' ); ?>
<h3><?php _e('Backup Your Original Existing .htaccess Files'); ?></h3>
<h3><?php _e('<font color="red"><strong>CAUTION: </strong></font>'); ?><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#bps-backup-restore" target="_blank" onmouseover="Tip('Back up your existing .htaccess files first before activating any BulletProof Security Modes. You only need to back up your existing original .htaccess files once in case of a problem when you first install and activate any BulletProof Security Modes. Once you have backed up your original existing .htaccess files you will see them listed in the <strong>Current Backed Up .htaccess Files Status</strong> window below. I also recommend you manually download any existing .htaccess files, customized .htaccess files or other BPS files that you have personally customized or modified.<br><br>There is no need to perform additional backups because the BPS master files are stored in your /plugins/bulletproof-security/admin/htaccess folder.<br><br>Before installing future upgrades to BPS you should download both the /bulletproof-security/admin/htaccess folder and the /bulletproof-security/admin/backup folder. BPS Pro has advanced permanent Backup and Restore options and features.<br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 550, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()"><strong>Read Me</strong></a></h3>

<table class="form-table">
   <tr>
	<th><label><input name="selection" type="radio" value="backup_htaccess" class="tog" <?php checked('', $backup_htaccess); ?> />
<?php _e('Backup .htaccess Files'); ?></label></th>
	<td><?php _e('<font color="green"><strong>Backs up your existing original .htaccess files in your root and /wp-admin folders.</strong></font><br><strong>This is a One Time Backup to be used only for a first time installation of BPS. Read the <font color="red"><strong>CAUTION: </strong></font>Read Me ToolTip.</strong>'); ?></td>
	<td>
    </td>
   </tr>
</table>
<p class="submit">
<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('One Time Backup') ?>" />
</p></form>

<form name="BulletProof-Restore" action="options-general.php?page=bulletproof-security/admin/options.php" method="post">
<?php settings_fields( 'bulletproof_security_save_settings' ); ?>
<h3><?php _e('Restore Your Original .htaccess Files From Backup '); ?><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#bps-backup-restore" target="_blank" onmouseover="Tip('Restores your original .htaccess files that were backed up by you. Your backed up .htaccess files were copied and renamed to root.htaccess and wpadmin.htaccess and the copies are now located in the /plugins/bulletproof-security/admin/backup folder. Restoring your backed up .htaccess files will copy and rename them back to .htaccess and put those copies in your root and /wp-admin folders. If you did not have any original .htaccess files to begin with then you will not have any backed up .htaccess files.<br><br>For more information click this Read Me button link to view the <strong>BulletProof Security Guide.</strong>', WIDTH, 550, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()"><strong>Read Me</strong></a></h3>

<table class="form-table">
   <tr>
	<th><label><input name="selection" type="radio" value="restore_htaccess" class="tog" <?php checked('', $restore_htaccess); ?> />
<?php _e('Restore .htaccess Files'); ?></label></th>
	<td><?php _e('<font color="green"><strong>Restores your backed up original .htaccess files to your root and /wp-admin folders.</strong></font><br><strong>This restore feature is intended to be used only for first time installation problems.</strong>'); ?></td>
	<td>
    </td>
   </tr>
</table>
<p class="submit">
<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Restore Files') ?>" />
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
    <td class="table_cell_bottom">&nbsp;</td>
  </tr>
</table>
<br /><br /> 
</div>
        
<div id="tabs-5" class="tab-page">
<h2><?php _e('BulletProof Security Maintenance Mode'); ?></h2>

<form name="BulletProof-Maintenance" action="options-general.php?page=bulletproof-security/admin/options.php" method="post">
<?php settings_fields( 'bulletproof_security_save_settings' ); ?>
<h3><?php _e('Activate Website Under Maintenance Mode'); ?></h3>
<h3><?php _e('<font color="red"><strong>CAUTION: </strong></font>'); ?><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#maintenance-mode-ip-mod-instructions" target="_blank" onmouseover="Tip('When you activate Maintenance Mode your website will be put in HTTP 503 Service Temporarily Unavailable status and display a Website Under Maintenance page to visitors. You must add your public IP address to the BPS maintenance.htaccess file in order to view your website while everyone else sees the Website Under Maintenance page. Your Public IP address is shown below in the green box. Your Public IP address may change frequently so be sure to check that the IP address shown here matches the IP address contained in the maintenance.htaccess file.<br><br>Your SERPs (website or web page ranking) will not be affected by putting your website in Maintenance Mode for up to several days. When you put your website in maintenance mode you can continue to work in your WordPress Dashboard as long as you <strong>do not log out or completely close your browser program (IE, Firefox or whatever other browser program you use).</strong> If you have navigated away from your WordPress Dashboard, but still have your browser program open then you just need to enter this URL in your URL address window to get back into your Dashboard. http://www.your-website.com/wp-admin/options-general.php?page=bulletproof-security/admin/options.php<br><br>If you are unable to get back to your Dashboard then just upload, via FTP, either the BulletProof default .htaccess or secure .htaccess file (you need to rename either file to just .htaccess first) to overwrite the maintenance .htaccess file in your website root folder so you can get back into your Dashboard.<br><br>For more specific information and detailed instructions click this Read Me button link to view the <strong>BulletProof Security Guide.</strong><br><br>BPS Pro allows you log back into your WordPress Dashboard if you close your browser program or log out of your WordPress Dashboard while in Maintenance Mode.', WIDTH, 550, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()"><strong>Read Me</strong></a></h3>

<table class="form-table">
   <tr>
	<th><label><input name="selection" type="radio" value="bpmaintenance" class="tog" <?php checked('', $bpmaintenance); ?> />
	<?php _e('Maintenance Mode'); ?></label></th>
	<td class="url-path"><?php _e('<font color="green">Copies the file maintenance.htaccess to your root folder and renames the file name to just .htaccess<br>The file bp-maintenance.php is also copied to your root folder. This is the actual "Website Under Maintenance" page.</font>'); ?></td>
	<td><?php _e("<tr><td class=\"public-ip\">" .$_SERVER['REMOTE_ADDR'] . "</td><td>This is your CURRENT PUBLIC IP ADDRESS. If you plan on putting your website in website under maintenance mode, then this is your IP address that you will add to the maintenance.htacess master file. Read the CAUTION: Read Me ToolTip for more specific information.</td></tr></div>"); ?></td>
   </tr>
</table>
<p class="submit">
<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Activate') ?>" />
</p></form>
</div>

<div id="tabs-6">
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
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/" target="_blank">BPS .45.1 Guide</a></td>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#maintenance-mode-ip-mod-instructions" target="_blank">Maintenance Mode Help Info</a></td>
  </tr>
  <tr>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#bps-45-new-features" target="_blank">BPS .45.1 Features</a></td>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#bps-advanced-coding-modfications" target="_blank">BPS .45.1 Coding Modifications Help Info</a></td>
  </tr>
  <tr>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/319/bulletproof-security-plugin-support/bulletproof-security-comments-questions-problems-wishlist/" target="_blank">Post Questions and Comments for Assistance</a></td>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45/#modifying-htaccess-files" target="_blank">Modifying BPS .htaccess Files for WordPress Subfolders</a></td>
  </tr>
  <tr>
    <td class="table_cell_help"><a href="http://www.ait-pro.com/aitpro-blog/1183/bulletproof-security-plugin-support/bulletproof-security-plugin-bps-version-45-screenshots/" target="_blank">BPS .45.1 Screenshots</a></td>
    <td class="table_cell_help">&nbsp;</td>
  </tr>
  <tr>
    <td width="50%" class="table_cell_help">&nbsp;</td>
    <td width="50%" class="table_cell_help">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_cell_bottom">&nbsp;</td>
    <td class="table_cell_bottom">&nbsp;</td>
  </tr>
</table>
</div>

<div id="tabs-7" class="tab-page">
<h2><?php _e('BulletProof Security Pro Modules'); ?></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps_pro_activation_table">
  <tr>
    <td width="50%" class="table_title">BulletProof Security Pro Activation</td>
    <td width="50%" class="table_title">BPS Pro Modules / Features</td>
  </tr>
  <tr>
    <td class="table_cell">
<form id="BPS-PRO-Activation-ID" name="BPS-PRO-Activation" class="bps_pro_activation_form" action="http://www.ait-pro.com/aitpro-blog/website-metrics-posting-form/activation-key-verification/" method="post"><?php settings_fields( 'bulletproof_security_save_settings' ); ?>
      <label>
	<input name="bps_pro_activation" type="text" class="bps_pro_activate_text_field" id="bps_pro_activation-ID" style="background-color:#A9F5A0; border:2px; border-style:inset; margin-left:17px;" value="bps-0004319" size="22" /> Enter Your BPS Pro Activation Key</label>
    <input type="hidden" name="key_validator" value="check_key_ID" />
<p class="submit">
	<input type="submit" name="submit_activate" class="button-primary" value="<?php esc_attr_e('Activate BPS Pro') ?>" />
</p>
</form></td>
    <td rowspan="2" class="bps_pro_modules_info"><strong>Website Attack Alerts:</strong> Displayed Warnings &amp; Email  Notifications<br />
      <strong>Attack Method Detection:</strong> Logging &amp; Tracking<br />
      <strong>Blocked Threats:</strong> Displayed Warnings & Email Notifications<br />
      <strong>Website Hack Testing Utility:</strong> Includes 50+ XSS & SQL Hacking Scripts To Self Test Your Website For Possible Vulnerabilities<br /><br />
      <strong>Edit BPS Pro .htaccess Files From The  Dashboard</strong><br />
      <strong>Edit Maintenance Mode IP Address From The  Dashboard</strong><br />
      <strong>Additional Backup & Restore Options & Features</strong></td>
  </tr>
  <tr>
    <td class="table_cell_activation_details">Entering your Activation Key starts the installation process of Both BPS Pro<br />
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
</div>