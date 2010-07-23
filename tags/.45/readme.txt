=== BulletProof Security ===
Contributors: Edward Alexander
Donate link: http://www.ait-pro.com/aitpro-blog/bulletproof-security-plugin-support/bulletproof-security-master-sponsor-page-ebay-ipod-mp3-players/
Tags: bulletproof, security, secure, htaccess, chmod, maintenance, plugin, private, privacy, protection, permissions, 503 
Requires at least: 2.8
Tested up to: 3.0
Stable tag: .45

Fast one click switching between secure .htaccess security modes and maintenance mode from within the Dashboard. 

== Description ==

The BulletProof Security plugin is designed to be a fast, simple and convenient one click method for you to
switch between different levels of .htaccess website security and .htaccess maintenance modes from within
your WordPress Dashboard. The BulletProof Security WordPress plugin is a one click solution that simply copies,
renames and moves the provided .htaccess master files in the BulletProof Security plugin folder to either your root
folder or your /wp-admin folder or both from within your WordPress Dashboard.

There is no need to access your website via FTP or your Web Host Control Panel in order to switch between
BulletProof Security Maintenance Mode(503 Website Under Maintenance), WordPress Default .htaccess Mode and
BulletProof Security .htaccess Mode. In BulletProof Security Mode your WordPress website is protected from
ALL XSS and SQL Injection hacking attacks. The maintenance .htaccess file allows website developers or
website owners to access and work on a website while a 503 Website Under Maintenance page is displayed to
all other visitors to the website.

WordPress is already very secure, but every website, no matter what type of platform it is built on should
be using a secure .htaccess file as a standard website security measure.
The maintenance mode - 503 "Website Under Maintenance" - was originally added as an afterthought, but has proven 
to be a huge time saver for me personally as a website developer.

BulletProof Security .45 - BPS .45 has new additional security measures and features added, plus a new system
information page. BPS .45 now looks like a complete security and system information command center wrapped up
in a nice looking package. Enjoy!
  
* If you are upgrading from a previous version - download the existing BulletProof /htaccess folder and /backup
folder first before upgrading if you made customizations or modifications to any of the BPS files. 
* NEW jQuery UI Tabbed Menu with CSS Hover Menu Buttons - see screenshot
* NEW Message Display System
* NEW v wp-config.php is .htaccess protected by BPS .45 - new code in the .htaccess files
* NEW v WordPress Database Errors Are Turned Off - Verification of DB errors off and function insurance
* NEW v WordPress Version Is Not Displayed / Not Shown - WordPress version is removed
* NEW v WP Generator Meta Tag Removed From The WordPress Core
* NEW v The Administrator username “admin” is not being used - check for admin username
* NEW System Information Page PHP, MySQL, Server Info, etc. - see screenshot
* NEW Security Status Page - see screenshot
* NEW Help & FAQ page
* NEW BPS Pro Modules Page - BPS Pro Modules are installed separately
* Backup and Restore your original existing .htaccess files
* Use the provided BulletProof .htaccess files or create your own .htaccess files for BulletProof Security to manage for you 
* One-click security mode switching in less than 5 seconds from within the Dashboard
* Secure .htaccess file blocks XSS and SQL Injection attacks
* Website Developer Maintenance Mode (503 Site open to Developer / Site Owner ONLY)
* File and Folder Permission Checking
* Customizable 503 Website Under Maintenance Page w/Javascript countdown timer
* Extensive Read Me! help hover ToolTips throughout the BulletProof Security plugin options page

== Installation ==

1. If you are downloading the zip file from the WordPress Plugin Directory.
2. Download the bulletproof-security.zip file to your computer and unzip it.
3. Upload the bulletproof-security folder (including all files within) to your /wp-content/plugins folder.
4. Activate the BulletProof Security plugin.
5. Activating BulletProof Security DOES NOT enable any of the BulletProof Security .htaccess modes.
6. BulletProof .45 includes Backup and Restore. Back up your existing .htaccess files first before enabling any BulletProof Security Modes.
7. To enable BulletProof Security modes, click on the Settings link shown uder BulletProof Security in your Plugins Options page.
8. Click on the Read Me First link at the top of the BulletProof Security Settings page. Enjoy!

