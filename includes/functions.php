<?php
// Direct calls to this file are Forbidden when core files are not present
if ( ! function_exists ('add_action') ) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}

// jQuery ScrollTop Animation based on Browser User Agent
// Opera uses the Chromium Rendering engine & the UA is Chrome
function bpsPro_Browser_UA_scroll_animation() {
	
	$user_agent = esc_html($_SERVER['HTTP_USER_AGENT']);

	if ( preg_match( '/Chrome/i', $user_agent, $matches ) ) { ?>
		
		<script type="text/javascript">
		/* <![CDATA[ */
		jQuery(document).ready(function($){
	
			$("html, body").animate({ scrollTop: "50px" }, 400, function(){
 				$("html, body").animate({ scrollTop: "0px" });
				// essential for the jQuery UI Tabs framework hash anchors
				$( this ).css( "background", "url('') no-repeat left top" );
    		});
			return false;
		});
		/* ]]> */
		</script>

<?php } elseif ( preg_match( '/Firefox/i', $user_agent, $matches ) ) { ?>

		<script type="text/javascript">
		/* <![CDATA[ */
		jQuery(document).ready(function($){
	
			$("html, body").animate({ scrollTop: "50px" }, 600, function(){
 				$("html, body").animate({ scrollTop: "0px" });
				// essential for the jQuery UI Tabs framework hash anchors
				$( this ).css( "background", "url('') no-repeat left top" );
			});
			return false;
		});
		/* ]]> */
		</script>

<?php } elseif ( preg_match( '/Safari/i', $user_agent, $matches ) ) { ?>

		<script type="text/javascript">
		/* <![CDATA[ */
		jQuery(document).ready(function($){
	
			$("html, body").animate({ scrollTop: "100px" }, 600, function(){
 				$("html, body").animate({ scrollTop: "0px" });
				// essential for the jQuery UI Tabs framework hash anchors
				$( this ).css( "background", "url('') no-repeat left top" );
			});
			return false;
		});
		/* ]]> */
		</script>

<?php } elseif ( preg_match( '/MSIE/i', $user_agent, $matches ) || preg_match( '/Trident/i', $user_agent, $matches ) ) { ?>

		<script type="text/javascript">
		/* <![CDATA[ */
		jQuery(document).ready(function($){
	
			$("html, body").animate({ scrollTop: "350px" }, 400, function(){
 				$("html, body").animate({ scrollTop: "0px" });
				// essential for the jQuery UI Tabs framework hash anchors
				$( this ).css( "background", "url('') no-repeat left top" );
			});
			return false;
		});
		/* ]]> */
		</script>

<?php } else { ?>

		<script type="text/javascript">
		/* <![CDATA[ */
		jQuery(document).ready(function($){
	
			$("html, body").animate({ scrollTop: "50px" }, 400, function(){
 				$("html, body").animate({ scrollTop: "0px" });
				// essential for the jQuery UI Tabs framework hash anchors
				$( this ).css( "background", "url('') no-repeat left top" );
    		});
			return false;
		});
		/* ]]> */
		</script>
<?php
	}
}

// Get the Current / Last Modifed Date of the bulletproof-security.php File - Minutes check
function getBPSInstallTime() {
$filename = WP_PLUGIN_DIR . '/bulletproof-security/bulletproof-security.php';

	if ( file_exists($filename) ) {
		$gmt_offset = get_option( 'gmt_offset' ) * 3600;
		$last_modified_install = date("F d Y H:i", filemtime($filename) + $gmt_offset );
	return $last_modified_install;
	}
}

// Get the Current / Last Modifed Date of the bulletproof-security.php File + one minute buffer - Minutes check
function getBPSInstallTime_plusone() {
$filename = WP_PLUGIN_DIR . '/bulletproof-security/bulletproof-security.php';
	
	if ( file_exists($filename) ) {
		$gmt_offset = get_option( 'gmt_offset' ) * 3600;
		$last_modified_install = date("F d Y H:i", filemtime($filename) + $gmt_offset + (60 * 1));
	return $last_modified_install;
	}
}

// Get the Current / Last Modifed Date of the Root .htaccess File - Minutes check
function getBPSRootHtaccessLasModTime_minutes() {
$filename = ABSPATH . '.htaccess';
	
	if ( file_exists($filename) ) {
		$gmt_offset = get_option( 'gmt_offset' ) * 3600;
		$last_modified_install = date ("F d Y H:i", filemtime($filename) + $gmt_offset );
	return $last_modified_install;
	}
}

// Get the Current / Last Modifed Date of the wp-admin .htaccess File - Minutes check
function getBPSwpadminHtaccessLasModTime_minutes() {
$filename = ABSPATH . 'wp-admin/.htaccess';
	
	if ( file_exists($filename) ) {
		$gmt_offset = get_option( 'gmt_offset' ) * 3600;
		$last_modified_install = date ("F d Y H:i", filemtime($filename) + $gmt_offset );
	return $last_modified_install;
	}
}

// Recreate the User Agent filters in the 403.php file on BPS upgrade
function bpsPro_autoupdate_useragent_filters() {		
global $wpdb;

	$bps403File = WP_PLUGIN_DIR . '/bulletproof-security/403.php';

	if ( ! file_exists($bps403File) ) {
		return;
	}
	
	$blankFile = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/blank.txt';
	$userAgentMaster = WP_CONTENT_DIR . '/bps-backup/master-backups/UserAgentMaster.txt';

	if ( file_exists($blankFile) ) {
		copy($blankFile, $userAgentMaster);
	}

	$table_name = $wpdb->prefix . "bpspro_seclog_ignore";
	$search = '';
	
	$getSecLogTable = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE user_agent_bot LIKE %s", "%$search%" ) );
	$UserAgentRules = array();
	
	if ( $wpdb->num_rows != 0 ) {

		foreach ( $getSecLogTable as $row ) {
			$UserAgentRules[] = "(.*)".$row->user_agent_bot."(.*)|";
			file_put_contents($userAgentMaster, $UserAgentRules);
		}
	
	$UserAgentRulesT = file_get_contents($userAgentMaster);
	$stringReplace = file_get_contents($bps403File);

	$stringReplace = preg_replace('/# BEGIN USERAGENT FILTER(.*)# END USERAGENT FILTER/s', "# BEGIN USERAGENT FILTER\nif ( @!preg_match('/".trim($UserAgentRulesT, "|")."/', \$_SERVER['HTTP_USER_AGENT']) ) {\n# END USERAGENT FILTER", $stringReplace);
		
	file_put_contents($bps403File, $stringReplace);
	}
}

