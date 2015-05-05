<?php
// Direct calls to this file are Forbidden when core files are not present 
if ( ! current_user_can('manage_options') ) { 
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}
	
	/**	AutoMagic, Setup Steps & Other Help Info **/
	$bps_modal_content1 = '<strong>'.__('Automated Setup Steps:', 'bulletproof-security').'</strong><br>'.__('1. Go to the Setup Wizard page and click the Setup Wizard button.', 'bulletproof-security').'<br><br><strong>'.__('Manual Setup Steps:', 'bulletproof-security').'</strong><br><strong>'.__('htaccess Core htaccess Files Manual Setup Steps', 'bulletproof-security').'</strong><br>'.__('1. Click the ','bulletproof-security').'<strong>'.__('Create default.htaccess File ','bulletproof-security').'</strong>'.__('button.', 'bulletproof-security').'<br>'.__('2. Click the ','bulletproof-security').'<strong>'.__('Create secure.htaccess File ','bulletproof-security').'</strong>'.__('button.', 'bulletproof-security').'<br>'.__('3. Select the Activate Root Folder BulletProof Mode Radio button and click the Activate|Deactivate button.', 'bulletproof-security').'<br>'.__('4. Select the Activate wp-admin Folder BulletProof Mode Radio button and click the Activate|Deactivate button.', 'bulletproof-security').'<br><br><strong>'.__('AutoMagic Buttons', 'bulletproof-security').'</strong><br>'.__('Clicking the AutoMagic buttons: Create default.htaccess File and Create secure.htaccess File creates customized htaccess Master Files for your website type - Single/Standard site types or Network/Multisite site types. BPS detects your site type and displays the correct AutoMagic buttons for your site type. Single/Standard site types are all WordPress installation types that are not Network/Multisite installations of WordPress. Network/Multisite site types are all Network/Multisite Subdirectory/Subdomain WordPress installation site types.', 'bulletproof-security').'<br><br><strong>'.__('Activate|Deactivate Root Folder BulletProof Mode (RBM)', 'bulletproof-security').'</strong><br>'.__('Activating Root Folder BulletProof Mode copies the secure.htaccess file that you created by clicking the Create secure.htaccess File AutoMagic button to your WordPress installation folder and renames the file to .htaccess. Deactivating Root Folder BulletProof Mode (Default Mode) copies the default.htaccess file that you created by clicking Create default.htaccess File AutoMagic button to your WordPress installation folder and renames the file to .htaccess. Default Mode does not have any security protection - it is just a standard generic WordPress htaccess file that you should only use for testing or troubleshooting purposes.', 'bulletproof-security').'<br><br><strong>'.__('Activate|Deactivate wp-admin Folder BulletProof Mode (WBM)', 'bulletproof-security').'</strong><br>'.__('Activating wp-admin Folder BulletProof Mode copies a BPS pre-made wp-admin htaccess file that works for all site types to the WordPress wp-admin folder.  Deactivating wp-admin Folder BulletProof Mode deletes the htaccess file in your wp-admin folder.', 'bulletproof-security').'<br><br><strong>'.__('Enable|Disable wp-admin BulletProof Mode (GDMW Hosting)', 'bulletproof-security').'</strong><br>'.__('This option is ONLY for Hosts that do not allow .htaccess files in the wp-admin folder. Go Daddy Managed WordPress Hosting (not standard Go Daddy Hosting) is the only known hosting account type where this option should be set to: Disable wp-admin BulletProof Mode. For everyone else you do not need to use this option. The default setting is already set to: Enable wp-admin BulletProof Mode.', 'bulletproof-security').'<br><br><strong>'.__('Additional (Automated) BulletProof Modes - Manual Controls', 'bulletproof-security').'</strong><br>'.__('BPS Master and BPS Backup folder BulletProof Modes are activated automatically unless your Server does not allow that. You can manually activate the Deny All BulletProof Modes.', 'bulletproof-security').'<br>'.__('1. Activate Master htaccess BulletProof Mode.', 'bulletproof-security').'<br>'.__('2. Activate BPS Backup BulletProof Mode.','bulletproof-security').'<br><br><strong>'.__('Inpage Status Display', 'bulletproof-security').'</strong><br>'.__('The Inpage Status Display displays at the top of the BPS plugin pages and displays the current BPS version installed & clickable links to pages: Root Folder BulletProof Mode (RBM), wp-admin Folder BulletProof Mode (WBM), Login Security & Monitoring (LSM) and Database Backup (DBB). The Inpage Status Display performs checks and displays the status of BPS features, options and your site security in real-time. The Inpage Status Display automatically turns itself off when a Form is submitted using POST and displays a Reload BPS Status Display button. Clicking the Reload BPS Status Display button reloads|displays the Inpage Status Display again. The Inpage Status Display can be turned Off on the Security Status tab page by selecting Turn Off Status Display and clicking the Save Option button.', 'bulletproof-security').'<br><br><strong>'.__('Reset|Recheck Dismiss Notices','bulletproof-security').'</strong><br>'.__('To Reset|Recheck Dismiss Notices go to the Security Status tab page and click the Reset|Recheck button. Clicking this button resets ALL Dismiss Notices such as Bonus Code Dismiss Notices and ALL other Dismiss Notices. If you previously dismissed a Dismiss Notice and want to display it again at a later time, click the Reset|Recheck button.', 'bulletproof-security').'<br><br><strong>'.__('NOTES: ', 'bulletproof-security').'</strong><br><strong>'.__('Testing, Troubleshooting & Checking the Status of htaccess Files', 'bulletproof-security').'</strong><br>'.__('Click the Security Status tab to check the status of all of your htaccess files.', 'bulletproof-security').'<br><br>'.__('BPS has built-in troubleshooting capability - all features can be turned Off/On independently. Deactivating/activating or uninstalling/reinstalling the BPS Pro plugin is not the correct way to troubleshoot issues or problems. See the BPS Troubleshooting Steps link at the top of this Read Me help file.', 'bulletproof-security').'<br><br>'.__('Your BPS Security Log logs anything that BPS is blocking - hackers, spammers or something legitimate in another plugin or theme. If you are testing BPS to determine if there is a plugin conflict or other conflict then Deactivate Root Folder BulletProof Mode (Default Mode) and Deactivate wp-admin Folder BulletProof.This overwrites all BPS security code with the standard default WP htaccess code. This puts your site in a standard WordPress state with a default or generic Root htaccess file and no htaccess file in your wp-admin folder if you selected Delete wp-admin htaccess file. After testing or troubleshooting is completed activate BulletProof Modes for both the Root and wp-admin folders.', 'bulletproof-security').'<br><br><strong>'.__('Editing, Modifying or Testing htaccess Code', 'bulletproof-security').'</strong><br>'.__('If you would like to view, edit or add any additional htaccess code directly into your new secure.htaccess Master file use the htaccess File Editor and click on the secure.htaccess menu tab and make your editing changes before you Activate BulletProof Mode for your Root folder. It is recommended that you use BPS Custom Code to save any custom code permanently instead of adding it directly into your secure.htaccess file or your actual active root htaccess file.', 'bulletproof-security').'<br><br><strong>'.__('WordPress Network (Multisite) Sites Info','bulletproof-security').'</strong><br>'.__('BPS will automatically detect whether you have a subdomain or subdirectory Network (Multisite) installation and create the correct htaccess code for your website type. The BPS plugin can be Network Activated or you can allow the BPS plugin to be activated individually on each Network/Multisite subsite or of course you can choose not to Network Activate BPS or allow the BPS plugin on subsites. Super Admins will see BPS Dashboard Alerts and other Status displays on the Primary Site only. Administrators can activate or deactivate BPS on subsites, if you allow this on your Network/Multisite.', 'bulletproof-security').'<br><br>'.__('If you activate BulletProof Mode for your Root folder you should also activate BulletProof Mode for your wp-admin folder. On some Hosts that is required and on other Hosts that is not required for everything to work correctly.', 'bulletproof-security').'<br><br><strong>'.__('BPS Video Tutorial links can be found in the Help & FAQ pages.', 'bulletproof-security').'</strong>';
	
	/** Additional (Automated) BulletProof Modes - BPS Master htaccess Folder & BPS Backup Folder **/
	$bps_modal_content6 = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)','bulletproof-security').'</strong><br><br><strong>'.__('Activate Master htaccess BulletProof Mode', 'bulletproof-security').'</strong><br>'.__('Your BPS Master htaccess folder should already be automatically protected by BPS, but if it is not then activate BulletProof Mode for your BPS Master htaccess folder. Activating Master htaccess BulletProof Mode copies and renames the deny-all.htaccess file located in the /bulletproof-security/admin/htaccess/ folder and renames it to just .htaccess to protect this folder. This Deny All htaccess file blocks everyone, except for you, from accessing and viewing the BPS Master htaccess files folder.','bulletproof-security').'<br><br><strong>'.__('Activate BPS Backup BulletProof Mode', 'bulletproof-security').'</strong><br>'.__('Your BPS Backup folder should already be automatically protected by BPS, but if it is not then activate BulletProof Mode for your BPS Backup folder. Activating BPS Backup BulletProof Mode copies and renames the deny-all.htaccess file located in the /bulletproof-security/admin/htaccess/ folder to the BPS Backup folder /','bulletproof-security').$bps_wpcontent_dir.__('/bps-backup and renames it to just .htaccess to protect this folder. This Deny All htaccess file blocks everyone, except for you, from accessing and viewing your BPS Backup folder.','bulletproof-security').'<br><br><strong>'.__('BPS Video Tutorial links can be found in the Help & FAQ pages.','bulletproof-security').'</strong>';
	
	/** htaccess File Backup & Restore**/	
	$bps_modal_content10 = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)','bulletproof-security').'</strong><br><br>'.__('The Backup and Restore tools can be used to quickly backup and restore the root and wp-admin htaccess files. Example usage: You are testing some code and want to save copies of your working root and wp-admin htaccess files so that you can quickly restore them. It is not necessary to create backups of the root and wp-admin htaccess files. These tools should just be used as stated above.','bulletproof-security').'<br><br><strong>'.__('BPS Video Tutorial links can be found in the Help & FAQ pages.','bulletproof-security').'</strong>';	

	/** File Editing **/
	$bps_modal_content14 = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)','bulletproof-security').'</strong><br><br><strong>'.__('Lock|Unlock .htaccess Files','bulletproof-security').'</strong><br>'.__('If your Server API is using CGI then you will see Lock and Unlock buttons to lock your Root htaccess file with 404 Permissions and unlock your root htaccess file with 644 Permissions. If your Server API is using CLI - DSO/Apache/mod_php then you will not see lock and unlock buttons. 644 Permissions are required to write to/edit the root htaccess file. Once you are done editing your root htaccess file use the lock button to lock it with 404 Permissions. 644 Permissions for DSO are considered secure for DSO because of the different way that file security is handled with DSO.','bulletproof-security').'<br><br>'.__('If your Root htaccess file is locked and you try to save your editing changes you will see a pop message that your Root htaccess file is locked. You will need to unlock your Root htaccess file before you can save your changes.','bulletproof-security').'<br><br><strong>'.__('Turn On AutoLock|Turn Off AutoLock','bulletproof-security').'</strong><br>'.__('AutoLock is designed to automatically lock your root .htaccess file to save you an additional step of locking your root .htaccess file when performing certain actions, tasks or functions and AutoLock also automatically locks your root .htaccess during BPS upgrades. This can be a problem for some folks whose Web Hosts do not allow locking the root .htaccess file with 404 file permissions and can cause 403 errors and/or cause a website to crash. For 99.99% of folks leaving AutoLock turned On will work fine. If your Web Host ONLY allows 644 file permissions for your root .htaccess file then click the Turn Off AutoLock button. This turns Off AutoLocking for all BPS actions, tasks, functions and also for BPS upgrades.','bulletproof-security').'<br><br><strong>'.__('The File Editor is designed to open all of your htaccess files simultaneously and allow you to copy and paste from one window (file) to another window (file), BUT you can ONLY save your edits for one file at a time. Whichever file you currently have opened (the tab that you are currently viewing) when you click the Update File button is the file that will be updated/saved.','bulletproof-security').'</strong><br><br>'.__('Help links and Video Tutorial links are provided on the Help & FAQ page ','bulletproof-security');

	/** Custom Code - Network/Multisite specific **/
	if ( is_multisite() ) {
	$network_cc_help = '<br><br><strong>'.__('CUSTOM CODE WP REWRITE LOOP END: Add WP Rewrite Loop End code here','bulletproof-security').'</strong><br>'.__('This is a Special Network/Multisite Custom Code text box that should ONLY be used if the correct WP REWRITE LOOP END code is not being created in your root .htaccess file by AutoMagic. If you have a Network/Multisite site that is installed in an unusual way/has an unusual folder structure then what seems to work best in these cases is to delete any folder paths/names and the trailing slash: "delete-this-folder-name/" that you see in these 2 example RewriteRules: ', 'bulletproof-security').'RewriteRule ^[_0-9a-zA-Z-]+/(wp-(content|admin|includes).*) delete-this-folder-name/$1 [L] RewriteRule ^[_0-9a-zA-Z-]+/(.*\.php)$ delete-this-folder-name/$1 [L] '.__('Typically this problem is caused by not being able to get the correct folder/directory structure for the website. This is very rare, but can happen on unusual Network/Multisite setups with unusual folder structures.', 'bulletproof-security');	
	} else {
	$network_cc_help = '';	
	}

	/** Custom Code **/
	$bps_modal_content16 = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)','bulletproof-security').'</strong><br><br><strong>'.__('Custom Code General Help Information', 'bulletproof-security').'</strong><br><br>'.__('ONLY add valid htaccess code into these text areas/text boxes. If you want to add regular text instead of .htaccess code then you will need to add a pound sign # in front of the text to comment it out. If you do not do this then the next time you use AutoMagic and activate BulletProof Mode for your Root folder or your wp-admin folder your website WILL crash.', 'bulletproof-security').'<br><br>'.__('For Custom Code text boxes the require that you copy the entire section of code that you want to edit and modify you will see this blue help text - ', 'bulletproof-security').'<strong><font color="blue">'.__('"You MUST copy and paste the entire xxxxx section of code from your root .htaccess file into this text box first. You can then edit and modify the code in this text window and save your changes."', 'bulletproof-security').'</font></strong><br><br><strong>'.__('If you do not copy the entire section of code into a text box that requires this then the next time you use AutoMagic and activate BulletProof Mode for your Root folder or your wp-admin folder your website WILL crash.', 'bulletproof-security').'</strong><br><br><strong>'.__('If your website crashes after adding custom code: FTP to your website or use your web host control panel file manager and delete the root .htaccess file or the wp-admin file or both files if necessary. Log back into your website and correct/fix the invalid/incorrect custom htaccess code that was added in any of the Custom Code text boxes, save your changes, click the AutoMagic buttons on the Security Modes page and activate BulletProof Modes again.', 'bulletproof-security').'</strong><br><br>'.__('Your Custom Code is saved permanently to your WordPress Database until you delete it and will not be removed or deleted when you upgrade BPS.','bulletproof-security').'<br><br><strong>'.__('Root htaccess File Custom Code Setup Steps', 'bulletproof-security').'</strong><br>'.__('1. Enter your custom code in the appropriate Root Custom Code text box.', 'bulletproof-security').'<br>'.__('2. Click the Save Root Custom Code button to save your Root custom code.', 'bulletproof-security').'<br>'.__('3. Go to the Security Modes page and click the Create secure.htaccess File AutoMagic button.', 'bulletproof-security').'<br>'.__('4. Select the Activate Root Folder BulletProof Mode Radio button and click the Activate|Deactivate button.', 'bulletproof-security').'<br><br><strong>'.__('CUSTOM CODE TOP PHP/PHP.INI HANDLER/CACHE CODE:', 'bulletproof-security').'<br>'.__('Add php/php.ini handler code, cache code and/or Speed Boost Cache Code here', 'bulletproof-security').'</strong><br>'.__('ONLY add valid php/php.ini handler htaccess code and/or cache htaccess code or text commented out with a pound sign #.','bulletproof-security').'<br><br><strong>'.__('CUSTOM CODE TURN OFF YOUR SERVER SIGNATURE:', 'bulletproof-security').'</strong><br>'.__('You MUST copy and paste the entire TURN OFF YOUR SERVER SIGNATURE section of code from your root .htaccess file into this text box first. You can then edit and modify the code in this text window and save your changes.','bulletproof-security').'<br><br><strong>'.__('CUSTOM CODE DO NOT SHOW DIRECTORY LISTING/DIRECTORY INDEX:','bulletproof-security').'</strong><br>'.__('You MUST copy and paste the entire DO NOT SHOW DIRECTORY LISTING and DIRECTORY INDEX sections of code from your root .htaccess file into this text box first. You can then edit and modify the code in this text window and save your changes.','bulletproof-security').'<br><br><strong>'.__('CUSTOM CODE BRUTE FORCE LOGIN PAGE PROTECTION:','bulletproof-security').'</strong><br>'.__('This Custom Code text box is for optional/Bonus code. To get this code go to this link: http://forum.ait-pro.com/forums/topic/protect-login-page-from-brute-force-login-attacks/. CAUTION! This code has a 95%/5% success/fail ratio meaning that this code will not work on 5% of websites. If you see a 403 error when logging out and logging into your website then you cannot use this code on your website and will need to delete this code to correct the 403 error when logging out and logging into your website.','bulletproof-security').'<br><br><strong>'.__('CUSTOM CODE ERROR LOGGING AND TRACKING:','bulletproof-security').'</strong><br>'.__('You MUST copy and paste the entire ERROR LOGGING AND TRACKING section of code from your root .htaccess file into this text box first. You can then edit and modify the code in this text window and save your changes.','bulletproof-security').'<br><br><strong>'.__('CUSTOM CODE DENY ACCESS TO PROTECTED SERVER FILES AND FOLDERS:', 'bulletproof-security').'</strong><br>'.__('You MUST copy and paste the entire DENY ACCESS TO PROTECTED SERVER FILES AND FOLDERS section of code from your root .htaccess file into this text box first. You can then edit and modify the code in this text window and save your changes.', 'bulletproof-security').'<br><br><strong>'.__('CUSTOM CODE WP-ADMIN/INCLUDES: DO NOT add wp-admin .htaccess file code here', 'bulletproof-security').'</strong><br>'.__('Add one pound sign # in this text box to prevent the WP-ADMIN/INCLUDES section of code from being created in your root .htaccess file.','bulletproof-security').'<br><br><strong>'.__('CUSTOM CODE WP REWRITE LOOP START: Add www to non-www/non-www to www code here', 'bulletproof-security').'</strong><br>'.__('You MUST copy and paste the entire WP REWRITE LOOP START section of code from your root .htaccess file into this text box first. You can then edit and modify the code in this text window and save your changes.','bulletproof-security').'<br><br><strong>'.__('CUSTOM CODE REQUEST METHODS FILTERED: Whitelist User Agents or remove HEAD here', 'bulletproof-security').'</strong><br>'.__('You MUST copy and paste the entire REQUEST METHODS FILTERED section of code from your root .htaccess file into this text box first. You can then edit and modify the code in this text window and save your changes.','bulletproof-security').'<br><br><strong>'.__('CUSTOM CODE PLUGIN/THEME SKIP/BYPASS RULES:','bulletproof-security').'</strong><br>'.__('ONLY add valid htaccess code or text commented out with a pound sign #. This text area is for plugin fixes that are specific to your website. BPS already has some plugin skip/bypass rules included in the Root htaccess file by default. Adding additional plugin skip/bypass rules for your plugins on your website goes in this text box. There are 12 default skip rules in the standard BPS root htaccess file already. Skip rules MUST be in descending consecutive number order: 15, 14, 13... If you add one plugin skip/bypass rule in this text box it should be skip rule #13. For each additional plugin skip rule that you add the S= skip number is increased by one. Example: if you add 3 plugin skip rules in this text box they would be Skip rules #15, #14 and #13 - RewriteRule . - [S=15] and RewriteRule . - [S=14] and RewriteRule . - [S=13] in descending consecutive order', 'bulletproof-security').'<br><br><strong>'.__('CUSTOM CODE TIMTHUMB FORBID RFI and MISC FILE SKIP/BYPASS RULE:','bulletproof-security').'</strong><br>'.__('You MUST copy and paste the entire TIMTHUMB FORBID RFI section of code from your root .htaccess file into this text box first. You can then edit and modify the code in this text window and save your changes.','bulletproof-security').'<br><br><strong>'.__('CUSTOM CODE BPSQSE BPS QUERY STRING EXPLOITS:','bulletproof-security').'</strong><br>'.__('You MUST copy and paste the entire BPSQSE QUERY STRING EXPLOITS section of code from your root .htaccess file from # BEGIN BPSQSE BPS QUERY STRING EXPLOITS to # END BPSQSE BPS QUERY STRING EXPLOITS into this text box first. You can then edit and modify the code in this text window and save your changes.', 'bulletproof-security').$network_cc_help.'<br><br><strong>'.__('CUSTOM CODE DENY BROWSER ACCESS TO THESE FILES:','bulletproof-security').'</strong><br>'.__('You MUST copy and paste the entire DENY BROWSER ACCESS section of code from your root .htaccess file into this text box first. You can then edit and modify the code in this text window and save your changes.', 'bulletproof-security').'<br><br><strong>'.__('CUSTOM CODE BOTTOM HOTLINKING/FORBID COMMENT SPAMMERS/BLOCK BOTS/BLOCK IP/REDIRECT CODE: Add miscellaneous code here','bulletproof-security').'</strong><br>'.__('This Custom Code text box is for any/all personal custom code that you have created or want to use that is not standard BPS htaccess code. ONLY add valid htaccess code below or text commented out with a pound sign # You can save any miscellaneous custom htaccess code here as long as it is valid htaccess code or if it is just plain text then you will need to comment it out with a pound sign # in front of the text.', 'bulletproof-security').'<br><br><strong>'.__('wp-admin htaccess File Custom Code Steps','bulletproof-security').'</strong><br>'.__('1. Enter your custom code in the appropriate wp-admin Custom Code text box.', 'bulletproof-security').'<br>'.__('2. Click the Save wp-admin Custom Code button to save your wp-admin custom code.', 'bulletproof-security').'<br>'.__('3. Go to the Security Modes page, select the Activate wp-admin Folder BulletProof Mode Radio button and click the Activate|Deactivate button.', 'bulletproof-security').'<br><br><strong>'.__('CUSTOM CODE BPS WPADMIN DENY ACCESS TO FILES:','bulletproof-security').'<br>'.__('Add additional wp-admin files that you would like to block here','bulletproof-security').'</strong><br>'.__('You MUST copy and paste the entire WPADMIN DENY BROWSER ACCESS TO FILES section of code from your wp-admin .htaccess file into this text box first. You can then edit and modify the code in this text window and save your changes. Add one pound sign # below to prevent the WPADMIN DENY BROWSER ACCESS TO FILES section of code from being created in your wp-admin .htaccess file.', 'bulletproof-security').'<br><br><strong>'.__('CUSTOM CODE WPADMIN TOP:','bulletproof-security').'<br>'.__('Add wp-admin password protection, IP whitelist allow access & miscellaneous custom code here','bulletproof-security').'</strong><br>'.__('ONLY add valid htaccess code below or text commented out with a pound sign # You can save any miscellaneous custom htaccess code here as long as it is valid htaccess code or if it is just plain text then you will need to comment it out with a pound sign # in front of the text.','bulletproof-security').'<br><br><strong>'.__('CUSTOM CODE WPADMIN PLUGIN/FILE SKIP RULES:','bulletproof-security').'<br>'.__('Add wp-admin plugin/file skip rules code here','bulletproof-security').'</strong><br>'.__('ONLY add valid htaccess code below or text commented out with a pound sign #. There is currently one default skip rule [S=1] in the standard BPS wp-admin htaccess file already. Skip rules MUST be in descending consecutive number order: 4, 3, 2... If you add one plugin skip/bypass rule in this text box it will be skip rule #2. For each additional plugin skip rule that you add the S= skip number is increased by one. Example: if you add 3 plugin skip rules in this text box they would be Skip rules #4, #3 and #2 - RewriteRule . - [S=4] and RewriteRule . - [S=3] and RewriteRule . - [S=2] in descending consecutive order.','bulletproof-security').'<br><br><strong>'.__('CUSTOM CODE BPSQSE-check BPS QUERY STRING EXPLOITS AND FILTERS:','bulletproof-security').'<br>'.__('Modify wp-admin Query String Exploit code here','bulletproof-security').'</strong><br>'.__('You MUST copy and paste the entire BPS QUERY STRING EXPLOITS section of code from your wp-admin .htaccess file from # BEGIN BPSQSE-check BPS QUERY STRING EXPLOITS AND FILTERS to # END BPSQSE-check BPS QUERY STRING EXPLOITS AND FILTERS into this text box first. You can then edit and modify the code in this text window and save your changes.','bulletproof-security').'<br><br><strong>'.__('BPS Video Tutorial links can be found in the Help & FAQ pages.','bulletproof-security').'</strong>';

?>