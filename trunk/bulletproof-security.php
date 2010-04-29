<?php
/*
Plugin Name: BulletProof Security
Plugin URI: http://www.ait-pro.com/bulletproof-security-wordpress-plugin/bulletproof-security-wordpress-htaccess-plugin/
Description: One click switching between BulletProof Security modes and website under maintenance mode (http 503 Service Unavailable). BulletProof .htaccess file contains Filter and Query String Exploits code that protects your site against XSS & SQL Innjection hacking attempts.
Version: .44
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

define('BULLETPROOF_VERSION', '.44');

// Typically used for WP Pre2.6. Used here for DHTML and javascript Tool Tips - Hinky change later
if ( ! defined( 'WP_CONTENT_URL' ) )
     define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
      define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) )
      define( 'WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
      define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );

// Code below not used in this BP version
// register_activation_hook( __FILE__, 'bulletproof_security_activate' );
// register_deactivation_hook( __FILE__, 'bulletproof_security_deactivate' );
// add_action('init', 'bulletproof_security_init');
// add_action('admin_head', 'bulletproof_head');

add_action( 'admin_menu', 'bp_setup_options' );

// BulletProof Menu
function bp_setup_options()
{
	add_filter( 'plugin_action_links', 'bp_plugin_settings', 10, 2 );
	add_options_page( __( 'BulletProof Security', 'bulletproof-security' ), __( 'BulletProof Security', 'bulletproof-security' ), 9, basename( __FILE__ ), 'bp_main_page' );
}

/*
 * bp_plugin_settings()
 * @param mixed $links
 * @param mixed $file
 * @return
 */
function bp_plugin_settings( $links, $file )
{
	static $this_plugin;
	if ( !$this_plugin ) $this_plugin = plugin_basename( __FILE__ );
	if ( $file == $this_plugin ) $links = array_merge( array( '<a href="' . attribute_escape( 'options-general.php?page=bulletproof-security.php' ) . '">Settings</a>' ), $links );
	return $links;
}
// Form copy and rename htaccess file for root
$bpsecureroot = 'unchecked';
$bpdefaultroot = 'unchecked';
$old = ABSPATH . '/wp-content/plugins/bulletproof-security/htaccess/default.htaccess';
$new = ABSPATH . '/.htaccess';
$old1 = ABSPATH . '/wp-content/plugins/bulletproof-security/htaccess/secure.htaccess';
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
$oldadmin = ABSPATH . '/wp-content/plugins/bulletproof-security/htaccess/default.htaccess';
$newadmin = ABSPATH . '/wp-admin/.htaccess';
$oldadmin1 = ABSPATH . '/wp-content/plugins/bulletproof-security/htaccess/secure.htaccess';
$newadmin1 = ABSPATH . '/wp-admin/.htaccess';

if (isset($_POST['submit'])) {
	$selected_radio = $_POST['selection'];
		if ($selected_radio == 'bpsecurewpadmin') {
			$bpsecurewpadmin = 'checked';
			copy($oldadmin1, $newadmin1) or die("Unable to copy $oldadmin1 to $newadmin1.");
		}
		else if ($selected_radio == 'bpdefaultwpadmin') {
			$bpdefaultwpadmin = 'checked';
			copy($oldadmin, $newadmin) or die("Unable to copy $oldadmin to $newadmin.");
		}
}
// Form copy and rename maintenance htaccess for root + copy bp-maintenance.php to root
$bpmaintenance = 'unchecked';
$oldmaint = ABSPATH . '/wp-content/plugins/bulletproof-security/htaccess/maintenance.htaccess';
$newmaint = ABSPATH . '/.htaccess';
$oldmaint1 = ABSPATH . '/wp-content/plugins/bulletproof-security/htaccess/bp-maintenance.php';
$newmaint1 = ABSPATH . '/bp-maintenance.php';

if (isset($_POST['submit'])) {
	$selected_radio = $_POST['selection'];
		if ($selected_radio == 'bpmaintenance') {
			$bpmaintenance = 'checked';
			copy($oldmaint, $newmaint) or die("Unable to copy $oldmaint to $newmaint.");
			copy($oldmaint1, $newmaint1) or die("Unable to copy $oldmaint1 to $newmaint1.");
		}
}