// Update/Add/Save any new DB options/features during the BPS upgrade
// BPS .51.8: new Login Security option: Attempts Remaining
// BPS .52.3: Pre-save Custom Code db options for Export|Import tools if they do not exist
// BPS .52.7: Set Security Log Limit POST Request Body Data option to checked/limited by default
// BPS .52.9: POST Request Attack Protection code correction|addition
function bpsPro_new_feature_autoupdate() {
$BPS_LSM_Options = get_option('bulletproof_security_options_login_security');
	
	if ( ! $BPS_LSM_Options['bps_login_security_remaining'] ) {

		$BPS_Options_lsm = array(
		'bps_max_logins' 				=> $BPS_LSM_Options['bps_max_logins'], 
		'bps_lockout_duration' 			=> $BPS_LSM_Options['bps_lockout_duration'], 
		'bps_manual_lockout_duration' 	=> $BPS_LSM_Options['bps_manual_lockout_duration'], 
		'bps_max_db_rows_display' 		=> $BPS_LSM_Options['bps_max_db_rows_display'], 
		'bps_login_security_OnOff' 		=> $BPS_LSM_Options['bps_login_security_OnOff'], 
		'bps_login_security_logging' 	=> $BPS_LSM_Options['bps_login_security_logging'], 
		'bps_login_security_errors' 	=> $BPS_LSM_Options['bps_login_security_errors'], 
		'bps_login_security_remaining' 	=> 'On', 
		'bps_login_security_pw_reset' 	=> $BPS_LSM_Options['bps_login_security_pw_reset'],  
		'bps_login_security_sort' 		=> $BPS_LSM_Options['bps_login_security_sort'] 
		);

		foreach( $BPS_Options_lsm as $key => $value ) {
			update_option('bulletproof_security_options_login_security', $BPS_Options_lsm);
		}
	}

	$bps_Root_CC_Options = 'bulletproof_security_options_customcode';

	if ( ! is_multisite() ) {

		$Root_CC_Options = array(
		'bps_customcode_one' 				=> '', 
		'bps_customcode_server_signature' 	=> '', 
		'bps_customcode_directory_index' 	=> '', 
		'bps_customcode_server_protocol' 	=> '', 
		'bps_customcode_error_logging' 		=> '', 
		'bps_customcode_deny_dot_folders' 	=> '', 
		'bps_customcode_admin_includes' 	=> '', 
		'bps_customcode_wp_rewrite_start' 	=> '', 
		'bps_customcode_request_methods' 	=> '', 
		'bps_customcode_two' 				=> '', 
		'bps_customcode_timthumb_misc' 		=> '', 
		'bps_customcode_bpsqse' 			=> '', 
		'bps_customcode_deny_files' 		=> '', 
		'bps_customcode_three' 				=> ''
		);
				
	} else {
					
		$Root_CC_Options = array(
		'bps_customcode_one' 				=> '', 
		'bps_customcode_server_signature' 	=> '', 
		'bps_customcode_directory_index' 	=> '', 
		'bps_customcode_server_protocol' 	=> '', 
		'bps_customcode_error_logging' 		=> '', 
		'bps_customcode_deny_dot_folders' 	=> '', 
		'bps_customcode_admin_includes' 	=> '', 
		'bps_customcode_wp_rewrite_start' 	=> '', 
		'bps_customcode_request_methods' 	=> '', 
		'bps_customcode_two' 				=> '', 
		'bps_customcode_timthumb_misc' 		=> '', 
		'bps_customcode_bpsqse' 			=> '', 
		'bps_customcode_wp_rewrite_end' 	=> '', 
		'bps_customcode_deny_files' 		=> '', 
		'bps_customcode_three' 				=> ''
		);					
	}

	if ( ! get_option( $bps_Root_CC_Options ) ) {			

		foreach( $Root_CC_Options as $key => $value ) {
			update_option('bulletproof_security_options_customcode', $Root_CC_Options);
		}
	}

	$bps_wpadmin_CC_Options = 'bulletproof_security_options_customcode_WPA';			

	$wpadmin_CC_Options = array(
	'bps_customcode_deny_files_wpa' => '', 
	'bps_customcode_one_wpa' 		=> '', 
	'bps_customcode_two_wpa' 		=> '', 
	'bps_customcode_bpsqse_wpa' 	=> ''
	);
			
	if ( ! get_option( $bps_wpadmin_CC_Options ) ) {			
		
		foreach( $wpadmin_CC_Options as $key => $value ) {
			update_option('bulletproof_security_options_customcode_WPA', $wpadmin_CC_Options);
		}
	}
	
	// BPS .52.6: Pre-save UI Theme Skin with Blue Theme if DB option does not exist
	bpsPro_presave_ui_theme_skin_options();

	// .52.7: Set Security Log Limit POST Request Body Data option to checked/limited by default
	$bps_seclog_post_limit_Options = 'bulletproof_security_options_sec_log_post_limit';			

	$seclog_post_limit_Options = array( 'bps_security_log_post_limit' => '1' );
			
	if ( ! get_option( $bps_seclog_post_limit_Options ) ) {			
		
		foreach( $seclog_post_limit_Options as $key => $value ) {
			update_option('bulletproof_security_options_sec_log_post_limit', $seclog_post_limit_Options);
		}
	}
	
	// .52.9: POST Request Attack Protection code correction|addition
	bpsPro_post_request_protection_check();
}