== Frequently Asked Questions ==

= How does the BulletProof Security Plugin work? =

The BulletProof Security Plugin is a secure radio button form with options
that you select for what level of .htaccess security you want for your root
and /wp-admin folders. You can switch between (enable) all available modes
- default .htacces security, bulletproof .htaccess security and maintenance modes
in less than 5 seconds - ALL from within your WordPress Dashboard - No need to
access your site via FTP or your web host Control Panel to do anything more. 

= Are there any known conflicts with other WordPress Plugins? =

Yes. There is one known conflict with the Ozh' plugin. BulletProof has been
tested with over 1000+ WordPress plugins. 

= Can I add my own .htaccess code to the BulletProof .htaccess files? =

Yes.  Of course. The secure.htaccess BulletProof file contains .htaccess
code that protects your website against ALL XSS (Cross Site Scripting) and SQL Injection
hacking attacks. Add your own additional .htaccess code to the master .htaccess
files to make them even more BulletProof to hackers.

= Does the BulletProof Plugin create or write the .htaccess files? =

No. The .htaccess files have already been created so you can just add more code
to them or create completely new .htaccess master files if you want and just use BulletProof
to manage them for you. BulletProof is designed to handle copying, renaming and moving of
the .htaccess files. BPS Pro does perform file writing from the Dashboard.

== Screenshots ==

1. BulletProof Security Modes page
2. BulletProof Security Status page
3. BulletProof System Information page

== Changelog ==

= .45 =
* Completely recoded with WordPress 3.0 coding enhancements and improvements
* Completely new sophisticated visual design and look
* jQuery UI Tabbed Menu with CSS Hover Menu Buttons - see screenshot
* New Messaging Display System added
* ,htaccess code added to master files to .htaccess protect wp-config.php
* WordPress DB error on / off checking and verification status display
* WordPress version is not displayed - remove_action('wp_head', 'wp_generator');
* WP generator meta tag removed - remove_action('wp_head', 'wp_generator');
* Administrator username “admin” check
* System information page displays PHP, MySQL, Server Info, etc. - see screenshot
* Security Status page added - see screenshot
* Help & FAQ page added
* BPS Pro Modules page added - BPS Pro Modules are installed separately
* New BPS .45 Guide created @ AIT-pro.com

= .44.1 =
* If you are upgrading from .44 to .44.1 download the /htaccess folder first
* before upgrading and upload it back to the back to the BulletProof plugin folder
* after you have upgraded to .44.1.
* Added Backup form function - backs up users original existing htaccess files
* Added Restore form function - restores users original existing htaccess files
* Backup folder added for backed up original htaccess files
* Removed links from all ToolTips except for the top Read Me! hover ToolTip

= .44 =
* First version release of BulletProof Security
* Extensive Read Me! help hover ToolTips added to the BulletProof plugin page
* Visual and coding Enhancements made to the BulletProof Maintenance page
* Function check_perm redeclare conflict fixed

== Upgrade Notice ==

* Completely recoded with WordPress 3.0 coding enhancements and improvements
* Completely new sophisticated visual design and look
* NEW jQuery UI Tabbed Menu with CSS Hover Menu Buttons - see screenshot
* NEW Message Display System
* NEW v wp-config.php is .htaccess protected by BPS .45 - new code in the .htaccess files
* NEW v WordPress Database Errors Are Turned Off - Verification of DB errors off and function insurance
* NEW v WordPress Version Is Not Displayed / Not Shown - WordPress version is removed
* NEW v WP Generator Meta Tag Removed From The WordPress Core
* NEW v The Administrator username “admin” is not being used - check for admin username
* NEW System Information Page PHP, MySQL, Server Info, etc. - see screenshot
* NEW Security Status Page - see screenshot
* NEW Help & FAQ page
* NEW BPS Pro Modules Page - BPS Pro Modules are installed separately
* NEW BPS .45 Guide created @ AIT-pro.com