/*
 * bp_main_page()
 * Menu Function End Hook
 * @return
 */
function bp_main_page() { ?>

<div class=wrap>
<script type="text/javascript" src="<?php echo WP_PLUGIN_URL; ?>/bulletproof-security/js/wz_tooltip.js"></script>
<?php $bulletproof_ver = '.44'; ?>
<?php screen_icon(); ?>
<h2><?php echo esc_html( $title ); ?></h2>
<h2>BulletProof Security v<?php echo $bulletproof_ver; ?></h2>
<h3><?php _e('IMPORTANT!: '); ?><a href="http://www.ait-pro.com/aitpro-blog/category/bulletproof-security-plugin-support/" target="_blank" onmouseover="Tip('BEFORE activating any BulletProof Security modes look at your root path to your website WordPress installation shown below under BulletProof .htaccess Security Modes. If your WordPress installation is installed in your website domain root folder than you will see http://your-website-domain-name/.htaccess. If your WordPress installation is installed in a subfolder off of your website domain root than you will see something like this for example http://your-website-domain-name/a-folder-name/.htaccess. If your WordPress installation is in your website domain root then you DO NOT need to modify anything and can just activate any of the BulletProof Security modes you want now. If your WordPress installation is in a subfolder then DO NOT activate any of the BulletProof Security Modes until you have fully read the help files here and on taken a look at my BulletProof Security screenshots page on my website BEFORE activating any security modes.<br><br>IMPORTANT!!! Setting up BulletProof Security to work correctly for your website if you have WordPress installed in a subfolder off of your root website domain WILL require a one time manual editing of 4 files that are provided with the BulletProof plugin (3 .htaccess files & 1 maintenance PHP file). Those 4 files are located in the /plugins/bulletproof-security/htaccess/ folder. The files are named: default.htaccess, secure.htaccess, maintenance.htaccess and bp-maintenance.php. Download the 4 files to your computer to make the modifications to each file if necessary. If Wordpress is installed in your root folder on your website then you DO NOT need to make any modifications to any of the BulletProof .htaccess files. DO NOT EDIT OR REMOVE the 5th file named .htaccess - it is there to protect that folder from being visible or accessible to anyone except you.<br><br>Screenshot images of example .htaccess file modifications and detailed .htaccess setup instructions can be viewed by clicking the FAQ, Screenshots, Support, Questions, Comments and Wishlist link or by clicking any of the Read Me! hover ToolTips links.<br><br>The BulletProof secure.htaccess file contains filter and query string exploits code that should be more than secure enough to completely prevent all hackers from hacking your website using XSS or SQL Injection attacks, but if you would like to add your own additional code or mods to the provided .htaccess files then just make sure that any additional code or mods that you add to these provided .htaccess files DOES NOT negatively affect your site from being crawled and indexed by search engines.<br><br>The provided BulletProof secure.htaccess file has been thoroughly tested against hackers and also for search engine crawling and indexing. Hackers that have been able to penetrate BulletProof = 0. Search Engine crawling or indexing problems = 0. Enjoy!', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me First!</a></h3>

<h3><?php _e('General Information About BulletProof '); ?><a href="javascript:void(0);" target="_blank" onmouseover="Tip('The BulletProof Security plugin performs a very simple function: It copies, renames and moves the provided .htaccess files in the BulletProof plugin folder to either your root folder or your wp-admin folder or both. Maintenance mode is very convenient for fast switching to Under Maintenance and regular website operation. And of course your website is protected from ALL XSS and SQL Injection hacking attacks when your website is in BulletProof Mode.<br><br>The BulletProof Security secure.htaccess file blocks XSS (Cross Site Scripting) & SQL Injection hacking attempts, it also blocks administrator level configuration of Widgets and activation and deactivation of a very few plugins. In order to perform Widget configuration changes or if a plugin will not activate or deactivate correctly, you will need to temporarily put your website into default.htaccess mode while performing these tasks. This plugin allows you to quickly switch between default level, secure level and maintenance .htaccess modes without having to manually rename, modify or move .htaccess files via FTP or a web host Control Panel.<br><br>BulletProof is designed to be a fast, convenient and simple one click way for you to switch between different levels of website security and maintenance modes. The maintenance .htaccess file allows website developers or website owners to access and work on a website while a Website Under Maintenance page is displayed to all other visitors to the website.<br><br>BulletProof was originally designed to change the .htaccess modes for both the root folder and /wp-admin folder simultaneously. At users requests the BulletProof plugin now allows you to control the root .htaccess file and /wp-admin .htaccess file separately. Simpler is usually better.<br><br>NO .htaccess file writing or other file writing occurs in this version of BulletProof - ONLY .htaccess file copying, renaming and moving. BulletProof Pro includes file writing and more advanced functions. (BulletProof Pro release date - TBA).', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me!</a></h3>
<?php
		echo '<a href="http://www.ait-pro.com/bulletproof-security-wordpress-plugin/bulletproof-security-wordpress-htaccess-plugin" target="_blank">';
		_e('BulletProof Security Overview');
		echo '</a>';
		echo ' | <a href="http://www.ait-pro.com/aitpro-blog/bulletproof-security-plugin-support/bulletproof-security-wordpress-plugin-support" target="_blank">';
		_e('FAQ, Screenshots, Support, Questions, Comments, Wishlist');
		echo '</a>';
?>
<h3><?php _e('Current General .htaccess Status '); ?><a href="javascript:void(0);" target="_blank" onmouseover="Tip('If you already have an existing .htaccess file or files be sure to download them via FTP as a backup. If you have customized your current  .htaccess file(s) with your own code then just add your custom code to your BulletProof .htaccess files.<br><br>A Green font color message indicates a file IS present or INFORMATION.  A Red font color message indicates a file IS NOT present, an ERROR message or WARNING.', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me!</a></h3>

<?php 
		$dir='../';
		$filename = '.htaccess';
		if (file_exists($dir.$filename)) {
		    _e('<font color="green">An .htaccess file DOES exist in your root folder</font>');
		} else {
		    _e('<font color="red">An .htaccess file does NOT exist in your root folder</font>');
		}
?>		
		<br />
<?php 
		$filename = '.htaccess';
		if (file_exists($filename)) {
		    _e('<font color="green">An .htaccess file DOES exist in your /wp-admin folder</font>');
		} else {
		    _e('<font color="red">An .htaccess file does NOT exist in your /wp-admin folder</font>');
		}
?>
		<br /><br />
        
<h3><?php _e('Current Active BulletProof .htaccess Files '); ?><a href="javascript:void(0);" target="_blank" onmouseover="Tip('The String you see listed below, if you have an active BulletProof .htaccess file, is reading and displaying the actual contents of the existing .htaccess files here. This is not just a displayed message - this is the actual first 44 characters of the contents of your .htaccess files. To change the String that is displayed here you would change the actual contents of your .htaccess files.  To add or remove how many String characters are displayed here modify code line 164 & 174 in the bulletproof-security.php file.', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me!</a></h3>        
<?php
// Read first 44 characters of current root .htaccess file starting from the 3rd character
$filename = '.htaccess';
if (file_exists(ABSPATH . $filename)) {
		    $section = file_get_contents(ABSPATH . $filename, NULL, NULL, 3, 44);
			var_dump($section); _e('<font color="green"> is currently active in your root folder</font>');
		} else {
		    _e('<font color="red">NO .htaccess file was found in your root folder</font>');
		}
?>		
		<br />
<?php
// Read first 44 characters of current wp-admin .htaccess file starting from the 3rd character
$filename = 'wp-admin/.htaccess';
if (file_exists(ABSPATH . $filename)) {
		    $section = file_get_contents(ABSPATH . $filename, NULL, NULL, 3, 44);
			var_dump($section); _e('<font color="green"> is currently active in your /wp-admin folder</font>');
		} else {
		    _e('<font color="red">NO .htaccess file was found in /wp-admin folder</font>');
		}
?> 

<h3><?php _e('BulletProof .htaccess Security Modes '); ?></h3>
<h4><?php _e('Root folder .htaccess Security Mode '); ?><a href="javascript:void(0);" target="_blank" onmouseover="Tip('Copies, Renames and Moves either default.htaccess or secure.htaccess depending on what radio button option you choose from /plugins/bulletproof-security/htaccess/secure.htaccess or default.htaccess to your root folder. secure.htaccess or  default.htaccess is renamed to just .htaccess in the process so that either file will overwrite the existing .htaccess file in your root folder. Since this is a copy of your secure.htaccess or default.htaccess file the original master secure.htaccess or default.htaccess file stays intact in the /plugins/bulletproof-security/htaccess/ folder. If you want to make changes or add code to your secure.htaccess or default.htaccess files you would make those changes to the /plugins/bulletproof-security/htaccess/secure.htaccess master file or default.htaccess master file.', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me!</a></h4>

<form name="BulletProof-Root" action="options-general.php?page=bulletproof-security.php" method="post">
<?php wp_nonce_field('update-options'); ?>
<table class="form-table">
<tr>
<th><label><input name="selection" type="radio" value="bpdefaultroot" class="tog" <?php checked('', $bpdefaultroot); ?> /><?php _e('Default Mode'); ?></label></th>
<td><code><?php echo get_option('home'); ?>/.htaccess</code><?php _e('<font color="green"> (Copies & Renames default.htaccess to your root folder)</font>'); ?></td>
</tr>
<tr>
<th><label><input name="selection" type="radio" value="bpsecureroot" class="tog" <?php checked('', $bpsecureroot); ?> /> <?php _e('BulletProof Mode'); ?></label></th>
<td><code><?php echo get_option('home'); ?>/.htaccess</code><?php _e('<font color="green"> (Copies & Renames secure.htaccess to your root folder)</font>'); ?></td>
</tr>
</table>
<input type="hidden" name="action" value="bpplugin-update-htaccess" />
<input type="hidden" name="action" value="bpplugin-noupdate-htaccess" />
<p class="submit">
<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
</p>
</form>

<h4><?php _e('wp-admin folder .htaccess Security Mode '); ?><a href="javascript:void(0);" target="_blank" onmouseover="Tip('Copies, Renames and Moves either default.htaccess or secure.htaccess depending on what radio button option you choose from /plugins/bulletproof-security/htaccess/secure.htaccess or default.htaccess to your /wp-admin folder. secure.htaccess or  default.htaccess is renamed to just .htaccess in the process so that either file will overwrite the existing .htaccess file in your /wp-admin folder. Since this is a copy of your secure.htaccess or default.htaccess file the original master secure.htaccess or default.htaccess file stays intact in the /plugins/bulletproof-security/htaccess/ folder. If you want to make changes or add code to your secure.htaccess or default.htaccess files you would make those changes to the /plugins/bulletproof-security/htaccess/secure.htaccess master file or default.htaccess master file.', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me!</a></h4>

<form name="BulletProof-WPadmin" action="options-general.php?page=bulletproof-security.php" method="post">
<?php wp_nonce_field('update-options'); ?>
<table class="form-table">
<tr>
<th><label><input name="selection" type="radio" value="bpdefaultwpadmin" class="tog" <?php checked('', $bpdefaultwpadmin); ?> /> <?php _e('Default Mode'); ?></label></th>
<td><code><?php echo get_option('home'); ?>/wp-admin/.htaccess</code><?php _e('<font color="green"> (Copies & Renames default.htaccess to your /wp-admin folder)</font>'); ?></td>
</tr>
<tr>
<th><label><input name="selection" type="radio" value="bpsecurewpadmin" class="tog" <?php checked('', $bpsecurewpadmin); ?> /> <?php _e('BulletProof Mode'); ?></label></th>
<td><code><?php echo get_option('home'); ?>/wp-admin/.htaccess</code><?php _e('<font color="green"> (Copies & Renames secure.htaccess to your /wp-admin folder)</font>'); ?></td>
</tr>
</table>
<input type="hidden" name="action" value="bpplugin-update-htaccess" />
<input type="hidden" name="action" value="bpplugin-noupdate-htaccess" />
<p class="submit">
<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
</p>
</form>
 
<form name="BulletProof-Maintenance" action="options-general.php?page=bulletproof-security.php" method="post">
<?php wp_nonce_field('update-options'); ?>
<h4><?php _e('Maintenance .htaccess Security Mode'); ?></h4>
<?php _e('<font color="red"><strong>CAUTION: </strong></font>'); ?><a href="javascript:void(0);" target="_blank" onmouseover="Tip('By enabling Maintenance .htaccess Security Mode your website will be put in HTTP 503 Service Temporarily Unavailable status and display an Under Maintenance page to visitors. Your SERPs (website or web page ranking) will not be effected by putting your website in maintenance mode for at least 24 hours or even several days.<br><br>When you put your website in maintenance mode you can continue to work in your Wordpress Dashboard as long as you DO NOT log out. If you log out or close your browser window you will NOT be able to access your Dashboard until you rename or delete the .htaccess maintenance file copied to your root website folder via FTP or via your web host control panel.<br><br>To allow ONLY yourself to view, access and work on your website OUTSIDE of your Dashboard while the Under Maintenance page is displayed to all other visitors, you MUST add your CURRENT PUBLIC IP ADDRESS shown below the Maintenance Mode radio button to the maintenance.htaccess file FIRST BEFORE putting your site in Maintenance mode (BulletProof Pro will allow you to enter your IP address directly from this page and it will be written to the maintenance.htaccess master file - BulletProof Pro release date - TBA). If you do not add your IP address to the maintenance.htaccess file FIRST you will also not be able to view, access or work on your website OUTSIDE of your Dashboard until you manually rename or just delete the copy of the .htaccess maintenance file copied to your root website folder via FTP or via your web host control panel. There are some limitations to what you can do OUTSIDE of your Dashboard while your website is in maintenance mode. You can perform all visual design work, you can perform all Dashboard work. You can ONLY view your index.php or website home page OUTSIDE of your Dashboard. Normally you would not put your website in maintenance mode to work on a particular post or page anyway.<br><br>You can customize the Under Maintenance bp-maintenance.php file located in the /plugins/bulletproof-security/htaccess/ folder to add your own custom Under Maintenance message and graphics to visitors. The Under Maintenance page displays a Javascript countdown timer, which you can set to indicate how many days, hours, minutes and seconds until your website will be back online and fully accessible to all visitors again. BulletProof Pro will contain a customizable Flash Movie that will be displayed on the Under Maintenance page. (BulletProof Pro release date - TBA).', WIDTH, 550, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()"><strong>Read Me!</strong></a>

<table class="form-table">
<tr>
<th><label><input name="selection" type="radio" value="bpmaintenance" class="tog" <?php checked('', $bpmaintenance); ?> />
<?php _e('Maintenance Mode'); ?></label></th>
<td><code><?php echo get_option('home'); ?>/.htaccess</code><?php _e('<font color="green"> (Copies & Renames maintenance.htaccess to your root folder)<br> * bp-maintenance.php is also copied to your root folder.</font>'); ?></td>
<td><?php _e("<tr><td style=\"text-align: center\"><strong>" .$_SERVER['REMOTE_ADDR'] ."</strong></td><td>This is your CURRENT PUBLIC IP ADDRESS. This is the IP address you add to the maintenance.htacess master file. Your Public IP address changes from time to time so be sure to check that your IP address displayed here is the same as your IP address in the maintenance.htaccess file.</td></tr></div>"); ?></td>
</tr>
</table>
<input type="hidden" name="action" value="bpplugin-update-htaccess" />
<input type="hidden" name="action" value="bpplugin-noupdate-htaccess" />
<p class="submit">
<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
</p>
</form>

<h4><?php _e('BulletProof .htaccess Master File Check '); ?><a href="javascript:void(0);" target="_blank" onmouseover="Tip('Just a quick check to verify that the required files are in your BulletProof Plugin folder. The BulletProof Security folder location for the .htaccess files listed below is /wp-content/plugins/bulletproof-security/htaccess/.', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me!</a></h4>
        
<?php
		// $dir='../'; is only good for stepping 
		$filename = '/wp-content/plugins/bulletproof-security/htaccess/default.htaccess';
		if (file_exists(ABSPATH . $filename)) {
		    _e('<font color="green">A default.htaccess file DOES exist in your BulletProof Plugin folder</font>');
		} else {
		    _e('<font color="red">A default.htaccess file does NOT exist in your BulletProof Plugin folder</font>');
		}
?>		
		<br />
<?php
		$filename = '/wp-content/plugins/bulletproof-security/htaccess/secure.htaccess';
		if (file_exists(ABSPATH . $filename)) {
		    _e('<font color="green">A secure.htaccess file DOES exist in your BulletProof Plugin folder</font>');
		} else {
		    _e('<font color="red">A secure.htaccess file does NOT exist in your BulletProof Plugin folder</font>');
		}
?>
		<br />
<?php
		$filename = '/wp-content/plugins/bulletproof-security/htaccess/maintenance.htaccess';
		if (file_exists(ABSPATH . $filename)) {
		    _e('<font color="green">A maintenance.htaccess file DOES exist in your BulletProof Plugin folder</font>');
		} else {
		    _e('<font color="red">A maintenance.htaccess file does NOT exist in your BulletProof Plugin folder</font>');
		}
?>
		<br />
<?php
		$filename = '/wp-content/plugins/bulletproof-security/htaccess/bp-maintenance.php';
		if (file_exists(ABSPATH . $filename)) {
		    _e('<font color="green">A bp-maintenance.php file DOES exist in your BulletProof Plugin folder</font>');
		} else {
		    _e('<font color="red">A bp-maintenance.php file does NOT exist in your BulletProof Plugin folder</font>');
		}
?>
		<br /><br />
<?php

if (!function_exists('check_perms')) { 
  	function check_perms($name,$path,$perm) {
  	clearstatcache();
    $configmod = substr(sprintf(".%o.", fileperms($path)), -4);
    $trcss = (($configmod != $perm));
    echo "<tr style=".$trcss.">";
    echo '<td style="border:0px;">' . $name . "</td>";
    echo '<td style="border:0px;">'. $path ."</td>";
    echo '<td style="border:0px;">' . $perm . '</td>';
    echo '<td style="border:0px;">' . $configmod . '</td>';
    echo "</tr>";
  
   } 
} 
?> 
           
<h3><?php _e('Current File and Folder Permissions ') ?><a href="javascript:void(0);" target="_blank" onmouseover="Tip('Your current file and folder permissions are shown below with suggested file and folder permission settings that you should have for best security and functionality. I recommend using FileZilla to change your file and folder permissions. FileZilla is a free FTP software that makes changing your file and folder permissions very simple and easy as well as many other very nice FTP features. With FileZilla you can right mouse click on your files or folders and set the permissions with a Numeric value like 755, 644, etc. Takes the confusion out of which attributes to check or uncheck.', WIDTH, 400, PADDING, 8, ABOVE, true, FADEIN, 400, FADEOUT, 300)" onmouseout="UnTip()">Read Me!</a></h3>
        
        <div style="height:300px">
		<table width="60%"  border="1px" cellspacing="3px" cellpadding="5px" style="text-align:left; border-color: #0000FF;border-bottom:thick; border-top: thick; border-left:thick; border-right:thick;">
        <tr>
        <th style="border-bottom:medium;border-color: #0000FF;"><b>File/Folder Name</b></th>
        <th style="border-bottom:medium;border-color: #0000FF;"><b>File/Folder Path</b></th>
        <th style="border-bottom:medium;border-color: #0000FF;"><b>Suggested Permissions</b></th>
        <th style="border-bottom:medium;border-color: #0000FF;"><b>Current Permissions</b></th>
      	</tr>
<?php
        check_perms("root folder","../","0755");
        check_perms("wp-includes/","../wp-includes","0755");
        check_perms(".htaccess","../.htaccess","0644");
		check_perms("wp-admin/.htaccess","../wp-admin/.htaccess","0644");
		check_perms("index.php","../index.php","0644");
        check_perms("wp-admin/index.php","../wp-admin/index.php","0644");
        check_perms("wp-admin/js/","../wp-admin/js/","0755");
        check_perms("wp-content/themes/","../wp-content/themes","0755");
        check_perms("wp-content/plugins/","../wp-content/plugins","0755");
        check_perms("wp-admin/","../wp-admin","0755");
        check_perms("wp-content/","../wp-content","0755");
?>
</table>
	</div>
       	</div>
             BulletProof Security Plugin by <a href="http://www.ait-pro.com/" target="_blank" title="AITpro Website Design">AITpro Website Design</a>
        </div>
<?php }?>