// BPS Update/Upgrade Status Alert in WP Dashboard|Status Display BPS pages only
function bps_root_htaccess_status_dashboard() {

	if ( current_user_can('manage_options') ) {

	global $bps_version, $bps_last_version, $aitpro_bullet;

	if ( esc_html($_SERVER['REQUEST_METHOD']) == 'POST' ) {
		
		$bps_status_display = get_option('bulletproof_security_options_status_display'); 

		if ( $bps_status_display['bps_status_display'] != 'Off' ) {

			if ( preg_match( '/page=bulletproof-security/', esc_html($_SERVER['REQUEST_URI']), $matches ) ) {
		
			if ( esc_html($_SERVER['QUERY_STRING']) == '' ) {
				$bps_base = basename(esc_html($_SERVER['REQUEST_URI']));
			} else {
				$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) );
			}		
		
			echo '<div id="bps-status-display" style="float:left;margin:6px 0px -40px 8px;padding:3px 5px 3px 5px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'" style="text-decoration:none;font-weight:bold;">'.__('Reload BPS Status Display', 'bulletproof-security').'</a></div>';
			echo '<div style="clear:both;"></div>';
			}
		}
		
		if ( @$_POST['Submit-DBB-Run-Job'] == true || @$_POST['Submit-DB-Table-Prefix'] == true || @$_POST['Submit-DB-Prefix-Table-Refresh'] == true ) {  
		
			$bpsPro_Spinner = get_option('bulletproof_security_options_spinner');	
	
		if ( $bpsPro_Spinner['bps_spinner'] != 'Off' ) {

			echo '<div id="bps-status-display" style="padding:2px 0px 4px 8px;width:240px;">';
			echo '<div id="bps-spinner" class="bps-spinner" style="background:#fff;border:4px solid black;">';
   			echo '<img id="bps-img-spinner" src="'.plugins_url('/bulletproof-security/admin/images/bps-spinner.gif').'" style="float:left;margin:0px 20px 0px 0px;" />'; 
			echo '<div id="bps-spinner-text-btn" style="padding:20px 0px 26px 0px;font-size:14px;">Processing...<br><button style="margin:10px 0px 0px 10px;" onclick="javascript:history.go(-1)">Cancel</button></div>';
			echo '</div>';

?>
    
<style>
<!--
.bps-spinner {
    visibility:visible;
	position:fixed;
    top:7%;
    left:45%;
 	width:240px;
	padding:2px 0px 4px 8px;   
	z-index:99999;
}
-->
</style>

<?php
		echo '</div>';
		}  
		}

	} elseif ( esc_html($_SERVER['QUERY_STRING']) == 'page=bulletproof-security/admin/system-info/system-info.php' ) {
		
		$bps_status_display = get_option('bulletproof_security_options_status_display');

		if ( $bps_status_display['bps_status_display'] != 'Off' ) {
		
		echo '<div id="bps-status-display" style="float:left;padding:0px 0px 10px 0px;">'.__('The BPS Status Display is set to Off by default on the System Info page', 'bulletproof-security').'</div>';
		echo '<div style="clear:both;"></div>';
		}

	} else {

	$options = get_option('bulletproof_security_options_autolock');	
	$filename = ABSPATH . '.htaccess';
	$permsHtaccess = @substr(sprintf('%o', fileperms($filename)), -4);
	$sapi_type = @php_sapi_name();	
	$check_string = @file_get_contents($filename);
	$section = @file_get_contents($filename, NULL, NULL, 3, 46);	
	$bps_get_domain_root = bpsGetDomainRoot();
	$bps_get_wp_root_secure = bps_wp_get_root_folder();
	$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR );
	$bps_root_upgrade = '';

	$patterna = '/RedirectMatch\s403\s\/\\\.\.\*\$/';
	$pattern0 = '/ErrorDocument\s404\s(.*)\/404\.php\s*ErrorDocument\s410\s(.*)410\.php/s';		
	$pattern1 = '/#\sFORBID\sEMPTY\sREFFERER\sSPAMBOTS(.*)RewriteCond\s%{HTTP_USER_AGENT}\s\^\$\sRewriteRule\s\.\*\s\-\s\[F\]/s';	
	// Only match 2 or more identical duplicate referer lines: 1 will not match and 2, 3, 4... will match
	$pattern2 = '/AnotherWebsite\.com\)\.\*\s*(RewriteCond\s%\{HTTP_REFERER\}\s\^\.\*'.$bps_get_domain_root.'\.\*\s*){2,}\s*RewriteRule\s\.\s\-\s\[S=1\]/s';
	$pattern4 = '/\.\*\(allow_url_include\|allow_url_fopen\|safe_mode\|disable_functions\|auto_prepend_file\) \[NC,OR\]/s';
	$pattern6 = '/(\[|\]|\(|\)|<|>|%3c|%3e|%5b|%5d)/s';
	$pattern7 = '/RewriteCond %{QUERY_STRING} \^\.\*(.*)[3](.*)[5](.*)[5](.*)[7](.*)\)/';
	$pattern8 = '/\[NC\]\s*RewriteCond\s%{HTTP_REFERER}\s\^\.\*(.*)\.\*\s*(.*)\s*(.*)\s*(.*)\s*(.*)\s*(.*)\s*RewriteRule\s\.\s\-\s\[S=1\]/';
	$pattern9 = '/RewriteCond\s%{QUERY_STRING}\s\(sp_executesql\)\s\[NC\]\s*(.*)\s*(.*)END\sBPSQSE(.*)\s*RewriteCond\s%{REQUEST_FILENAME}\s!-f\s*RewriteCond\s%{REQUEST_FILENAME}\s!-d\s*RewriteRule\s\.(.*)\/index\.php\s\[L\]\s*(.*)LOOP\sEND/';
	$pattern10 = '/#\sBEGIN\sBPSQSE\sBPS\sQUERY\sSTRING\sEXPLOITS\s*#\sThe\slibwww-perl\sUser\sAgent\sis\sforbidden/';
	$pattern10a = '/RewriteCond\s%\{THE_REQUEST\}\s(.*)\?(.*)\sHTTP\/\s\[NC,OR\]\s*RewriteCond\s%\{THE_REQUEST\}\s(.*)\*(.*)\sHTTP\/\s\[NC,OR\]/';
	$pattern10b = '/RewriteCond\s%\{THE_REQUEST\}\s.*\?\+\(%20\{1,\}.*\s*RewriteCond\s%\{THE_REQUEST\}\s.*\+\(.*\*\|%2a.*\s\[NC,OR\]/';	
	$pattern10c = '/RewriteCond\s%\{THE_REQUEST\}\s\(\\\\?.*%2a\)\+\(%20\+\|\\\\s\+.*HTTP\(:\/.*\[NC,OR\]/';
	$pattern11 = '/RewriteCond\s%\{QUERY_STRING\}\s\[a-zA-Z0-9_\]\=http:\/\/\s\[OR\]/';
	$pattern12 = '/RewriteCond\s%\{QUERY_STRING\}\s\[a-zA-Z0-9_\]\=\(\\\.\\\.\/\/\?\)\+\s\[OR\]/';
	$pattern13 = '/RewriteCond\s%\{QUERY_STRING\}\s\(\\\.\\\.\/\|\\\.\\\.\)\s\[OR\]/';
	$pattern14 = '/RewriteCond\s%{QUERY_STRING}\s\(\\\.\/\|\\\.\.\/\|\\\.\.\.\/\)\+\(motd\|etc\|bin\)\s\[NC,OR\]/';
	$pattern_amod = '/#\sDENY\sBROWSER\sACCESS\sTO\sTHESE\sFILES(.*\s*){6,8}<FilesMatch(.*)wp-config(.*\s*){4,6}<\/FilesMatch>/';
	$pattern15 = '/BPS\sPOST\sRequest\sAttack\sProtection/';
	$pattern16 = '/#\sNEVER\sCOMMENT\sOUT\sTHIS\sLINE\sOF\sCODE\sBELOW\sFOR\sANY\sREASON(\s*){1}RewriteCond\s%\{REQUEST_URI\}\s\!\^\.\*\/wp-admin\/\s\[NC\]/';

	$BPSVpattern = '/BULLETPROOF\s\.[\d](.*)[\>]/';
	$BPSVreplace = "BULLETPROOF $bps_version >>>>>>>";

	// Setup Wizard added in BPS .51.8: 
	// BPS Upgrade: Save the Setup Wizard DB option automatically on BPS plugin upgrade.
	// New BPS Installation: Display Setup Wizard Notice.
	// Manual Setup: Save the Setup Wizard DB option if BPS is setup manually instead of using the Setup Wizard.
	if ( ! file_exists($filename) ) {
		
		// Setup Wizard Notice:
		if ( ! get_option('bulletproof_security_options_wizard_free') ) {
			
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('BPS Setup Wizard Notification', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/wizard/wizard.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the BPS Setup Wizard page and click the Setup Wizard button to setup the BPS plugin.', 'bulletproof-security').'</div>';
			echo $text;			

		} else {
		
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('BPS Alert! An htaccess file was NOT found in your WordPress root folder', 'bulletproof-security').'</font><br>'.__('If you have deleted the root htaccess file for troubleshooting purposes you can disregard this Alert.', 'bulletproof-security').'<br>'.__('After you are done troubleshooting ', 'bulletproof-security').'</font><a href="admin.php?page=bulletproof-security/admin/wizard/wizard.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the BPS Setup Wizard page and click the Setup Wizard button to setup the BPS plugin again.', 'bulletproof-security').'<br>'.__('Important Note: If you deleted the root htaccess file due to bad/invalid Root Custom Code causing a problem then ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/core.php#bps-tabs-7">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the BPS Custom Code page, delete the bad/invalid Root Custom Code and click the Save Root Custom Code button before running the Setup Wizard again.', 'bulletproof-security').'</div>';
			echo $text;
		}
	
	} else {
	
	if ( file_exists($filename) ) {

switch ( $bps_version ) {
    case $bps_last_version: // for testing
		if ( strpos( $check_string, "BULLETPROOF $bps_last_version" ) && strpos( $check_string, "BPSQSE" ) ) {
			print($section);
		}
		break; 
    case ! strpos( $check_string, "BULLETPROOF" ) && ! strpos( $check_string, "DEFAULT" ):
	
		// Setup Wizard Notice
		if ( ! get_option('bulletproof_security_options_wizard_free') ) {
				
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('BPS Setup Wizard Notification', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/wizard/wizard.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the BPS Setup Wizard page and click the Setup Wizard button to setup the BPS plugin.', 'bulletproof-security').'</div>';
			echo $text;			
		
		} else {

			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('BPS Alert! Your site may not be protected by BulletProof Security', 'bulletproof-security').'</font><br>'.__('The BPS version: BULLETPROOF .xx.x >>>>>>> SECURE .HTACCESS line of code was not found at the top of your Root htaccess file.', 'bulletproof-security').'<br>'.__('The BPS version line of code MUST be at the very top of your Root htaccess file.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/wizard/wizard.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the BPS Setup Wizard page and click the Setup Wizard button to setup the BPS plugin again.', 'bulletproof-security').'<br>'.__('Important Note: If you manually added other htaccess code above the BPS version line of code in your root htaccess file, you can copy that code to BPS Root Custom Code so that your code is saved in the correct place in the BPS root htaccess file. ', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/core/core.php#bps-tabs-7">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the BPS Custom Code page, add your Root custom htaccess code in an appropriate Root Custom Code text box and click the Save Root Custom Code button before running the Setup Wizard again.', 'bulletproof-security').'</div>';
			echo $text;
		}

		break;	
	case ! strpos( $check_string, "BULLETPROOF $bps_version" ) && strpos( $check_string, "BPSQSE" ):
	
			// delete the old Maintenance Mode DB option - added in BPS .49.9
			if ( get_option('bulletproof_security_options_maint') ) {	
				delete_option('bulletproof_security_options_maint');
			}			
			// Recreate the User Agent filters in the 403.php file on BPS upgrade
			bpsPro_autoupdate_useragent_filters();
			// mod_authz_core forward/backward compatibility: create new htaccess files if needed
			bpsPro_apache_mod_directive_check();
			$Apache_Mod_options = get_option('bulletproof_security_options_apache_modules');
			$BPSCustomCodeOptions = get_option('bulletproof_security_options_customcode');
			// Delete all the old plugin api junk content in this transient
			delete_transient( 'bulletproof-security_info' );
			// Update/Add/Save any New DB options/features on upgrade
			bpsPro_new_feature_autoupdate();
			// Save the Setup Wizard DB option only if it does not already exist
			$bps_setup_wizard = 'bulletproof_security_options_wizard_free';
			$BPS_Wizard = array( 'bps_wizard_free' => 'upgrade' );	
	
			if ( ! get_option( $bps_setup_wizard ) ) {	
		
				foreach( $BPS_Wizard as $key => $value ) {
					update_option('bulletproof_security_options_wizard_free', $BPS_Wizard);
				}
			}
			
			if ( @substr($sapi_type, 0, 6) != 'apache' || @$permsHtaccess != '0666' || @$permsHtaccess != '0777') { // Windows IIS, XAMPP, etc
				@chmod($filename, 0644);
			}			

			$stringReplace = @file_get_contents($filename);
			$stringReplace = preg_replace($BPSVpattern, $BPSVreplace, $stringReplace);	
			
			$stringReplace = str_replace("RewriteCond %{HTTP_USER_AGENT} (libwww-perl|wget|python|nikto|curl|scan|java|winhttp|clshttp|loader) [NC,OR]", "RewriteCond %{HTTP_USER_AGENT} (havij|libwww-perl|wget|python|nikto|curl|scan|java|winhttp|clshttp|loader) [NC,OR]", $stringReplace);
			
		if ( preg_match($patterna, $stringReplace, $matches) ) {
			$stringReplace = preg_replace('/#\sDENY\sACCESS\sTO\sPROTECTED\sSERVER\sFILES(.*)RedirectMatch\s403\s\/\\\.\.\*\$/s', "# DENY ACCESS TO PROTECTED SERVER FILES AND FOLDERS\n# Files and folders starting with a dot: .htaccess, .htpasswd, .errordocs, .logs\nRedirectMatch 403 \.(htaccess|htpasswd|errordocs|logs)$", $stringReplace);
		}

		if ( $BPSCustomCodeOptions['bps_customcode_error_logging'] == '' && ! preg_match( $pattern0, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/ErrorDocument\s404\s(.*)\/404\.php/s', "ErrorDocument 404 $bps_get_wp_root_secure"."404.php\nErrorDocument 410 $bps_get_wp_root_secure"."$bps_plugin_dir/bulletproof-security/410.php", $stringReplace);
		}

		if ( preg_match($pattern1, $stringReplace, $matches) ) {
			$stringReplace = preg_replace('/#\sFORBID\sEMPTY\sREFFERER\sSPAMBOTS(.*)RewriteCond\s%{HTTP_USER_AGENT}\s\^\$\sRewriteRule\s\.\*\s\-\s\[F\]/s', '', $stringReplace);
		}			
			
		if ( preg_match($pattern2, $stringReplace, $matches) ) {
			$stringReplace = preg_replace('/AnotherWebsite\.com\)\.\*\s*(RewriteCond\s%\{HTTP_REFERER\}\s\^\.\*'.$bps_get_domain_root.'\.\*\s*){2,}\s*RewriteRule\s\.\s\-\s\[S=1\]/s', "AnotherWebsite.com).*\nRewriteCond %{HTTP_REFERER} ^.*$bps_get_domain_root.*\nRewriteRule . - [S=1]", $stringReplace);
		}
		
		if ( ! preg_match($pattern10, $stringReplace, $matches) ) {
			$stringReplace = preg_replace('/#\sBPSQSE\sBPS\sQUERY\sSTRING\sEXPLOITS\s*#\sThe\slibwww-perl\sUser\sAgent\sis\sforbidden/', "# BEGIN BPSQSE BPS QUERY STRING EXPLOITS\n# The libwww-perl User Agent is forbidden", $stringReplace);
		}

		if ( preg_match($pattern10a, $stringReplace, $matches) ) {
			$stringReplace = preg_replace( $pattern10a, "RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\\s+|%20+\\\\\s+|\\\\\s+%20+|\\\\\s+%20+\\\\\s+)HTTP(:/|/) [NC,OR]", $stringReplace);
		}

		if ( preg_match($pattern10b, $stringReplace, $matches) ) {
			$stringReplace = preg_replace( $pattern10b, "RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\\s+|%20+\\\\\s+|\\\\\s+%20+|\\\\\s+%20+\\\\\s+)HTTP(:/|/) [NC,OR]", $stringReplace);
		}

		if ( preg_match($pattern10c, $stringReplace, $matches) ) {
			$stringReplace = preg_replace( $pattern10c, "RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\\s+|%20+\\\\\s+|\\\\\s+%20+|\\\\\s+%20+\\\\\s+)HTTP(:/|/) [NC,OR]", $stringReplace);
		}

		if ( preg_match($pattern11, $stringReplace, $matches) ) {
			$stringReplace = preg_replace('/RewriteCond\s%\{QUERY_STRING\}\s\[a-zA-Z0-9_\]\=http:\/\/\s\[OR\]/s', "RewriteCond %{QUERY_STRING} [a-zA-Z0-9_]=http:// [NC,OR]", $stringReplace);
		}

		if ( preg_match($pattern12, $stringReplace, $matches) ) {
			$stringReplace = preg_replace('/RewriteCond\s%\{QUERY_STRING\}\s\[a-zA-Z0-9_\]\=\(\\\.\\\.\/\/\?\)\+\s\[OR\]/s', "RewriteCond %{QUERY_STRING} [a-zA-Z0-9_]=(\.\.//?)+ [NC,OR]", $stringReplace);
		}

		if ( preg_match($pattern13, $stringReplace, $matches) ) {
			$stringReplace = preg_replace('/RewriteCond\s%\{QUERY_STRING\}\s\(\\\.\\\.\/\|\\\.\\\.\)\s\[OR\]/s', "RewriteCond %{QUERY_STRING} (\.\./|%2e%2e%2f|%2e%2e/|\.\.%2f|%2e\.%2f|%2e\./|\.%2e%2f|\.%2e/) [NC,OR]", $stringReplace);
		}

		if ( preg_match($pattern6, $stringReplace, $matches)) {
			$stringReplace = str_replace("RewriteCond %{QUERY_STRING} ^.*(\[|\]|\(|\)|<|>|%3c|%3e|%5b|%5d).* [NC,OR]", "RewriteCond %{QUERY_STRING} ^.*(\(|\)|<|>|%3c|%3e).* [NC,OR]", $stringReplace);
			$stringReplace = str_replace("RewriteCond %{QUERY_STRING} ^.*(\x00|\x04|\x08|\x0d|\x1b|\x20|\x3c|\x3e|\x5b|\x5d|\x7f).* [NC,OR]", "RewriteCond %{QUERY_STRING} ^.*(\x00|\x04|\x08|\x0d|\x1b|\x20|\x3c|\x3e|\x7f).* [NC,OR]", $stringReplace);		
		}
		
		if ( preg_match($pattern7, $stringReplace, $matches)) {
			$stringReplace = preg_replace('/RewriteCond %{QUERY_STRING} \^\.\*(.*)[5](.*)[5](.*)\)/', 'RewriteCond %{QUERY_STRING} ^.*(\x00|\x04|\x08|\x0d|\x1b|\x20|\x3c|\x3e|\x7f)', $stringReplace);
		}

		if ( preg_match($pattern14, $stringReplace, $matches) ) {
			$stringReplace = preg_replace('/RewriteCond\s%{QUERY_STRING}\s\(\\\.\/\|\\\.\.\/\|\\\.\.\.\/\)\+\(motd\|etc\|bin\)\s\[NC,OR\]/s', "RewriteCond %{QUERY_STRING} (\.{1,}/)+(motd|etc|bin) [NC,OR]", $stringReplace);
		}

		if ( ! preg_match($pattern4, $stringReplace, $matches) ) {
			$stringReplace = str_replace("RewriteCond %{QUERY_STRING} union([^a]*a)+ll([^s]*s)+elect [NC,OR]", "RewriteCond %{QUERY_STRING} union([^a]*a)+ll([^s]*s)+elect [NC,OR]\nRewriteCond %{QUERY_STRING} \-[sdcr].*(allow_url_include|allow_url_fopen|safe_mode|disable_functions|auto_prepend_file) [NC,OR]", $stringReplace);
		}

		if ( ! is_multisite() && ! preg_match($pattern9, $stringReplace, $matches) ) {
			$stringReplace = preg_replace('/RewriteCond\s%{QUERY_STRING}\s\(sp_executesql\)\s\[NC\]\s*(.*)\s*RewriteCond\s%{REQUEST_FILENAME}\s!-f\s*RewriteCond\s%{REQUEST_FILENAME}\s!-d\s*RewriteRule\s\.(.*)\/index\.php\s\[L\]/', "RewriteCond %{QUERY_STRING} (sp_executesql) [NC]\nRewriteRule ^(.*)$ - [F,L]\n# END BPSQSE BPS QUERY STRING EXPLOITS\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteRule . ".$bps_get_wp_root_secure."index.php [L]\n# WP REWRITE LOOP END", $stringReplace);
		}

		if ( preg_match( $pattern_amod, $stringReplace, $matches ) && $BPSCustomCodeOptions['bps_customcode_deny_files'] == '' && $Apache_Mod_options['bps_apache_mod_ifmodule'] == 'Yes' ) {
			
			$stringReplace = preg_replace( $pattern_amod, "# DENY BROWSER ACCESS TO THESE FILES\n# Use BPS Custom Code to modify/edit/change this code and to save it permanently.\n# wp-config.php, bb-config.php, php.ini, php5.ini, readme.html\n# To be able to view these files from a Browser, replace 127.0.0.1 with your actual\n# current IP address. Comment out: #Require all denied and Uncomment: Require ip 127.0.0.1\n# Comment out: #Deny from all and Uncomment: Allow from 127.0.0.1\n# Note: The BPS System Info page displays which modules are loaded on your server.\n\n<FilesMatch \"^(wp-config\.php|php\.ini|php5\.ini|readme\.html|bb-config\.php)\">\n<IfModule mod_authz_core.c>\nRequire all denied\n#Require ip 127.0.0.1\n</IfModule>\n\n<IfModule !mod_authz_core.c>\n<IfModule mod_access_compat.c>\nOrder Allow,Deny\nDeny from all\n#Allow from 127.0.0.1\n</IfModule>\n</IfModule>\n</FilesMatch>", $stringReplace);
		
		} elseif ( preg_match( $pattern_amod, $stringReplace, $matches ) && $BPSCustomCodeOptions['bps_customcode_deny_files'] == '' && $Apache_Mod_options['bps_apache_mod_ifmodule'] == 'No' ) {
			
			$stringReplace = preg_replace( $pattern_amod, "# DENY BROWSER ACCESS TO THESE FILES\n# Use BPS Custom Code to modify/edit/change this code and to save it permanently.\n# wp-config.php, bb-config.php, php.ini, php5.ini, readme.html\n# To be able to view these files from a Browser, replace 127.0.0.1 with your actual\n# current IP address. Comment out: #Deny from all and Uncomment: Allow from 127.0.0.1\n# Note: The BPS System Info page displays which modules are loaded on your server.\n\n<FilesMatch \"^(wp-config\.php|php\.ini|php5\.ini|readme\.html|bb-config\.php)\">\nOrder Allow,Deny\nDeny from all\n#Allow from 127.0.0.1\n</FilesMatch>", $stringReplace);	
		}

		// .52.9: POST Request Attack Protection code correction|addition
		if ( preg_match( $pattern15, $stringReplace, $matches ) && ! preg_match( $pattern16, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/RewriteCond\s%\{REQUEST_METHOD\}\sPOST\s\[NC\]/s', "RewriteCond %{REQUEST_METHOD} POST [NC]\n# NEVER COMMENT OUT THIS LINE OF CODE BELOW FOR ANY REASON\nRewriteCond %{REQUEST_URI} !^.*/wp-admin/ [NC]\n# Whitelist the WordPress Theme Customizer\nRewriteCond %{HTTP_REFERER} !^.*/wp-admin/customize.php", $stringReplace);
		}

		// Clean up - replace 3 and 4 multiple newlines with 1 newline
		if ( preg_match('/(\n\n\n|\n\n\n\n)/', $stringReplace, $matches) ) {			
			$stringReplace = preg_replace("/(\n\n\n|\n\n\n\n)/", "\n", $stringReplace);
		}
		// remove duplicate referer lines
		if ( preg_match($pattern8, $stringReplace, $matches) ) {
			$stringReplace = preg_replace("/\[NC\]\s*RewriteCond\s%{HTTP_REFERER}\s\^\.\*(.*)\.\*\s*(.*)\s*(.*)\s*(.*)\s*(.*)\s*(.*)\s*RewriteRule\s\.\s\-\s\[S=1\]/", "[NC]\nRewriteCond %{HTTP_REFERER} ^.*$bps_get_domain_root.*\nRewriteRule . - [S=1]", $stringReplace);
		}

		file_put_contents($filename, $stringReplace);
		
		if ( $options['bps_root_htaccess_autolock'] == 'On') {			
			@chmod($filename, 0404);
		}

		if ( getBPSInstallTime() == getBPSRootHtaccessLasModTime_minutes() || getBPSInstallTime_plusone() == getBPSRootHtaccessLasModTime_minutes() ) {
			
			$bps_root_upgrade = 'upgrade';
			
			$pos = strpos( $check_string, 'IMPORTANT!!! DO NOT DELETE!!! - B E G I N Wordpress' );
			
			if ( $pos === false ) {			
			
				$updateText = '<div class="update-nag" style="float:left;background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__("The BPS Automatic htaccess File Update Completed Successfully!", 'bulletproof-security').'</font></div>';
				print($updateText);				
			}
		}  // end up upgrade processing
		break;		
	case strpos( $check_string, "BULLETPROOF $bps_version" ) && strpos( $check_string, "BPSQSE" ):
		
		$bps_status_display = get_option('bulletproof_security_options_status_display');

		if ( $bps_status_display['bps_status_display'] != 'Off' ) {
					
			if ( preg_match( '/page=bulletproof-security/', esc_html($_SERVER['REQUEST_URI']), $matches ) ) {

				$RBM = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/core/core.php" title="Root Folder BulletProof Mode" style="text-decoration:none;">'.__('RBM', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
				$RBM_str = str_replace( "BULLETPROOF $bps_version >>>>>>> SECURE .HTACCESS", "BPS $bps_version $RBM", $section );
			
				echo '<div id="bps-status-display" style="float:left;font-weight:bold;margin:0px 0px 0px 5px;">'.$RBM_str.'</div>';		
			}
		}
		break;
	default:
		
		if ( $bps_root_upgrade != 'upgrade' ) {		
		
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('BPS Alert! Your site does not appear to be protected by BulletProof Security', 'bulletproof-security').'</font><br>'.__('Go to the ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/core.php">'.__('Security Modes page', 'bulletproof-security').'</a>'.__(' and click the Create secure.htaccess File AutoMagic button and Activate Root Folder BulletProof Mode.', 'bulletproof-security').'<br>'.__('If your site is in Default Mode then it is NOT protected by BulletProof Security. Check the BPS ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/core.php#bps-tabs-2">'.__('Security Status page', 'bulletproof-security').'</a>'.__(' to view your BPS Security Status information.', 'bulletproof-security').'</div>';
			echo $text;
		}
	}
	}
	}
	}
	}
}

add_action('admin_notices', 'bps_root_htaccess_status_dashboard');

// BPS Update/Upgrade Status Alert in WP Dashboard|Status Display in BPS pages only
function bps_wpadmin_htaccess_status_dashboard() {

	if ( current_user_can('manage_options') ) {

	global $bps_version, $bps_last_version, $aitpro_bullet;

	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {

	$BPS_wpadmin_Options = get_option('bulletproof_security_options_htaccess_res');
	
	if ( $BPS_wpadmin_Options['bps_wpadmin_restriction'] == 'disabled' ) {
		return;
	}

	$filename = ABSPATH . 'wp-admin/.htaccess';
	$permsHtaccess = @substr(sprintf('%o', fileperms($filename)), -4);	
	$check_string = @file_get_contents($filename);
	$section = @file_get_contents($filename, NULL, NULL, 3, 46);
	$bps_wpadmin_upgrade = '';	
	
	$pattern10a = '/RewriteCond\s%\{THE_REQUEST\}\s(.*)\?(.*)\sHTTP\/\s\[NC,OR\]\s*RewriteCond\s%\{THE_REQUEST\}\s(.*)\*(.*)\sHTTP\/\s\[NC,OR\]/';
	$pattern10b = '/RewriteCond\s%\{THE_REQUEST\}\s.*\?\+\(%20\{1,\}.*\s*RewriteCond\s%\{THE_REQUEST\}\s.*\+\(.*\*\|%2a.*\s\[NC,OR\]/';	
	$pattern10c = '/RewriteCond\s%\{THE_REQUEST\}\s\(\\\\?.*%2a\)\+\(%20\+\|\\\\s\+.*HTTP\(:\/.*\[NC,OR\]/';
	$pattern1 = '/(\[|\]|\(|\)|<|>)/s';
	$pattern_amod = '/#\sWPADMIN\sDENY\sBROWSER\sACCESS\sTO\sFILES(.*\s*){13,16}#\sEND\sBPS\sWPADMIN\sDENY\sACCESS\sTO\sFILES/';

	$BPSVpattern = '/BULLETPROOF\s\.[\d](.*)WP-ADMIN/';
	$BPSVreplace = "BULLETPROOF $bps_version WP-ADMIN";
	
	if ( ! file_exists($filename) ) {
	
		// Setup Wizard Notice: not displayed. The Setup Wizard DB option is automatically saved in the root htaccess funcion on BPS plugin upgrades.
		if ( ! get_option('bulletproof_security_options_wizard_free') ) {
		// display nothing. Notice is already displayed in the root htaccess function.
		} else {
		
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('BPS Alert! An htaccess file was NOT found in your WordPress wp-admin folder', 'bulletproof-security').'</font><br>'.__('If you have deleted the wp-admin htaccess file for troubleshooting purposes you can disregard this Alert.', 'bulletproof-security').'<br>'.__('After you are done troubleshooting ', 'bulletproof-security').'</font><a href="admin.php?page=bulletproof-security/admin/wizard/wizard.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the BPS Setup Wizard page and click the Setup Wizard button to setup the BPS plugin again.', 'bulletproof-security').'<br>'.__('Important Note: If you deleted the wp-admin htaccess file due to bad/invalid Custom Code causing a problem then ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/core.php#bps-tabs-7">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the BPS Custom Code page, delete the bad/invalid wp-admin Custom Code and click the Save wp-admin Custom Code button before running the Setup Wizard again.', 'bulletproof-security').'</div>';
			echo $text;
		}	
	
	} else {
	
	if ( file_exists($filename) ) {

switch ( $bps_version ) {
    case $bps_last_version: // for Testing
		if ( strpos( $check_string, "BULLETPROOF $bps_last_version" ) && strpos( $check_string, "BPSQSE-check" ) ) {
			// echo or print for testing
		}
		break;
    case ! strpos( $check_string, "BULLETPROOF" ):

		// Setup Wizard Notice: not displayed. The Setup Wizard DB option is automatically saved in the root htaccess funcion on BPS plugin upgrades.
		if ( ! get_option('bulletproof_security_options_wizard_free') ) {
		// display nothing. Notice is already displayed in the root htaccess function.	
		
		} else {

			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('BPS Alert! Your wp-admin folder may not be protected by BulletProof Security', 'bulletproof-security').'</font><br>'.__('he BPS version: BULLETPROOF .xx.x WP-ADMIN SECURE .HTACCESS line of code was not found at the top of your wp-admin htaccess file.', 'bulletproof-security').'<br>'.__('The BPS version line of code MUST be at the very top of your wp-admin htaccess file.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/wizard/wizard.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the BPS Setup Wizard page and click the Setup Wizard button to setup the BPS plugin again.', 'bulletproof-security').'<br>'.__('Important Note: If you manually added other htaccess code above the BPS version line of code in your wp-admin htaccess file, you can copy that code to BPS wp-admin Custom Code so that your code is saved in the correct place in the BPS wp-admin htaccess file. ', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/core/core.php#bps-tabs-7">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the BPS Custom Code page, add your wp-admin custom htaccess code in an appropriate wp-admin Custom Code text box and click the Save wp-admin Custom Code button before running the Setup Wizard again.', 'bulletproof-security').'</div>';
			echo $text;
		}

		break;
	case ! strpos( $check_string, "BULLETPROOF $bps_version" ) && strpos( $check_string, "BPSQSE-check" ):
			
			// mod_authz_core forward/backward compatibility: create new htaccess files if needed
			bpsPro_apache_mod_directive_check();
			$CC_Options_wpadmin = get_option('bulletproof_security_options_customcode_WPA');
			$Apache_Mod_options = get_option('bulletproof_security_options_apache_modules');

			if ( @substr($sapi_type, 0, 6) != 'apache' || @$permsHtaccess != '0666' || @$permsHtaccess != '0777') { // Windows IIS, XAMPP, etc
				@chmod($filename, 0644);
			}
			
			$stringReplace = @file_get_contents($filename);
			$stringReplace = preg_replace($BPSVpattern, $BPSVreplace, $stringReplace);	

		if ( preg_match( $pattern_amod, $stringReplace, $matches ) && $CC_Options_wpadmin['bps_customcode_deny_files_wpa'] == '' && $Apache_Mod_options['bps_apache_mod_ifmodule'] == 'Yes' ) {
			
			$stringReplace = preg_replace( $pattern_amod, "# WPADMIN DENY BROWSER ACCESS TO FILES\n# Deny Browser access to /wp-admin/install.php\n# Use BPS Custom Code to modify/edit/change this code and to save it permanently.\n# To be able to view the install.php file from a Browser, replace 127.0.0.1 with your actual\n# current IP address. Comment out: #Require all denied and Uncomment: Require ip 127.0.0.1\n# Comment out: #Deny from all and Uncomment: Allow from 127.0.0.1\n# Note: The BPS System Info page displays which modules are loaded on your server.\n\n# BEGIN BPS WPADMIN DENY ACCESS TO FILES\n<FilesMatch \"^(install\.php)\">\n<IfModule mod_authz_core.c>\nRequire all denied\n#Require ip 127.0.0.1\n</IfModule>\n\n<IfModule !mod_authz_core.c>\n<IfModule mod_access_compat.c>\nOrder Allow,Deny\nDeny from all\n#Allow from 127.0.0.1\n</IfModule>\n</IfModule>\n</FilesMatch>\n# END BPS WPADMIN DENY ACCESS TO FILES", $stringReplace);
		
		} elseif ( preg_match( $pattern_amod, $stringReplace, $matches ) && $CC_Options_wpadmin['bps_customcode_deny_files_wpa'] == '' && $Apache_Mod_options['bps_apache_mod_ifmodule'] == 'No' ) {
			
			$stringReplace = preg_replace( $pattern_amod, "# WPADMIN DENY BROWSER ACCESS TO FILES\n# Deny Browser access to /wp-admin/install.php\n# Use BPS Custom Code to modify/edit/change this code and to save it permanently.\n# To be able to view the install.php file from a Browser, replace 127.0.0.1 with your actual\n# current IP address. Comment out: #Deny from all and Uncomment: Allow from 127.0.0.1\n# Note: The BPS System Info page displays which modules are loaded on your server.\n\n# BEGIN BPS WPADMIN DENY ACCESS TO FILES\n<FilesMatch \"^(install\.php)\">\nOrder Allow,Deny\nDeny from all\n#Allow from 127.0.0.1\n</FilesMatch>\n# END BPS WPADMIN DENY ACCESS TO FILES", $stringReplace);	
		}

		if ( preg_match($pattern10a, $stringReplace, $matches) ) {
			$stringReplace = preg_replace( $pattern10a, "RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\\s+|%20+\\\\\s+|\\\\\s+%20+|\\\\\s+%20+\\\\\s+)HTTP(:/|/) [NC,OR]", $stringReplace);
		}

		if ( preg_match($pattern10b, $stringReplace, $matches) ) {
			$stringReplace = preg_replace( $pattern10b, "RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\\s+|%20+\\\\\s+|\\\\\s+%20+|\\\\\s+%20+\\\\\s+)HTTP(:/|/) [NC,OR]", $stringReplace);
		}

		if ( preg_match($pattern10c, $stringReplace, $matches) ) {
			$stringReplace = preg_replace( $pattern10c, "RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\\s+|%20+\\\\\s+|\\\\\s+%20+|\\\\\s+%20+\\\\\s+)HTTP(:/|/) [NC,OR]", $stringReplace);
		}

		if ( preg_match($pattern1, $stringReplace, $matches) ) {
			$stringReplace = str_replace("RewriteCond %{QUERY_STRING} ^.*(\[|\]|\(|\)|<|>).* [NC,OR]", "RewriteCond %{QUERY_STRING} ^.*(\(|\)|<|>).* [NC,OR]", $stringReplace);		
		}

			file_put_contents($filename, $stringReplace);
		
		if ( getBPSInstallTime() == getBPSwpadminHtaccessLasModTime_minutes() || getBPSInstallTime_plusone() == getBPSwpadminHtaccessLasModTime_minutes() ) {
			//print("Testing wp-admin auto-update");	
			$bps_wpadmin_upgrade = 'upgrade';
		} // end upgrade processing		
		break;		
	case strpos( $check_string, "BULLETPROOF $bps_version" ) && strpos( $check_string, "BPSQSE-check" ):		
		
		$bps_status_display = get_option('bulletproof_security_options_status_display');

		if ( $bps_status_display['bps_status_display'] != 'Off' ) {		

			if ( preg_match( '/page=bulletproof-security/', esc_html($_SERVER['REQUEST_URI']), $matches ) ) {

				$WBM = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/core/core.php#WBM-Link" title="wp-admin Folder BulletProof Mode" style="text-decoration:none;">'.__('WBM', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
				$WBM_str = str_replace( "BULLETPROOF $bps_version WP-ADMIN SECURE .HTACCESS", "$WBM", $section );			
			
				echo '<div id="bps-status-display" style="float:left;font-weight:bold;margin:0px;">'.$WBM_str.'</div>';
			}
		}
		break;
	default:
		
		if ( $bps_wpadmin_upgrade != 'upgrade' ) {		
		
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('BPS Alert! A valid BPS htaccess file was NOT found in your wp-admin folder', 'bulletproof-security').'</font><br>'.__('BulletProof Mode for the wp-admin folder should also be activated when you have BulletProof Mode activated for the Root folder.', 'bulletproof-security').'<br>'.__('Check the BPS ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/core.php#bps-tabs-2">'.__('Security Status page', 'bulletproof-security').'</a>'.__(' to view your BPS Security Status information.', 'bulletproof-security').'</div>';
		echo $text;
		}
	}
	}
	}
	}
	}
}

add_action('admin_notices', 'bps_wpadmin_htaccess_status_dashboard');

// Login Security Status display - BPS pages ONLY
function bps_Login_Security_admin_notice_status_bps() {
global $aitpro_bullet;
	
	if ( current_user_can('manage_options') ) {
	
	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {

	$bps_status_display = get_option('bulletproof_security_options_status_display');

	if ( $bps_status_display['bps_status_display'] == 'Off' ) {
		return;
	}

		if ( $bps_status_display['bps_status_display'] != 'Off' && preg_match( '/page=bulletproof-security/', esc_html($_SERVER['REQUEST_URI']), $matches ) ) {

			// New BPS installation - do not display status
			if ( ! get_option('bulletproof_security_options_wizard_free') ) { 
				return;
			}

			$BPSoptions = get_option('bulletproof_security_options_login_security');	

			if ( $BPSoptions['bps_login_security_OnOff'] == 'On' ) {
				$text = '<div id="bps-status-display" style="float:left;font-weight:bold;margin:0px;">' . $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/login/login.php" title="Login Security & Monitoring" style="text-decoration:none;">'.__('LSM', 'bulletproof-security').'</a>: <font color="green">'.__('On', 'bulletproof-security').'</font></div>';
				echo $text;
			}

			if ( ! $BPSoptions['bps_login_security_OnOff'] || $BPSoptions['bps_login_security_OnOff'] == 'Off' || $BPSoptions['bps_login_security_OnOff'] == '' || $BPSoptions['bps_login_security_OnOff'] == 'pwreset' ) {
				$text = '<div id="bps-status-display" style="float:left;font-weight:bold;margin:0px;">' . $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/login/login.php" title="Login Security & Monitoring" style="text-decoration:none;">'.__('LSM', 'bulletproof-security').'</a>: <font color="red">'.__('Off', 'bulletproof-security').'</font></div>';
				echo $text;
			}
		}
	}
	}
}

add_action('admin_notices', 'bps_Login_Security_admin_notice_status_bps');

// DB Backup Status display BPS pages only
// First time installations and upgrades the DB option bps_db_backup_status_display has value "No DB Backups"
// When a Backup Job is created for the first time the value is "Backup Job Created" - one time/one-shot option
// All DB Backup options are automatically created and saved for new installations and upgrades
function bpsProDBBStatus() {

	if ( current_user_can('manage_options') ) {
	
	global $aitpro_bullet;
	
	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {

	$bps_status_display = get_option('bulletproof_security_options_status_display');

	if ( $bps_status_display['bps_status_display'] == 'Off' ) {
		return;
	}

		if ( $bps_status_display['bps_status_display'] != 'Off' && preg_match( '/page=bulletproof-security/', esc_html($_SERVER['REQUEST_URI']), $matches ) ) {	
	
			// New BPS installation - do not display status
			if ( ! get_option('bulletproof_security_options_wizard_free') ) { 
				return;
			}

			$DBBoptions = get_option('bulletproof_security_options_db_backup');	
	
			if ( $DBBoptions['bps_db_backup_status_display'] == 'No DB Backups' ) {
		
				$text = '<div id="bps-status-display" style="float:left;font-weight:bold;margin:0px;">' . $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/db-backup-security/db-backup-security.php" title="Database Backup" style="text-decoration:none;">'.__('DBB', 'bulletproof-security').'</a>: <font color="blue"><strong>'.__('No DB Backups', 'bulletproof-security').'</strong></font></div><div style="clear:right;"></div>';
				echo $text;
	
			} elseif ( $DBBoptions['bps_db_backup_status_display'] == 'Backup Job Created' ) {
		
				$text = '<div id="bps-status-display" style="float:left;font-weight:bold;margin:0px;">' . $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/db-backup-security/db-backup-security.php" title="Database Backup" style="text-decoration:none;">'.__('DBB', 'bulletproof-security').'</a>: <font color="blue"><strong>'.__('Backup Job Created', 'bulletproof-security').'</strong></font></div><div style="clear:right;"></div>';
				echo $text;		
	
			} else {
		
				$text = '<div id="bps-status-display" style="float:left;font-weight:bold;margin:0px;">' . $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/db-backup-security/db-backup-security.php" title="Database Backup" style="text-decoration:none;">'.__('DBB', 'bulletproof-security').'</a>: <font color="green"><strong>'.$DBBoptions['bps_db_backup_status_display'].'</strong></font></div><div style="clear:right;"></div>';
				echo $text;
			}
		}
	}
	}
}
add_action('admin_notices', 'bpsProDBBStatus');

// GET HTTP Status Response from /mod-test/ images to determine which Apache Modules are Loaded, 
// Directive Backward Compatibility & if Host is allowing/processing IfModule conditions (Known Hosts: HostGator).
// System Info page updates the DB option on page load in real-time, but does not create htaccess files. 
// htaccess Core updates/creates the DB option and creates htaccess files if needed inpage on page load based on timestamp: once per 15 minute time restriction.
// BPS plugin upgrades & Pre-Installation Wizard checks: new htaccess files created if needed.
// bpsPro_apache_mod_create_htaccess_files() executed in this function which creates new htaccess files if needed.
// BPS 52.6: fallback to mod_access_compat for everything else under the sun 
function bpsPro_apache_mod_directive_check() {
	
	if ( current_user_can('manage_options') ) {

	if ( esc_html($_SERVER['QUERY_STRING']) == 'page=bulletproof-security/admin/system-info/system-info.php' ) {

	// 2: 403: mod_access_compat Module IS loaded. "Deny from all". Allows "Order, Deny, Allow" directives
	$url2 = plugins_url( '/bulletproof-security/admin/mod-test/mod_access_compat-od-denied.png' );
	// 3: 403: mod_authz_core Module IS loaded. "Require all denied" Conditional
	$url3 = plugins_url( '/bulletproof-security/admin/mod-test/mod_authz_core-denied.png' );
	// 4: 403: mod_authz_core|mod_access_compat Order Directive Denied Conditional
	$url4 = plugins_url( '/bulletproof-security/admin/mod-test/mod_authz_core-od-cond-denied.png' );
	// 5: 403: mod_authz_host Module IS loaded. "Require ip 127.9.9.1" Conditional
	$url5 = plugins_url( '/bulletproof-security/admin/mod-test/mod_authz_host-require-ip.png' );	
	// 6: 403: mod_authz_host|mod_access_compat Order Directive Denied Conditional
	$url6 = plugins_url( '/bulletproof-security/admin/mod-test/mod_authz_host-od-cond-denied.png' );
	// 8: 403: mod_access_compat: No IfModule Condition Order Directive Deny from all
	// if 2 is a 200 response and 8 is a 403 response then the host is not allowing/processing IfModule conditions
	$url8 = plugins_url( '/bulletproof-security/admin/mod-test/mod_access_compat-od-nc-denied.png' );	
	
	$view_test_page = plugins_url( '/bulletproof-security/admin/mod-test/' );
	$url_array = array( $url2, $url3, $url4, $url5, $url6, $url8 );
	
	echo '<strong>'.__('Apache Modules|Directives|Backward Compatibility(Yes|No)|IfModule(Yes|No)', 'bulletproof-security').': <a href="'.$view_test_page.'" target="_blank" title="Apache Module and Directives test page">View Visual Test</a></strong><br>';
	
	foreach ( $url_array as $key => $value ) {
		
		$response = wp_remote_get( $value );
	
		if ( ! is_wp_error( $response ) ) {	

			if ( $key == 0 ) { // 2
				$status_code2 = $response['response']['code'];
			}
		
			if ( $key == 1 ) { // 3
				$status_code3 = $response['response']['code'];
			}

			if ( $key == 2 ) { // 4
				$status_code4 = $response['response']['code'];
			}

			if ( $key == 3 ) { // 5
				$status_code5 = $response['response']['code'];			
			}		
		
			if ( $key == 4 ) { // 6
				$status_code6 = $response['response']['code'];
			}

			if ( $key == 5 ) { // 8
				$status_code8 = $response['response']['code'];
			}
		
		} else {
		
			$text = '<font color="red"><strong>'.__('ERROR: wp_remote_get() function is blocked or unable to get the URL path', 'bulletproof-security').'</strong></font><br>';
			echo $text;;
		}
	}
			
	// mod_access_compat loaded, IfModule condition working, Order, Allow, Deny directives are supported
	if ( 403 == $status_code2 && 403 == $status_code8 ) {

		$apache_ifmodule = 'Yes';
		
		$text = '<strong>'.__('mod_access_compat is Loaded|Order, Allow, Deny directives are supported|IfModule: Yes', 'bulletproof-security').'</strong><br>';
		echo $text;				
			
	} elseif ( 403 != $status_code2 && 403 == $status_code8 ) {
		
		$apache_ifmodule = 'No';
		
		$text = '<strong>'.$status_code2.': '.__('mod_access_compat is Loaded|Order, Allow, Deny directives are supported|IfModule: No', 'bulletproof-security').'</strong><br>';
		echo $text;				
			
	} else { // BPS 52.6: for everything else under the sun use mod_access_compat code as a fallback
				
		$apache_ifmodule = 'No';

		$text = '<strong>'.$status_code8.': '.__('mod_access_compat is NOT Loaded|Order, Allow, Deny directives are NOT supported', 'bulletproof-security').'</strong><br>';
		echo $text;

	}

	// mod_authz_core loaded, IfModule condition working, Order, Allow, Deny directives are supported			
	if ( 403 == $status_code3 && 403 == $status_code4 ) {
				
		$text = '<strong>'.__('mod_authz_core is Loaded|Order, Allow, Deny directives are supported|BC: Yes|IfModule: Yes', 'bulletproof-security').'</strong><br>';
		echo $text;
				
	} elseif ( 403 == $status_code3 && 403 != $status_code4 ) {
			
		$text = '<strong>'.__('mod_authz_core is Loaded|Order, Allow, Deny directives are NOT supported|BC: No|IfModule: Yes', 'bulletproof-security').'</strong><br>';
		echo $text;		
			
	} elseif ( 403 != $status_code2 && 403 != $status_code3 && 403 != $status_code4 && 403 == $status_code8 ) {
				// IfModule: No
		$text = '<strong>'.$status_code3.': '.__('mod_authz_core Inconclusive: IfModule condition is not allowed/processed by Host Server', 'bulletproof-security').'</strong><br>';
		echo $text;				
			
	} else {
				
		$text = '<strong>'.__('mod_authz_core is NOT Loaded', 'bulletproof-security').'</strong><br>';
		echo $text;	

	}

	// mod_authz_host loaded, IfModule condition working, Order, Allow, Deny directives are supported			
	if ( 403 == $status_code5 && 403 == $status_code6 ) {
				
		$text = '<strong>'.__('mod_authz_host is Loaded|Order, Allow, Deny directives are supported|BC: Yes|IfModule: Yes', 'bulletproof-security').'</strong><br>';
		echo $text;
				
	} elseif ( 403 == $status_code5 && 403 != $status_code6 ) {
			
		$text = '<strong>'.__('mod_authz_host is Loaded|Order, Allow, Deny directives are NOT supported|BC: No|IfModule: Yes', 'bulletproof-security').'</strong><br>';
		echo $text;		
			
	} elseif ( 403 != $status_code2 && 403 != $status_code5 && 403 != $status_code5 && 403 == $status_code8 ) {
		// IfModule: No			
		$text = '<strong>'.$status_code5.': '.__('mod_authz_host Inconclusive: IfModule condition is not allowed/processed by Host Server', 'bulletproof-security').'</strong><br>';
		echo $text;				
			
	} else {
				
		$text = '<strong>'.__('mod_authz_host is NOT Loaded', 'bulletproof-security').'</strong><br>';
		echo $text;	
	}

		$apache_modules_Options = array(
		'bps_apache_mod_ifmodule' 	=> $apache_ifmodule, 
		'bps_apache_mod_time' 		=> time() + 900 
		);

		foreach( $apache_modules_Options as $key => $value ) {
			update_option('bulletproof_security_options_apache_modules', $apache_modules_Options);
		}	

	} else { // inpage BPS check & create db options and new htaccess files during BPS upgrade & Pre-Installation Wizard checks

		// 2: 403: mod_access_compat Module IS loaded. "Deny from all". Allows "Order, Deny, Allow" directives
		$url2 = plugins_url( '/bulletproof-security/admin/mod-test/mod_access_compat-od-denied.png' );
		// 8: 403: mod_access_compat: No IfModule Condition Order Directive Deny from all
		// if 2 is a 200 response and 8 is a 403 response then the host is not allowing/processing IfModule conditions
		$url8 = plugins_url( '/bulletproof-security/admin/mod-test/mod_access_compat-od-nc-denied.png' );	
	
		$url_array = array( $url2, $url8 );

		$Apache_Mod_options = get_option('bulletproof_security_options_apache_modules');
		
		// Note: if the db option does not exist yet it is created: time now is greater than nothing
		if ( time() < $Apache_Mod_options['bps_apache_mod_time'] ) {
			// do nothing
	
		} else {		 
		
			foreach ( $url_array as $key => $value ) {
		
				$response = wp_remote_get( $value );
	
				if ( ! is_wp_error( $response ) ) {	

					if ( $key == 0 ) { // 2
						$status_code2 = $response['response']['code'];
					}

					if ( $key == 1 ) { // 8
						$status_code8 = $response['response']['code'];
					}
				}
			}
			
			// mod_access_compat loaded, IfModule condition working, Order, Allow, Deny directives are supported
			// BPS 52.6: for everything else under the sun use mod_access_compat code as a fallback 
			if ( 403 == $status_code2 && 403 == $status_code8 ) {

				$apache_ifmodule = 'Yes';
			
			} else { 
		
				$apache_ifmodule = 'No';
			}

			$apache_modules_Options = array(
			'bps_apache_mod_ifmodule' 	=> $apache_ifmodule, 
			'bps_apache_mod_time' 		=> time() + 900 
			);

			foreach( $apache_modules_Options as $key => $value ) {
				update_option('bulletproof_security_options_apache_modules', $apache_modules_Options);
			}		
		
			bpsPro_apache_mod_create_htaccess_files();
		} // end if ( time() < $Apache_Mod_options['bps_apache_mod_time'] ) {
	}
	}
}

// Creates htaccess files based on bps_apache_mod_ifmodule DB value
// 11 htaccess files total
function bpsPro_apache_mod_create_htaccess_files() {

	if ( is_admin() && current_user_can('manage_options') ) {

	$denyall_htaccess = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/deny-all.htaccess';
	$denyall_ifmodule_htaccess = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/deny-all-ifmodule.htaccess';	

	$bps_backup = WP_CONTENT_DIR . '/bps-backup/.htaccess';
	$bps_master_backups = WP_CONTENT_DIR . '/bps-backup/master-backups/.htaccess';
	$bpsPro_pf = WP_PLUGIN_DIR . '/bulletproof-security/';
	$core1 = $bpsPro_pf  . 'admin/core/.htaccess';
	$core2 = $bpsPro_pf  . 'admin/db-backup-security/.htaccess';
	$core3 = $bpsPro_pf  . 'admin/htaccess/.htaccess';
	$core4 = $bpsPro_pf  . 'admin/login/.htaccess';
	$core5 = $bpsPro_pf . 'admin/maintenance/.htaccess';
	$core6 = $bpsPro_pf . 'admin/security-log/.htaccess';
	$core7 = $bpsPro_pf . 'admin/system-info/.htaccess';
	$core8 = $bpsPro_pf . 'admin/theme-skin/.htaccess';	
	$core9 = $bpsPro_pf . 'admin/wizard/.htaccess';	
	
		$files = array( $bps_backup, $bps_master_backups, $core1, $core2, $core3, $core4, $core5, $core6, $core7, $core8, $core9 );
	
		$Apache_Mod_options = get_option('bulletproof_security_options_apache_modules');

		foreach ( $files as $file ) {

			$check_string = @file_get_contents($file);
		
			if ( $Apache_Mod_options['bps_apache_mod_ifmodule'] == 'Yes' && ! strpos( $check_string, "BPS mod_authz_core IfModule BC" ) ) {
				@copy($denyall_ifmodule_htaccess, $file);
			} elseif ( $Apache_Mod_options['bps_apache_mod_ifmodule'] == 'No' && ! strpos( $check_string, "BPS mod_access_compat" ) ) {
				@copy($denyall_htaccess, $file);
			}
		}
	
		if ( esc_html($_SERVER['QUERY_STRING']) == 'page=bulletproof-security/admin/wizard/wizard.php' ) {
			
			if ( $Apache_Mod_options['bps_apache_mod_ifmodule'] == 'Yes' ) {
				
				echo '<font color="green"><strong>'.__('mod_authz_core is Loaded|Order, Allow, Deny directives are supported|BC: Yes|IfModule: Yes', 'bulletproof-security').'</strong></font><br>';
			
			} elseif ( $Apache_Mod_options['bps_apache_mod_ifmodule'] == 'No' ) {
				
				echo '<font color="green"><strong>'.__('mod_access_compat is Loaded|Order, Allow, Deny directives are supported|IfModule: No', 'bulletproof-security').'</strong></font><br>';

			}
		}
	}
}

?>