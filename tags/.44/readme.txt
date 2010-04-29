=== BulletProof Security ===
Contributors: Edward Alexander
Donate link: http://www.ait-pro.com/aitpro-blog/bulletproof-security-plugin-support/bulletproof-security-master-sponsor-page-ebay-ipod-mp3-players/
Tags: bulletproof, security, secure, htaccess, chmod, maintenance, plugin, private, protection, permissions 
Requires at least: 2.8
Tested up to: 2.9.2
Stable tag: .44

Fast one click switching between secure .htaccess security modes and maintenance mode from within the Dashboard. 

== Description ==

The BulletProof Security plugin is designed to be a fast, simple and convenient one click method for you to
switch between different levels of .htaccess website security and .htaccess maintenance modes from within
your WordPress Dashboard. The BulletProof Security WordPress plugin is a one click solution that simply copies,
renames and moves the provided .htaccess files in the BulletProof Security plugin folder to either your root
folder or your wp-admin folder or both from within your WordPress Dashboard.  There is no need to access your
website via FTP or your Web Host Control Panel in order to switch between BulletProof Security Maintenance Mode
(Website Under Maintenance), WordPress Default .htaccess Mode and  BulletProof Security .htaccess Mode.
In BulletProof Security Mode your WordPress website is protected from ALL XSS and SQL Injection hacking attacks.
The maintenance .htaccess file allows website developers or website owners to access and work on a website while
a Website Under Maintenance page is displayed to all other visitors to the website.  

* One-click security mode switching in less than 5 seconds from within the Dashboard
* Secure .htaccess file blocks XSS and SQL Injection attacks
* Website Developer Maintenance Mode (Site open to Developer / Site Owner ONLY)
* File and Folder Permission Checking
* Customizable Under Maintenance Page w/Javascript countdown timer
* Extensive Read Me! help hover ToolTips throughout the BulletProof plugin page

== Installation ==

1. Upload bulletproof-security directory (including all files within) to the /wp-content/plugins directory
1. Activate the plugin through the Plugins menu in WordPress
1. You will need to add your WordPress installation folder name to the 3 .htaccess files provided with
1. BulletProof Security ONLY if your WordPress installation is NOT installed in your root folder (ie WordPress
1. is installed in a subfolder named /blog). If your WordPress installation is in your root folder than
1. you DO NOT need to edit anything.

== Frequently Asked Questions ==

= How does the BulletProof Security Plugin work? =

The BulletProof Security Plugin is a secure radio button form with options
that you select for what level of .htaccess security you want for your root
and /wp-admin folders. You can switch between (enable) all available modes
- default .htacces security, bulletproof .htaccess security and maintenance modes
in less than 5 seconds - ALL from within your WordPress Dashboard - No need to
access your site via FTP or your web host Control Panel to do anything more. 

= Are there any known conflicts with other WordPress Plugins? =

BulletProof Security has been tested with over 100 WordPress plugins and no
conflicts have been found. BulletProof is a backend form that uses a few core
WordPress files to process the form selections you choose so there should be
no reason for BulletProof to conflict with any other frontend or backend plugins. 

= Can I add my own .htaccess code to the BulletProof .htaccess files? =

Yes.  Of course. The secure.htaccess BulletProof file contains .htaccess
code that protects your website against XSS (Cross Site Scripting) and SQL Injection
hacking attacks. Add your own additional .htaccess code to the Master .htaccess
files to make them even more BulletProof to hackers. The WordPress core app is already
very secure, but if by some chance custom coding or "dirty" code is added to your
website you could have a vulnerability that can be exploited. When your website is
in BulletProof Secure Mode it does not matter if you have "dirty" code somewhere
on your website because it cannot be exploited if the BulletProof secure .htaccess
file is enabled.

= Does the BulletProof Plugin create or write the .htaccess files? =

No. The .htaccess files have already been created so you can just add more code
to them or create completely new .htaccess master files if you want. BulletProof
is designed to handle copying, renaming and moving the .htaccess files. BulletProof
Security Pro (release date TBA) does perform file writing.

== Screenshots ==

1. Main BulletProof Security Options page
2. Read Me! hover ToolTips
3. BulletProof Secure .htaccess file screenshot
4. File and Folder Permissions Checker

== Changelog ==

= .44 =
* First version release of BulletProof Security
* Extensive Read Me! help hover ToolTips added to the BulletProof plugin page
* Visual and coding Enhancements made to the BulletProof Maintenance page
* Function check_perm redeclare conflict fixed

== Upgrade Notice ==

New release of BulletProof Security. Next Release will contain a restore default settings option.